<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
    public function produitsAction()
    {
        return $this->render('EcommerceSiteBundle:Produits/Layout:produits.html.twig');
    }

    public function presentationAction()
    {
        return $this->render('EcommerceSiteBundle:Produits/Layout:presentation.html.twig');
    }
}
