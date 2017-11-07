<?php

namespace RC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RCAdminBundle:Default:index.html.twig');
    }
}
