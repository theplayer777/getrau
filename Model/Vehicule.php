<?php

class Model_Vehicule implements JsonSerializable{

    private $numero;
    private $transporteurNom;


    public function __construct(){
        
    }

    public function getNumero(){
        return $this->numero;
    }
    
    public function setNumero($numero){
        $this->numero = $numero;
        return $this->numero;
    }

    public function setTransporteurNom($transporteurNom){
        $this->transporteurNom = $transporteurNom;
        return $this->transporteurNom;
    }

    public function getTransporteurNom()
    {
        return $this->transporteurNom;
    }

    public function jsonSerialize() {
        $vehicule = array('numero' => $this->numero, 'transporteur' => $this->transporteurNom);
        return $vehicule;    
    }
}
?>