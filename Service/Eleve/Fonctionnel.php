<?php

class Service_Eleve_Fonctionnel {
    
    function getById($id){
        $serviceCrud = new Service_Eleve_Crud();
        return $serviceCrud->getById($id);
    }
    
    function persist($eleve){
        if (!$eleve->getIdeleve()){
            $serviceCrud = new Service_Eleve_Crud();
            return $serviceCrud->insert($eleve);
        }else{
            $serviceCrud = new Service_Eleve_Crud();
            return $serviceCrud->modify($eleve);     
        }
    }
    
}
?>
