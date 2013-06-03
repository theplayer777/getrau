<?php

class Service_Eleve_Crud {
    
    private $db;
        
    function __construct(){
        $this->db = new PDO('pgsql:host=localhost;port=5432;dbname=getrau;user=postgres;password=postgres');
    }
    
    public function getAll(){
        $sql = "SELECT * FROM eleve";
        $result = $this->db->query($sql);
        $object = $result->fetch(PDO::FETCH_OBJ);
    }
    
    public function getById($id){
        
        $sql = "SELECT * FROM eleve WHERE ideleve = ".$id;
        $result = $this->db->query($sql);
        $object = $result->fetch(PDO::FETCH_OBJ);
        
        $eleve = new Model_Eleve();
        
        // LA LIGNE SUIVANTE NE DOIT ETRE POSSIBLE QU'ICI!!!
        $eleve->setIdEleve($object->ideleve);
        $eleve->setDatenaissance($object->datenaissance);
        $eleve->setNom($object->nom);
        $eleve->setNumeroscolaire($object->numeroscolaire);
        $eleve->setPrenom($object->prenom);
        $eleve->setSexe($object->sexe);
        $eleve->setStatuscourant($object->statuscourant);
        $eleve->setStatussuivant($object->statussuivant);
        return $eleve;
        
    }
    
    public function insert($eleve){
        $sql = "INSERT INTO eleve (numeroscolaire,nom,prenom,datenaissance,sexe,statuscourant,statussuivant) VALUES
            ('".$eleve->getNumeroscolaire()."',
            '".$eleve->getNom()."',
            '".$eleve->getPrenom()."',
            '".$eleve->getDatenaissance()."',
            '".$eleve->getSexe()."',
            '".$eleve->getStatuscourant()."',
            '".$eleve->getStatussuivant()."'
                )";
        $this->db->query($sql);
        
        echo $sql;
    }
    
    public function modify($eleve){
        $sql = "UPDATE eleve SET
            numeroscolaire = '".$eleve->getNumeroscolaire()."',
            nom = '".$eleve->getNom()."',
            prenom = '".$eleve->getPrenom()."',
            datenaissance = '".$eleve->getDatenaissance()."',
            sexe = '".$eleve->getSexe()."',
            statuscourant = '".$eleve->getStatuscourant()."',
            statussuivant = '".$eleve->getStatussuivant()."'
                WHERE ideleve = ".$eleve->getIdeleve();
        
        $this->db->query($sql);
        echo $sql;
    }
    
    private function buildEleve(){
        
    }
}
?>
