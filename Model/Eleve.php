<?php


class Model_Eleve
{
    
    private $ideleve;

    
    private $numeroscolaire;

    
    private $nom;

    
    private $prenom;

    
    private $datenaissance;

    
    private $sexe;

    
    private $statuscourant;

    
    private $statussuivant;

    
    private $idadresse;

   
    private $idclasse;

    
    public function __construct()
    {
    }

    public function setIdeleve($ideleve){
        $this->ideleve = $ideleve;
    }
    
    public function getIdeleve()
    {
        return $this->ideleve;
    }


    public function setNumeroscolaire($numeroscolaire)
    {
        $this->numeroscolaire = $numeroscolaire;

        return $this;
    }

    
    public function getNumeroscolaire()
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

    
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    
    public function getDatenaissance()
    {
        return $this->datenaissance;
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

    
    public function setStatuscourant($statuscourant)
    {
        $this->statuscourant = $statuscourant;

        return $this;
    }

   
    public function getStatuscourant()
    {
        return $this->statuscourant;
    }

    
    public function setStatussuivant($statussuivant)
    {
        $this->statussuivant = $statussuivant;

        return $this;
    }

    
    public function getStatussuivant()
    {
        return $this->statussuivant;
    }

    
    public function addIdadresse($idadresse)
    {
        $this->idadresse[] = $idadresse;

        return $this;
    }

    
    public function removeIdadresse($idadresse)
    {
        $this->idadresse->removeElement($idadresse);
    }

    
    public function getIdadresse()
    {
        return $this->idadresse;
    }

    
    public function addIdclasse($idclasse)
    {
        $this->idclasse[] = $idclasse;

        return $this;
    }

    
    public function removeIdclasse($idclasse)
    {
        $this->idclasse->removeElement($idclasse);
    }

    
    public function getIdclasse()
    {
        return $this->idclasse;
    }
}
