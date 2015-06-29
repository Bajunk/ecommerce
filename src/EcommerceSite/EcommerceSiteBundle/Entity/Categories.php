<?php

namespace EcommerceSite\EcommerceSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="EcommerceSite\EcommerceSiteBundle\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\OneToOne(targetEntity="EcommerceSite\EcommerceSiteBundle\Entity\Media",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=125)
     */
    private $nom;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Categories
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set image
     *
     * @param \EcommerceSite\EcommerceSiteBundle\Entity\Media $image
     * @return Categories
     */
    public function setImage(\EcommerceSite\EcommerceSiteBundle\Entity\Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \EcommerceSite\EcommerceSiteBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
    }
}
