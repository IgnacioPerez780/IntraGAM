<?php
// s incluye la conexion a la base //
include '../app/conexion.php';
$conexion = conexion();

// se declaran las variables que contienen los datos recibidos por post //
$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s",$time);
$tipo = "COMENTARIO";
$contador = "1";

// se inserta la consulta UPDATE a la tabla correspondiente //
$cont0="UPDATE notificaciones1_s set contador='0' where folio='$folio'";
    $result = mysqli_query($conexion,$cont0);

$cont = "insert into notificaciones_s(folio,usuario,estado,fecha,tipo,contador)
            values
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador')";
$resultc = mysqli_query($conexion,$cont);

$sql ="insert into comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";

$result = mysqli_query($conexion,$sql);

?>