<?php

namespace Shead\FencingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name=null)
    {
        return $this->render('SheadFencingBundle:Fencing:index.html.twig', array('name' => $name));
    }
}
