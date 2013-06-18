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
    
    public function getElevesGeoJSON(){
        $servicesManager = new Service_Manager();
        print_r($servicesManager->getGeoJSON('Eleve'));
    }
    
    public function getEleves($json = 0){
        $serviceManager = new Service_Manager();
        $eleves = $serviceManager->getAll('Eleve');
        
        if($json == 1){
            return $eleves;
        }else{
            header('Content-type: application/json; charset =utf-8');
            echo json_encode($eleves,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        //print_r($eleves);
        //echo $this->twig->render('index.html.twig',array('eleve' => $eleve));
    }
    
    public function getVehicules($json = 0){
        $serviceManager = new Service_Manager();
        $vehicules = $serviceManager->getAll('Vehicule');
        
        if($json == 1){
            return $vehicules;
        }else{
            header('Content-type: application/json; charset =utf-8');
            echo json_encode($vehicules, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
    
    public function getLignes($json = 0){
        $serviceManager = new Service_Manager();
        $lignes = $serviceManager->getAll('Ligne');
        //print_r($lignes);
        
        if($json == 1){
            return $lignes;
        }else{
            header('Content-type: application/json; charset =utf-8');
            echo json_encode($lignes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
    
}

?>
