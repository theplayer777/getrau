<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="vehicule_numero_seq", allocationSize=1, initialValue=1)
     */
    private $numero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Course", inversedBy="vehiculeNumero")
     * @ORM\JoinTable(name="vehicule_course",
     *   joinColumns={
     *     @ORM\JoinColumn(name="vehicule_numero", referencedColumnName="numero")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="course_numero", referencedColumnName="numero")
     *   }
     * )
     */
    private $courseNumero;

    /**
     * @var \Transporteur
     *
     * @ORM\ManyToOne(targetEntity="Transporteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transporteur_nom", referencedColumnName="nom")
     * })
     */
    private $transporteurNom;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courseNumero = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add courseNumero
     *
     * @param \Jne\GetrauBundle\Entity\Course $courseNumero
     * @return Vehicule
     */
    public function addCourseNumero(\Jne\GetrauBundle\Entity\Course $courseNumero)
    {
        $this->courseNumero[] = $courseNumero;

        return $this;
    }

    /**
     * Remove courseNumero
     *
     * @param \Jne\GetrauBundle\Entity\Course $courseNumero
     */
    public function removeCourseNumero(\Jne\GetrauBundle\Entity\Course $courseNumero)
    {
        $this->courseNumero->removeElement($courseNumero);
    }

    /**
     * Get courseNumero
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourseNumero()
    {
        return $this->courseNumero;
    }

    /**
     * Set transporteurNom
     *
     * @param \Jne\GetrauBundle\Entity\Transporteur $transporteurNom
     * @return Vehicule
     */
    public function setTransporteurNom(\Jne\GetrauBundle\Entity\Transporteur $transporteurNom = null)
    {
        $this->transporteurNom = $transporteurNom;

        return $this;
    }

    /**
     * Get transporteurNom
     *
     * @return \Jne\GetrauBundle\Entity\Transporteur 
     */
    public function getTransporteurNom()
    {
        return $this->transporteurNom;
    }
}
