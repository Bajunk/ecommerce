<?php
namespace EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceSite\EcommerceSiteBundle\Entity\Produits;

/**
 * Class LoadProduitsData
 * @package EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM
 */
class LoadProduitsData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $produit1 = new Produits();
        $produit1->setCategorie($this->getReference('categorie1'));
        $produit1->setDescription('Téléphone de première génération.');
        $produit1->setDisponible(true);
        $produit1->setImage($this->getReference('media1'));
        $produit1->setNom('Lexo3390');
        $produit1->setPrix('15');
        $produit1->setTva($this->getReference('tva1'));
        $manager->persist($produit1);

        $produit2 = new Produits();
        $produit2->setCategorie($this->getReference('categorie2'));
        $produit2->setDescription('Ordinateur HP de luxe');
        $produit2->setDisponible(true);
        $produit2->setImage($this->getReference('media2'));
        $produit2->setNom('HP7548');
        $produit2->setPrix('599.99');
        $produit2->setTva($this->getReference('tva2'));
        $manager->persist($produit2);

        $produit3 = new Produits();
        $produit3->setCategorie($this->getReference('categorie3'));
        $produit3->setDescription('Le stockage est limité à la taille définie.');
        $produit3->setDisponible(true);
        $produit3->setImage($this->getReference('media3'));
        $produit3->setNom('Disque Dur Western Digital 1To');
        $produit3->setPrix('80.0');
        $produit3->setTva($this->getReference('tva1'));
        $manager->persist($produit3);

        $produit4 = new Produits();
        $produit4->setCategorie($this->getReference('categorie3'));
        $produit4->setDescription('Stockage rapide et ultra portable.');
        $produit4->setDisponible(true);
        $produit4->setImage($this->getReference('media5'));
        $produit4->setNom('Clé USB ScanDriver 32Go');
        $produit4->setPrix('25.99');
        $produit4->setTva($this->getReference('tva1'));
        $manager->persist($produit4);

        $produit5 = new Produits();
        $produit5->setCategorie($this->getReference('categorie4'));
        $produit5->setDescription('Imprimante jet d\'encres, 1000 pages par mois');
        $produit5->setDisponible(true);
        $produit5->setImage($this->getReference('media4'));
        $produit5->setNom('Imrimante Canon MP520');
        $produit5->setPrix('37.0');
        $produit5->setTva($this->getReference('tva2'));
        $manager->persist($produit5);

        $produit6 = new Produits();
        $produit6->setCategorie($this->getReference('categorie5'));
        $produit6->setDescription('Cable ethernet de 100 mètres');
        $produit6->setDisponible(true);
        $produit6->setImage($this->getReference('media7'));
        $produit6->setNom('Cable RJ45-100M');
        $produit6->setPrix('18.99');
        $produit6->setTva($this->getReference('tva1'));
        $manager->persist($produit6);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}