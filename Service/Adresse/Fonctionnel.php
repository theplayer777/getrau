<?php

class Service_Adresse_Fonctionnel {
    
    function getById($id){
        $serviceCrud = new Service_Adresse_Crud();
        return $serviceCrud->getById($id);
    }
    
    function persist($adresse){
        if (!$adresse->id){
            $serviceCrud = new Service_Adresse_Crud();
            return $serviceCrud->insert($adresse);
        }else{
            $serviceCrud = new Service_Adresse_Crud();
            return $serviceCrud->modify($adresse);     
        }
    }
    
}
?>
