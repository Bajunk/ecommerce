<?php

namespace EcommerceSite\EcommerceSiteBundle\Twig\Extensions;


class TvaExtension extends \Twig_Extension{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tva_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('tva', array($this, 'calculTva')));
    }

    /**
     * @param $prixHT
     * @param $tva
     * @return float
     */
    public function calculTva($prixHT, $tva)
    {
        return round($prixHT/$tva,2);
    }

}