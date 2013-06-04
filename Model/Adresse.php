<?php

class Model_Adresse {

    private $idAdresse;
    private $rue;
    private $numero;
    private $codePostal;
    private $localite;
    private $emplacement;

    public function __construct() {
        
    }

    public function setIdAdresse($idAdresse) {
        $this->idAdresse = $idAdresse;
    }

    public function getIdAdresse() {
        return $this->idAdresse;
    }

    public function setRue($rue) {
        $this->rue = $rue;

        return $this;
    }

    public function getRue() {
        return $this->rue;
    }

    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setCodepostal($codepostal) {
        $this->codePostal = $codepostal;

        return $this;
    }

    public function getCodepostal() {
        return $this->codePostal;
    }

    public function setLocalite($localite) {
        $this->localite = $localite;

        return $this;
    }

    public function getLocalite() {
        return $this->localite;
    }
    
    public function setEmplacement($emplacement){
        $this->emplacement = $emplacement;
    }
    
    public function getEmplacement(){
        return $this->emplacement;
    }

}
