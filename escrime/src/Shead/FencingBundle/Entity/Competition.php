<?php

namespace Shead\FencingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shead\FencingBundle\Entity\CompetitionRepository")
 */
class Competition
{

    /**
    * @ORM\ManyToMany(targetEntity="Shead\FencingBundle\Entity\Licencies",mappedBy="competitions")
    */
    private $licencies;

    /**
    * @ORM\ManyToMany(targetEntity="Shead\FencingBundle\Entity\Arbitres",mappedBy="competitions")
    */
    private $arbitres;

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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=50)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datec", type="date")
     */
    private $datec;

    /**
     * @var string
     *
     * @ORM\Column(name="arme", type="string", length=10)
     */
    private $arme;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=10)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=10)
     */
    private $sexe;


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
     * Set description
     *
     * @param string $description
     * @return Competition
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    

    /**
     * Set arme
     *
     * @param string $arme
     * @return Competition
     */
    public function setArme($arme)
    {
        $this->arme = $arme;

        return $this;
    }

    /**
     * Get arme
     *
     * @return string 
     */
    public function getArme()
    {
        return $this->arme;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Competition
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Competition
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Competition
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set datec
     *
     * @param \DateTime $datec
     * @return Competition
     */
    public function setDatec($datec)
    {
        $this->datec = $datec;

        return $this;
    }

    /**
     * Get datec
     *
     * @return \DateTime 
     */
    public function getDatec()
    {
        return $this->datec;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->licencies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->arbitres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add licencies
     *
     * @param \Shead\FencingBundle\Entity\Licencies $licencies
     * @return Competition
     */
    public function addLicency(\Shead\FencingBundle\Entity\Licencies $licencies)
    {
        $this->licencies[] = $licencies;

        return $this;
    }

    /**
     * Remove licencies
     *
     * @param \Shead\FencingBundle\Entity\Licencies $licencies
     */
    public function removeLicency(\Shead\FencingBundle\Entity\Licencies $licencies)
    {
        $this->licencies->removeElement($licencies);
    }

    /**
     * Get licencies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLicencies()
    {
        return $this->licencies;
    }

    /**
     * Add arbitres
     *
     * @param \Shead\FencingBundle\Entity\Arbitres $arbitres
     * @return Competition
     */
    public function addArbitre(\Shead\FencingBundle\Entity\Arbitres $arbitres)
    {
        $this->arbitres[] = $arbitres;

        return $this;
    }

    /**
     * Remove arbitres
     *
     * @param \Shead\FencingBundle\Entity\Arbitres $arbitres
     */
    public function removeArbitre(\Shead\FencingBundle\Entity\Arbitres $arbitres)
    {
        $this->arbitres->removeElement($arbitres);
    }

    /**
     * Get arbitres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArbitres()
    {
        return $this->arbitres;
    }
}
