<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $vector = array();
    $api = new Api();
    $vector = $api->getAsistenciaAlumno();
    $json = json_encode($vector);
    echo $json;
}
