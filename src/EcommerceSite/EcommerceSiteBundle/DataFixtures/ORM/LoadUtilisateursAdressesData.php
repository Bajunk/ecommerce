<?php
namespace EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses;

/**
 * Class LoadUtilisateursAdressesData
 * @package EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM
 */
class LoadUtilisateursAdressesData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $adresse1 = new UtilisateursAdresses();
        $adresse1->setUtilisateur($this->getReference('utilisateur1'));
        $adresse1->setNom('Doe');
        $adresse1->setPrenom('John');
        $adresse1->setTelephone('0606060606');
        $adresse1->setAdresse('1 rue de la paix');
        $adresse1->setCodepostal('99000');
        $adresse1->setPays('France');
        $adresse1->setVille('Strasbourg');
        $adresse1->setComplement('Dans la cabane verte');
        $manager->persist($adresse1);

        $adresse2 = new UtilisateursAdresses();
        $adresse2->setUtilisateur($this->getReference('utilisateur2'));
        $adresse2->setNom('Haley');
        $adresse2->setPrenom('Oliver');
        $adresse2->setTelephone('0612345678');
        $adresse2->setAdresse('2 rue de la marre');
        $adresse2->setCodepostal('45000');
        $adresse2->setVille('Orléans');
        $adresse2->setComplement('En face de la Poste');
        $adresse2->setPays('France');
        $manager->persist($adresse2);

        $manager->flush();

        //$this->addReference('adresse1', $adresse1);
        //$this->addReference('adresse2', $adresse2);

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 6;
    }
}