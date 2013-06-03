<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Routebus
 *
 * @ORM\Table(name="routebus")
 * @ORM\Entity
 */
class Routebus
{
    /**
     * @var string
     *
     * @ORM\Column(name="idroutebus", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="routebus_idroutebus_seq", allocationSize=1, initialValue=1)
     */
    private $idroutebus;

    /**
     * @var integer
     *
     * @ORM\Column(name="longueur", type="integer", nullable=true)
     */
    private $longueur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ligne", mappedBy="idroutebus")
     */
    private $idligne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Arret", inversedBy="idroutebus")
     * @ORM\JoinTable(name="routebus_arret",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idroutebus", referencedColumnName="idroutebus")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idarret", referencedColumnName="idarret")
     *   }
     * )
     */
    private $idarret;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idligne = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idarret = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idroutebus
     *
     * @return string 
     */
    public function getIdroutebus()
    {
        return $this->idroutebus;
    }

    /**
     * Set longueur
     *
     * @param integer $longueur
     * @return Routebus
     */
    public function setLongueur($longueur)
    {
        $this->longueur = $longueur;

        return $this;
    }

    /**
     * Get longueur
     *
     * @return integer 
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * Add idligne
     *
     * @param \Jne\GetrauBundle\Entity\Ligne $idligne
     * @return Routebus
     */
    public function addIdligne(\Jne\GetrauBundle\Entity\Ligne $idligne)
    {
        $this->idligne[] = $idligne;

        return $this;
    }

    /**
     * Remove idligne
     *
     * @param \Jne\GetrauBundle\Entity\Ligne $idligne
     */
    public function removeIdligne(\Jne\GetrauBundle\Entity\Ligne $idligne)
    {
        $this->idligne->removeElement($idligne);
    }

    /**
     * Get idligne
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdligne()
    {
        return $this->idligne;
    }

    /**
     * Add idarret
     *
     * @param \Jne\GetrauBundle\Entity\Arret $idarret
     * @return Routebus
     */
    public function addIdarret(\Jne\GetrauBundle\Entity\Arret $idarret)
    {
        $this->idarret[] = $idarret;

        return $this;
    }

    /**
     * Remove idarret
     *
     * @param \Jne\GetrauBundle\Entity\Arret $idarret
     */
    public function removeIdarret(\Jne\GetrauBundle\Entity\Arret $idarret)
    {
        $this->idarret->removeElement($idarret);
    }

    /**
     * Get idarret
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdarret()
    {
        return $this->idarret;
    }
}
