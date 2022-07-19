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

if ($method == 'POST') {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $idRegistroAsistencia = $data['id_registro_asistencia'];
    $idAlumno = $data['id_alumno'];
    $dniAlumno = $data['dni_alumno'];
    $tipoAsistencia = $data['tipo_asistencia'];
    $estadoAsistencia = $data['estado_asistencia'];
    $fecha = $data['fecha'];
    $hora = $data['hora'];
    $id_coordinador = $data['id_coordinador'];
    $api = new Api();
    $json = $api->insertAsistencia($idRegistroAsistencia, $hora, $fecha, $id_coordinador, $idAlumno, $tipoAsistencia, $estadoAsistencia);
    echo $json;
}
