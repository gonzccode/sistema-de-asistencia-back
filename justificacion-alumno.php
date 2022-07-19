<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $idDetalleJustificacion = $data['id_detalle_justificacion'];
    $idJustificacion = $data['idJustificacion'];
    $idAlumno = $data['idAlumno'];
    $descripcionjustificacion = $data['descripcionjustificacion'];
    $fileName = $data['a'];
    $api = new Api();
    $api1 = new Api();
    $json = $api->insertDetalleJustificacion($idDetalleJustificacion, $idAlumno, $descripcionjustificacion, $fileName);
    $json1 = $api1->updateJustificacion($idDetalleJustificacion, $idAlumno, $idJustificacion);
    echo $json1;
    echo $json;
    echo 'esto es post';
}

/*if ($method == "POST") {
    $json1 = null;
    $data1 = json_decode(file_get_contents("php://input"), true);
    $idJustificacion = $data1['idJustificacion'];
    $api1 = new Api();
    $json1 = $api1->updateJustificacion($idJustificacion);
    echo $json1;
    echo 'esto es post';
}*/
