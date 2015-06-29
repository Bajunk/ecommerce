<?php
namespace EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EcommerceSite\EcommerceSiteBundle\Entity\Media;

/**
 * Class LoadMediaData
 * @package EcommerceSite\EcommerceSiteBundle\DataFixtures\ORM
 */
class LoadMediaData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setPath('http://www.telephones-senior.com/media/telephones/telephone-portable-senior.jpg');
        $media1->setAlt('Téléphone');
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('http://static.dealabs.com/deal_image/5101547c8d42f6.53705109.png');
        $media2->setAlt('Ordinateur');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('http://4.bp.blogspot.com/-pvF17OyrmwI/UiIkv5sf27I/AAAAAAAAAA0/U1f3QHIEPTw/s150-c/disque+dur+portable.jpg');
        $media3->setAlt('Disque dur externe');
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setPath('http://media.ldlc.com/ld/products/00/01/21/76/LD0001217682_1.jpg');
        $media4->setAlt('Imprimante');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setPath('http://s7g1.scene7.com/is/image/odeu11/5014404?$md$');
        $media5->setAlt('Clé USB');
        $manager->persist($media5);

        $media6 = new Media();
        $media6->setPath('http://media.ldlc.com/v3/lbo/LD0001373911_1.jpg');
        $media6->setAlt('Routeur');
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setPath('http://media.ldlc.com/ld/products/00/00/71/14/LD0000711413_1.jpg');
        $media7->setAlt('Cable RJ45');
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setPath('https://img0.etsystatic.com/031/0/9452166/il_340x270.608171012_hxm6.jpg');
        $media8->setAlt('Montre');
        $manager->persist($media8);

        $manager->flush();

        $this->addReference('media1',$media1);
        $this->addReference('media2',$media2);
        $this->addReference('media3',$media3);
        $this->addReference('media4',$media4);
        $this->addReference('media5',$media5);
        $this->addReference('media6',$media6);
        $this->addReference('media7',$media7);
        $this->addReference('media8',$media8);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}