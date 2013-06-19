<?php

class Service_Ligne_Fonctionnel {
    
    function getGeoJSON(){
        $serviceCrud = new Service_Ligne_Crud();
        return $serviceCrud->getGeoJSON();
    }
    
    function getById($id){
        $serviceCrud = new Service_Ligne_Crud();
        return $serviceCrud->getById($id);
    }
    
    function getAll(){
        $serviceCrud = new Service_Ligne_Crud();
        return $serviceCrud->getAll();
    }
    
}
?>