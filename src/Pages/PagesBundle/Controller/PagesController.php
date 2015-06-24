<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function pagesAction($id)
    {
        return $this->render('PagesBundle:Pages/Layout:pages.html.twig', array('id' => $id));
    }
}
