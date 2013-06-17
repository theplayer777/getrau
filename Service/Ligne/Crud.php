<?php

class Service_Ligne_Crud {
    
    private $db;
    
    function __construct() {
        $this->db = Application::getInstance()->getDB();
    }
    
    function getGeoJSON() {
        
        $queryLigne = "select * from ligne";

        $queryDrop="drop sequence rownum";
$queryCreate="create temp sequence rownum";
$query="WITH final_route AS
(
  WITH RECURSIVE route AS
  (
    SELECT idligne, idroutebus, idroutebussuivante
    FROM ligne_routebus
    WHERE idroutebusprecedente is null
    UNION ALL
    SELECT b.idligne, b.idroutebus, b.idroutebussuivante
    FROM ligne_routebus b
    INNER JOIN route r
            ON r.idligne = b.idligne
           AND r.idroutebussuivante = b.idroutebus
    WHERE idroutebusprecedente is not null
  )
  SELECT idligne, idroutebus, nextval('rownum') as rownum
  FROM route
)
SELECT final_route.idligne, ligne.region, final_route.idroutebus, ST_AsGeoJSON(routebus.geometrie), routebus.idarretdebut, routebus.idarretfin
FROM final_route
INNER JOIN routebus ON final_route.idroutebus = routebus.idroutebus
INNER JOIN ligne ON final_route.idligne = ligne.idligne
ORDER BY idligne, rownum";

        $this->db->query($queryDrop);
        $this->db->query($queryCreate);
        $result = $this->db->query($query);

        if (!$result) {
            echo $query;
            exit;
        }

        $fc = new lib_FeatureCollection();
        
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        //return $row;
        //$i=0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $fc->addFeature(new lib_Feature($row['idligne'], json_decode($row['st_asgeojson']), array("region" => $row['region'], "tags" => $row['region'])));
            //echo $row['nom'];
        }

        return json_encode($fc);
    }
    
}
?>
