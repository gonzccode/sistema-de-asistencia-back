<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

/*if ($method == "POST") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $idAlumno = $data['idAlumno'];
    $dniAlumno = $data['dniAlumno'];
    $pass = $data['newPassword'];
    $api = new Api();
    $json = $api->addProducto($idAlumno, $pass);
    echo $json;
}*/
