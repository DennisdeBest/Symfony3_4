<?php

namespace RC\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RCCustomerBundle:Default:index.html.twig');
    }
}
