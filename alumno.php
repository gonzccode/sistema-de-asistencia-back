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
        $vector = $api->getAlumnos_p();
        $json = json_encode($vector);
        echo $json;
    }
}

if ($method == "POST") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $idAlumno = $data['idAlumno'];
    $dniAlumno = $data['dniAlumno'];
    $pass = $data['newPassword'];
    $api = new Api();
    $json = $api->updatePass($idAlumno, $pass);
    echo $json;
}
