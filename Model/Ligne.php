<?php

class Model_Ligne implements JsonSerializable
{

    private $idLigne;

    private $region;
    
    private $couleur;
    
    private $arrets;

    public function __construct(){

    }

    public function setIdLigne($idLigne){
        $this->idLigne = $idLigne;
    }
    
    public function getIdLigne(){
        return $this->idLigne;
    }

    public function setRegion($region){
        $this->region = $region;
        return $this;
    }

    public function getRegion(){
        return $this->region;
    }
    
    public function getArrets() {
        return $this->arrets;
    }

    public function addArret($idArret) {
        $this->arrets[] = $idArret;
    }

    public function getCouleur() {
        return $this->couleur;
    }

    public function setCouleur($couleur) {
        $this->couleur = $couleur;
    }

    public function jsonSerialize() {
        $ligne = array('id' => $this->idLigne, 'region' => $this->region, 'arrets' => array($this->arrets));
        return $ligne;
    }


}

?>