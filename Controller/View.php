<?php

class Controller_View {

    private $twig;
    private $errors;

    public function __construct() {
        $loader = new Twig_Loader_Filesystem('views');
        $this->twig = new Twig_Environment($loader, array(
                    'cache' => false
                ));
        $this->errors = Application::getInstance()->getErrors();
    }

    public function test() {
        echo "hello world";
    }

    public function getMap($filter = null) {
        $servicesManager = new Service_Manager();
        //$reponse = $servicesManager->getById('Adresse', 4);
        echo $this->twig->render('map.html.twig', array('filter' => $filter));
    }

    public function getEleves() {
        $controllerGetData = new Controller_GetData();
        $eleves = $controllerGetData->getEleves(1);
        echo $this->twig->render('eleves.html.twig', array('eleves' => $eleves));
    }

    public function import() {
        echo $this->twig->render('import.html.twig');
    }

    public function executeImport() {

        //première étape, suppression des fichiers existants
        $files = glob('data/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file); // delete file
        }

        //2ème phase, importation des nouveaux fichiers
        $true = 0;
        $i = 0;
        for ($i; $i < count($_FILES['file']['name']); $i++) {

            $filename = $_FILES['file']['name'][$i];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            // vérification si le fichier est bien de type Excel
            if ($ext == 'xls' || $ext == 'xlsx') {
                $tmp = $_FILES['file']['tmp_name'][$i];
                if ($tmp != "") {
                    //Setup our new file path
                    $newFilePath = "data/" . $filename;

                    //Upload the file into the temp dir
                    if (move_uploaded_file($tmp, $newFilePath)) {

                        $true ++;
                    }
                }
            }else{
                $this->errors->addError("le fichier \"".$filename ."\" n'est pas un fichier Excel (.xls,.xlsx)");
            }
        }
        
        
        if($this->errors->noError()){
         $controllerSetData = new Controller_SetData();
         $controllerSetData->importEleves();
         $controllerGetData = new Controller_GetData();
         $eleves = $controllerGetData->getEleves(1);
        }
        if(!$this->errors->noError()){
            echo $this->twig->render('eleves.html.twig', array('eleves' => $eleves, 'msgType' => 'error','msgTitle' => 'Une erreur est survenue', 'msgText' => $this->errors->getLastError()));
        }else{
            echo $this->twig->render('eleves.html.twig', array('eleves' => $eleves, 'msgType' => 'success','msgTitle' => "L'opération s'est bien déroulée", 'msgText' => "Les élèves ont étés importés avec succès"));
        }
    }
    
    public function getHorairesBus(){
        $controllerGetData = new Controller_GetData();
        $vehicules = $controllerGetData->getVehicules(1);
        echo $this->twig->render('horairesBus.html.twig',array('vehicules' => $vehicules));
    }

}

?>
