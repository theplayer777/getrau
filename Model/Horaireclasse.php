<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horaireclasse
 *
 * @ORM\Table(name="horaireclasse")
 * @ORM\Entity
 */
class Horaireclasse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idhoraireclasse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="horaireclasse_idhoraireclasse_seq", allocationSize=1, initialValue=1)
     */
    private $idhoraireclasse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurematindebut", type="time", nullable=true)
     */
    private $heurematindebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurematinfin", type="time", nullable=true)
     */
    private $heurematinfin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureapresmididebut", type="time", nullable=true)
     */
    private $heureapresmididebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureapresmidifin", type="time", nullable=true)
     */
    private $heureapresmidifin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Classe", mappedBy="idhoraireclasse")
     */
    private $idclasse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Jour", inversedBy="idhoraireclasse")
     * @ORM\JoinTable(name="horaireclasse_jour",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idhoraireclasse", referencedColumnName="idhoraireclasse")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="nom", referencedColumnName="nom")
     *   }
     * )
     */
    private $nom;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idclasse = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nom = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idhoraireclasse
     *
     * @return integer 
     */
    public function getIdhoraireclasse()
    {
        return $this->idhoraireclasse;
    }

    /**
     * Set heurematindebut
     *
     * @param \DateTime $heurematindebut
     * @return Horaireclasse
     */
    public function setHeurematindebut($heurematindebut)
    {
        $this->heurematindebut = $heurematindebut;

        return $this;
    }

    /**
     * Get heurematindebut
     *
     * @return \DateTime 
     */
    public function getHeurematindebut()
    {
        return $this->heurematindebut;
    }

    /**
     * Set heurematinfin
     *
     * @param \DateTime $heurematinfin
     * @return Horaireclasse
     */
    public function setHeurematinfin($heurematinfin)
    {
        $this->heurematinfin = $heurematinfin;

        return $this;
    }

    /**
     * Get heurematinfin
     *
     * @return \DateTime 
     */
    public function getHeurematinfin()
    {
        return $this->heurematinfin;
    }

    /**
     * Set heureapresmididebut
     *
     * @param \DateTime $heureapresmididebut
     * @return Horaireclasse
     */
    public function setHeureapresmididebut($heureapresmididebut)
    {
        $this->heureapresmididebut = $heureapresmididebut;

        return $this;
    }

    /**
     * Get heureapresmididebut
     *
     * @return \DateTime 
     */
    public function getHeureapresmididebut()
    {
        return $this->heureapresmididebut;
    }

    /**
     * Set heureapresmidifin
     *
     * @param \DateTime $heureapresmidifin
     * @return Horaireclasse
     */
    public function setHeureapresmidifin($heureapresmidifin)
    {
        $this->heureapresmidifin = $heureapresmidifin;

        return $this;
    }

    /**
     * Get heureapresmidifin
     *
     * @return \DateTime 
     */
    public function getHeureapresmidifin()
    {
        return $this->heureapresmidifin;
    }

    /**
     * Add idclasse
     *
     * @param \Jne\GetrauBundle\Entity\Classe $idclasse
     * @return Horaireclasse
     */
    public function addIdclasse(\Jne\GetrauBundle\Entity\Classe $idclasse)
    {
        $this->idclasse[] = $idclasse;

        return $this;
    }

    /**
     * Remove idclasse
     *
     * @param \Jne\GetrauBundle\Entity\Classe $idclasse
     */
    public function removeIdclasse(\Jne\GetrauBundle\Entity\Classe $idclasse)
    {
        $this->idclasse->removeElement($idclasse);
    }

    /**
     * Get idclasse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdclasse()
    {
        return $this->idclasse;
    }

    /**
     * Add nom
     *
     * @param \Jne\GetrauBundle\Entity\Jour $nom
     * @return Horaireclasse
     */
    public function addNom(\Jne\GetrauBundle\Entity\Jour $nom)
    {
        $this->nom[] = $nom;

        return $this;
    }

    /**
     * Remove nom
     *
     * @param \Jne\GetrauBundle\Entity\Jour $nom
     */
    public function removeNom(\Jne\GetrauBundle\Entity\Jour $nom)
    {
        $this->nom->removeElement($nom);
    }

    /**
     * Get nom
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNom()
    {
        return $this->nom;
    }
}
