<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use CoastersWorld\Bundle\SiteBundle\Entity\User;
use CoastersWorld\Bundle\SiteBundle\Form\Type\UserType;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'CoastersWorldSiteBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function registerAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = new User();
        $form = $this->createForm(new UserType, $user);

        $request = $this->get('request');
        if("POST" === $request->getMethod())
        {
            $form->handleRequest($this->getRequest());
            if($form->isValid())
            {
                $user->setPassword($this->container
                                        ->get('security.encoder_factory')
                                        ->getEncoder($user)
                                        ->encodePassword($user->getPassword(), $user->getSalt()));
                $em->persist($user);
                $em->flush();
            }
            return $this->render('CoastersWorldSiteBundle:Security:registersucceed.html.twig');
        }

        return $this->render('CoastersWorldSiteBundle:Security:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
