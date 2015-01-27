<?php

namespace Shead\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SheadUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
