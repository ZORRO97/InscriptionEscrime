<?php

namespace Shead\FencingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arbcomp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shead\FencingBundle\Entity\ArbcompRepository")
 */
class Arbcomp
{

    /**
    * @ORM\ManyToOne(targetEntity="Shead\FencingBundle\Entity\Arbitres")
    * @ORM\JoinColumn(nullable=false)
    */
     private $Arbitres;

     /**
    * @ORM\ManyToOne(targetEntity="Shead\FencingBundle\Entity\Competition")
    * @ORM\JoinColumn(nullable=false)
    */
     private $Competition;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * Set Arbitres
     *
     * @param \Shead\FencingBundle\Entity\Arbitres $arbitres
     * @return Arbcomp
     */
    public function setArbitres(\Shead\FencingBundle\Entity\Arbitres $arbitres)
    {
        $this->Arbitres = $arbitres;

        return $this;
    }

    /**
     * Get Arbitres
     *
     * @return \Shead\FencingBundle\Entity\Arbitres 
     */
    public function getArbitres()
    {
        return $this->Arbitres;
    }

    /**
     * Set Competition
     *
     * @param \Shead\FencingBundle\Entity\Competition $competition
     * @return Arbcomp
     */
    public function setCompetition(\Shead\FencingBundle\Entity\Competition $competition)
    {
        $this->Competition = $competition;

        return $this;
    }

    /**
     * Get Competition
     *
     * @return \Shead\FencingBundle\Entity\Competition 
     */
    public function getCompetition()
    {
        return $this->Competition;
    }
}
