<?php

class Controller_GetData {
    
    private $twig;
    
    public function __construct() {
       $loader = new Twig_Loader_Filesystem('views');
       $this->twig = new Twig_Environment($loader, array(
      'cache' => false
        ));
    }
    
    public function getArretsGeoJSON(){
        $servicesManager = new Service_Manager();
        print_r($servicesManager->getGeoJSON('Arret'));
    }
    
    public function getLignesGeoJSON(){
        $servicesManager = new Service_Manager();
        print_r($servicesManager->getGeoJSON('Ligne'));
    }
    
}

?>
