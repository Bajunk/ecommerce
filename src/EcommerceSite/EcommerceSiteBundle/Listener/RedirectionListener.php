<?php

namespace EcommerceSite\EcommerceSiteBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener {

    public function __construct(ContainerInterface $container, Session $session)
    {
        $this->session = $session;
        $this->routeur = $container->get('router');
        $this->securityContext = $container->get('security.token_storage');
    }

    /**
     * Vérification à chaque changement de route
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');
        if($route == 'ecommerce_site_panier_livraison' || $route == 'ecommerce_site_panier_validation') {
            if ($this->session->has('panier')) {
                if (count($this->session->get('panier')) == 0) { //si on essaye d'accéder à la page de livraison avec 0 article
                    $event->setResponse(new RedirectResponse($this->routeur->generate('ecommerce_site_panier_homepage')));
                }
            }
            // si l'utilisateur n'est pas connecté alors on le redirige vers la page de connexion
            if (!is_object($this->securityContext->getToken()->getUser())) {
                $this->session->getFlashBag()->add('notification', 'Vous devez vous identifier');
                $event->setResponse(new RedirectResponse($this->routeur->generate('fos_user_security_login')));
            }
        }
    }

}