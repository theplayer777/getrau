<?php

class Model_Course{

    private $idCourse;
    private $idLigne;


    public function __construct(){

    }
    public function getIdCourse() {
        return $this->idCourse;
    }

    public function setIdCourse($idCourse) {
        $this->idCourse = $idCourse;
    }

    public function getIdLigne() {
        return $this->idLigne;
    }

    public function setIdLigne($idLigne) {
        $this->idLigne = $idLigne;
    }

}

?>