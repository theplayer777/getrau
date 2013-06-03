<?php

class Controller_View {
    
    private $twig;
    
    public function __construct() {
       $loader = new Twig_Loader_Filesystem('views');
       $this->twig = new Twig_Environment($loader, array(
      'cache' => false
        ));
    }
    
    public function test() {
        echo "hello world";
    }
    
    public function getMap() {
        $servicesManager = new Service_Manager();
        //$reponse = $servicesManager->getById('Adresse', 4);
        echo $this->twig->render('map.html.twig');
    }
    
    public function getEleve(){
        
        
        $serviceManager = new Service_Manager();
        $eleve = $serviceManager->getById('Eleve', 2);
        echo $this->twig->render('index.html.twig',array('eleve' => $eleve));
    }
    
}

?>
