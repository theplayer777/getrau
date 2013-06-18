<?php

class Service_Vehicule_Fonctionnel {
    
    public function getAll(){
        $serviceCrud = new Service_Vehicule_Crud();
        $vehicules = $serviceCrud->getAll();
        return $vehicules;
    }
}

?>