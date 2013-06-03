<?php


class Model_Adresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idadresse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="adresse_idadresse_seq", allocationSize=1, initialValue=1)
     */
    private $idadresse;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=200, nullable=true)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10, nullable=true)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="codepostal", type="integer", nullable=true)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="localite", type="string", length=45, nullable=true)
     */
    private $localite;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="emplacement", type="integer", length=128, nullable=true)
     */

    private $ideleve;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->ideleve = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idadresse
     *
     * @return integer 
     */
    public function getIdadresse()
    {
        return $this->idadresse;
    }

    /**
     * Set rue
     *
     * @param string $rue
     * @return Adresse
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string 
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Adresse
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
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
     * Set codepostal
     *
     * @param integer $codepostal
     * @return Adresse
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return integer 
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set localite
     *
     * @param string $localite
     * @return Adresse
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * Get localite
     *
     * @return string 
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * Add ideleve
     *
     * @param \Jne\GetrauBundle\Entity\Eleve $ideleve
     * @return Adresse
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

}
