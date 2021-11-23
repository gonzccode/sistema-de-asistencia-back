<?php
class Conexion
{
    public function getConexion()
    {
        $host = "localhost";
        $port = "3308";
        $db = "mydb";
        $user = "root";
        $password = "";

        $db = new PDO("mysql:host=$host;port=$port;dbame=$db;", $user, $password);

        return $db;
    }
}
