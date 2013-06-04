<?php

class Service_Eleve_Crud {
    
    private $db;
    
    function __construct() {
        $this->db = Application::getInstance()->db;
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
        $eleve->setDateNaissance($object->datenaissance);
        $eleve->setNom($object->nom);
        $eleve->setNumeroScolaire($object->numeroscolaire);
        $eleve->setPrenom($object->prenom);
        $eleve->setSexe($object->sexe);
        $eleve->setStatuscourant($object->statuscourant);
        $eleve->setStatussuivant($object->statussuivant);
        return $eleve;
        
    }
    
    public function insert($eleve){
        $params="numeroscolaire";
        $values="";
        if(isset($eleve->getNom())){
            $params.=",nom";
            $values.=",'".$eleve->getNumeroScolaire()."'";
        }
        if(isset($eleve->getPrenom())){
            $params.=",prenom";
            $values.=",'".$eleve->getPrenom()."'";
        }
        if(isset($eleve->getDateNaissance())){
            $params.=",datenaissance";
            $values.=",'".$eleve->getDateNaissance()."'";
        }
        if(isset($eleve->getSexe())){
            $params.=",sexe";
            $values.=",'".$eleve->getSexe()."'";
        }
        if(isset($eleve->getStatusCourant())){
            $params.=",statuscourant";
            $values.=",'".$eleve->getStatusCourant()."'";
        }
        if(isset($eleve->getStatusSuivant())){
            $params.=",statussuivant";
            $values.=",'".$eleve->getStatusSuivant()."'";
        }
        $query = "INSERT INTO eleve (".$params.") VALUES (".$values.") RETURNING ideleve";

        return $this->db->query($query);
    }
    
    public function modify($eleve){
        $sql = "UPDATE eleve SET
            numeroscolaire = '".$eleve->getNumeroScolaire()."',
            nom = '".$eleve->getNom()."',
            prenom = '".$eleve->getPrenom()."',
            datenaissance = '".$eleve->getDateNaissance()."',
            sexe = '".$eleve->getSexe()."',
            statuscourant = '".$eleve->getStatuscourant()."',
            statussuivant = '".$eleve->getStatussuivant()."'
                WHERE ideleve = ".$eleve->getIdEleve()."RETURNING ideleve";
        
        return $this->db->query($sql);
    }
    
    private function buildEleve(){
        
    }
}
?>
