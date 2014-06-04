<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CounterController extends Controller
{
    public function listAction($page)
    {
        if (! $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('login'));
        }

        $queryCoaster = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Coaster')
            ->findAllRiddenByUser($this->getUser())
        ;

        $paginator = $this->get('knp_paginator');
        $listCoaster = $paginator->paginate(
            $queryCoaster,
            $page,
            10
        );

        if (count($listCoaster) == 0) {
            //@todo exception
        }

        return $this->render('CoastersWorldSiteBundle:Counter:list.html.twig', array(
            'listCoaster' => $listCoaster
        ));
    }

    public function addAction($id)
    {
        if (! $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('login'));
        }

        $em = $this->getDoctrine()->getManager();

        $coaster = $em
            ->getRepository('CoastersWorldSiteBundle:Coaster')
            ->find($id)
        ;

        $user = $this->getUser();

        $coaster->addUser($user);
        $user->addCoaster($coaster);

        $em->persist($coaster);
        $em->flush();

        return $this->redirect($this->generateUrl('counter_list'));
    }
}
