<?php

namespace Utilisateurs\UtilisateursBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateurs")
 * @ORM\Entity(repositoryClass="Utilisateurs\UtilisateursBundle\Repository\UtilisateursRepository")
 */
class Utilisateurs extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="EcommerceSite\EcommerceSiteBundle\Entity\Commandes",
     *                mappedBy="utilisateur",
     *                cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses",
     *                mappedBy="utilisateur",
     *                cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $adresses;


    public function __construct()
    {
        parent::__construct();
        $this->commandes = new ArrayCollection();
        $this->adresses  = new ArrayCollection();
    }

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
     * Add commandes
     *
     * @param \EcommerceSite\EcommerceSiteBundle\Entity\Commandes $commandes
     * @return Utilisateurs
     */
    public function addCommande(\EcommerceSite\EcommerceSiteBundle\Entity\Commandes $commandes)
    {
        $this->commandes[] = $commandes;

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param \EcommerceSite\EcommerceSiteBundle\Entity\Commandes $commandes
     */
    public function removeCommande(\EcommerceSite\EcommerceSiteBundle\Entity\Commandes $commandes)
    {
        $this->commandes->removeElement($commandes);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Add adresses
     *
     * @param \EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses $adresses
     * @return Utilisateurs
     */
    public function addAdress(\EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses $adresses)
    {
        $this->adresses[] = $adresses;

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses $adresses
     */
    public function removeAdress(\EcommerceSite\EcommerceSiteBundle\Entity\UtilisateursAdresses $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses()
    {
        return $this->adresses;
    }
}
