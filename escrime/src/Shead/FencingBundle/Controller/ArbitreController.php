<?php

namespace Shead\FencingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Shead\FencingBundle\Entity\Arbitres;


use Doctrine\ORM\EntityRepository;

/**
 * Arbitre controller.
 *
 */
class ArbitreController extends Controller 
{

	public function showAction()
	{
		$em=$this->getDoctrine()->getManager();
		$entities = $em->getRepository('SheadFencingBundle:Arbitres')->findAll();
		if (!$entities) {
    		throw $this->createNotFoundException('Aucun arbitre trouvé dans la base');
    	}

	        return $this->render('SheadFencingBundle:Arbitre:show.html.twig', array(
	            'entities' => $entities,
	        ));
	}

	public function listeArbitreAction()
    {
    	
    	$repository=$this->getDoctrine()->getRepository('SheadFencingBundle:Arbitres');
    	$arbitres=$repository->findAll();

    	if (!$arbitres) {
    		throw $this->createNotFoundException('Aucun arbitre trouvé dans la base');
    	}

    	$paginator  = $this->get('knp_paginator');
    	$pagination = $paginator->paginate(
        $arbitres,
        $this->get('request')->query->get('page', 1)/*page number*/,
        10/*limit per page*/
    		);

    	return $this->render('SheadFencingBundle:Arbitre:listeArbitrePage.html.twig',
    			array('pagination'=>$pagination)
    		);

    }

}