<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity
 */
class Etablissement
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="etablissement_numero_seq", allocationSize=1, initialValue=1)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

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
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idadresse", referencedColumnName="idadresse")
     * })
     */
    private $idadresse;



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
     * Set nom
     *
     * @param string $nom
     * @return Etablissement
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
     * Set idarret
     *
     * @param \Jne\GetrauBundle\Entity\Arret $idarret
     * @return Etablissement
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
     * Set idadresse
     *
     * @param \Jne\GetrauBundle\Entity\Adresse $idadresse
     * @return Etablissement
     */
    public function setIdadresse(\Jne\GetrauBundle\Entity\Adresse $idadresse = null)
    {
        $this->idadresse = $idadresse;

        return $this;
    }

    /**
     * Get idadresse
     *
     * @return \Jne\GetrauBundle\Entity\Adresse 
     */
    public function getIdadresse()
    {
        return $this->idadresse;
    }
}
