<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistiques
 *
 * @ORM\Table(name="statistiques")
 * @ORM\Entity
 */
class Statistiques
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idstatistique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="statistiques_idstatistique_seq", allocationSize=1, initialValue=1)
     */
    private $idstatistique;

    /**
     * @var integer
     *
     * @ORM\Column(name="distanceapied", type="integer", nullable=true)
     */
    private $distanceapied;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredepartmatin", type="time", nullable=true)
     */
    private $heuredepartmatin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurearriveematin", type="time", nullable=true)
     */
    private $heurearriveematin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredepartmidi", type="time", nullable=true)
     */
    private $heuredepartmidi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurearriveemidi", type="time", nullable=true)
     */
    private $heurearriveemidi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredepartapresmidi", type="time", nullable=true)
     */
    private $heuredepartapresmidi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurearriveeapresmidi", type="time", nullable=true)
     */
    private $heurearriveeapresmidi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredepartsoir", type="time", nullable=true)
     */
    private $heuredepartsoir;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurearriveesoir", type="time", nullable=true)
     */
    private $heurearriveesoir;

    /**
     * @var \Eleve
     *
     * @ORM\ManyToOne(targetEntity="Eleve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ideleve", referencedColumnName="ideleve")
     * })
     */
    private $ideleve;

    /**
     * @var \Classe
     *
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idclasse", referencedColumnName="idclasse")
     * })
     */
    private $idclasse;

    /**
     * @var \Arret
     *
     * @ORM\ManyToOne(targetEntity="Arret")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idarret", referencedColumnName="idarret")
     * })
     */
    private $idarret;

    /**
     * @var \Ligne
     *
     * @ORM\ManyToOne(targetEntity="Ligne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idligne", referencedColumnName="idligne")
     * })
     */
    private $idligne;



    /**
     * Get idstatistique
     *
     * @return integer 
     */
    public function getIdstatistique()
    {
        return $this->idstatistique;
    }

    /**
     * Set distanceapied
     *
     * @param integer $distanceapied
     * @return Statistiques
     */
    public function setDistanceapied($distanceapied)
    {
        $this->distanceapied = $distanceapied;

        return $this;
    }

    /**
     * Get distanceapied
     *
     * @return integer 
     */
    public function getDistanceapied()
    {
        return $this->distanceapied;
    }

    /**
     * Set heuredepartmatin
     *
     * @param \DateTime $heuredepartmatin
     * @return Statistiques
     */
    public function setHeuredepartmatin($heuredepartmatin)
    {
        $this->heuredepartmatin = $heuredepartmatin;

        return $this;
    }

    /**
     * Get heuredepartmatin
     *
     * @return \DateTime 
     */
    public function getHeuredepartmatin()
    {
        return $this->heuredepartmatin;
    }

    /**
     * Set heurearriveematin
     *
     * @param \DateTime $heurearriveematin
     * @return Statistiques
     */
    public function setHeurearriveematin($heurearriveematin)
    {
        $this->heurearriveematin = $heurearriveematin;

        return $this;
    }

    /**
     * Get heurearriveematin
     *
     * @return \DateTime 
     */
    public function getHeurearriveematin()
    {
        return $this->heurearriveematin;
    }

    /**
     * Set heuredepartmidi
     *
     * @param \DateTime $heuredepartmidi
     * @return Statistiques
     */
    public function setHeuredepartmidi($heuredepartmidi)
    {
        $this->heuredepartmidi = $heuredepartmidi;

        return $this;
    }

    /**
     * Get heuredepartmidi
     *
     * @return \DateTime 
     */
    public function getHeuredepartmidi()
    {
        return $this->heuredepartmidi;
    }

    /**
     * Set heurearriveemidi
     *
     * @param \DateTime $heurearriveemidi
     * @return Statistiques
     */
    public function setHeurearriveemidi($heurearriveemidi)
    {
        $this->heurearriveemidi = $heurearriveemidi;

        return $this;
    }

    /**
     * Get heurearriveemidi
     *
     * @return \DateTime 
     */
    public function getHeurearriveemidi()
    {
        return $this->heurearriveemidi;
    }

    /**
     * Set heuredepartapresmidi
     *
     * @param \DateTime $heuredepartapresmidi
     * @return Statistiques
     */
    public function setHeuredepartapresmidi($heuredepartapresmidi)
    {
        $this->heuredepartapresmidi = $heuredepartapresmidi;

        return $this;
    }

    /**
     * Get heuredepartapresmidi
     *
     * @return \DateTime 
     */
    public function getHeuredepartapresmidi()
    {
        return $this->heuredepartapresmidi;
    }

    /**
     * Set heurearriveeapresmidi
     *
     * @param \DateTime $heurearriveeapresmidi
     * @return Statistiques
     */
    public function setHeurearriveeapresmidi($heurearriveeapresmidi)
    {
        $this->heurearriveeapresmidi = $heurearriveeapresmidi;

        return $this;
    }

    /**
     * Get heurearriveeapresmidi
     *
     * @return \DateTime 
     */
    public function getHeurearriveeapresmidi()
    {
        return $this->heurearriveeapresmidi;
    }

    /**
     * Set heuredepartsoir
     *
     * @param \DateTime $heuredepartsoir
     * @return Statistiques
     */
    public function setHeuredepartsoir($heuredepartsoir)
    {
        $this->heuredepartsoir = $heuredepartsoir;

        return $this;
    }

    /**
     * Get heuredepartsoir
     *
     * @return \DateTime 
     */
    public function getHeuredepartsoir()
    {
        return $this->heuredepartsoir;
    }

    /**
     * Set heurearriveesoir
     *
     * @param \DateTime $heurearriveesoir
     * @return Statistiques
     */
    public function setHeurearriveesoir($heurearriveesoir)
    {
        $this->heurearriveesoir = $heurearriveesoir;

        return $this;
    }

    /**
     * Get heurearriveesoir
     *
     * @return \DateTime 
     */
    public function getHeurearriveesoir()
    {
        return $this->heurearriveesoir;
    }

    /**
     * Set ideleve
     *
     * @param \Jne\GetrauBundle\Entity\Eleve $ideleve
     * @return Statistiques
     */
    public function setIdEleve(\Jne\GetrauBundle\Entity\Eleve $ideleve = null)
    {
        $this->ideleve = $ideleve;

        return $this;
    }

    /**
     * Get ideleve
     *
     * @return \Jne\GetrauBundle\Entity\Eleve 
     */
    public function getIdEleve()
    {
        return $this->ideleve;
    }

    /**
     * Set idclasse
     *
     * @param \Jne\GetrauBundle\Entity\Classe $idclasse
     * @return Statistiques
     */
    public function setIdclasse(\Jne\GetrauBundle\Entity\Classe $idclasse = null)
    {
        $this->idclasse = $idclasse;

        return $this;
    }

    /**
     * Get idclasse
     *
     * @return \Jne\GetrauBundle\Entity\Classe 
     */
    public function getIdclasse()
    {
        return $this->idclasse;
    }

    /**
     * Set idarret
     *
     * @param \Jne\GetrauBundle\Entity\Arret $idarret
     * @return Statistiques
     */
    public function setIdarret(\Jne\GetrauBundle\Entity\Arret $idarret = null)
    {
        $this->idarret = $idarret;

        return $this;
    }

    /**
     * Get idarret
     *
     * @return \Jne\GetrauBundle\Entity\Arret 
     */
    public function getIdarret()
    {
        return $this->idarret;
    }

    /**
     * Set idligne
     *
     * @param \Jne\GetrauBundle\Entity\Ligne $idligne
     * @return Statistiques
     */
    public function setIdligne(\Jne\GetrauBundle\Entity\Ligne $idligne = null)
    {
        $this->idligne = $idligne;

        return $this;
    }

    /**
     * Get idligne
     *
     * @return \Jne\GetrauBundle\Entity\Ligne 
     */
    public function getIdligne()
    {
        return $this->idligne;
    }
}
