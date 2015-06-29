<?php
namespace EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

/**
 * Class LoadUtilisateursData
 * @package EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM
 */
class LoadUtilisateursData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{

    /**
     * @var
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {


        $manager->flush();

        //$this->addReference('',);
        //$this->addReference('',);

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->$container = $container;
    }
}