<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jour
 *
 * @ORM\Table(name="jour")
 * @ORM\Entity
 */
class Jour
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="jour_nom_seq", allocationSize=1, initialValue=1)
     */
    private $nom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Horaireclasse", mappedBy="nom")
     */
    private $idhoraireclasse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Horairecourse", inversedBy="nom")
     * @ORM\JoinTable(name="jour_horairecourse",
     *   joinColumns={
     *     @ORM\JoinColumn(name="nom", referencedColumnName="nom")
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
        $this->idhoraireclasse = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idhorairecourse = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add idhoraireclasse
     *
     * @param \Jne\GetrauBundle\Entity\Horaireclasse $idhoraireclasse
     * @return Jour
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
     * Add idhorairecourse
     *
     * @param \Jne\GetrauBundle\Entity\Horairecourse $idhorairecourse
     * @return Jour
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
