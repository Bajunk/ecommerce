<?php
namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

/**
 * Class LoadUtilisateursData
 * @package Utilisateurs\UtilisateursBundle\DataFixtures\ORM
 */
class LoadUtilisateursData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $utilisateur1 = new Utilisateurs();
        $utilisateur1->setUsername('John');
        $utilisateur1->setEmail('john@doe.com');
        $utilisateur1->setEnabled(true);
        $utilisateur1->setPassword($this->container->get('security.encoder_factory')
                                                   ->getEncoder($utilisateur1)
                                                   ->encodePassword('nobody',$utilisateur1->getSalt()));
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateurs();
        $utilisateur2->setUsername('Oliver');
        $utilisateur2->setEmail('oliver@doe.com');
        $utilisateur2->setEnabled(true);
        $utilisateur2->setPassword($this->container->get('security.encoder_factory')
                                                   ->getEncoder($utilisateur2)
                                                   ->encodePassword('anybody',$utilisateur2->getSalt()));
        $manager->persist($utilisateur2);

        $manager->flush();

        $this->addReference('utilisateur1',$utilisateur1);
        $this->addReference('utilisateur2',$utilisateur2);


    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }

}