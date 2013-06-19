<?php


class Model_HoraireCourse
{

    private $idHoraireCourse;
    private $heure;
    private $type;
    private $idArret;
    private $idCourse;


    public function __construct(){
    }
    
    public function getIdhorairecourse() {
        return $this->idHoraireCourse;
    }

    public function setIdhorairecourse($idhorairecourse) {
        $this->idHoraireCourse = $idhorairecourse;
    }

    public function getHeure() {
        return $this->heure;
    }

    public function setHeure($heure) {
        $this->heure = $heure;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getIdArret() {
        return $this->idArret;
    }

    public function setIdArret($idArret) {
        $this->idArret = $idArret;
    }

    public function getIdCourse() {
        return $this->idCourse;
    }

    public function setIdCourse($idCourse) {
        $this->idCourse = $idCourse;
    }
}

?>