<?php

namespace RC\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('RCWebBundle:Default:index.html.twig');
    }
}
