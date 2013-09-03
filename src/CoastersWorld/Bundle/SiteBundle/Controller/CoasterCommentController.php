<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Form\Type\CoasterCommentType;
use CoastersWorld\Bundle\SiteBundle\Entity\CoasterComment;

class CoasterCommentController extends Controller
{
    public function newAction($id)
    {
        $coaster = $this->getCoaster($id);

        if (! $this->get('security.context')->isGranted('ROLE_USER')) {
            $uri = $this->get('router')->generate('coasters_world_database_view', array('slug' => $coaster->getSlug()), true);
            $this->getRequest()->getSession()->set('_security.secured_area.target_path', $uri);
            return $this->render('CoastersWorldSiteBundle:Security:redirectLogin.html.twig');
        }

        $comment = new CoasterComment();
        $comment->setCoaster($coaster);
        $comment->setAuthor($this->getUser());
        $form = $this->createForm(new CoasterCommentType(), $comment, array(
            'action' => $this->generateUrl('coaster_comment_create', array('id' => $id)),
            'method' => 'POST',
        ));

        return $this->render('CoastersWorldSiteBundle:Comment:edit.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    public function createAction($id)
    {
        $coaster = $this->getCoaster($id);

        $comment  = new CoasterComment();
        $comment->setCoaster($coaster);
        $comment->setAuthor($this->getUser());
        $request = $this->getRequest();
        $form    = $this->createForm(new CoasterCommentType(), $comment);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('coasters_world_database_view', array(
                'slug' => $coaster->getSlug()
            )));
        }

        return $this->render('CoastersWorldSiteBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getCoaster($id)
    {
        $em = $this->getDoctrine()->getManager();
        $coaster = $em->getRepository('CoastersWorldSiteBundle:Coaster')->find($id);

        return $coaster;
    }

}
