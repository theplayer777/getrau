<?php

class Classe {

    private $idClasse;
    private $nom;
    private $cycle;
    private $professeur;
    private $horaires;
    private $numeroEtablissement;

    public function __construct() {
        
    }

    public function setIdClasse($idClasse) {
        $this->idClasse = $idClasse;
    }

    public function getIdClasse() {
        return $this->idClasse;
    }

    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setCycle($cycle) {
        $this->cycle = $cycle;

        return $this;
    }

    public function getCycle() {
        return $this->cycle;
    }

    public function setProfesseur($professeur) {
        $this->professeur = $professeur;

        return $this;
    }

    public function getProfesseur() {
        return $this->professeur;
    }

    public function addHoraire($horaire) {
        $this->horaires[] = $horaire;

        return $this;
    }

    public function removeHoraire($horaire) {
        //$this->idhoraireclasse->removeElement($idhoraireclasse);
    }

    public function getHoraires() {
        return $this->horaires;
    }

    public function setNumeroEtablissement($numeroEtablissement) {
        $this->numeroEtablissement = $numeroEtablissement;

        return $this;
    }

    public function getNumeroEtablissement() {
        return $this->numeroEtablissement;
    }

}
