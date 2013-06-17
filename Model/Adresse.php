<?php
header('Content-Type: text/html; charset=utf-8');
class Model_Adresse implements JsonSerializable {

    private $idAdresse;
    private $rue;
    private $numero;
    private $codePostal;
    private $localite;
    private $emplacement;
    private $x;
    private $y;

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

    public function setCodePostal($codepostal) {
        $this->codePostal = $codepostal;

        return $this;
    }

    public function getCodePostal() {
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
    
    public function getX(){
        return $this->x;
    }
    public function setX($x){
        $this->x = $x;
    }
    public function getY(){
        return $this->y;
    }
    public function setY($y){
        $this->y = $y;
    }

    public function jsonSerialize() {
        $adresse = array('rue' => $this->rue, "numero" => $this->numero, "localite" => $this->localite, "x" => $this->x, "y" => $this->y );
        return $adresse;
    }

}
