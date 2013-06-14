<?php


class Model_Eleve implements JsonSerializable
{
    
    private $idEleve;

    
    private $numeroscolaire;

    
    private $nom;

    
    private $prenom;

    
    private $dateNaissance;

    
    private $sexe;

    
    private $statusCourant;

    
    private $statusSuivant;

    
    private $adresses;

   
    private $classes;

    
    public function __construct()
    {
    }

    public function setIdEleve($ideleve){
        $this->idEleve = $ideleve;
    }
    
    public function getIdEleve()
    {
        return $this->idEleve;
    }


    public function setNumeroScolaire($numeroscolaire)
    {
        $this->numeroscolaire = $numeroscolaire;

        return $this;
    }

    
    public function getNumeroScolaire()
    {
        return $this->numeroscolaire;
    }

    
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    
    public function getNom()
    {
        return $this->nom;
    }

    
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    
    public function getPrenom()
    {
        return $this->prenom;
    }

    
    public function setDateNaissance($datenaissance)
    {
        $this->dateNaissance = $datenaissance;

        return $this;
    }

    
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    
    public function getSexe()
    {
        return $this->sexe;
    }

    
    public function setStatusCourant($statuscourant)
    {
        $this->statusCourant = $statuscourant;

        return $this;
    }

   
    public function getStatusCourant()
    {
        return $this->statusCourant;
    }

    
    public function setStatusSuivant($statussuivant){
        $this->statusSuivant = $statussuivant;

        return $this;
    }

    
    public function getStatusSuivant(){
        return $this->statusSuivant;
    }

    
    public function addAdresse($adresse){
        $this->adresses[] = $adresse;

        return $this;
    }
    
    public function getAdresses(){
        return $this->adresses;
    }
    public function getClasses(){
        return $this->classes;
    }
    public function setAdresses($adresses){
        $this->adresses = $adresses;
    }
    
    public function setClasses($classes){
        $this->classes = $classes;
    }
    
    public function removeAdresse($adresse){
        
    }

    
    public function addClasse($classe){
        $this->classes[] = $classe;

        return $this;
    }

    
    public function removeClasse($idclasse){
        $this->idclasse->removeElement($idclasse);
    }

    public function jsonSerialize() {
        $eleve = array('nom' => $this->nom, 'prenom' => $this->prenom, 'adresses' => array($this->adresses), 'classes' => array($this->classes));
        return $eleve;
    }
}
