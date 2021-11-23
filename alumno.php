<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    if (!empty($_GET['id_alumno'])) {
        $id_alumno = $_GET['id_alumno'];
        $api = new Api();
        $obj = $api->getAlumno($id_alumno);
        $json = json_encode($obj);
        echo $json;
    } else {
        $vector = array();
        $api = new Api();
        $vector = $api->getAlumnos();
        $json = json_encode($vector);
        echo $json;
    }
}
