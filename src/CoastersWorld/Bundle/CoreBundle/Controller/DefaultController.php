<?php

namespace CoastersWorld\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $listNews = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('CoastersWorldNewsBundle:News')
            ->findTwoLatest()
        ;

        return $this->render('CoastersWorldCoreBundle:Default:index.html.twig', array(
            'listNews' => $listNews
        ));
    }
}
