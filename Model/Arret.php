<?php

class Model_Arret implements JsonSerializable
{

    private $idarret;
    
    private $nom;
    
    private $localite;
    
    private $emplacement;

    private $idroutebus;

   
    public function __construct()
    {
    }


    
    public function getIdarret(){
        return $this->idarret;
    }

    public function setIdarret($idarret){
        $this->idarret = $idarret;
        return $this;
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getLocalite() {
        return $this->localite;
    }

    public function setLocalite($localite) {
        $this->localite = $localite;
    }

    public function getEmplacement() {
        return $this->emplacement;
    }

    public function setEmplacement($emplacement) {
        $this->emplacement = $emplacement;
    }

    public function jsonSerialize() {
        $arret = array('id' => $this->idarret, 'nom' => $this->nom, 'localite' => $this->localite);
        return $arret;
    }


    
    
}
