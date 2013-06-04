<?php
class Controller_SetData {

    private $twig;

    public function __construct() {
        $loader = new Twig_Loader_Filesystem('views');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false
        ));
    }

    public function insertEleve() {
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

    public function modifyEleve() {

        $serviceManager = new Service_Manager();

        $jonas = $serviceManager->getById('Eleve', 2);
        $jonas->setPrenom("Jonas2");

        $serviceManager->persist($jonas);
    }

    public function importEleves() {
        $colNames = Array();
        $colNames['idEleve'] = utf8_decode("IDElève");
        $colNames['nomEleve'] = "Nom";
        $colNames['prenomEleve'] = utf8_decode("Prénom");
        $colNames['classeCourante'] = "ClasseCourante";
        $colNames['classeSuivante'] = "ClasseSuivante";
        $colNames['etablissementCourant'] = "LieuEnsCourant";
        $colNames['etablissementSuivant'] = "LieuEnsSuivant";
        $colNames['rue'] = "Adresse";
        $colNames['npa'] = "NPALocalitéDomicileRésultat";
        $colNames['localite'] = "LocalitéDomicileRésultat";
        $colRows = Array();
        
        /*if (file_exists("data/sample.xlsx")) {
            $objPHPExcel = PHPExcel_IOFactory::load("data/sample.xlsx");
            //print_r($objPHPExcel->getActiveSheet()->getCellCollection());
            $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
            $highestCol = PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
            $y = 0;
            for ($i=1;$i <= $highestCol; $i++){
                $names[$i] = utf8_decode($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, 1)->getValue());
                foreach($colNames as $col){
                    if($names[$i] == $col){
                        $colRows[$y] = $i;
                        $y++;
                    }
                }
            }
            
            for($i=0;$i <= $highestRow; $i++){
                foreach($colNames as $col){
                    //$objPHPExcel->getActiveSheet()->getCo
                }
            }
            //print_r($names);
            print_r($colRows);
        }else{
            echo "salut";
        }*/
        echo $colNames['npa'];
    }

}

?>
