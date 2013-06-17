<?php

class Service_Adresse_Crud {

    private $db;

    function __construct() {
        $this->db = Application::getInstance()->getDB();
    }

    public function getById($id) {

        $query = "SELECT *,ST_AsGeoJSON(adresse.emplacement) as xy FROM adresse WHERE idadresse = " . $id;
        $result = $this->db->query($query);
        if (!empty($result)) {
            $object = $result->fetch(PDO::FETCH_OBJ);
            $adresse = $this->buildAdresse($object);
            return $adresse;
        } else {
            return null;
        }
    }

    public function insert($adresse) {
        $params = "rue";
        $values = "'" . pg_escape_string($adresse->getRue()) . "'";

        $numero = $adresse->getNumero();
        $codepostal = $adresse->getCodePostal();
        $localite = pg_escape_string($adresse->getLocalite());
        if (isset($numero)) {
            $params.=",numero";
            $values.=",'" . $numero . "'";
        }
        if (isset($codepostal)) {
            $params.=",codepostal";
            $values.=",'" . $codepostal . "'";
        }
        if (isset($localite)) {
            $params.=",localite";
            $values.=",'" . $localite . "'";
        }

        $query = "INSERT INTO adresse (" . $params . ") VALUES (" . $values . ") RETURNING idadresse";
        //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo $query;
        $queryprepared = $this->db->prepare($query);
        $queryprepared->execute();


        $result = $queryprepared->fetch(PDO::FETCH_ASSOC);
        //echo "ID DE L'ADRESSE: ".$result["idadresse"];
        return $result["idadresse"];
    }

    public function modify($adresse) {
        $sql = "UPDATE...";
    }

    public function getByParams($params) {

        $query = "SELECT *,ST_AsGeoJSON(adresse.emplacement) as xy FROM adresse";

        if (!empty($params)) {
            $query.=" WHERE ";
            foreach ($params as $key => $param) {
                $query.=$key . " = '" . pg_escape_string($param) . "' AND ";
            }
            $query = substr($query, 0, -5);
        }
        //echo $query;
        $result = $this->db->query($query);
        if (!empty($result)) {
            $adresses = array();
            while ($object = $result->fetch(PDO::FETCH_OBJ)) {
                $adresse = $this->buildAdresse($object);
                array_push($adresses, $adresse);
            }
            return $adresses;
        } else {
            return null;
        }
    }
    
    public function getByIdEleve($id){
        $query = "SELECT *,ST_AsGeoJSON(adresse.emplacement) as xy FROM adresse INNER JOIN eleve_adresse ON adresse.idAdresse = eleve_adresse.idAdresse  WHERE eleve_adresse.ideleve = ".$id;
        $result = $this->db->query($query);
        if (!empty($result)) {
            $adresses = array();
            while ($object = $result->fetch(PDO::FETCH_OBJ)) {
                $adresse = $this->buildAdresse($object);
                array_push($adresses, $adresse);
            }
            return $adresses;
        } else {
            //echo "RETOURNE NULL";
            return null;
        }
        
    }
    
    private function buildAdresse($object) {
            $adresse = new Model_Adresse();
            $adresse->setIdAdresse($object->idadresse);
            $adresse->setRue($object->rue);
            $adresse->setNumero($object->numero);
            $adresse->setCodePostal($object->codepostal);
            $adresse->setLocalite($object->localite);
            $adresse->setX($object->x);
            $adresse->setY($object->y);
           // print_r($object);

        return $adresse;
    }

}

?>
