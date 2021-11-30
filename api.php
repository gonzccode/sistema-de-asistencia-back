<?php
class Api
{
    /*public function getAlumnos()
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
    }*/

    public function getAlumnos_p()
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT a.id_alumno, a.contraseña, p.nombres, p.apellidos, p.dni, p.correo_electronico from mydb.alumno a inner join mydb.persona p on p.id_persona = a.persona_id_persona";
        $consulta = $db->prepare($sql);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_alumno" => $fila['id_alumno'],
                "password" => $fila['contraseña'],
                "nombre" => $fila['nombres'],
                "apellido" => $fila['apellidos'],
                "dni" => $fila['dni'],
                "correo" => $fila['correo_electronico']
            );
        }
        return $vector;
    }


    //funcion no utilizada
    public function getAlumno($id_alumno)
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * FROM mydb.alumno WHERE id_alumno=:id_alumno";
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
        //return $vector[0];
        return $vector;
    }

    public function getJustificacion()
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * from mydb.justificacion_faltas order by fecha desc";
        $consulta = $db->prepare($sql);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_justificacion" => $fila['id_justificacion_faltas'],
                "hora" => $fila['hora_justificacion'],
                "fecha" => $fila['fecha'],
                "estado_justificacion" => $fila['estado_justificacion_id_estado_justificacion'],
                "tipo_falta" => $fila['tipo_falta_id_tipo_falta'],
                "id_alumno" => $fila['alumno_id_alumno'],
                "id_coordinador" => $fila['coordinador_id_coordinador'],
                "id_detalle" => $fila['Detalle_justificacion_id_detalle_justificacion']
            );
        }
        return $vector;
    }

    public function getAsistenciaAlumno()
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT * from mydb.registro_asistencia order by fecha desc";
        $consulta = $db->prepare($sql);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_registro" => $fila['id_registro_asistencia'],
                "hora" => $fila['hora_ingreso'],
                "fecha" => $fila['fecha'],
                "id_coordinador" => $fila['coordinador_id_coordinador'],
                "id_alumno" => $fila['alumno_id_alumno'],
                "tipo_asistencia" => $fila['tipo_asistencia_id_tipo_asistencia'],
                "estado_asistencia" => $fila['estado_asistencia_id_estado_asistencia']
            );
        }
        return $vector;
    }

    //funcion utilizada
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

    //funcion no utilizada
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

    public function updatePass($idAlumno, $pass)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "UPDATE mydb.alumno SET contraseña = :pass WHERE id_alumno=:idAlumno";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':idAlumno', $idAlumno);
        $consulta->bindParam(':pass', $pass);
        $consulta->execute();
        return '{"msg":"contraseña actualizada"}';
    }



    public function insertDetalleJustificacion($idAlumno, $descripcionjustificacion)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "INSERT into mydb.detalle_justificacion  values('DJ-68020867M-10',:descripcionjustificacion,'1',:idAlumno)";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':idAlumno', $idAlumno);
        $consulta->bindParam(':descripcionjustificacion', $descripcionjustificacion);
        $consulta->execute();
        return '{"msg":"detalle insertada"}';
    }
    public function updateJustificacion($idAlumno, $idJustificacion)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "UPDATE mydb.justificacion_faltas SET Detalle_justificacion_id_detalle_justificacion = 'DJ-68020867M-10', estado_justificacion_id_estado_justificacion='1' where id_justificacion_faltas = :idJustificacion and alumno_id_alumno = :idAlumno";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':idAlumno', $idAlumno);
        $consulta->bindParam(':idJustificacion', $idJustificacion);
        $consulta->execute();
        return '{"msg":"justificacion actualizado"}';
        //DJ-68020867M-08 id detalle
    }
}
