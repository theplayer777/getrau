<?php

class Model_EleveAdresse {

    private $idAdresse;
    private $idEleve;

    public function __construct() {
        
    }
    
    public function setIdAdresse($idAdresse){
        $this->idAdresse = $idAdresse;
    }
    
    public function setIdEleve($idEleve){
        $this->idEleve = $idEleve;
    }
    
}
?>
