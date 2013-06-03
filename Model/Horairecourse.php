<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horairecourse
 *
 * @ORM\Table(name="horairecourse")
 * @ORM\Entity
 */
class Horairecourse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idhorairecourse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="horairecourse_idhorairecourse_seq", allocationSize=1, initialValue=1)
     */
    private $idhorairecourse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurearrivee", type="time", nullable=true)
     */
    private $heurearrivee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredepart", type="time", nullable=true)
     */
    private $heuredepart;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Course", mappedBy="idhorairecourse")
     */
    private $numero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Jour", mappedBy="idhorairecourse")
     */
    private $nom;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->numero = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nom = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idhorairecourse
     *
     * @return integer 
     */
    public function getIdhorairecourse()
    {
        return $this->idhorairecourse;
    }

    /**
     * Set heurearrivee
     *
     * @param \DateTime $heurearrivee
     * @return Horairecourse
     */
    public function setHeurearrivee($heurearrivee)
    {
        $this->heurearrivee = $heurearrivee;

        return $this;
    }

    /**
     * Get heurearrivee
     *
     * @return \DateTime 
     */
    public function getHeurearrivee()
    {
        return $this->heurearrivee;
    }

    /**
     * Set heuredepart
     *
     * @param \DateTime $heuredepart
     * @return Horairecourse
     */
    public function setHeuredepart($heuredepart)
    {
        $this->heuredepart = $heuredepart;

        return $this;
    }

    /**
     * Get heuredepart
     *
     * @return \DateTime 
     */
    public function getHeuredepart()
    {
        return $this->heuredepart;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Horairecourse
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add numero
     *
     * @param \Jne\GetrauBundle\Entity\Course $numero
     * @return Horairecourse
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
     * Add nom
     *
     * @param \Jne\GetrauBundle\Entity\Jour $nom
     * @return Horairecourse
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
