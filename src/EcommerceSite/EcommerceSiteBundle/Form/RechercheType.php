<?php

namespace EcommerceSite\EcommerceSiteBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class RechercheType extends AbstractType{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recherche', 'text', array('attr' => array('class' => 'input-medium search-query'),
                                                 'label' => false));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'ecommercesite_ecommercesitebundle_recherche';
    }
}