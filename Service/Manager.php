<?php

class Service_Manager {
    
    private static $PREFIX = "Service_";
    
    function __construct() {

    }
    
    function getById($class, $id){
        //DES TESTS A FAIRE
        $serviceName = self::$PREFIX.$class."_Fonctionnel";
        $serviceFonctionnel = new $serviceName();
        return $serviceFonctionnel->getById($id);
        
    }
    
    function getAll($class){
        $serviceName = self::$PREFIX.$class."_Fonctionnel";
        $serviceFonctionnel = new $serviceName();
        return $serviceFonctionnel->getAll();
        
    }
    
    function persist($entity){
        //DES TESTS A FAIRE
        $class = substr(get_class($entity),6);
        $serviceName = self::$PREFIX.$class."_Fonctionnel";
        $serviceFonctionnel = new $serviceName();
        return $serviceFonctionnel->persist($entity);
        
    }
    
    function delete($entity){
        
    }
    
    function deleteAll($class){
        $serviceName = self::$PREFIX.$class."_Fonctionnel";
        $serviceFonctionnel = new $serviceName();
        return $serviceFonctionnel->deleteAll();
    }
    
    function getGeoJSON($class){
        $serviceName = self::$PREFIX.$class."_Fonctionnel";
        $serviceFonctionnel = new $serviceName();
        return $serviceFonctionnel->getGeoJSON();
    }
    
    function getByParams($class,$params){
        $serviceName = self::$PREFIX.$class."_Fonctionnel";
        $serviceFonctionnel = new $serviceName();
        return $serviceFonctionnel->getByParams($params);
    }
}
?>
