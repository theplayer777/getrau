<?php

class Controller_SetData {
    
    private $twig;
    
    public function __construct() {
       $loader = new Twig_Loader_Filesystem('views');
       $this->twig = new Twig_Environment($loader, array(
      'cache' => false
        ));
    }
    
    public function insertEleve(){
        $eleve = new Model_Eleve();
        $eleve->setNom("Nicole");
        $eleve->setPrenom("Jonas");
        $eleve->setDatenaissance("1987-03-23");
        $eleve->setSexe("H");
        $eleve->setNumeroscolaire("JNE");
        $eleve->setStatuscourant("courant");
        $eleve->setStatussuivant("suivant");
        
        //print_r($eleve);
        
        $serviceManager = new Service_Manager();
        $serviceManager->persist($eleve);
    }
    
    public function modifyEleve(){
        
        $serviceManager = new Service_Manager();
        
        $jonas = $serviceManager->getById('Eleve',2);
        $jonas->setPrenom("Jonas2");
        
        $serviceManager->persist($jonas);
    }
    
}

?>
