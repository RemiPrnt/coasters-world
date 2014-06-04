<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use CoastersWorld\Bundle\SiteBundle\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    public function listAction($page)
    {
        $queryArticle = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findAllOrderedByDateDesc()
        ;

        $paginator = $this->get('knp_paginator');
        $articles = $paginator->paginate(
            $queryArticle,
            $page,
            5
        );
        $articles->setTemplate('CoastersWorldSiteBundle:Article:pagination.html.twig');
        $articles->setUsedRoute('coasters_world_news_list');

        if (count($articles) == 0) {
            throw new NotFoundHttpException("No article was found");
        }

        return $this->render('CoastersWorldSiteBundle:Article:list.html.twig', array(
            'articles' => $articles
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
            $article = $om->getRepository('CoastersWorldSiteBundle:Article')->find($id);
            $action = $this->generateUrl('coasters_world_news_edit', array('id' => $id));
        } else {
            $article = new Article();
            $action = $this->generateUrl('coasters_world_news_new');
        }

        $form = $this->createForm('article_type', $article, array(
            'action' => $action,
            'method' => 'POST',
            'om' => $om,
        ));

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $article->setAuthor($this->getUser());

            $article->setHtml(
                $this->container->get('markdown.parser')->transformMarkdown($article->getBody())
            );

            $om->persist($article);
            $om->flush();

            return $this->redirect($this->generateUrl('coasters_world_news_view', array('slug' => $article->getSlug())));
        }

        return $this->render('CoastersWorldSiteBundle:Article:edit.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,
            'tags' => $tags,
        ));
    }

    public function viewAction($slug)
    {
        $article = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($article) == 0) {
            throw new NotFoundHttpException("No article was found");
        }

        return $this->render('CoastersWorldSiteBundle:Article:view.html.twig', array(
            'article' => $article
        ));
    }

    public function latestAction($number = 5)
    {
        $articles = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findLatest($number)
        ;

        return $this->render('CoastersWorldSiteBundle:Article:sidebar.html.twig', array(
            'articles' => $articles,
            'title' => 'news.latest'
        ));
    }

    public function mostPopularAction($number = 5)
    {
        $articles = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Article')
            ->findMostPopular($number)
        ;

        return $this->render('CoastersWorldSiteBundle:Article:sidebar.html.twig', array(
            'articles' => $articles,
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
