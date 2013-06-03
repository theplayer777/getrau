<?php

namespace Jne\GetrauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity
 */
class Route
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idroute", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="route_idroute_seq", allocationSize=1, initialValue=1)
     */
    private $idroute;

    /**
     * @var integer
     *
     * @ORM\Column(name="longueur", type="integer", nullable=true)
     */
    private $longueur;



    /**
     * Get idroute
     *
     * @return integer 
     */
    public function getIdroute()
    {
        return $this->idroute;
    }

    /**
     * Set longueur
     *
     * @param integer $longueur
     * @return Route
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
}
