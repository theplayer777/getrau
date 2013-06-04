<?php

class Service_Adresse_Fonctionnel {
    
    function getById($id){
        $serviceCrud = new Service_Adresse_Crud();
        return $serviceCrud->getById($id);
    }
    
    function persist($adresse){
        $serviceCrud = new Service_Adresse_Crud();
        if (!$adresse->idAdresse){
            return $serviceCrud->insert($adresse);
        }else{
            return $serviceCrud->modify($adresse);     
        }
    }
    
    function getByParams($params){
        $serviceCrud = new Service_Adresse_Crud();
        return $serviceCrud->getByParams($params);
    }
    
}
?>
