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
        $sql = "SELECT jf.id_justificacion_faltas,jf.hora_justificacion,jf.fecha, jf.estado_justificacion_id_estado_justificacion, jf.tipo_falta_id_tipo_falta, jf.alumno_id_alumno, jf.coordinador_id_coordinador, jf.Detalle_justificacion_id_detalle_justificacion, p.nombres, p.apellidos, p.dni, df.id_detalle_justificacion, df.descripcion_justificacion, df.archivo_adjunto
        from mydb.justificacion_faltas  jf 
        inner join mydb.alumno a on a.id_alumno = jf.alumno_id_alumno
        inner join mydb.persona p on a.persona_id_persona = p.id_persona
        inner join mydb.detalle_justificacion df on jf.Detalle_justificacion_id_detalle_justificacion = df.id_detalle_justificacion
        order by jf.fecha desc";
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
                "id_detalle" => $fila['Detalle_justificacion_id_detalle_justificacion'],
                "nombre_alumno" => $fila['nombres'],
                "apellido_alumno" => $fila['apellidos'],
                "dni_alumno" => $fila['dni'],
                "id_detalle" => $fila['id_detalle_justificacion'],
                "descripcion_detalle" => $fila['descripcion_justificacion'],
                "archivo_adjunto" => $fila['archivo_adjunto']
            );
        }
        return $vector;
    }

    public function getAsistenciaAlumno()
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT rg.id_registro_asistencia, rg.hora_ingreso,rg.fecha, rg.coordinador_id_coordinador,rg.alumno_id_alumno, 
        rg.tipo_asistencia_id_tipo_asistencia,rg.estado_asistencia_id_estado_asistencia, 
        p.nombres as nombre_coordinador, p.apellidos as apellido_coordinador, a.aula_id_aula, a.turno_id_turno, 
        pa.nombres as nombre_alumno, pa.apellidos as apellido_alumno 
        from mydb.registro_asistencia rg 
        left join mydb.coordinador c on c.id_coordinador = rg.coordinador_id_coordinador 
        inner join mydb.persona p on p.id_persona = c.persona_id_persona 
        inner join mydb.alumno a on a.id_alumno = rg.alumno_id_alumno 
        inner join mydb.persona pa on pa.id_persona = a.persona_id_persona order by rg.fecha desc;";
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
                "estado_asistencia" => $fila['estado_asistencia_id_estado_asistencia'],
                "nombre_coordinador" => $fila['nombre_coordinador'],
                "apellido_coordinador" => $fila['apellido_coordinador'],
                "aula" => $fila['aula_id_aula'],
                "turno" => $fila['turno_id_turno'],
                "nombre_alumno" => $fila['nombre_alumno'],
                "apellido_alumno" => $fila['apellido_alumno'],
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
        $sql = "SELECT c.id_coordinador, c.contraseña, p.nombres, p.apellidos,p.id_persona, p.dni, p.correo_electronico,c.fecha_contrato from mydb.coordinador c inner join mydb.persona p on p.id_persona = c.persona_id_persona";
        $consulta = $db->prepare($sql);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_coordinador" => $fila['id_coordinador'],
                "nombre" => $fila['nombres'],
                "apellido" => $fila['apellidos'],
                "dni" => $fila['dni'],
                "correo" => $fila['correo_electronico'],
                "password" => $fila['contraseña'],
                "fecha_contrato" => $fila['fecha_contrato'],
                "id_persona" => $fila['id_persona']
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



    public function insertDetalleJustificacion($idDetalleJustificacion, $idAlumno, $descripcionjustificacion, $fileName)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "INSERT into mydb.detalle_justificacion  values(:id_detalle_justificacion,:descripcionjustificacion,:archivoNombre,:idAlumno)";
        $consulta = $db->prepare($sql);
        // Id detalle falso
        //$text = 'asd';
        //$completo = $text . $idAlumno;
        // 
        $consulta->bindParam(':id_detalle_justificacion', $idDetalleJustificacion);
        $consulta->bindParam(':idAlumno', $idAlumno);
        $consulta->bindParam(':descripcionjustificacion', $descripcionjustificacion);
        $consulta->bindParam(':archivoNombre', $fileName);
        $consulta->execute();
        return '{"msg":"detalle insertada"}';
    }
    public function updateJustificacion($idDetalleJustificacion, $idAlumno, $idJustificacion)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "UPDATE mydb.justificacion_faltas SET Detalle_justificacion_id_detalle_justificacion = :Detalle_justificacion_id_detalle_justificacion, estado_justificacion_id_estado_justificacion='1' where id_justificacion_faltas = :idJustificacion and alumno_id_alumno = :idAlumno";
        $consulta = $db->prepare($sql);
        //$text2 = 'asd';
        //$completo = $text2 . $idAlumno;
        $consulta->bindParam(':Detalle_justificacion_id_detalle_justificacion', $idDetalleJustificacion);
        $consulta->bindParam(':idAlumno', $idAlumno);
        $consulta->bindParam(':idJustificacion', $idJustificacion);
        $consulta->execute();
        return '{"msg":"justificacion actualizado"}';
        //DJ-68020867M-08 id detalle

    }

    public function insertAsistencia($idRegistroAsistencia, $hora, $fecha, $id_coordinador, $idAlumno, $tipoAsistencia, $estadoAsistencia)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "INSERT into mydb.registro_asistencia  values(:idRegistroAsistencia,:hora,:fecha,:id_coordinador,:idAlumno,:tipoAsistencia,:estadoAsistencia)";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':idRegistroAsistencia', $idRegistroAsistencia);
        $consulta->bindParam(':hora', $hora);
        $consulta->bindParam(':idAlumno', $idAlumno);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':id_coordinador', $id_coordinador);
        $consulta->bindParam(':tipoAsistencia', $tipoAsistencia);
        $consulta->bindParam(':estadoAsistencia', $estadoAsistencia);
        $consulta->execute();
        return '{"msg":"asistencia insertada"}';
    }

    // -----------------------------------
    //     FIN LISTAS DE JUSTIFICACIONES 
    // -----------------------------------



    public function getDetalleJustificacion($id_detalle_justificacion)
    {
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "SELECT *, CONVERT(archivo_adjunto USING utf8) as text FROM mydb.detalle_justificacion WHERE id_detalle_justificacion=:id_detalle_justificacion";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':id_detalle_justificacion', $id_detalle_justificacion);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id_detalle" => $fila['id_detalle_justificacion'],
                "descripcion" => $fila['descripcion_justificacion'],
                "archivoAdjunto" => $fila['archivo_adjunto'],
                "id_alumno " => $fila['alumno_id_alumno'],
                "text" => $fila['text']
            );
        }
        return $vector;
    }

    public function getDetalleJustificaciones()
    {
        //     $vector = array();
        //     $conexion = new Conexion();
        //     $db =$conexion->getConexion();
        //     $sql="SELECT * FROM mydb.justificacion_faltas WHERE tipo_falta_id_tipo_falta = 4";
        //     $consulta = $db->prepare($sql);
        //     $consulta->execute();
        //     while ($fila=$consulta->fetch()) {
        //         $vector[]= array(
        //             "alumno_id_alumno"=>$fila['alumno_id_alumno'],
        //             "Fecha"=>$fila['fecha'],
        //             "id_detalle_justificaciÃ³n"=>$fila['Detalle_justificacion_id_detalle_justificacion'],
        //             "id_tipo_falta"=>$fila['tipo_falta_id_tipo_falta'] 
        //         );
        //     }
        //     return $vector;
    }

    public function aprobarJustificion($Detalle_justificacion_id_detalle_justificacion)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "UPDATE mydb.justificacion_faltas SET estado_justificacion_id_estado_justificacion='2' where id_justificacion_faltas = :Detalle_justificacion_id_detalle_justificacion";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':Detalle_justificacion_id_detalle_justificacion', $Detalle_justificacion_id_detalle_justificacion);
        $consulta->execute();
        return '{"msg":"justificacion actualizado aprobado"}';
    }


    public function rechazarJustificion($Detalle_justificacion_id_detalle_justificacion)
    {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = "UPDATE mydb.justificacion_faltas SET estado_justificacion_id_estado_justificacion='4' where id_justificacion_faltas = :Detalle_justificacion_id_detalle_justificacion";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':Detalle_justificacion_id_detalle_justificacion', $Detalle_justificacion_id_detalle_justificacion);
        $consulta->execute();
        return '{"msg":"justificacion actualizado rechazado"}';
    }
}
