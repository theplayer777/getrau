<?php

class Model_Ligne
{

    private $idLigne;

    private $region;

    private $numero;
    
    private $couleur;

    private $routesBus;
    
    private $idArrets;

    public function __construct(){

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

    public function setNumero($numero){
        $this->numero[] = $numero;

        return $this;
    }

    public function removeNumero($numero){
        $this->numero->removeElement($numero);
    }

    public function getNumero(){
        return $this->numero;
    }

    public function addRouteBus($routeBus){
        $this->routesBus[] = $routeBus;

        return $this;
    }

    public function removeRouteBus($routeBus){
        unset($this->routesBus->$routeBus);
    }

    public function getRoutesbus()
    {
        return $this->routesBus;
    }
    
    public function getIdArrets() {
        return $this->idArrets;
    }

    public function addIdArret($idArret) {
        $this->idArrets[] = $idArret;
    }

    public function getCouleur() {
        return $this->couleur;
    }

    public function setCouleur($couleur) {
        $this->couleur = $couleur;
    }


}
