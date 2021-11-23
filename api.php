<?php
class Api
{
    public function getAlumnos()
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * FROM mydb.alumno";
        $consulta = $db->prepare($sql);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_alumno" => $fila['id_alumno'],
                "password" => $fila['contraseña'],
                "num_tarjeta" => $fila['num_tarjeta'],
                "estado_alumno_id_estado_alumno" => $fila['estado_alumno_id_estado_alumno'],
                "estado_tarjeta_id_estado_tarjeta" => $fila['estado_tarjeta_id_estado_tarjeta'],
                "aula_id_aula" => $fila['aula_id_aula'],
                "turno_id_turno" => $fila['turno_id_turno'],
                "persona_id_persona" => $fila['persona_id_persona']
            );
        }
        return $vector;
    }
    public function getAlumno($id_alumno)
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * FROM pruebaasistencia.asistencia WHERE id_alumno=:id_alumno";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':id_alumno', $id_alumno);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id" => $fila['id'],
                "password" => $fila['contraseña'],
                "num_tarjeta" => $fila['num_tarjeta'],
                "estado_alumno_id_estado_alumno" => $fila['estado_alumno_id_estado_alumno'],
                "estado_tarjeta_id_estado_tarjeta" => $fila['estado_tarjeta_id_estado_tarjeta'],
                "aula_id_aula" => $fila['aula_id_aula'],
                "turno_id_turno" => $fila['turno_id_turno'],
                "persona_id_persona" => $fila['persona_id_persona']
            );
        }
        return $vector[0];
    }
    public function getCoordinadores()
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * FROM mydb.coordinador";
        $consulta = $db->prepare($sql);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_coordinador" => $fila['id_coordinador'],
                "password" => $fila['contraseña'],
                "fecha_contrato" => $fila['fecha_contrato'],
                "id_persona" => $fila['persona_id_persona']
            );
        }
        return $vector;
    }
    public function getCoordinador($id)
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * FROM mydb.coordinador WHERE id_coordinador=:id_coordinador";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':id_coordinador', $id_coordinador);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_coordinador" => $fila['id_coordinador'],
                "password" => $fila['tipoAsistencia'],
                "fecha_contrato" => $fila['fecha_contrato'],
                "id_persona" => $fila['persona_id_persona']
            );
        }
        return $vector[0];
    }
}
