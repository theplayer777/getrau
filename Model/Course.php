<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity
 */
class Course
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="course_numero_seq", allocationSize=1, initialValue=1)
     */
    private $numero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vehicule", mappedBy="courseNumero")
     */
    private $vehiculeNumero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ligne", inversedBy="numero")
     * @ORM\JoinTable(name="course_ligne",
     *   joinColumns={
     *     @ORM\JoinColumn(name="numero", referencedColumnName="numero")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idligne", referencedColumnName="idligne")
     *   }
     * )
     */
    private $idligne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Horairecourse", inversedBy="numero")
     * @ORM\JoinTable(name="course_horairecourse",
     *   joinColumns={
     *     @ORM\JoinColumn(name="numero", referencedColumnName="numero")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idhorairecourse", referencedColumnName="idhorairecourse")
     *   }
     * )
     */
    private $idhorairecourse;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehiculeNumero = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idligne = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idhorairecourse = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Add vehiculeNumero
     *
     * @param \Jne\GetrauBundle\Entity\Vehicule $vehiculeNumero
     * @return Course
     */
    public function addVehiculeNumero(\Jne\GetrauBundle\Entity\Vehicule $vehiculeNumero)
    {
        $this->vehiculeNumero[] = $vehiculeNumero;

        return $this;
    }

    /**
     * Remove vehiculeNumero
     *
     * @param \Jne\GetrauBundle\Entity\Vehicule $vehiculeNumero
     */
    public function removeVehiculeNumero(\Jne\GetrauBundle\Entity\Vehicule $vehiculeNumero)
    {
        $this->vehiculeNumero->removeElement($vehiculeNumero);
    }

    /**
     * Get vehiculeNumero
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehiculeNumero()
    {
        return $this->vehiculeNumero;
    }

    /**
     * Add idligne
     *
     * @param \Jne\GetrauBundle\Entity\Ligne $idligne
     * @return Course
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
     * Add idhorairecourse
     *
     * @param \Jne\GetrauBundle\Entity\Horairecourse $idhorairecourse
     * @return Course
     */
    public function addIdhorairecourse(\Jne\GetrauBundle\Entity\Horairecourse $idhorairecourse)
    {
        $this->idhorairecourse[] = $idhorairecourse;

        return $this;
    }

    /**
     * Remove idhorairecourse
     *
     * @param \Jne\GetrauBundle\Entity\Horairecourse $idhorairecourse
     */
    public function removeIdhorairecourse(\Jne\GetrauBundle\Entity\Horairecourse $idhorairecourse)
    {
        $this->idhorairecourse->removeElement($idhorairecourse);
    }

    /**
     * Get idhorairecourse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdhorairecourse()
    {
        return $this->idhorairecourse;
    }
}
