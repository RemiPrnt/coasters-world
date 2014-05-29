<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function searchAjaxAction()
    {
        $request = $this->getRequest();
        $term = $request->query->get('q');

        // @todo
        $term = '%' . $term . '%';

        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Image')
            ->searchByCoaster($term)
        ;

        $images = $qb->getQuery()->getArrayResult();

        $prefix = $this->container->getParameter('coastersworldPathImages');
        $return = array();

        foreach ($images as $image) {
            $tmp = $image;
            $tmp['src_thumb'] = $this->get('liip_imagine.cache.manager')->generateUrl($prefix.'/'.$image['path'], 'thumb_news');
            $tmp['src_news'] = $this->get('liip_imagine.cache.manager')->generateUrl($prefix.'/'.$image['path'], 'news');

            $return[] = $tmp;
        }

        return new JsonResponse($return);
    }
}
