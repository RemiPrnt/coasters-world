<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use CoastersWorld\Bundle\SiteBundle\Entity\Comment;
use CoastersWorld\Bundle\SiteBundle\Entity\News;
use CoastersWorld\Bundle\SiteBundle\Form\Type\CommentType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class NewsController extends Controller
{
    public function listAction($page)
    {
        $queryNews = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:News')
            ->findAllOrderedByDateDesc()
        ;

        $paginator = $this->get('knp_paginator');
        $listNews = $paginator->paginate(
            $queryNews,
            $page,
            5
        );
        $listNews->setTemplate('CoastersWorldSiteBundle:News:pagination.html.twig');
        $listNews->setUsedRoute('coasters_world_news_list');

        if (count($listNews) == 0) {
            //@todo exception
        }

        return $this->render('CoastersWorldSiteBundle:News:list.html.twig', array(
            'listNews' => $listNews
        ));
    }

    public function editAction($id = null)
    {
        if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->render('CoastersWorldSiteBundle:Security:redirectLogin.html.twig');
        }

        $om = $this->getDoctrine()->getManager();

        $tags = $om->getRepository('CoastersWorldSiteBundle:Tag')->findAllArray();

        if (null !== $id) {
            $news = $om->getRepository('CoastersWorldSiteBundle:News')->find($id);
            $action = $this->generateUrl('coasters_world_news_edit', array('id' => $id));
        } else {
            $news = new News();
            $action = $this->generateUrl('coasters_world_news_new');
        }

        $form = $this->createForm('news_type', $news, array(
            'action' => $action,
            'method' => 'POST',
            'om' => $om,
        ));

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $news->setAuthor($this->getUser());

            $news->setHtml(
                $this->container->get('markdown.parser')->transformMarkdown($news->getBody())
            );

            $om->persist($news);
            $om->flush();

            return $this->redirect($this->generateUrl('coasters_world_news_view', array('slug' => $news->getSlug())));
        }

        return $this->render('CoastersWorldSiteBundle:News:edit.html.twig', array(
            'form' => $form->createView(),
            'news' => $news,
            'tags' => $tags,
        ));
    }

    public function viewAction($slug)
    {
        $news = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:News')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($news) == 0) {
            throw new NotFoundHttpException("No news was found");
        }

        return $this->render('CoastersWorldSiteBundle:News:view.html.twig', array(
            'news' => $news
        ));
    }

    public function latestAction($number = 5)
    {
        $latestNews = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('CoastersWorldSiteBundle:News')
                           ->findLatest($number);
        return $this->render('CoastersWorldSiteBundle:News:latest.html.twig', array(
            'latestNews' => $latestNews
        ));
    }

    public function convertMarkdownAction()
    {
        $markdown = $this->get('request')->request->get('markdown');

        return new Response($this->container->get('markdown.parser')->transformMarkdown($markdown));
    }
}
