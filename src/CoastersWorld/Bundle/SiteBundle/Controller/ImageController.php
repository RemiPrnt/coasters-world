<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('CoastersWorldSiteBundle:Image')->findLatestOrderedByDateDesc(8);

        return $this->render('CoastersWorldSiteBundle:Image:list.html.twig', array(
            'images' => $images
        ));
    }

    public function uploadAction()
    {
        $image = new Image();
        $form = $this->createFormBuilder($image)
            ->setAction($this->generateUrl('coasters_world_image_upload'))
            ->setMethod('POST')
            ->add('file', 'hidden')
            ->getForm()
        ;

        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($image);
                $em->flush();

                return new Response('OK');
            }
        }

        return $this->render('CoastersWorldSiteBundle:Image:upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id)
    {
        $om = $this->getDoctrine()->getManager();
        $image = $om->getRepository('CoastersWorldSiteBundle:Image')->find($id);
        $tags = $om->getRepository('CoastersWorldSiteBundle:Tag')->findAllArray();

        $form = $this->createForm('image_type', $image, array(
            'action' => $this->generateUrl('coasters_world_image_edit', array('id' => $id)),
            'method' => 'POST',
            'om' => $om,
        ));

        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $om->persist($image);
                $om->flush();
            }
        }

        return $this->render('CoastersWorldSiteBundle:Image:edit.html.twig', array(
            'form' => $form->createView(),
            'image' => $image,
            'tags' => $tags
        ));

    }
}
