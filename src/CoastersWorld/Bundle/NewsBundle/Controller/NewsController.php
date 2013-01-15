<?php

namespace CoastersWorld\Bundle\NewsBundle\Controller;

use CoastersWorld\Bundle\NewsBundle\Entity\News;
use CoastersWorld\Bundle\NewsBundle\Entity\Comment;
use CoastersWorld\Bundle\NewsBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class NewsController extends Controller
{
    public function listAction($page)
    {
        $queryNews = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('CoastersWorldNewsBundle:News')
            ->findAllOrderedByDateDesc()
        ;

        $paginator = $this->get('knp_paginator');
        $listNews = $paginator->paginate(
            $queryNews,
            $page,
            1
        );

        if (count($listNews) == 0) {
            //@todo exception
        }

        return $this->render('CoastersWorldNewsBundle:News:list.html.twig', array(
            'listNews' => $listNews
        ));
    }

    public function editAction($id = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if (null !== $id) {
            $news = $em->getRepository('CoastersWorldNewsBundle:News')->find($id);
        } else {
            $news = new News();
        }

        $form    = $this->createForm('news_type', $news);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($news);
                $em->flush();

                return $this->redirect($this->generateUrl('coasters_world_news_list'));
            }
        }

        return $this->render('CoastersWorldNewsBundle:News:edit.html.twig', array(
            'form' => $form->createView(),
            'news' => $news,
        ));
    }

    public function viewAction($slug)
    {
        $news = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('CoastersWorldNewsBundle:News')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($news) == 0) {
            throw new NotFoundHttpException("No news was found");
        }

        return $this->render('CoastersWorldNewsBundle:News:view.html.twig', array(
            'news' => $news
        ));
    }
}
