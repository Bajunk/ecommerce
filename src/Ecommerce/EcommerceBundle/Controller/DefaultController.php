<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceBundle:Default:index.html.twig');
    }

    public function firstTestAction($id)
    {
        return $this->render('EcommerceBundle:Default:first.html.twig', array('id'=>$id));
    }

    public function secondTestAction()
    {
        return $this->render('EcommerceBundle:Default:second.html.twig');
    }
}
