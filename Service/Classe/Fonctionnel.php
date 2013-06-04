<?php

class Service_Classe_Fonctionnel {
    
    function getById($id){
        $serviceCrud = new Service_Classe_Crud();
        return $serviceCrud->getById($id);
    }
    
    function persist($classe){
        $serviceCrud = new Service_Classe_Crud();
        if (!$classe->idClasse){
            return $serviceCrud->insert($classe);
        }else{
            return $serviceCrud->modify($classe);     
        }
    }
    
    function getByParams($params){
        $serviceCrud = new Service_Classe_Crud();
        return $serviceCrud->getByParams($params);
    }
    
}
?>
