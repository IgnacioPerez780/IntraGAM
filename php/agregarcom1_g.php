<?php

// se incluye la conexión //
include '../app/conexion.php';
$conexion = conexion();

// se crean las variables con los nuevos datos //
$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s",$time);
$tipo = "COMENTARIO";
$contador = "1";

//$cont0="UPDATE notificaciones_g set contador='0' where folio='$folio'";
    //$result = mysqli_query($conexion,$cont0);

$cont = "INSERT INTO notificaciones_g(folio,usuario,estado,fecha,tipo,contador)
            VALUES
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador')";
$resultc = mysqli_query($conexion,$cont);

$sql ="INSERT INTO comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1)
                  VALUES
      ('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";

$result = mysqli_query($conexion,$sql);
//echo $observaciones;

?>