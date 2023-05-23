<?php
include '../app/conexion.php';
$conexion = conexion();

// PARAMETROS del formulario
$usuario = $_POST['usuario'];
$comentario = $_POST['comentario'];

// Se obtiene la zona horaria de México
date_default_timezone_set("America/Mexico_City");
$time = time();
$fecha_actual = date("Y-m-d H:i:s", $time);

// Query inserta la feche, los comentarios y el usaruio quien haya ingresado alguna nota en en el apartado material de apoyo
$consulta = "INSERT INTO material_apoyo_info (fecha_comentario,comentario,usuario) VALUES ('$fecha_actual','$comentario','$usuario')";
$resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

// Redirecciona a la pagina material_c.php realizada la insercion a la base
if ($resultado) {
    echo "<script>window.location='../material_c.php'</script>";
}

// Nos permite cerrar la conexion con la base de datos abierta
mysqli_close($conexion);

?>