<?php

namespace RC\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RCClubBundle:Default:index.html.twig');
    }
}
