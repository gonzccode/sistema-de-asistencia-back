<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    if (!empty($_GET['id_coordinador'])) {
        $id_coordinador = $_GET['id_coordinador'];
        $api = new Api();
        $obj = $api->getCoordinador($id_coordinador);
        $json = json_encode($obj);
        echo $json;
    } else {
        $vector = array();
        $api = new Api();
        $vector = $api->getCoordinadores();
        $json = json_encode($vector);
        echo $json;
    }
}
