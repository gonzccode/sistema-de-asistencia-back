<?php
    require_once('conexion.php');
    require_once('api.php');
    require_once('cors.php');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method =="GET"){
        if (!empty($_GET['id_detalle_justificacion'])) {
            $id_detalle_justificacion=$_GET['id_detalle_justificacion'];
            $api = new Api();
            $obj = $api->getDetalleJustificacion($id_detalle_justificacion);
            $json = json_encode($obj);
            echo $json;

        }else{
            $vector = array();
            $api = new Api();
            $vector = $api->getDetalleJustificaciones();
            $json = json_encode($vector);
            echo $json;
            
        }
    }
    // http://localhost/backend-asistencia/detalleJustificacion.php?id_justificacion=10
