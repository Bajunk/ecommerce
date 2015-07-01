<?php

namespace EcommerceSite\EcommerceSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoriesController
 * @package EcommerceSite\EcommerceSiteBundle\Controller
 */
class CategoriesController extends Controller
{
    /**
     * Affiche le menu des catégories
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('EcommerceSiteBundle:Categories')->findAll();

        return $this->render('@EcommerceSite/Categories/Layout/menucateg.html.twig', array('categories' => $categories));
    }
}
