<?php

class Service_Classe_Crud {

    private $db;

    public function __construct() {
        $this->db = Application::getInstance()->db;
    }

    public function getAll() {
        $query = "SELECT * FROM classe";
        $result = $this->db->query($query);
        $objects = $result->fetch(PDO::FETCH_OBJ);
        $classes = array();
        foreach ($objects as $object) {
            $classe = $this->buildClasse($object);
            array_push($classes, $classe);
        }
        return $classes;
    }

    public function getById($id) {

        $query = "SELECT * FROM classe WHERE idclasse = " . $id;
        $result = $this->db->query($query);
        if (!empty($result)) {
            $object = $result->fetch(PDO::FETCH_OBJ);
            $classe = $this->buildClasse($object);
            return $classe;
        } else {
            return null;
        }
    }

    public function insert($classe) {
        $params = "nom,numeroetablissement";
        $values = "'" . pg_escape_string($classe->getNom()) . "','" . pg_escape_string($classe->getNumeroEtablissement()) . "'";
        $cycle = pg_escape_string($classe->getCycle());
        $professeur = pg_escape_string($classe->getProfesseur());
        if (isset($cycle)) {
            $params.=",cycle";
            $values.=",'" . $cycle . "'";
        }
        if (isset($professeur)) {
            $params.=",professeur";
            $values.=",'" . $professeur . "'";
        }
        $query = "INSERT INTO classe (" . $params . ") VALUES (" . $values . ") RETURNING idclasse";
        echo $query;
        $queryprepared = $this->db->prepare($query);
        $queryprepared->execute();

        $result = $queryprepared->fetch(PDO::FETCH_ASSOC);
        return $result["idclasse"];
    }

    public function modify($classe) {
        $query = "UPDATE classe SET
            nom = '" . $classe->getNumeroScolaire() . "',
            cycle = '" . $classe->getNom() . "',
            professeur = '" . $classe->getPrenom() . "',
            numeroEtablissement = '" . $classe->getDateNaissance() . "'
                WHERE idclasse = " . $classe->getIdClasse() . "RETURNING idclasse";

        return $this->db->query($query);
    }

    function getByParams($params) {

        $query = "SELECT * FROM classe";
        if (!empty($params)) {
            $query.=" WHERE ";
            foreach ($params as $key => $param) {
                $query.=$key . " = '" . pg_escape_string($param) . "' AND ";
            }
            $query = substr($query, 0, -5);
            echo $query;
        }

        $result = $this->db->query($query);

        if (!empty($result)) {
            $classes = array();
            while ($object = $result->fetch(PDO::FETCH_OBJ)) {
                $classe = $this->buildClasse($object);
                array_push($classes, $classe);
            }
            return $classes;
        } else {
            return null;
        }
    }

    public function getByIdEleve($id) {
        $query = "SELECT * FROM classe INNER JOIN eleve_classe ON classe.idClasse = eleve_classe.idClasse WHERE eleve_classe.ideleve = " . $id;
        $result = $this->db->query($query);
        if (!empty($result)) {
            $classes = array();
            while ($object = $result->fetch(PDO::FETCH_OBJ)) {
                $classe = $this->buildClasse($object);
                array_push($classes, $classe);
            }
            return $classes;
        } else {
            echo "RETURN NULL";
            return null;
        }
    }

    private function buildClasse($object) {
        $classe = new Model_Classe();
        //print_r($object);
        // LA LIGNE SUIVANTE NE DOIT ETRE POSSIBLE QU'ICI!!!
        $classe->setIdClasse($object->idclasse);
        $classe->setNom($object->nom);
        $classe->setCycle($object->cycle);
        $classe->setProfesseur($object->professeur);
        $classe->setNumeroEtablissement($object->numeroetablissement);

        return $classe;
    }

}

?>
