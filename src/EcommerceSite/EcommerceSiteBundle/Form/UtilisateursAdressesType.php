<?php

namespace EcommerceSite\EcommerceSiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateursAdressesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('codepostal')
            ->add('ville')
            ->add('pays')
            ->add('complement', null, array('required' => false))
            //->add('utilisateur')
        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommercesite_ecommercesitebundle_utilisateursadresses';
    }
}
