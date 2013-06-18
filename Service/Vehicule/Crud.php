<?php
header('Content-Type: text/html; charset=utf-8');
class Service_Vehicule_Crud {

    private $db;

    function __construct() {
        $this->db = Application::getInstance()->getDB();
    }

    public function getAll() {
        $sql = "SELECT * FROM vehicule";
        $result = $this->db->query($sql);
        if (!empty($result)) {
            $vehicules = array();
            while ($object = $result->fetch(PDO::FETCH_OBJ)) {
                $vehicule = $this->buildVehicule($object);
                array_push($vehicules, $vehicule);
            }
            return $vehicules;
        } else {
            return null;
        }
    }

    public function getById($numero) {
        $sql = "SELECT * FROM vehicule WHERE numero = '" . $numero['numero'];
        //echo $sql;
        $result = $this->db->query($sql);
        $object = $result->fetch(PDO::FETCH_OBJ);

        $vehicule = $this->buildVehicule($object);
        return $vehicule;
    }

    public function insert($vehicule) {

    }



    private function buildVehicule($object) {
        $vehicule = new Model_Vehicule();

        $vehicule->setNumero($object->numero);
        $vehicule->setTransporteurNom($object->transporteur_nom);
        
        return $vehicule;       
    }
    
    public function deleteAll(){
        $query="DELETE FROM Vehicule";
        $this->db->query($query);
    }

}

?>
