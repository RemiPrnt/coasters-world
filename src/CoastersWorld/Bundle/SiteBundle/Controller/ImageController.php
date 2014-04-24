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
        $images = $em->getRepository('CoastersWorldSiteBundle:Image')->findLatestOrderedByDateDesc(5);

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

    public function testAction()
    {
        echo '<pre>'; var_dump('TOTO'); exit;
    }
}
