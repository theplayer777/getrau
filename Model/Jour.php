<?php

class Jour
{
 
    private $nom;

   
    public function __construct(){

    }
    
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
}

?>