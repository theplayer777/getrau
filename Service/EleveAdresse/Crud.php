<?php
class Service_EleveAdresse_Crud {

    private $db;

    public function __construct() {
        $this->db = Application::getInstance()->getDB();
    }
    
    public function persist($idEleve,$idAdresse){
        $query = "SELECT * FROM eleve_adresse WHERE ideleve=".$idEleve." AND idadresse=".$idAdresse;
        $result = $this->db->query($query);
        //echo $query;
        
        if($result->fetchColumn() == 0){
            $query = "INSERT INTO eleve_adresse (ideleve,idadresse) VALUES (".$idEleve.",".$idAdresse.")";
            //echo $query;
            $this->db->query($query);
        }else{
            //echo "pas passé";
        }
    }
    
    public function deleteAll(){
        $query="DELETE FROM eleve_adresse";
        $this->db->query($query);
    }
}
?>