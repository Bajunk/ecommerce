<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use EcommerceSite\EcommerceSiteBundle\Entity\Commandes;
use EcommerceSite\EcommerceSiteBundle\Entity\Produits;
use EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommandesController extends Controller{

    /**
     * Préparation des données à envoyer au système de paiement
     * @param Request $request
     * @return une commande
     */
    private function facture(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $generator  = $this->container->get('security.secure_random');
        $session    = $request->getSession();
        $adresse    = $session->get('adresse');
        $panier     = $session->get('panier');
        $commande   = array();
        $totalHT    = 0;
        $totalTVA   = 0;

        $facturation = $em->getRepository('EcommerceSiteBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison   = $em->getRepository('EcommerceSiteBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $produits    = $em->getRepository('EcommerceSiteBundle:Produits')->findArray(array_keys($panier));

        foreach($produits as $produit) {
            $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = $prixHT / $produit->getTva()->getMultiplicate();
            $totalHT += $prixHT;


            if (!isset($commande['tva'][$produit->getTva()->getValeur() . '%'])){
                $commande['tva'][$produit->getTva()->getValeur() . '%'] = round($prixTTC - $prixHT, 2);
            } else{
                $commande['tva'][$produit->getTva()->getValeur().'%'] += round($prixTTC-$prixHT,2);
            }
            $totalTVA += round($prixTTC - $prixHT, 2);

            $commande['produit'][$produit->getId()] = array(
                'reference' => $produit->getNom(),
                'quantite'  => $panier[$produit->getId()],
                'prixHT'    => round($produit->getPrix(),2),
                'prixTTC'   => round($produit->getPrix()/$produit->getTva()->getMultiplicate(),2));
        }
        $commande['livraison'] = array(
            'prenom'     => $livraison->getPrenom(),
            'nom'        => $livraison->getNom(),
            'telephone'  => $livraison->getTelephone(),
            'adresse'    => $livraison->getAdresse(),
            'codepostal' => $livraison->getCodepostal(),
            'ville'      => $livraison->getVille(),
            'pays'       => $livraison->getPays(),
            'complement' => $livraison->getComplement());

        $commande['facturation'] = array(
            'prenom'     => $facturation->getPrenom(),
            'nom'        => $facturation->getNom(),
            'telephone'  => $facturation->getTelephone(),
            'adresse'    => $facturation->getAdresse(),
            'codepostal' => $facturation->getCodepostal(),
            'ville'      => $facturation->getVille(),
            'pays'       => $facturation->getPays(),
            'complement' => $facturation->getComplement());

        $commande['prixHT']  = round($totalHT,2);
        $commande['prixTTC'] = round($totalHT + $totalTVA,2);
        $commande['token']   = bin2hex($generator->nextBytes(20));

        return $commande;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function prepareCommandeAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if(!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('EcommerceSiteBundle:Commandes')->find($session->get('commande'));

        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->container->get('security.token_storage')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture($request));

        if(!$session->has('commande')){
            $em->persist($commande);
            $session->set('commande', $commande);
        }
        $em->flush();
        return new Response($commande->getId());
    }

    /**
     * Cette méthode remplace l'API Banque
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function validationCommandeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('EcommerceSiteBundle:Commandes')->find($id);

        if(!$commande || $commande->getValider() == true)
            throw $this->createNotFoundException('La commande n\'existe pas ou a déjà été validée.');

        $commande->setValider(true);
        $commande->setReference($this->container->get('setNewReference')->latestReference()); //recours à un service
        $em->flush();

        $session = $request->getSession();
        $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');

        $this->get('session')->getFlashBag()->add('success','Votre commande est validée avec succès.');
        return $this->redirectToRoute('utilisateurs_factures');
    }

}