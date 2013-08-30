<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Form\Type\TestType;
use CoastersWorld\Bundle\SiteBundle\Entity\Rating;
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

        $rating = $em->getRepository('CoastersWorldSiteBundle:Rating')
            ->findOneBy(array('coaster' => $coaster, 'user' => $this->getUser()))
        ;

        if (is_null($rating)) {
            $rating = new Rating();
        }

        $form = $this->createForm(new TestType(), $rating);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $rating->setCoaster($coaster);
                $rating->setUser($this->getUser());

                $em->persist($rating);

                $em->flush();

                $rate = null;
                $i = 0;
                foreach ($coaster->getRatings() as $test) {
                    $rate = $rate + $test->getValue();
                    $i++;
                }
                $rate = ($rate / $i) * 2;
                $rate = round($rate, 1);

                $coaster->setRate($rate);
                $em->persist($coaster);

                $em->flush();
            }
        }

        return $this->render('CoastersWorldSiteBundle:Coaster:view.html.twig', array(
            'coaster' => $coaster,
            'form' => $form->createView()
        ));
    }

    public function searchAjaxAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $request = $this->getRequest();
        $term = $request->query->get('q');

        $term = '%' . $term . '%';

        $qb = $em->createQueryBuilder();
        $qb
            ->select('c')
            ->from('CoastersWorld\Bundle\SiteBundle\Entity\Coaster', 'c')
            ->where($qb->expr()->like('c.name', ':identifier'))
            ->setParameter('identifier', $term)
        ;

        $result = $qb->getQuery()->getArrayResult();

        return new JsonResponse($result);
    }
}
