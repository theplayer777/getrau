<?php
header('Content-Type: text/html; charset=utf-8');
class Service_Eleve_Crud {

    private $db;

    function __construct() {
        $this->db = Application::getInstance()->getDB();
    }

    public function getAll() {
        $sql = "SELECT * FROM eleve";
        $result = $this->db->query($sql);
        if (!empty($result)) {
            $eleves = array();
            while ($object = $result->fetch(PDO::FETCH_OBJ)) {
                $eleve = $this->buildEleve($object);
                array_push($eleves, $eleve);
            }
            return $eleves;
        } else {
            return null;
        }
    }

    public function getById($id) {
        $sql = "SELECT * FROM eleve WHERE ideleve = " . $id['id'];
        //echo $sql;
        $result = $this->db->query($sql);
        $object = $result->fetch(PDO::FETCH_OBJ);

        $eleve = $this->buildEleve($object);
        return $eleve;
    }

    public function insert($eleve) {
        $params = "numeroscolaire";
        $values = "'" . pg_escape_string($eleve->getNumeroScolaire()) . "'";
        $nom = pg_escape_string($eleve->getNom());
        $prenom = pg_escape_string($eleve->getPrenom());
        $dateNaissance = $eleve->getDateNaissance();
        $sexe = $eleve->getSexe();
        $statusCourant = $eleve->getStatusCourant();
        $statusSuivant = $eleve->getStatusSuivant();
        if (isset($nom)) {
            $params.=",nom";
            $values.=",'" . $nom . "'";
        }
        if (isset($prenom)) {
            $params.=",prenom";
            $values.=",'" . $prenom . "'";
        }
        if (isset($dateNaissance)) {
            $params.=",datenaissance";
            $values.=",'" . $dateNaissance . "'";
        }
        if (isset($sexe)) {
            $params.=",sexe";
            $values.=",'" . $sexe . "'";
        }
        if (isset($statusCourant)) {
            $params.=",statuscourant";
            $values.=",'" . $statusCourant . "'";
        }
        if (isset($statusSuivant)) {
            $params.=",statussuivant";
            $values.=",'" . $statusSuivant . "'";
        }
        $query = "INSERT INTO eleve (" . $params . ") VALUES (" . $values . ") RETURNING ideleve";
        //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $queryprepared = $this->db->prepare($query);
        $queryprepared->execute();
        //echo $query;

        $result = $queryprepared->fetch(PDO::FETCH_ASSOC);
        return $result["ideleve"];

        //adresses
        /*$adresses = $eleve->getAdresses();
        //print_r($adresses);
        if (isset($adresses)) {
            foreach ($adresses as $adresse) {
                $idAdresse = $adresse->getIdAdresse();
                if (!isset($idAdresse)) {
                    $serviceManager = new Service_Manager();
                    $idAdresse = $serviceManager->persist($adresse);
                    echo "ID DE LADRESSE: ".$idAdresse;
                    $adresse->setIdAdresse($idAdresse);
                }
                $queryAdresse = "INSERT INTO eleve_adresse (ideleve,idadresse) VALUES (" . $idEleve . "," . $adresse->getIdAdresse() . ")";
                echo $queryAdresse;
                $this->db->query($queryAdresse);
            }
        }

        //classes
        $classes = $eleve->getClasses();
        print_r($classes);
        if (isset($classes)) {
            echo "IL PASSE DANS LA FONCTION";
            foreach ($classes as $classe) {
                echo "IL PASSE DANS LE FOREACH";
                $idClasse = $classe->getIdClasse();
                if (!isset($idClasse)) {
                    echo "IL PASSE DANS LE ISSET";
                    $serviceManager = new Service_Manager();
                    $idClasse = $serviceManager->persist($classe);
                    $classe->setIdClasse($idClasse);
                }
                echo "IL A FINI OU PRESQUE";
                $queryClasse = "INSERT INTO eleve_classe (ideleve,idclasse) VALUES (" . $idEleve . "," . $classe->getIdClasse() . ")";
                echo $queryClasse;
                $this->db->query($queryClasse);
            }
        }*/
    }

    public function modify($eleve) {
        $sql = "UPDATE eleve SET
            numeroscolaire = '" . $eleve->getNumeroScolaire() . "',
            nom = '" . $eleve->getNom() . "',
            prenom = '" . $eleve->getPrenom() . "',
            datenaissance = '" . $eleve->getDateNaissance() . "',
            sexe = '" . $eleve->getSexe() . "',
            statuscourant = '" . $eleve->getStatuscourant() . "',
            statussuivant = '" . $eleve->getStatussuivant() . "'
                WHERE ideleve = " . $eleve->getIdEleve() . "RETURNING ideleve";

        return $this->db->query($sql);
    }
    
    public function removeAllWithCascade(){
        $query = "TRUNCATE TABLE eleve CASCADE";
        $this->db->query($query);
    }
    
    public function getGeoJSON() {

        $query = "SELECT eleve.ideleve, nom, prenom ,ST_AsGeoJSON(adresse.emplacement), adresse.localite FROM eleve INNER JOIN eleve_adresse ON eleve.ideleve = eleve_adresse.ideleve INNER JOIN adresse ON eleve_adresse.idadresse = adresse.idadresse";

        $result = $this->db->query($query);

        if (!$result) {
            echo "Oups!!! " . pg_last_error($conn);
            exit;
        }

        $fc = new lib_FeatureCollection();
        
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        //return $row;
        $i=0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $fc->addFeature(new lib_Feature($row['ideleve'], json_decode($row['st_asgeojson']), array("name" => $row['nom'], "prenom" => $row["prenom"], "localite" => $row['localite'], "tags" =>  $row['prenom']." ".$row['nom']." ".$row['localite'])));
            //echo $row['nom'];
        }

        return json_encode($fc);
    }

    private function buildEleve($object) {
        $eleve = new Model_Eleve();

        // LA LIGNE SUIVANTE NE DOIT ETRE POSSIBLE QU'ICI!!!
        $eleve->setIdEleve($object->ideleve);
        $eleve->setDateNaissance($object->datenaissance);
        $eleve->setNom($object->nom);
        $eleve->setNumeroScolaire($object->numeroscolaire);
        $eleve->setPrenom($object->prenom);
        $eleve->setSexe($object->sexe);
        $eleve->setStatuscourant($object->statuscourant);
        $eleve->setStatussuivant($object->statussuivant);
        return $eleve;
        
    }
    
    public function deleteAll(){
        $query="DELETE FROM Eleve";
        $this->db->query($query);
    }

}

?>
