<?php
namespace EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceSite\EcommerceSiteBundle\Entity\Commandes;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class LoadCommandesData
 * @package EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM
 */
class LoadCommandesData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $commande1 = new Commandes();
        $commande1->setUtilisateur($this->getReference('utilisateur1'));
        $commande1->setDate(new \DateTime());
        $commande1->setReference('1');
        $commande1->setValider(true);
        $commande1->setProduits(array('0' => array('1' => '2'), //idarticle => nb articles
                                      '1' => array('2' => '1'),
                                      '2' => array('4' => '5')));
        $manager->persist($commande1);

        $commande2 = new Commandes();
        $commande2->setUtilisateur($this->getReference('utilisateur2'));
        $commande2->setDate(new \DateTime());
        $commande2->setReference('2');
        $commande2->setValider(true);
        $commande2->setProduits(array('0' => array('1' => '2'),
                                      '1' => array('2' => '1'),
                                      '2' => array('4' => '5')));
        $manager->persist($commande2);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 7;
    }
}