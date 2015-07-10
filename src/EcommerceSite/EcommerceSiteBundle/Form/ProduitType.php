<?php

namespace EcommerceSite\EcommerceSiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ProduitType
 * @package EcommerceSite\EcommerceSiteBundle\Form
 */
class ProduitType extends AbstractType{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('required' => false))  //->add('nom')
            ->add('prenom')
            ->add('sexe', 'choice', array('choices' => array('M' => 'Male',
                                                             'F' => 'Femelle',
                                                             'D' => 'Autre')))
                                   //, 'expanded' => true)) // le expanded permet d'avoir des boutons radio
                                   //, 'preferred_choices' => array('M') // pour définir des choix préférés

            ->add('email', 'email')     //->add('email', 'email', array('required' => false))
            ->add('date_de_naissance', 'birthday')
            ->add('pays_de_naissance', 'country')
            ->add('contenu', 'textarea')
            ->add('utilisateurs', 'entity', array('class' => 'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs'))
            ->add('envoyer', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'ecommercesite_ecommercesitebundle_produits';
    }
}