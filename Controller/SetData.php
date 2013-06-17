<?php

header('Content-Type: text/html; charset=utf-8');

class Controller_SetData {

    private $twig;
    private $errors;

    public function __construct() {
        $loader = new Twig_Loader_Filesystem('views');
        $this->twig = new Twig_Environment($loader, array(
                    'cache' => false
                ));
        $this->errors = $this->db = Application::getInstance()->getErrors();
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
            $colNames['classe'] = "ClasseSuivante";
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

        $files = array_slice(array_filter(glob('data/*'), 'is_file'), 0);
        //print_r($files);
        $serviceManager = new Service_Manager();


        //--------------------- PREMIERE ETAPE ----------------------//
        //On parcourt une première fois chaque fichier afin de créer les objects élève,
        //et ce même si certains élèves ne se trouve que dans un fichier
        $assocArray = Array();
        foreach ($files as $file) {
            $colRows = Array();
            $objPHPExcel = PHPExcel_IOFactory::load($file);
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

            //Si le fichier contient au moins l'id, le nom et le prénom de l'élève
            if (!empty($colRows['idEleve']) && !empty($colRows['nomEleve']) && !empty($colRows['prenomEleve'])) {
                $assocArray = $this->createAssocArray($colRows, $objPHPExcel, $assocArray);
            } else {
                $this->errors->addError("le fichier \"" . $file . "\" ne contient pas les colonnes requises");
            }
            for ($i = 2; $i <= $highestRow; $i++) {

                //On test si l'élève n'a pas déjà été créé lors d'un parcours precedent de la boucle
                //echo empty($assocArray[$colRows['idEleve']]);
                /* if (empty($assocArray[$colRows['idEleve']])) {

                  //Si il n'as pas encore été ajouté, on le créé avec les données principales
                  $eleve = new Model_Eleve();
                  if (!empty($colRows['idEleve']) && !empty($colRows['nomEleve']) && !empty($colRows['prenomEleve'])) {
                  $eleve->setNumeroScolaire($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue());
                  $eleve->setNom($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['nomEleve'], $i)->getValue());
                  $eleve->setPrenom($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['prenomEleve'], $i)->getValue());
                  array_push($eleves, $eleve);
                  }
                  } */
            }
        }

        /* echo "<pre>";
          print_r($assocArray);
          echo "</pre>"; */

        //------------------------ DEUXIEME ETAPE ------------------------------//
        //Nous avons maintenant tous les élèves avec leurs données principales: id,nom et prenom
        //Depuis ici, on parcourt tous les fichiers une nouvelles fois pour remplir les informations restantes
        //on defini les variables pour savoir quels éléments ont déjà étés ajoutés
        $sexeIsRegistered = false;
        $dateNaissanceIsRegistered = false;
        $adresseIsRegistered = false;
        $classeIsRegistered = false;

        /* foreach ($files as $file) {
          $objPHPExcel = PHPExcel_IOFactory::load($file);
          //print_r($objPHPExcel);
          //on repère quelles sont les nom des colonnes qui nous intéressent, en fonction de leurs noms
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

          //Pour que cela fonctionne même si l'ordre des fichiers n'est pas le même, on créé un tableau associatif avec l'id de chaque élève
          $assocArray = $this->createAssocArray($colRows, $objPHPExcel);

          if (!empty($colRows['sexeEleve']) && !$sexeIsRegistered) {
          foreach ($eleves as $eleve) {
          if (!empty($assocArray[$eleve->getIdEleve()]['sexe'])) {
          $eleve->setSexe($assocArray[$eleve->getIdEleve()]['sexe']);
          }
          }
          $sexeIsRegistered = true;
          }
          if (!empty($colRows['dateNaissance']) && !$dateNaissanceIsRegisteredIsRegistered) {
          foreach ($eleves as $eleve) {
          if (!empty($assocArray[$eleve->getIdEleve()]['dateNaissance'])) {
          $eleve->setDateNaissance($assocArray[$eleve->getIdEleve()]['dateNaissance']);
          }
          }
          $dateNaissanceIsRegistered = true;
          }

          //Données liées
          //Adresse
          if (!empty($colRows['rue']) && !empty($colRows['npa']) && !empty($colRows['localite']) && !$adresseIsRegistered) {

          foreach ($eleves as $eleve) {
          //on set les paramètres de l'adresse en fonction du fichier Excel, puis on recherche dans la db si cette adresse existe déjà
          $adresses = $serviceManager->getByParams('Adresse', array("rue" => $assocArray[$eleve->getIdEleve()]['rue'], $assocArray[$eleve->getIdEleve()]['numero'], "codepostal" => $assocArray[$eleve->getIdEleve()]['npa'], "localite" => $assocArray[$eleve->getIdEleve()]['localite']));
          //Si l'adresse n'existe pad dans la bd, on l'enregistre
          if (empty($adresses)) {
          $adresse = new Model_Adresse();
          $adresse->setRue($assocArray[$eleve->getIdEleve()]['rue']);
          if (!empty($assocArray[$eleve->getIdEleve()]['numero'])) {
          $adresse->setNumero($assocArray[$eleve->getIdEleve()]['numero']);
          }
          $adresse->setCodePostal($assocArray[$eleve->getIdEleve()]['npa']);
          $adresse->setLocalite($assocArray[$eleve->getIdEleve()]['localite']);
          $idAdresse = $serviceManager->persist($adresse);
          $adresses = $serviceManager->getById('Adresse', $idAdresse);
          //echo "NOUVELLE ADRESSE:";
          //print_r($adresses);
          }

          $eleve->setAdresses($adresses);
          }
          $adresseIsRegistered = true;
          }

          //Classe
          if (!empty($colRows['classe']) && !empty($colRows['etablissement']) && !$classeIsRegistered) {
          foreach ($eleves as $eleve) {
          //on set les paramètres de la classe en fonction du fichier Excel, puis on recherche dans la db si cette classe existe déjà
          $classes = $serviceManager->getByParams('Classe', array("nom" => $assocArray[$eleve->getIdEleve()]['classe'], "numeroetablissement" => $assocArray[$eleve->getIdEleve()]['etablissement']));

          //Si la classe n'existe pas dans la bd, on l'enregistre
          if (empty($classes)) {
          $classe = new Model_Classe();
          $classe->setNom($assocArray[$eleve->getIdEleve()]['classe']);
          $classe->setNumeroEtablissement($assocArray[$eleve->getIdEleve()]['etablissement']);
          if (!empty($assocArray[$eleve->getIdEleve()]['cycle'])) {
          $classe->setCycle($assocArray[$eleve->getIdEleve()]['cycle']);
          }
          if (!empty($assocArray[$eleve->getIdEleve()]['professeur'])) {
          $classe->setProfesseur($assocArray[$eleve->getIdEleve()]['numero']);
          }
          $idClasse = $serviceManager->persist($classe);
          $classes = $serviceManager->getById('Classe', $idClasse);
          }
          $eleve->setClasses($classes);
          }
          $classeIsRegistered = true;
          }
          } */

        //avant d'insérer les nouvelles données, on efface les anciennes
        $serviceManager->deleteAll('Eleve');
        foreach ($assocArray as $numeroEleve => $tabEleve) {
            //avant tout, on test si l'élève a une classe (dans le cas de l'enclassement courant)
            //car sinon, il ne doit pas être enregistré en tant qu'élève
            if (!empty($tabEleve['classe'])) {
                $eleve = new Model_Eleve();

                // LA LIGNE SUIVANTE NE DOIT ETRE POSSIBLE QU'ICI!!!
                if (!empty($tabEleve['dateNaissance'])) {
                    $eleve->setDateNaissance($tabEleve['dateNaissance']);
                }
                $eleve->setNom($tabEleve['nomEleve']);
                $eleve->setNumeroScolaire($numeroEleve);
                $eleve->setPrenom($tabEleve['prenomEleve']);
                if (!empty($tabEleve['sexe'])) {
                    $eleve->setSexe($tabEleve['sexe']);
                }
                //$eleve->setStatuscourant($tabEleve['nomEleve']);
                //$eleve->setStatussuivant($tabEleve['nomEleve']);
                if (!empty($tabEleve['rue']) && !empty($tabEleve['npa']) && !empty($tabEleve['localite'])) {
                    $paramsAdresse = array("rue" => $tabEleve['rue'], "codepostal" => $tabEleve['npa'], "localite" => $tabEleve['localite']);
                    if (!empty($tabEleve['numero'])) {
                        $paramsAdresse['numero'] = $tabEleve['numero'];
                    } else {
                        $paramsAdresse['numero'] = null;
                    }
                    $adresses = $serviceManager->getByParams('Adresse', $paramsAdresse);

                    //Si l'adresse n'existe pas, on l'ajoute dans la BD
                    if (empty($adresses)) {
                        $adresse = new Model_Adresse();
                        $adresse->setRue($tabEleve['rue']);
                        if (!empty($tabEleve['numero'])) {
                            $adresse->setNumero($tabEleve['numero']);
                        } else {
                            $adresse->setNumero(null);
                        }
                        $adresse->setCodePostal($tabEleve['npa']);
                        $adresse->setLocalite($tabEleve['localite']);
                        $idAdresse = $serviceManager->persist($adresse);
                        $adresses = array($serviceManager->getById('Adresse', $idAdresse));

                        /* return $eleve;
                          echo $numeroEleve;
                          echo $tabEleve['nomEleve']; */
                    }
                    $eleve->setAdresses($adresses);
                }
                if (!empty($tabEleve['classe']) && !empty($tabEleve['etablissement'])) {
                    $paramsClasse = array("nom" => $tabEleve['classe'], "numeroetablissement" => $tabEleve['etablissement']);
                    if (!empty($tabEleve['cycle'])) {
                        $paramsClasse['cycle'] = $tabEleve['cycle'];
                    }
                    $classes = $serviceManager->getByParams('Classe', $paramsClasse);
                    //Si la classe n'existe pas dans la bd, on l'enregistre
                    if (empty($classes)) {
                        $classe = new Model_Classe();
                        $classe->setNom($tabEleve['classe']);
                        $classe->setNumeroEtablissement($tabEleve['etablissement']);
                        if (!empty($tabEleve['cycle'])) {
                            $classe->setCycle($tabEleve['cycle']);
                        }
                        if (!empty($tabEleve['professeur'])) {
                            $classe->setProfesseur($tabEleve['professeur']);
                        }
                        $idClasse = $serviceManager->persist($classe);
                        $classes = array($serviceManager->getById('Classe', $idClasse));
                    }
                    $eleve->setClasses($classes);
                }
                $serviceManager->persist($eleve);
            }
        }
    }

    private function createAssocArray($colRows, $objPHPExcel, $valueTables) {
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        $highestCol = PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
        $i = 2;
        //echo "highestRow: " . $highestRow;
        for ($i = 2; $i <= $highestRow; $i++) {
            if (empty($valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['nomEleve'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['nomEleve'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['nomEleve'], $i)->getValue();
                //echo "valueTables[" . $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue() . "]['nomEleve']=" . $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['nomEleve'], $i)->getValue() . "<br/>";
            }
            $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['prenomEleve'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['prenomEleve'], $i)->getValue();
            if (!empty($colRows['dateNaissance'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['dateNaissance'] = PHPExcel_Style_NumberFormat::toFormattedString($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['dateNaissance'], $i)->getValue(), "M-D-YYYY");
            }
            if (!empty($colRows['sexe'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['sexe'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['sexe'], $i)->getValue();
            }
            if (!empty($colRows['rue'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['rue'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['rue'], $i)->getValue();
            }
            if (!empty($colRows['numero'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['numero'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['numero'], $i)->getValue();
            }
            if (!empty($colRows['npa'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['npa'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['npa'], $i)->getValue();
            }
            if (!empty($colRows['localite'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['localite'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['localite'], $i)->getValue();
            }
            if (!empty($colRows['classe'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['classe'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['classe'], $i)->getValue();
            }
            if (!empty($colRows['etablissement'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['etablissement'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['etablissement'], $i)->getValue();
            }
            if (!empty($colRows['cycle'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['cycle'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['cycle'], $i)->getValue();
            }
            if (!empty($colRows['professeur'])) {
                $valueTables[$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['idEleve'], $i)->getValue()]['professeur'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colRows['professeur'], $i)->getValue();
            }
        }

        return $valueTables;
    }

}

?>
