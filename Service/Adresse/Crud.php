<?php

class Service_Adresse_Crud {
        
    function __construct(){
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
}
?>
