<?php
namespace EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceSite\EcommerceSiteBundle\Entity\Categories;

/**
 * Class LoadCategoriesData
 * @package EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM
 */
class LoadCategoriesData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categories();
        $categorie1->setImage($this->getReference('media1'));
        $categorie1->setNom('Téléphones');
        $manager->persist($categorie1);

        $categorie2 = new Categories();
        $categorie2->setImage($this->getReference('media2'));
        $categorie2->setNom('Ordinateurs');
        $manager->persist($categorie2);

        $categorie3 = new Categories();
        $categorie3->setImage($this->getReference('media3'));
        $categorie3->setNom('Stockage');
        $manager->persist($categorie3);

        $categorie4 = new Categories();
        $categorie4->setImage($this->getReference('media4'));
        $categorie4->setNom('Imprimantes');
        $manager->persist($categorie4);

        $categorie5 = new Categories();
        $categorie5->setImage($this->getReference('media7'));
        $categorie5->setNom('Matériel divers');
        $manager->persist($categorie5);

        $manager->flush();

        $this->addReference('categorie1',$categorie1);
        $this->addReference('categorie2',$categorie2);
        $this->addReference('categorie3',$categorie3);
        $this->addReference('categorie4',$categorie4);
        $this->addReference('categorie5',$categorie5);

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}