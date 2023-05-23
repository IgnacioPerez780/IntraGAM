<?php

session_start();
include ('app/conexion.php');
$conexion = conexion();
date_default_timezone_set("America/Mexico_City");

/*VARIABLES
*/
$id = $_POST['id'];
$nombreContratante = $_POST['nombreContratante'];
$numeroP = $_POST['numeroP'];

$nuevoNombre = $_POST['nuevoNombre'];
$nuevaP = $_POST['nuevaP'];

$fecha = date("Y-m-d H:i:s");


echo "Enviando datos......";


$consulta = "INSERT INTO cambios_digitalizacion   (nombreContratanteAnterior, numeroPAnterior, id_contratante, nombreActual, numeroPActual, fecha) VALUES ('$nombreContratante','$numeroP', '$id', '$nuevoNombre', '$nuevaP', '$fecha')";

$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");



/*CONSULTA PARA MODIFICAR LA TABLA DE archivos_digitalizacion
*/$sql = "UPDATE archivos_digitalizacion SET nombreContratante = '$nuevoNombre'/*, numeroP = '$nuevaP'*/ WHERE nombreContratante = '$nombreContratante' ";
$updateSql = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");



/*CONSULTA PARA MODIFICAR LA TABLA DE CARETAS_DIGITALIZACION
*/$sql2 = "UPDATE carpetas_digitalizacion SET nombreContratante = '$nuevoNombre', numeroP = '$nuevaP' WHERE nombreContratante= '$nombreContratante'  AND id = '$id'  ";
$updateSql2 = mysqli_query( $conexion, $sql2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");




mysqli_close( $conexion );


?>


<form name="miformulario" action="detalles.php" method="POST">
	<input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>

	<input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nuevoNombre;  ?>" checked>
	<input style="display: none;" type="radio" name="numeroP" value="<?php echo $nuevaP;  ?>" checked>

	<input style="display: none;" type="radio" name="numeroPAnterior" value="<?php echo $numeroP;  ?>" checked>

</form>
<?php
 echo "<script> document.forms['miformulario'].submit(); </script>";
?>
