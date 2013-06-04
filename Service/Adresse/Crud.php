<?php

class Service_Adresse_Crud {
        
    private $db;
    
    function __construct() {
        $this->db = Application::getInstance()->db;
    }
    
    function getById($id){
        
        $getrau = Application::getInstance();
        $sql = "SELECT * FROM adresse WHERE idadresse = ".$id;
        $result = $getrau->db->query($sql);
        $object = $result->fetch(PDO::FETCH_OBJ);
        print_r ($object);
        
    }
    
    function insert($adresse){
        $sql = "INSERT INTO...";
    }
    
    function modify($adresse){
        $sql = "UPDATE...";
    }
    
    function getByParams($params){
        
        $query = "SELECT * FROM adresse";
        
        if(!empty($params)){
            $query.=" WHERE ";
            foreach($params as $key=>$param){
                $query.=$key." = '".pg_escape_string($param)."' AND ";
            }
            $query = substr($query, 0, -5);
        }
        
        $result = $this->db->query($query);
        $object = $result->fetch(PDO::FETCH_OBJ);
        
        if(!empty($object)){
            $adresse = new Model_Adresse();
            $adresse->setIdAdresse($object->idadresse);
            $adresse->setRue($object->rue);
            $adresse->setNumero($object->numero);
            $adresse->setCodepostal($object->codepostal);
            $adresse->setLocalite($object->localite);
            $adresse->setEmplacement($object->emplacement);
            return $adresse;
        }else{
            return null;
        }
    }
}
?>
