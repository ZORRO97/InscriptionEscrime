<?php

namespace Shead\FencingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shead\FencingBundle\Entity\Utilisateur;
use Shead\FencingBundle\Form\UtilisateurType;
use Shead\FencingBundle\Entity\Clubs;
use Shead\FencingBundle\Entity\ClubsRepository;
use Shead\FencingBundle\Entity\Licencies;
use Shead\FencingBundle\Form\LicenciesType;
use Shead\FencingBundle\Entity\LicenciesRepository;
use Shead\FencingBundle\Entity\Arbitres;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\PaginatorBundle\KnpPaginator;




	

class FencingController extends Controller
{
    
	public function ConceptionAction(){
		return $this->render('SheadFencingBundle:Static:conception.html.twig');
	}


	public function InsClub($code,$gogo) 
	    {
		
			
			
				
			$em=$this->getDoctrine()->getManager();
			$clubex=$em->getRepository('SheadFencingBundle:Clubs')->findOneByCode($code);
			if ($clubex==false) {
				$leclub = new Clubs;
				$leclub->setCode($code);
				$leclub->setNom($gogo[34]);
				$leclub->setVille($gogo[35]);
				$leclub->setZone($gogo[36]);
				$leclub->setLigue($gogo[37]);
				$leclub->setNodep($gogo[38]);

				$em->persist($leclub);

				$em->flush();
				return $leclub;
		    }
			return $clubex;
			
			
		}


		/* enregistre un nouveau licencié */
		function Inslicencie($club,$codep,$pigeon) 
		{

		 	$licencies=$club->getLicencies();
		 	$nblicencies=count($licencies);
		 	$deja=false;

		 	foreach ($licencies as $licencie) {
		 		if ($licencie->getCodet() == $codep) $deja=true;
		 	}

		 	if ($deja==false)
		 	{
			
				$fencer= new Licencies;
				$fencer->setClub($club);
				$fencer->setCodet($codep);
				$fencer->setNom($pigeon[2]);
				$fencer->setPrenom($pigeon[3]);
				if ($pigeon[4] == "Masculin") {$sexe="M";} else {$sexe="F";}
				$fencer->setSexe($sexe);
				$fencer->setDaten($pigeon[5]);
				$fencer->setCateg($pigeon[6]);
				$fencer->setNation($pigeon[7]);
				$fencer->setTypel($pigeon[8]);
				$fencer->setSurclas($pigeon[11]);
				$fencer->setLateralite($pigeon[12]);
				$fencer->setBlason($pigeon[31]);

				$em=$this->getDoctrine()->getManager();

				// traitement si le licencié est un arbitre
				if ($pigeon[23] != ""){
				$adispo= new Arbitres;

				

				$adispo->setTitre($pigeon[23]);

					if ($pigeon[24] != "")   // arbitre fleuret
					{
						$adispo->setArbF($pigeon[24]);
					}

					if ($pigeon[25] != "")   // arbitre épée
					{
						$adispo->setArbE($pigeon[25]);
					}

					if ($pigeon[26] != "")   // arbitre sabre
					{
						$adispo->setArbS($pigeon[26]);
					}
						$fencer->setArbitre($adispo);
						$em->persist($adispo);

				}

			
		

			
			$em->persist($fencer);
			$em->flush();
			echo('<p>'.$codep.'code de '.$fencer->getNom().'</p>');
			}
			
				
		}


    public function indexAction($name=null)
    {
        return $this->render('SheadFencingBundle:Fencing:index.html.twig', array('name' => $name));
    }

    /* Fonctions d'envoi de mails avec swiftmailer */
    public function mailAction($name)
	{
    $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('francois.lavazec@gmail.com')
        ->setTo('francois.lavazec@gmail.com')
        ->setBody($this->renderView('SheadFencingBundle:Mail:email.html.twig', array('name' => $name)),'text/html')
    ;
    $this->get('mailer')->send($message);

    return $this->render('SheadFencingBundle:Mail:envoye.html.twig');
	}

	public function mailServiceAction($name,$email){
		$mailer=$this->get('shead_fencing.flmail');
		$vue='SheadFencingBundle:Mail:emails.html.twig';
		$mailer->send($vue,$email,$name,'test envoi symfony');
		return $this->render('SheadFencingBundle:Mail:envoye.html.twig');
	}

	/* Fin Mailing */

    public function nouvelleBaseAction()
	{

		/* ici on définit le fichier utilisé pour grossir la base */
		/* pour les versions futures on prévoit un upload de fichier avec controle de validité */  
		$handle = fopen("/home/flavazec/public_html/Symfony/src/Shead/FencingBundle/Controller/Recherche93.csv", "r");

		if ($handle) 
		{
			$clubC="";
			$i=0;
		    while (($buffer = fgets($handle)) !== false) 
		    {
		    	if ( $i>0) 
		    	{
		 			$untireur=explode(";",$buffer);
		        	$codetot=explode(" ",$untireur[0]);

					$codeclub=$codetot[0].$codetot[1].$codetot[2];

		    	
		       
					if ($codeclub != $clubC) {
						
						$clubC=$codeclub;
						$club=new Clubs;
						/* ajouter le club dans la base de données */
						
						$club=$this->Insclub($codeclub,$untireur);
					}

		       		/*enregistrer le licencié*/
		       		
		        	$this->Inslicencie($club,$codetot[3],$untireur);
		        }
		        
		        $i++;
		       
		        
		    }
		    if (!feof($handle)) {
		        echo "Erreur: fgets() a échoué\n";
		    }
    		fclose($handle);
		}    
    	return $this->render('SheadFencingBundle:Fencing:nouveau.html.twig');
    }

    public function newUserAction()
    {
    	$utilisateur = new Utilisateur();
    	$form=$this->createForm(new UtilisateurType(), $utilisateur);
    	$request = $this->get('request');
		  if ($request->getMethod() == 'POST') 
		  {
		    $form->bind($request);
		    // On récupère le service validator
		    $validator = $this->get('validator');
		        
		    // On déclenche la validation
		    $liste_erreurs = $validator->validate($utilisateur);
		    if ($form->isValid() && count($liste_erreurs)==0) {
		      $em = $this->getDoctrine()->getManager();
		      $em->persist($utilisateur);
		      $em->flush();
		      return $this->redirect($this->generateUrl('shead_fencing_homepage',array('name'=>$utilisateur->getNom())));
		    }
		  }
  		return $this->render('SheadFencingBundle:Fencing:newUser.html.twig', array(
	    'form' => $form->createView(),
	  	));
    }

    public function listeUserAction()
    {
    	$utilisateur=new Utilisateur();
    	$repository=$this->getDoctrine()->getRepository('SheadFencingBundle:Utilisateur');
    	$utilisateurs=$repository->findAll();
    	if (!$utilisateurs) {
    		throw $this->createNotFoundException('Aucun utilisateur trouvé dans la base');
    	}

    	return $this->render('SheadFencingBundle:Fencing:listeUser.html.twig',
    			array('utilisateurs'=>$utilisateurs)
    		);

    }

    public function listeClubAction()
    {
    	$clubs=new Clubs();
    	$repository=$this->getDoctrine()->getRepository('SheadFencingBundle:Clubs');
    	$clubs=$repository->findAll();

    	if (!$clubs) {
    		throw $this->createNotFoundException('Aucun club trouvé dans la base');
    	}

    	return $this->render('SheadFencingBundle:Fencing:listeClub.html.twig',
    			array('clubs'=>$clubs)
    		);

    }

	public function listeClub2Action()
    {
    	
    	$repository=$this->getDoctrine()->getRepository('SheadFencingBundle:Clubs');
    	$clubs=$repository->findAll();

    	if (!$clubs) {
    		throw $this->createNotFoundException('Aucun club trouvé dans la base');
    	}
    	 $paginator  = $this->get('knp_paginator');
    	$pagination = $paginator->paginate(
        $clubs,
        $this->get('request')->query->get('page', 1)/*page number*/,
        4/*limit per page*/
    		);

    	return $this->render('SheadFencingBundle:Fencing:listeClubPage.html.twig',
    			array('pagination'=>$pagination)
    		);

    }


	/**
	 * @ParamConverter("club", options={"mapping": {"club_id": "id"}})
	 */
    public function unClubAction(Clubs $club)
    {
    	
    	$licencies=$club->getLicencies();
    	return $this->render('SheadFencingBundle:Fencing:unClub.html.twig',
    			array('club'=>$club,'licencies'=>$licencies));

    }


    public function unLicencieAction($codeClub,$codeTireur="0001")
    {
    	$em=$this->getDoctrine()->getManager();
    	$query=$em->getRepository('SheadFencingBundle:Clubs')->findOneByCodeJoinedToLicencies($codeClub);
    	//findOneByCode($codeClub);
    	if (!$club) {
    		throw $this->createNotFoundException('Aucun club trouvé dans la base');
    	}
    	die(var_dump($query));
    	//$licencies=$club->getLicencies();
    	if ($licencies)
    	{

    	 return
    	
    	// var_dump($licencies); 
    	 $this->render('SheadFencingBundle:Fencing:unLicencie.html.twig',
    	 		array('club'=>$club,'licencie'=>$licencies[0]));
    	}
    	else return $this->redirect($this->generateUrl('shead_fencing_liste_club'));
    }


    /**
	 * @ParamConverter("club", options={"mapping": {"club_id": "id"}})
	 */
    public function addLicenciesAction(Clubs $club, Request $request)

    {
    	$licencies=new Licencies();
    	$licencies->setClub($club);
    	$forml=$this->createForm(new LicenciesType(),$licencies,array('action'=>$this->generateUrl('shead_fencing_save_licencies_club',array('club_id'=>$club->getId()))
    		));
    	
    	$forml->handleRequest($request);
    	return $this->render('SheadFencingBundle:Fencing:ajoutLicencies.html.twig',
    		array("club_id"=>$club->getId(),
    				"forml"=>$forml->createView()
    		));
    }



    /**
	 * @ParamConverter("club", options={"mapping": {"club_id": "id"}})
	 */
    public function saveLicenciesAction(Clubs $club, Request $request)

    {
    	$licencies=new Licencies();
    	
    	$forml=$this->createForm(new LicenciesType(),$licencies);

    	$forml->handleRequest($request);
    	if ($forml->isValid())
    	{
    		$licencies->setClub($club);
    		$em=$this->getDoctrine()->getManager();
			$em->persist($licencies);
			$em->flush();
			return $this->redirect('shead_fencing_licencies_club',array('club_id'=>$club->getId()));
    	}
    	return $this->render('SheadFencingBundle:Fencing:saveLicencies.html.twig',
    		array("club_id"=>$club->getId(),
    				"forml"=>$forml->createView()
    		));
    }




}
