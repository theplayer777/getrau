<?php

header('Content-Type: text/html; charset=utf-8');

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
        $eleve->setDateNaissance("1987-03-23");
        $eleve->setSexe("H");
        $eleve->setNumeroScolaire("JNE");
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
        $status = "courant";
        $colNames = Array();
        $colNames['idEleve'] = "IDElève";
        $colNames['nomEleve'] = "Nom";
        $colNames['prenomEleve'] = "Prénom";
        if ($status == "courant") {
            $colNames['classe'] = "ClasseCourante";
            $colNames['etablissement'] = "LieuEnsCourant";
            $colNames['cycle'] = "CLDivisionCycleVoieCourant";
            $colNames['professeur'] = "MaîtreClasseCourant";
        } else {
            $colNames['classeSuivante'] = "ClasseSuivante";
            $colNames['etablissement'] = "LieuEnsSuivant";
            $colNames['cycle'] = "CLDivisionCycleVoieSuivant";
            $colNames['professeur'] = "MaîtreClasseSuivant";
        }
        $colNames['rue'] = "Adresse";
        $colNames['numero'] = "AdresseNo";
        $colNames['npa'] = "NPALocalitéDomicileRésultat";
        $colNames['localite'] = "LocalitéDomicileRésultat";
        $colNames['sexe'] = "Sexe";
        $colNames['dateNaissance'] = "DateNaissance";
        $colRows = Array();

        if (file_exists("data/sample.xlsx")) {
            $objPHPExcel = PHPExcel_IOFactory::load("data/sample.xlsx");
            //print_r($objPHPExcel->getActiveSheet()->getCellCollection());
            $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
            $highestCol = PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
            $y = 0;
            for ($i = 1; $i <= $highestCol; $i++) {
                $names[$i] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, 1)->getValue();
                foreach ($colNames as $col => $key) {
                    if ($names[$i] == $key) {
                        $colRows[$col] = $i;
                        $y++;
                    }
                }
            }
            $eleves = Array();
            for ($i = 2; $i <= $highestRow; $i++) {
                $eleve = new Model_Eleve();

                //Données de base
                if (!empty($colRows['idEleve'])) {
                    $eleve->setNom($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue());
                }
                if (!empty($colRows['nomEleve'])) {
                    $eleve->setNom($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['nomEleve'], $i)->getValue());
                }
                if (!empty($colRows['prenomEleve'])) {
                    $eleve->setPrenom($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['prenomEleve'], $i)->getValue());
                }
                if (!empty($colRows['sexeEleve'])) {
                    $eleve->setSexe($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['sexeEleve'], $i)->getValue());
                }
                if (!empty($colRows['dateNaissance'])) {
                    $eleve->setSexe($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['dateNaissance'], $i)->getValue());
                }

                //Données liées
                //Adresse
                if (!empty($colRows['rue']) && !empty($colRows['npa']) && !empty($colRows['localite'])) {
                    $serviceManager = new Service_Manager();
                    $adresse = $serviceManager->getByParams('Adresse', array("rue" => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['rue'], $i)->getValue(), "numero" => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['numero'], $i)->getValue(), "codepostal" => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['npa'], $i)->getValue(), "localite" => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['localite'], $i)->getValue()));
                    //print_r($adresse);
                    $eleve->addAdresse($adresse);
                }

                //Classe
                if (!empty($colRows['classe']) && !empty($colRows['etablissement'])) {
                    $serviceManager = new Service_Manager();
                    $classe = $serviceManager->getByParams('Classe', array("nom" => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['classe'], $i)->getValue(), "numeroEtablissement" => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['etablissement'], $i)->getValue()));
                    if (!empty($classe)) {
                        $classe = new Model_Classe();
                        $classe->setNom($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['classe'], $i)->getValue());
                        $classe->setNumeroEtablissement($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['etablissement'], $i)->getValue());
                        if (!empty($colRows['cycle'])) {
                            $classe->setCycle($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['cycle'], $i)->getValue());
                        }
                        if (!empty($colRows['professeur'])) {
                            $classe->setProfesseur($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['professeur'], $i)->getValue());
                        }
                        $idClasse = $serviceManager->persist($classe);
                        $classe = $serviceManager->getById('Classe', $idClasse);
                    }
                    $eleve->addClasse($classe);
                }
                
                $serviceManager->persist($eleve);

                //array_push($eleves, $eleve);
            }
            //print_r($eleves);
            //$eleve->persist;
        } else {
            echo "fichier introuvable";
        }
    }

}

?>
