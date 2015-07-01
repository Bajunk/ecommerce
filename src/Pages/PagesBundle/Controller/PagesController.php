<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PagesController
 * @package Pages\PagesBundle\Controller
 */
class PagesController extends Controller
{
    /**
     * Affiche la page dont l'id est passé en paramètre
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->find($id);

        if (!$page) {
            throw $this->createNotFoundException('La page n\'existe pas');
        }
        return $this->render('@Pages/Pages/Layout/pages.html.twig', array('page' => $page));
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PagesBundle:Pages')->findAll();

        return $this->render('@Pages/Pages/ModulesUsed/menu.html.twig', array('pages' => $pages));
    }
}
