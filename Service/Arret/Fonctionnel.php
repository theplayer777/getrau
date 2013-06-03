<?php

class Service_Arret_Fonctionnel {
    
    function getById($id){
        $serviceCrud = new Service_Arret_Crud();
        return $serviceCrud->getById($id);
    }
    
    function persist($arret){
        if (!$arret->id){
            $serviceCrud = new Service_Arret_Crud();
            return $serviceCrud->insert($arret);
        }else{
            $serviceCrud = new Service_Arret_Crud();
            return $serviceCrud->modify($arret);     
        }
    }
    
    function getGeoJSON(){
        $serviceCrud = new Service_Arret_Crud();
        return $serviceCrud->getGeoJSON();
    }
    
}
?>
