<?php

namespace Shead\FencingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LicenciesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codet')
            ->add('nom')
            ->add('prenom')
            ->add('sexe')
            ->add('daten')
            ->add('categ')
            ->add('nation')
            ->add('typel')
            ->add('surclas')
            ->add('lateralite')
            ->add('blason')
           ->add('Enregistrer','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shead\FencingBundle\Entity\Licencies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shead_fencingbundle_licencies';
    }
}
