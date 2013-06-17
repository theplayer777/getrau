<?php

class Service_Eleve_Fonctionnel {

    function getAll() {
        $serviceCrud = new Service_Eleve_Crud();
        $serviceCrudAdresse = new Service_Adresse_Crud();
        $serviceCrudClasse = new Service_Classe_Crud();
        $eleves = $serviceCrud->getAll();
        foreach ($eleves as $eleve) {
            $adresses = $serviceCrudAdresse->getByIdEleve($eleve->getIdEleve());
            $classes = $serviceCrudClasse->getByIdEleve($eleve->getIdEleve());
            $eleve->setAdresses($adresses);
            $eleve->setClasses($classes);
        }
        return $eleves;
    }

    function getById($id) {
        $serviceCrud = new Service_Eleve_Crud();
        $serviceCrudAdresse = new Service_Adresse_Crud();
        $serviceCrudClasse = new Service_Classe_Crud();
        $eleve = $serviceCrud->getById($id);
        $adresses = $serviceCrudAdresse->getByIdEleve($id);
        $classes = $serviceCrudClasse->getByIdEleve($id);
        $eleve->setAdresses($adresses);
        $eleve->setClasses($classes);
        //return $eleve;
        /*echo"<pre>";
        print_r($eleve);
        echo"<pre>";*/
    }

    function persist($eleve) {
        $serviceCrud = new Service_Eleve_Crud();
        $serviceCrudEleveAdresse = new Service_EleveAdresse_Crud();
        $serviceCrudEleveClasse = new Service_EleveClasse_Crud();
        if (!$eleve->getIdEleve()) {
            $idEleve = $serviceCrud->insert($eleve);
            //echo "ID DE L'ELEVE: ".$idEleve;
        } else {
            $idEleve = $serviceCrud->modify($eleve);
            //echo "ID DE L'ELEVE: ".$idEleve;
        }
        foreach ($eleve->getAdresses() as $adresse) {
            $serviceCrudEleveAdresse->persist($idEleve, $adresse->getIdAdresse());
        }
        $classes = $eleve->getClasses();
        if (!empty($classes)) {
            foreach ($classes as $classe) {
                $serviceCrudEleveClasse->persist($idEleve, $classe->getIdClasse());
                //echo "ID DE LA CLASSE: " . $classe->getIdClasse();
            }
        }
    }

    function getGeoJSON() {
        $serviceCrud = new Service_Eleve_Crud();
        return $serviceCrud->getGeoJSON();
    }

    public function deleteAll() {
        $serviceCrud = new Service_Eleve_Crud();
        $serviceCrudEleveAdresse = new Service_EleveAdresse_Crud();
        $serviceCrudEleveClasse = new Service_EleveClasse_Crud();
        $serviceCrudEleveAdresse->deleteAll();
        $serviceCrudEleveClasse->deleteAll();
        $serviceCrud->deleteAll();
    }

}

?>
