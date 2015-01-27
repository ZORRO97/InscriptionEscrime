<?php

namespace Shead\FencingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Clubs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shead\FencingBundle\Entity\ClubsRepository")
 * @UniqueEntity("code")
 */
class Clubs
{
    /**
     * @ORM\OneToMany(targetEntity="Licencies", mappedBy="club",cascade={"persist"})
     */
    private $licencies;


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
     * @ORM\Column(name="code", type="string", length=8)
     *
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=2)
     */
    private $zone;

    /**
     * @var string
     *
     * @ORM\Column(name="ligue", type="string", length=20)
     */
    private $ligue;

    /**
     * @var string
     *
     * @ORM\Column(name="nodep", type="string", length=3)
     */
    private $nodep;


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
     * Set code
     *
     * @param string $code
     * @return Clubs
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Clubs
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
     * Set ville
     *
     * @param string $ville
     * @return Clubs
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set zone
     *
     * @param string $zone
     * @return Clubs
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set ligue
     *
     * @param string $ligue
     * @return Clubs
     */
    public function setLigue($ligue)
    {
        $this->ligue = $ligue;

        return $this;
    }

    /**
     * Get ligue
     *
     * @return string 
     */
    public function getLigue()
    {
        return $this->ligue;
    }

    /**
     * Set nodep
     *
     * @param string $nodep
     * @return Clubs
     */
    public function setNodep($nodep)
    {
        $this->nodep = $nodep;

        return $this;
    }

    /**
     * Get nodep
     *
     * @return string 
     */
    public function getNodep()
    {
        return $this->nodep;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->licencies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add licencies
     *
     * @param \Shead\FencingBundle\Entity\Licencies $licencies
     * @return Clubs
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
}
