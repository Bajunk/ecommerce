<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use EcommerceSite\EcommerceSiteBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use EcommerceSite\EcommerceSiteBundle\Form\ProduitType;

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

    /**
     *  Ajout d'un nouveau produit
     */
    public function ajoutProdAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Produits();
        $product->setNom('Smartphone');
        $product->setDescription('S3');
        $product->setDisponible('1');
        $product->setPrix('555.55');

        $em->persist($product);
        $em->flush();

        return $this->render('EcommerceSiteBundle:Produits/Layout:presentation.html.twig', array('product' => $product));
    }

    /**
     * Vider la table
     */
    public function effacerProdAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('EcommerceSiteBundle:Produits')->findAll();

        foreach ($products as $product) {
            $em->remove($product);
            $em->flush();
        }

        return new Response('<html><body> Table vidée</body></html>');
    }

    public function creationFormulaireAction()
    {
        $form = $this->createForm(new ProduitType());
        $formView = $form->createView();

        if ($this->get('request')->getMethod() == 'POST') {
            $form->submit($this->get('request'));

            echo $form['email']->getData();

        }

        return $this->render('EcommerceSiteBundle:Produits/Layout:formulaireproduits.html.twig',
            array('form' => $formView));
    }
}
