<?php
// se incluye la conexión //
include '../app/conexion.php';
$conexion = conexion();


// variables que reciben los nuevos valores a insertar //
$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s",$time);
$tipo = "COMENTARIO";
$contador = "1";

// variable con la consulta de insert con los nuevos datos //
$cont = "INSERT INTO notificaciones_a(folio,usuario,estado,fecha,tipo,contador)
            VALUES
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador')";
$resultc = mysqli_query($conexion,$cont);

$sql ="INSERT INTO comentarios_a(fecha_comentario,comentarios,folio,usuario,estado1)
                  VALUES
      ('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";

$result = mysqli_query($conexion,$sql);
//echo $observaciones;

?>