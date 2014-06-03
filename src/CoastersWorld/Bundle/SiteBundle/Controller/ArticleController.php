<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use CoastersWorld\Bundle\SiteBundle\Entity\Comment;
use CoastersWorld\Bundle\SiteBundle\Entity\Article;
use CoastersWorld\Bundle\SiteBundle\Form\Type\CommentType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends Controller
{
    public function listAction($page)
    {
        $queryNews = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findAllOrderedByDateDesc()
        ;

        $paginator = $this->get('knp_paginator');
        $listNews = $paginator->paginate(
            $queryNews,
            $page,
            5
        );
        $listNews->setTemplate('CoastersWorldSiteBundle:Article:pagination.html.twig');
        $listNews->setUsedRoute('coasters_world_news_list');

        if (count($listNews) == 0) {
            //@todo exception
        }

        return $this->render('CoastersWorldSiteBundle:Article:list.html.twig', array(
            'listNews' => $listNews
        ));
    }

    public function editAction($id = null)
    {
        if (! $this->get('security.context')->isGranted('ROLE_NEWSER')) {
            return $this->render('CoastersWorldSiteBundle:Security:redirectLogin.html.twig');
        }

        $om = $this->getDoctrine()->getManager();

        $tags = $om->getRepository('CoastersWorldSiteBundle:Tag')->findAllArray();

        if (null !== $id) {
            $news = $om->getRepository('CoastersWorldSiteBundle:Article')->find($id);
            $action = $this->generateUrl('coasters_world_news_edit', array('id' => $id));
        } else {
            $news = new Article();
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

        return $this->render('CoastersWorldSiteBundle:Article:edit.html.twig', array(
            'form' => $form->createView(),
            'news' => $news,
            'tags' => $tags,
        ));
    }

    public function viewAction($slug)
    {
        $news = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($news) == 0) {
            throw new NotFoundHttpException("No article was found");
        }

        return $this->render('CoastersWorldSiteBundle:Article:view.html.twig', array(
            'news' => $news
        ));
    }

    public function latestAction($number = 5)
    {
        $news = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findLatest($number)
        ;

        return $this->render('CoastersWorldSiteBundle:Article:sidebar.html.twig', array(
            'news' => $news,
            'title' => 'news.latest'
        ));
    }

    public function mostPopularAction($number = 5)
    {
        $news = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findMostPopular($number)
        ;

        return $this->render('CoastersWorldSiteBundle:Article:sidebar.html.twig', array(
            'news' => $news,
            'title' => 'news.popular'
        ));
    }

    public function convertMarkdownAction()
    {
        $markdown = $this->get('request')->request->get('markdown');

        return new Response($this->container->get('markdown.parser')->transformMarkdown($markdown));
    }

    public function searchAction()
    {
        $request = $this->getRequest();
        $term = $request->get('q');

        // @todo
        $term = '%' . $term . '%';

        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->searchByTitle($term)
        ;

        return new JsonResponse($qb->getQuery()->getArrayResult());
    }
}
