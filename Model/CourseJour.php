<?php

class Model_CourseJour{

    private $idCourse;
    private $nomJour;
    private $numeroVehicule;
    private $idCourseLiee;


    public function __construct(){

    }
    public function getIdCourse() {
        return $this->idCourse;
    }

    public function setIdCourse($idCourse) {
        $this->idCourse = $idCourse;
    }

    public function getNomJour() {
        return $this->nomJour;
    }

    public function setNomJour($nomJour) {
        $this->nomJour = $nomJour;
    }

    public function getNumeroVehicule() {
        return $this->numeroVehicule;
    }

    public function setNumeroVehicule($numeroVehicule) {
        $this->numeroVehicule = $numeroVehicule;
    }

    public function getIdCourseLiee() {
        return $this->idCourseLiee;
    }

    public function setIdCourseLiee($idCourseLiee) {
        $this->idCourseLiee = $idCourseLiee;
    }
}

?>