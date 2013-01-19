<?php

namespace CoastersWorld\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoastersWorldCoreBundle:Default:index.html.twig');
    }
}
