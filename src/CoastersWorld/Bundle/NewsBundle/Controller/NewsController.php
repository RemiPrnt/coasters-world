<?php

namespace CoastersWorld\Bundle\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function listAction()
    {
        return $this->render('CoastersWorldNewsBundle:News:index.html.twig');
    }

    public function viewAction($slug)
    {
    }

    public function editAction($id)
    {
    }
}
