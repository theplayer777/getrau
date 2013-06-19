<?php

class Model_Transporteur{
    
    private $nom;

    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nom){
        $this->nom = $nom;
        return $this->nom;
    }
}
?>