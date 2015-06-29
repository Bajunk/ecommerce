<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateursController extends Controller
{
    public function indexAction()
    {
        return $this->render('UtilisateursBundle:Default:index.html.twig');
    }
}
