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
    
    public function getMap($filter=null) {
        $servicesManager = new Service_Manager();
        //$reponse = $servicesManager->getById('Adresse', 4);
        echo $this->twig->render('map.html.twig',array('filter' =>$filter));
    }
    
    
    public function getEleves(){
        $controllerGetData = new Controller_GetData();
        $eleves = $controllerGetData->getEleves(1);
        echo $this->twig->render('eleves.html.twig',array('eleves' => $eleves));

    }
    
    public function import(){
        echo $this->twig->render('import.html.twig');
    }
    
}

?>
