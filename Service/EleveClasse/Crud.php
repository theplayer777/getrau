<?php
class Service_EleveClasse_Crud {

    private $db;

    public function __construct() {
        $this->db = Application::getInstance()->getDB();
    }
    
    public function persist($idEleve,$idClasse){
        $query = "SELECT * FROM eleve_classe WHERE ideleve=".$idEleve." AND idclasse=".$idClasse;
        $result = $this->db->query($query);
        //echo $query;
        
        if($result->fetchColumn() == 0){
            $query = "INSERT INTO eleve_classe (ideleve,idclasse) VALUES (".$idEleve.",".$idClasse.")";
            $this->db->query($query);
        }
    }
    
    public function deleteAll(){
        $query="DELETE FROM eleve_classe";
        $this->db->query($query);
        //echo $query;
    }
}
?>