<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use EcommerceSite\EcommerceSiteBundle\Entity\Categories;
use EcommerceSite\EcommerceSiteBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EcommerceSite\EcommerceSiteBundle\Form\ProduitType;

/**
 * Class ProduitsController
 * @package EcommerceSite\EcommerceSiteBundle\Controller
 */
class ProduitsController extends Controller
{
    /**
     * Page contenant tous les produits
     */
    public function produitsAction(Request $request, Categories $categorie = null)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        if($categorie != null){
            $produits = $em->getRepository('EcommerceSiteBundle:Produits')->byCategorie($categorie);
        }
        else $produits = $em->getRepository('EcommerceSiteBundle:Produits')->findBy(array('disponible' => true));

        if($session->has('panier')) {
            $panier = $session->get('panier');
        }
        else $panier = false;

        return $this->render('EcommerceSiteBundle:Produits/Layout:produits.html.twig', array('produits' => $produits,
                                                                                             'panier' => $panier));
    }

    /**
     * Page de présentation d'un produit
     */
    public function presentationAction(Request $request, $id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceSiteBundle:Produits')->find($id);

        if(!$produit){
            throw $this->createNotFoundException('La page n\'existe pas ');
        }
        if($session->has('panier')) {
            $panier = $session->get('panier');
        }
        else $panier = false;

        return $this->render('EcommerceSiteBundle:Produits/Layout:presentation.html.twig', array('produit' => $produit,
                                                                                                 'panier' => $panier ));
    }

    /**
     * On crée un formulaire et on récupère les données par la suite
     * @return Les données entrées dans le forumlaire
     */
    public function creationFormulaireAction(Request $request)
    {
        $form = $this->createForm(new ProduitType());
        $formView = $form->createView();

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            echo $form['email']->getData();
        }
        return $this->render('EcommerceSiteBundle:Produits/Layout:formulaireproduits.html.twig',
            array('form' => $formView));
    }

    /**
     * On crée une vue du formulaire de recherche
     */
    public function rechercheAction()
    {
        $form = $this->createForm(new RechercheType());
        return $this->render('@EcommerceSite/Produits/ModulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }

    /**
     * On traite la requete de recherche de produit(s)
     * @param Request $request, à utliser du fait de la dépréciation entre versions de symfony
     * @return Response
     */
    public function traitementRechercheAction(Request $request)
    {
        //---- Ici on ne veut pas que le client puisse rajouter des produits qu'il a déjà dans son panier --
         $session = $request->getSession();
         if($session->has('panier')) $panier = $session->get('panier');
         else $panier = false;
        //---------------------------------------------------------------------------------------------------
        $form = $this->createForm(new RechercheType());

        if($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);
            $attribut = $form['recherche']->getData();

            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('EcommerceSiteBundle:Produits')->findByAttribute($attribut);
        }
        else throw $this->createNotFoundException('La page n\'existe pas');

        return $this->render('EcommerceSiteBundle:Produits/Layout:produits.html.twig', array('produits' => $produits,
                                                                                             'panier' => $panier));
    }

    /**
     * Ancien code (problème de doublon avec la fonction produitsAction)
     * On récupère les produits appartenant à une certaine catégorie
     * @param $categorie
     * @return La vue des produits appartenant à la catégorie passée en paramètre

    public function categorieAction($categorie)
    {
    $em = $this->getDoctrine()->getManager();
    $produits = $em->getRepository('EcommerceSiteBundle:Produits')->byCategorie($categorie);

    //vérifier si la catégorie par laquelle on fait le trie existe bien
    $categorieFound = $em->getRepository('EcommerceSiteBundle:Categories')->find($categorie);
    if(!$categorieFound){
    throw $this->createNotFoundException('La page n\'existe pas ');
    }
    return $this->render('EcommerceSiteBundle:Produits/Layout:produits.html.twig', array('produits' => $produits));
    }
     */

    /**
     * Vider la table

    public function effacerProdAction()
    {
    $em = $this->getDoctrine()->getManager();
    $products = $em->getRepository('EcommerceSiteBundle:Produits')->findAll();

    foreach ($products as $product) {
    $em->remove($product);
    $em->flush();
    }

    return new Response('<html><body> Table vidée</body></html>');
    }*/
}