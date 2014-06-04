<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CoasterController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoastersWorldSiteBundle:Coaster:index.html.twig');
    }

    public function viewAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $coaster = $em->getRepository('CoastersWorldSiteBundle:Coaster')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($coaster) == 0) {
            throw new NotFoundHttpException("No coaster was found");
        }

        return $this->render('CoastersWorldSiteBundle:Coaster:view.html.twig', array(
            'coaster' => $coaster
        ));
    }

    public function searchAjaxAction()
    {
        $request = $this->getRequest();
        $term = $request->query->get('q');

        // @todo
        $term = '%' . $term . '%';

        $qb = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:Coaster')
            ->searchByNameOrPark($term)
        ;

        return new JsonResponse($qb->getQuery()->getArrayResult());
    }
}
