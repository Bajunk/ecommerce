<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function panierAction()
    {
        return $this->render('EcommerceSiteBundle:Panier/Layout:panier.html.twig');
    }

    public function livraisonAction()
    {
        return $this->render('EcommerceSiteBundle:Panier/Layout:livraison.html.twig');
    }

    public function validationAction()
    {
        return $this->render('EcommerceSiteBundle:Panier/Layout:validation.html.twig');
    }
}
