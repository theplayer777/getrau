<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity
 */
class Classe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idclasse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="classe_idclasse_seq", allocationSize=1, initialValue=1)
     */
    private $idclasse;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cycle", type="string", length=45, nullable=true)
     */
    private $cycle;

    /**
     * @var string
     *
     * @ORM\Column(name="professeur", type="string", length=45, nullable=true)
     */
    private $professeur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Eleve", mappedBy="idclasse")
     */
    private $ideleve;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Horaireclasse", inversedBy="idclasse")
     * @ORM\JoinTable(name="classe_horaireclasse",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idclasse", referencedColumnName="idclasse")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idhoraireclasse", referencedColumnName="idhoraireclasse")
     *   }
     * )
     */
    private $idhoraireclasse;

    /**
     * @var \Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Etablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etablissement_numero", referencedColumnName="numero")
     * })
     */
    private $etablissementNumero;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ideleve = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idhoraireclasse = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idclasse
     *
     * @return integer 
     */
    public function getIdclasse()
    {
        return $this->idclasse;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Classe
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
     * Set cycle
     *
     * @param string $cycle
     * @return Classe
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get cycle
     *
     * @return string 
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set professeur
     *
     * @param string $professeur
     * @return Classe
     */
    public function setProfesseur($professeur)
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * Get professeur
     *
     * @return string 
     */
    public function getProfesseur()
    {
        return $this->professeur;
    }

    /**
     * Add ideleve
     *
     * @param \Jne\GetrauBundle\Entity\Eleve $ideleve
     * @return Classe
     */
    public function addIdeleve(\Jne\GetrauBundle\Entity\Eleve $ideleve)
    {
        $this->ideleve[] = $ideleve;

        return $this;
    }

    /**
     * Remove ideleve
     *
     * @param \Jne\GetrauBundle\Entity\Eleve $ideleve
     */
    public function removeIdeleve(\Jne\GetrauBundle\Entity\Eleve $ideleve)
    {
        $this->ideleve->removeElement($ideleve);
    }

    /**
     * Get ideleve
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdeleve()
    {
        return $this->ideleve;
    }

    /**
     * Add idhoraireclasse
     *
     * @param \Jne\GetrauBundle\Entity\Horaireclasse $idhoraireclasse
     * @return Classe
     */
    public function addIdhoraireclasse(\Jne\GetrauBundle\Entity\Horaireclasse $idhoraireclasse)
    {
        $this->idhoraireclasse[] = $idhoraireclasse;

        return $this;
    }

    /**
     * Remove idhoraireclasse
     *
     * @param \Jne\GetrauBundle\Entity\Horaireclasse $idhoraireclasse
     */
    public function removeIdhoraireclasse(\Jne\GetrauBundle\Entity\Horaireclasse $idhoraireclasse)
    {
        $this->idhoraireclasse->removeElement($idhoraireclasse);
    }

    /**
     * Get idhoraireclasse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdhoraireclasse()
    {
        return $this->idhoraireclasse;
    }

    /**
     * Set etablissementNumero
     *
     * @param \Jne\GetrauBundle\Entity\Etablissement $etablissementNumero
     * @return Classe
     */
    public function setEtablissementNumero(\Jne\GetrauBundle\Entity\Etablissement $etablissementNumero = null)
    {
        $this->etablissementNumero = $etablissementNumero;

        return $this;
    }

    /**
     * Get etablissementNumero
     *
     * @return \Jne\GetrauBundle\Entity\Etablissement 
     */
    public function getEtablissementNumero()
    {
        return $this->etablissementNumero;
    }
}
