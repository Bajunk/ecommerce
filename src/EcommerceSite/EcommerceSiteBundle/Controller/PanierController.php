<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses;
use EcommerceSite\EcommerceSiteBundle\Form\UtilisateursAdressesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller
{
    /**
     * @Template("EcommerceSiteBundle:Panier/ModulesUsed:menupanier.html.twig")
     * @param Request $request
     * @return array
     */
    public function menuAction(Request $request)
    {
        $session = $request->getSession();
        if(!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));
        return array('articles' => $articles);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function panierAction(Request $request)
    {
        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier', array());
        }
        $em = $this->getDoctrine()->getManager();
        $panier = $session->get('panier');
        $produits = $em->getRepository('EcommerceSiteBundle:Produits')->findArray(array_keys($panier));


        return $this->render('EcommerceSiteBundle:Panier/Layout:panier.html.twig', array('produits' => $produits ,
                                                                                         'panier' => $panier));
    }

    /**
     * @param Request $request
     * @return La page avec la nouvelle adresse prise en compte
     */
    public function livraisonAction(Request $request)
    {
        $utilisateur = $this->container->get('security.token_storage')->getToken()->getUser();
        $entity = new UtilisateursAdresses();
        $form = $this->createForm(new UtilisateursAdressesType(), $entity);

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();
                return $this->redirectToRoute('ecommerce_site_panier_livraison');
            }
        }
        return $this->render('EcommerceSiteBundle:Panier/Layout:livraison.html.twig',
               array('form' => $form->createView(), 'utilisateur' => $utilisateur));
    }

    /**
     * On efface une adresse de livraison
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function effacerAdresseAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $adresseEntity = $em->getRepository('EcommerceSiteBundle:UtilisateursAdresses')->find($id);
        $currentUSer = $this->container->get('security.token_storage')->getToken()->getUser();

        if($currentUSer != $adresseEntity->getUtilisateur() || !$adresseEntity){
            return $this->redirect('ecommerce_site_panier_livraison');
        }
        $em->remove($adresseEntity);
        $em->flush();
        return $this->redirectToRoute('ecommerce_site_panier_livraison');
    }

    private function setLivraisonOnSession(Request $request)
    {
        $session = $request->getSession();
    }

    public function validationAction()
    {
        return $this->render('EcommerceSiteBundle:Panier/Layout:validation.html.twig');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ajouterAction(Request $request, $id)
    {
        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier', array());
        }
        $panier = $session->get('panier');
        $qte = $request->query->get('qte');

        if(array_key_exists($id,$panier)){ //si le produit existe dans notre panier
            if($qte != null){
                $panier[$id] = $qte;
            }
            $this->get('session')->getFlashBag()->add('success','Quantité modifiée avec succès');
        }
        elseif($qte != null)
        {
            $panier[$id] = $qte;
        }
        else
        {
            $panier[$id] = '1';
            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('ecommerce_site_panier_homepage');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function supprimerAction($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');

        if(array_key_exists($id,$panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }
        return $this->redirectToRoute('ecommerce_site_panier_homepage');
    }
}
