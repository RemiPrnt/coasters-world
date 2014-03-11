<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $listNews = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:News')
            ->findTwoLatest()
        ;

        return $this->render('CoastersWorldSiteBundle:Default:index.html.twig', array(
            'listNews' => $listNews
        ));
    }
}
