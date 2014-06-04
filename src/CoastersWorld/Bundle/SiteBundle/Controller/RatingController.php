<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoastersWorld\Bundle\SiteBundle\Form\Type\TestType;
use CoastersWorld\Bundle\SiteBundle\Entity\Rating;

class RatingController extends Controller
{
    public function newAction($slug)
    {
        if (! $this->get('security.context')->isGranted('ROLE_USER')) {
            $uri = $this->get('router')->generate('coasters_world_database_view', array('slug' => $slug), true);
            $this->getRequest()->getSession()->set('_security.secured_area.target_path', $uri);

            return $this->render('CoastersWorldSiteBundle:Security:redirectLogin.html.twig');
        }

        $em = $this->getDoctrine()->getManager();
        $coaster = $em->getRepository('CoastersWorldSiteBundle:Coaster')
            ->findOneBy(array('slug' => $slug))
        ;
        $rating = $em->getRepository('CoastersWorldSiteBundle:Rating')
            ->findOneBy(array('coaster' => $coaster, 'user' => $this->getUser()))
        ;

        if (is_null($rating)) {
            $rating = new Rating();
        }

        $form = $this->createForm(new TestType(), $rating, array(
            'action' => $this->generateUrl('coasters_world_database_rating_new', array('slug' => $slug)),
            'method' => 'POST',
        ));

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

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
                //$rate = round($rate, 1);

                $coaster->setRate($rate);
                $em->persist($coaster);

                $em->flush();

                return $this->redirect($this->generateUrl('coasters_world_database_view', array(
                    'slug' => $slug
                )));
            }
        }

        return $this->render('CoastersWorldSiteBundle:Coaster:rating.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }
}
