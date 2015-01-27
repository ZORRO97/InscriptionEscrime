<?php

namespace Shead\FencingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arbitres
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shead\FencingBundle\Entity\ArbitresRepository")
 */
class Arbitres
{
    

     /**
     * @ORM\OneToOne(targetEntity="Shead\FencingBundle\Entity\Licencies",mappedBy="arbitre")
     */
    private $licencie;

    /**
    * @ORM\ManyToMany(targetEntity="Shead\FencingBundle\Entity\Competition",inversedBy="arbitres")
    * @ORM\JoinTable(name="arbitre_competition")
    */
    private $competitions;


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
     * @ORM\Column(name="titre", type="string", length=250)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="arbF", type="string", length=20, nullable=true)
     */
    private $arbF;

    /**
     * @var string
     *
     * @ORM\Column(name="arbE", type="string", length=20, nullable=true)
     */
    private $arbE;

    /**
     * @var string
     *
     * @ORM\Column(name="arbS", type="string", length=20, nullable=true)
     */
    private $arbS;


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
     * Set titre
     *
     * @param string $titre
     * @return Arbitres
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set arbF
     *
     * @param string $arbF
     * @return Arbitres
     */
    public function setArbF($arbF)
    {
        $this->arbF = $arbF;

        return $this;
    }

    /**
     * Get arbF
     *
     * @return string 
     */
    public function getArbF()
    {
        return $this->arbF;
    }

    /**
     * Set arbE
     *
     * @param string $arbE
     * @return Arbitres
     */
    public function setArbE($arbE)
    {
        $this->arbE = $arbE;

        return $this;
    }

    /**
     * Get arbE
     *
     * @return string 
     */
    public function getArbE()
    {
        return $this->arbE;
    }

    /**
     * Set arbS
     *
     * @param string $arbS
     * @return Arbitres
     */
    public function setArbS($arbS)
    {
        $this->arbS = $arbS;

        return $this;
    }

    /**
     * Get arbS
     *
     * @return string 
     */
    public function getArbS()
    {
        return $this->arbS;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set licencie
     *
     * @param \Shead\FencingBundle\Entity\Licencies $licencie
     * @return Arbitres
     */
    public function setLicencie(\Shead\FencingBundle\Entity\Licencies $licencie = null)
    {
        $this->licencie = $licencie;

        return $this;
    }

    /**
     * Get licencie
     *
     * @return \Shead\FencingBundle\Entity\Licencies 
     */
    public function getLicencie()
    {
        return $this->licencie;
    }

    /**
     * Add competitions
     *
     * @param \Shead\FencingBundle\Entity\Competition $competitions
     * @return Arbitres
     */
    public function addCompetition(\Shead\FencingBundle\Entity\Competition $competitions)
    {
        $this->competitions[] = $competitions;

        return $this;
    }

    /**
     * Remove competitions
     *
     * @param \Shead\FencingBundle\Entity\Competition $competitions
     */
    public function removeCompetition(\Shead\FencingBundle\Entity\Competition $competitions)
    {
        $this->competitions->removeElement($competitions);
    }

    /**
     * Get competitions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }
}
