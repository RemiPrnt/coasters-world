<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\DatabaseBundle\Form\Type\TestType;
use CoastersWorld\Bundle\DatabaseBundle\Entity\Rating;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoasterController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoastersWorldDatabaseBundle:Coaster:index.html.twig');
    }

    public function viewAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $coaster = $em->getRepository('CoastersWorldDatabaseBundle:Coaster')
            ->findOneBy(array('slug' => $slug))
        ;

        if (count($coaster) == 0) {
            throw new NotFoundHttpException("No coaster was found");
        }

        $rating = $em->getRepository('CoastersWorldDatabaseBundle:Rating')
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

        return $this->render('CoastersWorldDatabaseBundle:Coaster:view.html.twig', array(
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
            ->from('CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster', 'c')
            ->where($qb->expr()->like('c.name', ':identifier'))
            ->setParameter('identifier', $term)
        ;

        $result = $qb->getQuery()->getArrayResult();

        return new JsonResponse($result);
    }
}
