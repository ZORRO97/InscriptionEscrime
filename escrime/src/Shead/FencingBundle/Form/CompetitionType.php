<?php

namespace Shead\FencingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompetitionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('lieu')
            ->add('datec')
            ->add('arme','choice',array('choices'=>array('Epee'=>'Epée','Fleuret'=>'Fleuret','Sabre'=>'Sabre')
                ))
            ->add('categorie','choice',array('choices'=>array(
                    "V"=>'Vétérans',"Senior"=>"Séniors",'Junior'=>'Juniors','Cadet'=>'Cadets','Minime'=>'Minimes',
                    'Benjamin'=>'Benjamins','Pupille'=>'Pupilles','Poussin'=>'Poussins','Moustique'=>'Moustique'
                )

                ))
            ->add('sexe','choice',array('choices'=>array('masculin'=>'masculin','féminin'=>'féminin')))
            // ->add('licencies','entity',array('required'=>false))
            // ->add('arbitres','entity',array('required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shead\FencingBundle\Entity\Competition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shead_fencingbundle_competition';
    }
}
