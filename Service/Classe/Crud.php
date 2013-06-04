<?php

class Service_Classe_Crud {
    
    private $db;
    
    public function __construct() {
        $this->db = Application::getInstance()->db;
    }
    
    public function getAll(){
        $query = "SELECT * FROM classe";
        $result = $this->db->query($query);
        $objects = $result->fetch(PDO::FETCH_OBJ);
        $classes = array();
        foreach($objects as $object){
            $classe = $this->buildClasse($object);
            array_push($classes, $classe);
        }
        return $classes;
    }
    
    public function getById($id){
        
        $query = "SELECT * FROM classe WHERE idclasse = ".$id;
        $result = $this->db->query($query);
        $object = $result->fetch(PDO::FETCH_OBJ);
        
        return $this->buildClasse($object);
        
    }
    
    public function insert($classe){
        $params="nom,numeroetablissement";
        $values="'".$classe->getNom()."','".$classe->getNumeroEtablissement()."'";
        if(isset($classe->getCycle())){
            $params.=",cycle";
            $values.=",'".$eleve->getCycle()."'";
        }
        if(isset($classe->getCycle())){
            $params.=",professeur";
            $values.=",'".$eleve->getProfesseur()."'";
        }
        $query = "INSERT INTO classe (".$params.") VALUES (".$values.") RETURNING idclasse";
        
        return $this->db->query($query);
    }
    
    public function modify($classe){
        $query = "UPDATE classe SET
            nom = '".$classe->getNumeroScolaire()."',
            cycle = '".$classe->getNom()."',
            professeur = '".$classe->getPrenom()."',
            numeroEtablissement = '".$classe->getDateNaissance()."'
                WHERE idclasse = ".$classe->getIdClasse()."RETURNING idclasse";
        
        return $this->db->query($query);
    }
    
    private function buildClasse($object){
        $classe = new Model_Classe();
        
        // LA LIGNE SUIVANTE NE DOIT ETRE POSSIBLE QU'ICI!!!
        $classe->setIdClasse($object->idclasse);
        $classe->setNom($object->nom);
        $classe->setCycle($object->cycle);
        $classe->setProfesseur($object->professeur);
        $classe->setNumeroEtablissement($object->numeroEtablissement);
        
        return $classe;
    }
}
?>
