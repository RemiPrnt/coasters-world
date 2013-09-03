<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Form\Type\TestType;
use CoastersWorld\Bundle\SiteBundle\Entity\Rating;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Gloomy\PagerBundle\Pager\Wrapper\QueryBuilderWrapper;
use Gloomy\PagerBundle\Pager\Field;

class CounterController extends Controller
{
    public function listAction()
    {
        if (! $this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('login'));
        }

        $queryCoaster = $this->getDoctrine()
            ->getManager()
            ->getRepository('CoastersWorldSiteBundle:RefCoaster')
            ->findAllRiddenByUser($this->getUser())
        ;
        //$listCoaster = $queryCoaster->getResult();

        $wrapper = new QueryBuilderWrapper($queryCoaster);
        $wrapper
            ->addField(new Field('manufacturer.name', 'string', 'Manufacturer', 'm.name', array('tree' => true)), 'manufacturerName')
            ->addField(new Field('coasters.name', 'string', 'Name', 'cc.name', array('tree' => true)), 'toto')
        ;

        if (count($listCoaster) == 0) {
            //@todo exception
        }

        //var_dump($queryCoaster); exit;

        return $this->render('CoastersWorldSiteBundle:Counter:list.html.twig', array(
            'pager' => $this->get('gloomy.pager')->factory($wrapper)
        ));
    }
}
