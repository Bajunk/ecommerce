<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ajouterAction($id, Request $request)
    {
        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier', array());
        }
        $panier = $session->get('panier');

        if(array_key_exists($id, $panier) && ($request->query->get('qte') != null)) //si le produit existe dans notre panier
        {
            $panier['id'] = $request->query->get('qte');
        }
        else{

        }

        return $this->redirectToRoute('ecommerce_site_panier_homepage');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function supprimerAction($id, Request $request)
    {
        $session = $request->getSession();
        return $this->redirectToRoute('ecommerce_site_panier_homepage');
    }
}
