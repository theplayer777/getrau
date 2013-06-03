<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table(name="ligne")
 * @ORM\Entity
 */
class Ligne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idligne", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ligne_idligne_seq", allocationSize=1, initialValue=1)
     */
    private $idligne;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Course", mappedBy="idligne")
     */
    private $numero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Routebus", inversedBy="idligne")
     * @ORM\JoinTable(name="ligne_routebus",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idligne", referencedColumnName="idligne")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idroutebus", referencedColumnName="idroutebus")
     *   }
     * )
     */
    private $idroutebus;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->numero = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idroutebus = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idligne
     *
     * @return integer 
     */
    public function getIdligne()
    {
        return $this->idligne;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Ligne
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Add numero
     *
     * @param \Jne\GetrauBundle\Entity\Course $numero
     * @return Ligne
     */
    public function addNumero(\Jne\GetrauBundle\Entity\Course $numero)
    {
        $this->numero[] = $numero;

        return $this;
    }

    /**
     * Remove numero
     *
     * @param \Jne\GetrauBundle\Entity\Course $numero
     */
    public function removeNumero(\Jne\GetrauBundle\Entity\Course $numero)
    {
        $this->numero->removeElement($numero);
    }

    /**
     * Get numero
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Add idroutebus
     *
     * @param \Jne\GetrauBundle\Entity\Routebus $idroutebus
     * @return Ligne
     */
    public function addIdroutebus(\Jne\GetrauBundle\Entity\Routebus $idroutebus)
    {
        $this->idroutebus[] = $idroutebus;

        return $this;
    }

    /**
     * Remove idroutebus
     *
     * @param \Jne\GetrauBundle\Entity\Routebus $idroutebus
     */
    public function removeIdroutebus(\Jne\GetrauBundle\Entity\Routebus $idroutebus)
    {
        $this->idroutebus->removeElement($idroutebus);
    }

    /**
     * Get idroutebus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdroutebus()
    {
        return $this->idroutebus;
    }
}
