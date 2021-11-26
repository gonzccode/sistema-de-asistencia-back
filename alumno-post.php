<?php
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $idAlumno = $data['idAlumno'];
    $dniAlumno = $data['dniAlumno'];
    $pass = $data['newPassword'];
    $api = new Api();
    $json = $api->addProducto($idAlumno, $pass);
    echo $json;
}

/*if ($method == "POST") {
    $dni = $_POST['dniAlumno'];
    $pass = $_POST['contraseña'];

    if ($dni === ' ' ||  $pass === ' ') {
        echo json_encode('llena todos los campos');
    } else {
        echo json_encode('correcto: <br>dni:' . $dni . '<br>pass:' . $pass);
    }
} else {
    echo "no entra a post";
}*/

/*error_reporting(0);
$dni = $_POST['dniAlumno'];
$pass = $_POST['contraseña'];

if (isset($dni) && isset($pass)) {
    if ($dni === ' ' ||  $pass === ' ') {
        echo json_encode('llena todos los campos');
    } else {
        echo json_encode('correcto: <br>dni:' . $dni . '<br>pass:' . $pass);
    }
}*/
