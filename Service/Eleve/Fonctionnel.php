<?php

class Service_Eleve_Fonctionnel {
    
    function getById($id){
        $serviceCrud = new Service_Eleve_Crud();
        return $serviceCrud->getById($id);
    }
    
    function persist($eleve){
        $serviceCrud = new Service_Eleve_Crud();
        if (!$eleve->getIdEleve()){
            return $serviceCrud->insert($eleve);
        }else{
            return $serviceCrud->modify($eleve);     
        }
    }
    
}
?>
