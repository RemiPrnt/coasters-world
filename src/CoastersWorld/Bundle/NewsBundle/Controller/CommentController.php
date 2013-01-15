<?php

namespace CoastersWorld\Bundle\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\NewsBundle\Form\Type\CommentType;
use CoastersWorld\Bundle\NewsBundle\Entity\Comment;

class CommentController extends Controller
{
    public function newAction($id)
    {
        $news = $this->getNews($id);

        $comment = new Comment();
        $comment->setNews($news);
        $comment->setAuthor($this->getUser());
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('CoastersWorldNewsBundle:Comment:edit.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    public function createAction($id)
    {
        $news = $this->getNews($id);

        $comment  = new Comment();
        $comment->setNews($news);
        $comment->setAuthor($this->getUser());
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            //echo '<pre>'; var_dump($comment); exit;

            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('coasters_world_news_view', array(
                'slug' => $news->getSlug()
            )));
        }

        return $this->render('CoastersWorldNewsBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getNews($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $news = $em->getRepository('CoastersWorldNewsBundle:News')->find($id);

        return $news;
    }

}
