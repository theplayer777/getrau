<?php

class Service_Arret_Crud {

    function __construct() {
        
    }

    function getById($id) {

        $getrau = Application::getInstance();
        $sql = "SELECT * FROM arret WHERE idarret = " . $id;
        $result = $getrau->db->query($sql);
        $object = $result->fetch(PDO::FETCH_OBJ);
        print_r($object);
    }

    function insert($arret) {
        $sql = "INSERT INTO...";
    }

    function modify($arret) {
        $sql = "UPDATE...";
    }

    function getGeoJSON() {

        $query = "SELECT idarret, ST_AsGeoJSON(emplacement), nom, localite FROM arret";

        $getrau = Application::getInstance();
        $result = $getrau->db->query($query);

        if (!$result) {
            echo "Oups!!! " . pg_last_error($conn);
            exit;
        }

        $fc = new lib_FeatureCollection();
        
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        //return $row;
        $i=0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $fc->addFeature(new lib_Feature($row['idarret'], json_decode($row['st_asgeojson']), array("name" => $row['nom'], "localite" => $row['localite'])));
            //echo $row['nom'];
        }

        return json_encode($fc);
    }

}

?>
