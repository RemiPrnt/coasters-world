<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoasterController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoastersWorldDatabaseBundle:Coaster:index.html.twig');
    }

    public function viewAction($slug)
    {
        $coaster = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('CoastersWorldDatabaseBundle:Coaster')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($coaster) == 0) {
            throw new NotFoundHttpException("No coaster was found");
        }

        return $this->render('CoastersWorldDatabaseBundle:Coaster:view.html.twig', array(
            'coaster' => $coaster
        ));
    }
}
