<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();

$v1 = $_FILES['archivo']['name'];

$ruta = "material_gmm/".$v1;

$consulta = "INSERT INTO material_gmm (urlArchivo) VALUES ('".$ruta."')";

$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

mysqli_close( $conexion );

$ruta_carpeta = "material_gmm/"; //ruta para guardar los archivos en el servidor
$nombre_archivo = basename($_FILES["archivo"]["name"]); //se coloca el nombre del archivo
$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo; //se guarda el archivo con la ruta asignada

move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta_guardar_archivo);


?>



