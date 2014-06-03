<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Form\Type\CommentType;
use CoastersWorld\Bundle\SiteBundle\Entity\Comment;

class CommentController extends Controller
{
    public function newAction($id)
    {
        $article = $this->getArticle($id);

        if (! $this->get('security.context')->isGranted('ROLE_USER')) {
            $uri = $this->get('router')->generate('coasters_world_news_view', array('slug' => $article->getSlug()), true);
            $this->getRequest()->getSession()->set('_security.secured_area.target_path', $uri);
            return $this->render('CoastersWorldSiteBundle:Security:redirectLogin.html.twig');
        }

        $comment = new Comment();
        $comment->setArticle($article);
        $comment->setAuthor($this->getUser());
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('coasters_world_news_comment_create', array('id' => $id)),
            'method' => 'POST',
        ));

        return $this->render('CoastersWorldSiteBundle:Comment:edit.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    public function createAction($id)
    {
        $article = $this->getArticle($id);

        $comment  = new Comment();
        $comment->setArticle($article);
        $comment->setAuthor($this->getUser());
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('coasters_world_news_view', array(
                'slug' => $article->getSlug()
            )));
        }

        return $this->render('CoastersWorldSiteBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getArticle($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('CoastersWorldSiteBundle:Article')->find($id);

        return $article;
    }

}
