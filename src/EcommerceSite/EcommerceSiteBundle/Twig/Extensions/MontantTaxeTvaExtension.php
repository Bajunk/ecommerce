<?php

namespace EcommerceSite\EcommerceSiteBundle\Twig\Extensions;


class MontantTvaExtension extends \Twig_Extension{

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('montantTva', array($this, 'calculMontantTva')));
    }

    /**
     * Calcul du montant de la TVA, qui évaut au prixTTC - prixHT
     * @param $prixHT
     * @param $tva
     * @return float (le montant avec une précision de 2 chiffres après la virgule)
     */
    public function calculMontantTva($prixHT,$tva)
    {
        return round($prixHT/$tva - $prixHT , 2);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'montant_tva_extension';
    }
}