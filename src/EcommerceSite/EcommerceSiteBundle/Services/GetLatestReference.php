<?php

namespace EcommerceSite\EcommerceSiteBundle\Services;


class GetLatestReference {

    public function __construct($securityTokenStorage, $entityManager)
    {
        $this->securityTokenStorage = $securityTokenStorage;
        $this->em = $entityManager;
    }

    public function latestReference()
    {
        //on cherche un seul élement donc la référence est la dernière en date
        $reference = $this->em->getRepository('EcommerceSiteBundle:Commandes')->findOneBy(array('valider' =>1),
                                                                                          array('id'=>'DESC'),1,1);
        if(!$reference)
            return 1; //la facture n'existe pas donc la réf est toujours 1
        else
            return $reference->getReference() + 1;

    }
}