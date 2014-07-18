<?php

namespace CoastersWorld\Bundle\SiteBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
 
class CoastersWorldLogoutHandler implements LogoutSuccessHandlerInterface
{
    protected $router;
    protected $translator;

    public function __construct($router, $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }
 
    /**
     * Ajoute un message de succès de déconnexion dans le FlashBag
     */
    public function onLogoutSuccess(Request $request)
    {
        $request->getSession()
                ->getFlashBag()
                ->add('logout_success', $this->translator->trans('logout.success'));

        return new RedirectResponse($this->router->generate('coasters_world_homepage'));
    }
}