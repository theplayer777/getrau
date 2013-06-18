<?php

class Service_Ligne_Fonctionnel {
    
    function getGeoJSON(){
        $serviceCrud = new Service_Ligne_Crud();
        return $serviceCrud->getGeoJSON();
    }
    
}
?>
