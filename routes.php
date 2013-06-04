<?php
$array = [
    "/" => [
        "controller" => "View",
        "action" => "test",
    ],
    "/getEleve" => [
        "controller" => "View",
        "action" => "getEleve",
    ],
    "/map" => [
        "controller" => "View",
        "action" => "getMap",
    ],
    "/getArrets" => [
        "controller" => "GetData",
        "action" => "getArretsGeoJSON",
    ],
    "/getLignes" => [
        "controller" => "GetData",
        "action" => "getLignesGeoJSON",
    ],
    "/importEleves" => [
        "controller" => "SetData",
        "action" => "importEleves",
    ],
    "/modifyEleve" => [
        "controller" => "SetData",
        "action" => "modifyEleve",
    ],
];
?>
