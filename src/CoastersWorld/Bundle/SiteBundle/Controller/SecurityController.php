<?php

namespace CoastersWorld\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormError;

use CoastersWorld\Bundle\SiteBundle\Entity\User;
use CoastersWorld\Bundle\SiteBundle\Form\Type\RegisterType;
use CoastersWorld\Bundle\SiteBundle\Form\Type\ChangePasswordType;

class SecurityController extends Controller
{
    /**
     * loginAction
     * Affiche le formulaire de connexion
     */
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
                'error'         => $error
            )
        );
    }

    /**
     * registerAction
     * Affiche le formulaire d'inscription, vérifie les informations et enregistre le nouveau membre
     */
    public function registerAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $request    = $this->getRequest();
        
        $user = new User();
        $form = $this->createForm(new RegisterType($this->get('translator')), $user);

        if("POST" === $request->getMethod())
        {
            $form->handleRequest($request);

            $users_repository = $em->getRepository('CoastersWorldSiteBundle:User');
            $error = false;

            if($users_repository->findBy(array('username' => $user->getUsername())))
            {
                $error = true;
                $form->get('username')->addError(
                    new FormError('Ce pseudo est déjà utilisé. Veuillez en choisir un autre.')
                );
            }
            
            if($users_repository->findBy(array('email' => $user->getEmail())))
            {
                $error = true;
                $form->get('email')->addError(
                    new FormError('Cette adresse e-mail est déjà liée à un autre compte. Veuillez en choisir une autre.')
                );
            }

            if(!$error && $form->isValid())
            {
                $user->setPassword(
                    $this->container
                         ->get('security.encoder_factory')
                         ->getEncoder($user)
                         ->encodePassword($user->getPassword(), $user->getSalt())
                );
                $em->persist($user);
                $em->flush();

                // Création du message de succès de l'inscription
                $flashbag = $request->getSession()->getFlashBag();
                $flashbag->add('register_succeed_username', $user->getUsername());
                $flashbag->add('register_succeed_email',    $user->getEmail());

                // Envoi de l'email contenant le lien d'activation
                $this->get('coasters_world.mailer')->sendActivationEmail($user);
                
                return $this->redirect($this->generateUrl('coasters_world_register_succeed'));
            }
        }

        return $this->render('CoastersWorldSiteBundle:Security:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * registerSucceedAction
     * Affiche un message de succès si l'inscription a été prise en compte
     */
    public function registerSucceedAction()
    {
        $session = $this->getRequest()->getSession();

        // L'utilisateur ne vient pas de s'enregister et tente d'accéder à la page
        if( !$session->getFlashBag()->has('register_succeed_username') &&
            !$session->getFlashBag()->has('register_succeed_email') )
            return $this->redirect(
                $this->generateUrl('coasters_world_homepage')
            );

        return $this->render('CoastersWorldSiteBundle:Security:registersucceed.html.twig', array(
            'register_succeed_username' => $session->getFlashBag()->get('register_succeed_username')[0],
            'register_succeed_email'    => $session->getFlashBag()->get('register_succeed_email')[0]
        ));
    }

    /**
     * activateAction
     * Active un compte utilisateur via le lien envoyé par e-mail lors de l'inscription
     */
    public function activateAction($userid,$key)
    {
        $em = $this->getDoctrine()->getManager();
        $users_repository = $em->getRepository('CoastersWorldSiteBundle:User');

        $user = $users_repository->find($userid);

        if(is_null($user) || $user->getIsVerified())
            return $this->redirect($this->generateUrl('coasters_world_homepage'));

        if($key === $user->getActivationKey())
        {
            $user->setIsVerified(1);
            $user->setActivationKey(null);
            $em->persist($user);
            $em->flush();

            // Création du message de succès de l'activation
            $flashbag = $this->get("session")->getFlashBag();
            $flashbag->add('activate_succeed_username', $user->getUsername());

            return $this->redirect($this->generateUrl('coasters_world_activate_succeed'));
        }

        return $this->render('CoastersWorldSiteBundle:Security:activate.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * activateSucceedAction
     * Affiche un message de succès si l'activation a été prise en compte
     */
    public function activateSucceedAction()
    {
        $session = $this->getRequest()->getSession();

         // L'utilisateur ne vient pas de s'enregister et tente d'accéder à la page
        if(!$session->getFlashBag()->has('activate_succeed_username'))
            return $this->redirect(
                $this->generateUrl('coasters_world_homepage')
            );

        return $this->render('CoastersWorldSiteBundle:Security:activatesucceed.html.twig', array(
            'activate_succeed_username' => $session->getFlashBag()->get('activate_succeed_username')[0]
        ));
    }

    /**
     * motdepasseOublieAction
     * Affiche un formulaire permettant d'inscrire son adresse e-mail pour récupérer son mot de passe
     */
    public function motdepasseOublieAction()
    {
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();

        // L'email de changement de mot de passe vient d'être envoyé, affichage d'un message de confirmation
        if($session->getFlashBag()->has('password_reset_email'))
            return $this->render('CoastersWorldSiteBundle:Security:motdepasseoublie.html.twig', array(
                'email' => $session->getFlashBag()->get('password_reset_email')[0]
            ));

        $form = $this->createFormBuilder()
                     ->add('email', 'email', array('label' => "Adresse e-mail associée à votre compte"))
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('CoastersWorldSiteBundle:User')
                       ->findOneBy(array('email' => $form->getData()['email']));

            if(!is_null($user))
            {
                // Génération d'une clé et de la date de validité du changement de mot de passe
                $user->setChangePasswordKey(md5(uniqid(null,true)));
                $changePasswordDate = new \DateTime();
                $changePasswordDate->add(new \DateInterval('P'.$this->container->getParameter('coastersworldPasswordChangeTime').'D'));
                $user->setChangePasswordDate($changePasswordDate);
                $em->persist($user);
                $em->flush();

                // Création du message de succès de l'envoi du mail de changement de mot de passe
                $flashbag = $session->getFlashBag()
                                    ->add('password_reset_email', $user->getEmail());

                // Envoi de l'email contenant le lien vers le formulaire de changement de mot de passe
                $this->get('coasters_world.mailer')->sendPasswordResetEmail($user);
                
                return $this->redirect(
                    $this->generateUrl('mot_de_passe_oublie')
                );
            }

            $form->get('email')->addError(
                new FormError('Cette adresse e-mail n\'est rattachée à aucun compte utilisateur.')
            );
        }

        return $this->render('CoastersWorldSiteBundle:Security:motdepasseoublie.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * changePasswordAction
     * Affiche un message de succès si la modification du mot de passe a été prise en compte
     */
    public function changePasswordAction($userid,$key)
    {
        $em = $this->getDoctrine()->getManager();
        $users_repository = $em->getRepository('CoastersWorldSiteBundle:User');

        $user = $users_repository->find($userid);

        if(is_null($user))
            return $this->redirect(
                $this->generateUrl('coasters_world_homepage')
            );

        if($key != $user->getChangePasswordKey())
            return $this->render('CoastersWorldSiteBundle:Security:changepassword.html.twig', array(
                'error' => 'key'
            ));

        if(new \DateTime > $user->getChangePasswordDate())
            return $this->render('CoastersWorldSiteBundle:Security:changepassword.html.twig', array(
                'error' => 'date'
            ));

        $form = $this->createForm(new ChangePasswordType, $user);

        $request = $this->getRequest();
        if("POST" === $request->getMethod())
        {
            $form->handleRequest($request);

            $user->setPassword($this->container
                 ->get('security.encoder_factory')
                 ->getEncoder($user)
                 ->encodePassword($user->getPassword(), $user->getSalt()));
            $user->setChangePasswordKey(null);
            $user->setChangePasswordDate(null);
            $em->persist($user);
            $em->flush();

            // Création du message de succès de l'activation
            $flashbag = $this->getRequest()->getSession()->getFlashBag();
            $flashbag->add('change_password_succeed_username', $user->getUsername());

            return $this->redirect(
                $this->generateUrl('coasters_world_change_password_succeed')
            );
        }

        return $this->render('CoastersWorldSiteBundle:Security:changepassword.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * changePasswordAction
     * Affiche un formulaire permettant de modifier son mot de passe
     */
    public function changePasswordSucceedAction()
    {
        $session = $this->getRequest()->getSession();

        // L'utilisateur ne vient pas de modifier sont mot de passe et tente d'accéder à la page
        if(!$session->getFlashBag()->has('change_password_succeed_username')) 
            return $this->redirect(
                $this->generateUrl('coasters_world_homepage')
            );

        return $this->render('CoastersWorldSiteBundle:Security:changepasswordsucceed.html.twig', array(
            'change_password_succeed_username' => $session->getFlashBag()->get('change_password_succeed_username')[0]
        ));
    }
}
