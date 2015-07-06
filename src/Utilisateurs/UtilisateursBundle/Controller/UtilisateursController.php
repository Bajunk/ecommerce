<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UtilisateursController extends Controller
{
    public function facturesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('EcommerceSiteBundle:Commandes')->byFacture($this->getUser());

        return $this->render('UtilisateursBundle:Utilisateurs/Layout:facture.html.twig', array('factures'=>$factures));
    }

    public function facturePDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('EcommerceSiteBundle:Commandes')->findOneBy(array('utilisateur'=>$this->getUser(),
                                                                                         'valider' => 1,
                                                                                         'id' => $id));
        if(!$facture){
            $this->get('session')->getFlashBag()->add('error','La facture n\'existe pas (ou autre erreur)');
            return $this->redirectToRoute('utilisateurs_factures');
        }

        $html = $this->renderView('@Utilisateurs/Utilisateurs/Layout/facturePDF.html.twig', array('facture' => $facture));
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('Bajunk');
        $html2pdf->pdf->SetTitle('Facture '.$facture->getReference());
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('Facture.pdf');

        $response = new Response();
        $response->headers->set('Content-type','application/pdf');
        return $response;

    }

}
