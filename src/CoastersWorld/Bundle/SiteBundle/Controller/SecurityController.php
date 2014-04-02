<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormError;

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
                $users_repository = $em->getRepository('CoastersWorldSiteBundle:User');
                $error = false;

                if($users_repository->findBy(array('username' => $user->getUsername())))
                {
                    $error = true;
                    $form->get('username')->addError(
                        new FormError('Ce pseudo est déjà utilisé. Veuillez en choisir un autre.'));
                }
                
                if($users_repository->findBy(array('email' => $user->getEmail())))
                {
                    $error = true;
                    $form->get('email')->addError(
                        new FormError('Cette adresse e-mail est déjà liée à un autre compte. Veuillez en choisir une autre.'));
                }

                if(!$error)
                {
                    $user->setPassword($this->container
                        ->get('security.encoder_factory')
                        ->getEncoder($user)
                        ->encodePassword($user->getPassword(), $user->getSalt()));
                    $em->persist($user);
                    $em->flush();

                    // Création du message de succès de l'inscription
                    $flashbag = $this->get("session")->getFlashBag();
                    $flashbag->add('register_succeed_username', $user->getUsername());
                    $flashbag->add('register_succeed_email',    $user->getEmail());
                    
                    return $this->redirect($this->generateUrl('coasters_world_register_succeed'));
                }
            }
        }

        return $this->render('CoastersWorldSiteBundle:Security:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function registerSucceedAction()
    {
        $session = $this->get("session");

        if( !$session->getFlashBag()->has('register_succeed_username') &&
            !$session->getFlashBag()->has('register_succeed_email') ) // L'utilisateur ne vient pas de s'enregister et tente d'accéder à la page
            return $this->redirect($this->generateUrl('coasters_world_homepage'));

        return $this->render('CoastersWorldSiteBundle:Security:registersucceed.html.twig', array(
            'register_succeed_username' => $session->getFlashBag()->get('register_succeed_username')[0],
            'register_succeed_email'    => $session->getFlashBag()->get('register_succeed_email')[0]
        ));
    }
}
