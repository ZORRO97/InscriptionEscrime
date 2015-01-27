<?php

namespace Shead\FencingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Licencies
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shead\FencingBundle\Entity\LicenciesRepository")
 */
class Licencies
{ 


    /**
   * @ORM\ManyToOne(targetEntity="Shead\FencingBundle\Entity\Clubs",inversedBy="licencies",cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
    private $club;

   /**
    * @ORM\ManyToMany(targetEntity="Shead\FencingBundle\Entity\Competition",inversedBy="licencies")
    * @ORM\JoinTable(name="tireur_competition")
    */
    private $competitions;

    /**
    * @ORM\OneToOne(targetEntity="Shead\FencingBundle\Entity\Arbitres",cascade={"persist","remove"},
    * inversedBy="licencie")  
    */
    private $arbitre;

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
     * @ORM\Column(name="codet", type="string", length=4)
     */
    private $codet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="daten", type="string", length=8)
     */
    private $daten;

    /**
     * @var string
     *
     * @ORM\Column(name="categ", type="string", length=20)
     */
    private $categ;

    /**
     * @var string
     *
     * @ORM\Column(name="nation", type="string", length=30)
     */
    private $nation;

    /**
     * @var string
     *
     * @ORM\Column(name="typel", type="string", length=20)
     */
    private $typel;

    /**
     * @var string
     *
     * @ORM\Column(name="surclas", type="string", length=20)
     */
    private $surclas;

    /**
     * @var string
     *
     * @ORM\Column(name="lateralite", type="string", length=10)
     */
    private $lateralite;

    /**
     * @var string
     *
     * @ORM\Column(name="blason", type="string", length=10)
     */
    private $blason;


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
     * Set codet
     *
     * @param string $codet
     * @return Licencies
     */
    public function setCodet($codet)
    {
        $this->codet = $codet;

        return $this;
    }

    /**
     * Get codet
     *
     * @return string 
     */
    public function getCodet()
    {
        return $this->codet;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Licencies
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
     * Set prenom
     *
     * @param string $prenom
     * @return Licencies
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

 /**
     * Get nomPrenom
     *
     * @return string 
     */
    public function getNomPrenom()
    {
        return $this->nom." ".$this->prenom;
    }


    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Licencies
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
     * Set daten
     *
     * @param string $daten
     * @return Licencies
     */
    public function setDaten($daten)
    {
        $this->daten = $daten;

        return $this;
    }

    /**
     * Get daten
     *
     * @return string 
     */
    public function getDaten()
    {
        return $this->daten;
    }

    /**
     * Set categ
     *
     * @param string $categ
     * @return Licencies
     */
    public function setCateg($categ)
    {
        $this->categ = $categ;

        return $this;
    }

    /**
     * Get categ
     *
     * @return string 
     */
    public function getCateg()
    {
        return $this->categ;
    }

    /**
     * Set nation
     *
     * @param string $nation
     * @return Licencies
     */
    public function setNation($nation)
    {
        $this->nation = $nation;

        return $this;
    }

    /**
     * Get nation
     *
     * @return string 
     */
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * Set typel
     *
     * @param string $typel
     * @return Licencies
     */
    public function setTypel($typel)
    {
        $this->typel = $typel;

        return $this;
    }

    /**
     * Get typel
     *
     * @return string 
     */
    public function getTypel()
    {
        return $this->typel;
    }

    /**
     * Set surclas
     *
     * @param string $surclas
     * @return Licencies
     */
    public function setSurclas($surclas)
    {
        $this->surclas = $surclas;

        return $this;
    }

    /**
     * Get surclas
     *
     * @return string 
     */
    public function getSurclas()
    {
        return $this->surclas;
    }

    /**
     * Set lateralite
     *
     * @param string $lateralite
     * @return Licencies
     */
    public function setLateralite($lateralite)
    {
        $this->lateralite = $lateralite;

        return $this;
    }

    /**
     * Get lateralite
     *
     * @return string 
     */
    public function getLateralite()
    {
        return $this->lateralite;
    }

    /**
     * Set blason
     *
     * @param string $blason
     * @return Licencies
     */
    public function setBlason($blason)
    {
        $this->blason = $blason;

        return $this;
    }

    /**
     * Get blason
     *
     * @return string 
     */
    public function getBlason()
    {
        return $this->blason;
    }

    /**
     * Set club
     *
     * @param \Shead\FencingBundle\Entity\Clubs $club
     * @return Licencies
     */
    public function setClub(\Shead\FencingBundle\Entity\Clubs $club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Shead\FencingBundle\Entity\Clubs 
     */
    public function getClub()
    {
        return $this->club;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add competitions
     *
     * @param \Shead\FencingBundle\Entity\Competition $competitions
     * @return Licencies
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

    /**
     * Set arbitre
     *
     * @param \Shead\FencingBundle\Entity\Arbitres $arbitre
     * @return Licencies
     */
    public function setArbitre(\Shead\FencingBundle\Entity\Arbitres $arbitre = null)
    {
        $this->arbitre = $arbitre;

        return $this;
    }

    /**
     * Get arbitre
     *
     * @return \Shead\FencingBundle\Entity\Arbitres 
     */
    public function getArbitre()
    {
        return $this->arbitre;
    }
}
