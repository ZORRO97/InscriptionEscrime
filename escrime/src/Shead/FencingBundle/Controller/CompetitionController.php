<?php

namespace Shead\FencingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Shead\FencingBundle\Entity\Competition;
use Shead\FencingBundle\Form\CompetitionType;

use Doctrine\ORM\EntityRepository;

/**
 * Competition controller.
 *
 */
class CompetitionController extends Controller
{

    /**
     * Lists all Competition entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SheadFencingBundle:Competition')->findAll();

        return $this->render('SheadFencingBundle:Competition:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all Competition entities.
     *
     */
    public function listeClubAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SheadFencingBundle:Competition')->findAll();

        // vérifier que l'id du club est valide

        return $this->render('SheadFencingBundle:Competition:choix.html.twig', array(
            'entities' => $entities,'idClub'=>$id
        ));
    }


    /**
     * Creates a new Competition entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Competition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('competition_show', array('id' => $entity->getId())));
        }

        return $this->render('SheadFencingBundle:Competition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Competition entity.
     *
     * @param Competition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Competition $entity)
    {
        $form = $this->createForm(new CompetitionType(), $entity, array(
            'action' => $this->generateUrl('competition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Competition entity.
     *
     */
    public function newAction()
    {
        $entity = new Competition();
        $form   = $this->createCreateForm($entity);

        return $this->render('SheadFencingBundle:Competition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Competition entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SheadFencingBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SheadFencingBundle:Competition:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Competition entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SheadFencingBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competition entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SheadFencingBundle:Competition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Competition entity.
    *
    * @param Competition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Competition $entity)
    {
        $form = $this->createForm(new CompetitionType(), $entity, array(
            'action' => $this->generateUrl('competition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Competition entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SheadFencingBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('competition_edit', array('id' => $id)));
        }

        return $this->render('SheadFencingBundle:Competition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function createEditTireurForm(Competition $entity,$clubId)
    {
        $categorie=$entity->getCategorie();
        if ($entity->getSexe()=="masculin") $sexe="M"; else $sexe="F";
        $form=$this->createFormBuilder($entity,array('action'=>$this->generateUrl('competition_club_update',array('id'=>$entity->getId(),'clubId'=>$clubId)),'method'=>'PUT'))
            ->add('licencies','entity', 
                    array(
                    'class'=>'SheadFencingBundle:Licencies',
                    'property'=>'nomPrenom',
                    'by_reference'=>'false',
                    'query_builder' => function(EntityRepository $er ) use ($clubId,$categorie,$sexe)
                        {
                            return $er->createQueryBuilder('u')
                                    ->addSelect("c")
                                    ->innerJoin("u.club", "c", "WITH", "c.id=:clubId")
                                    ->setParameter("clubId", $clubId) 
                                    ->orderBy('u.nom', 'ASC')
                                    ->where("u.categ=:categorie AND u.sexe=:sexe")
                                    ->setParameter("categorie",$categorie)
                                    ->setParameter("sexe",$sexe);
                                                              
                        },
                    'expanded'=>'true',
                    'multiple'=>'true'    
                    )
                )
            ->add('arbitres','entity',array(
                    'class'=>'SheadFencingBundle:Arbitres',
                    'property'=>'licencie.nomPrenom',

                    'query_builder' => function(EntityRepository $er) use($clubId) {
                        return $er->createQueryBuilder('u')
                            ->addSelect('l')
                            ->join("u.licencie","l")
                            ->addSelect('c')
                            ->innerJoin("l.club","c","WITH", "c.id=:clubId")
                            ->setParameter("clubId",$clubId)
                            ->orderBy('u.id', 'ASC');
                    },
                    'expanded'=>'false',
                    'multiple'=> 'false'
                ))
            ->add('Valider','submit')
            ->getForm();


        return $form;
    }

    /**
     * Edits an existing Competition entity pour un club
     *
     */
    public function updateTireurClubAction(Request $request, $id, $clubId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SheadFencingBundle:Competition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competition entity.');
        }
        $anciens=array();
        $oldarbs=array();
        $dejas=$entity->getLicencies();
        foreach ($dejas as $deja) {
            if ($deja->getClub()->getId() ==$clubId)
                array_push($anciens, $deja);
        }
        $arbis=$entity->getArbitres();
        foreach ($arbis as $arbi) {
            if ($arbi->getLicencie()->getClub()->getId() == $clubId) array_push($oldarbs,$arbi);
        }


        $editForm = $this->createEditTireurForm($entity,$clubId);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

             //die(\Doctrine\Common\Util\Debug::dump($entity->getLicencies()));
            //die(\Doctrine\Common\Util\Debug::dump($editForm));

            $inscrits=$entity->getLicencies();
            // on enregistre les tireurs non-inscrits auparavant
            foreach ($inscrits as $inscrit) {
                $compets=$inscrit->getCompetitions();

                $trouve=false;
                foreach ($compets as $cp) {
                    if ($cp === $entity) $trouve=true;
                }
                if (!$trouve) {
                $inscrit->addCompetition($entity);
                $em->persist($inscrit);
                }
            }
            // chercher les tireurs décochés et  supprimer le lien à la compétition
            // die(\Doctrine\Common\Util\Debug::dump($anciens));
            foreach ($anciens as $ancien) {
                $trouve=false;
                foreach ($inscrits as $inscrit) {
                    if ($inscrit===$ancien) $trouve=true; 
                }
                if (!$trouve) {
                    $ancien->removeCompetition($entity);
                    $em->persist($ancien);
                }

            }

            $arbitres=$entity->getArbitres();
            foreach ($arbitres as $arbitre) {
                $compets=$arbitre->getCompetitions();
                $trouve=false;
                foreach ($compets as $cp) {
                    if ($cp === $entity) $trouve=true;
                }
                if (!$trouve){
                $arbitre->addCompetition($entity);
                $em->persist($arbitre);
                }
            }
            foreach ($oldarbs as $tiroflan) {
                $trouve=false;
                foreach ($arbitres as $arbitre) {
                    if ($arbitre===$tiroflan) $trouve=true; 
                }
                if (!$trouve) {
                    $tiroflan->removeCompetition($entity);
                    $em->persist($tiroflan);
                }

            }

            $em->persist($entity);
            $em->flush();
            // rediriger vers la page des tireurs inscrits pour la compétition de ce club
            return $this->redirect($this->generateUrl('competition_club_edit', array('id' => $id,'clubId'=>$clubId))); 
        }

        return $this->render('SheadFencingBundle:Competition:editTireur.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
            
        ));
    }

    /**
    * Affiche les inscrits d'un club à une compétition
    */
    public function editTireurClubAction($id,$clubId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SheadFencingBundle:Competition')->find($id);
        $club = $em->getRepository('SheadFencingBundle:Clubs')->find($clubId);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competition entity.');
        }
        return $this->render('SheadFencingBundle:Competition:show2.html.twig', array(
            'entity'      => $entity,'clubId'=> $clubId,'club'=>$club
            
        ));
    }


    /**
     * Deletes a Competition entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SheadFencingBundle:Competition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Competition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('competition'));
    }

    /**
     * Creates a form to delete a Competition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('competition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
