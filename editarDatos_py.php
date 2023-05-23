<?php

session_start();
include ('app/conexion.php');
$conexion = conexion();
date_default_timezone_set("America/Mexico_City");

/*VARIABLES
*/
$id = $_POST['id'];
$nombreContratante = $_POST['nombreContratante'];
$agente = $_POST['agente'];
$numeroP = $_POST['numeroP'];
$vigencia = $_POST['vigencia'];
$nuevoNombre = $_POST['nuevoNombre'];
$nuevaP = $_POST['nuevaP'];
$nuevaV = $_POST['nuevaV'];
$formaPago = $_POST['formaPago'];
$moneda = $_POST['moneda'];
$primaNeta = $_POST['primaNeta'];
$primaNueva = $_POST['primaNueva'];

$comentarioAnterior = $_POST['comentarioAnterior'];
$comentarioActual = $_POST['comentarioActual'];


$monedaN = $_POST['monedaN'];
$formaPagoN = $_POST['formaPagoN'];



$fecha = date("Y-m-d H:i:s");


echo "Enviando datos......";


$consulta = "INSERT INTO cambios_digitalizacion_pymes   (nombreContratanteAnterior, numeroPAnterior, vigenciaAnterior, primaNetaAnterior, formaPagoAnterior, monedaAnterior, comentarioAnterior, id_contratante, nombreActual, numeroPActual, vigenciaActual, primaNetaActual, formaPagoActual, monedaActual, comentarioActual, fecha) VALUES ('$nombreContratante','$numeroP', '$vigencia', '$primaNeta', '$formaPago', '$moneda', '$comentarioAnterior', '$id', '$nuevoNombre', '$nuevaP','$nuevaV', '$primaNueva', '$formaPagoN', '$monedaN', '$comentarioActual','$fecha')";

$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");



/*CONSULTA PARA MODIFICAR LA TABLA DE archivos_digitalizacion_pymes
*/$sql = "UPDATE archivos_digitalizacion_pymes SET nombreContratante = '$nuevoNombre'/*, numeroP = '$nuevaP'*/ WHERE nombreContratante = '$nombreContratante' ";
$updateSql = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");



/*CONSULTA PARA MODIFICAR LA TABLA DE CARETAS_DIGITALIZACION
*/$sql2 = "UPDATE carpetas_digitalizacion_pymes SET nombreContratante = '$nuevoNombre', numeroP = '$nuevaP', vigencia = '$nuevaV', primaNeta = '$primaNueva', formaPago = '$formaPagoN', moneda = '$monedaN', comentario = '$comentarioActual' WHERE nombreContratante= '$nombreContratante' AND id = '$id' ";
$updateSql2 = mysqli_query( $conexion, $sql2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");




mysqli_close( $conexion );


?>


<form name="miformulario" action="detalles_py.php" method="POST">
	<input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>
	<input style="display: none;" type="radio" name="agente" value="<?php echo $agente;  ?>" checked>
	<input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nuevoNombre;  ?>" checked>
	<input style="display: none;" type="radio" name="numeroP" value="<?php echo $nuevaP;  ?>" checked>
	<input style="display: none;" type="radio" name="vigencia" value="<?php echo $nuevaV;  ?>" checked>
	<input style="display: none;" type="radio" name="numeroPAnterior" value="<?php echo $numeroP;  ?>" checked>
	<input style="display: none;" type="radio" name="primaNeta" value="<?php echo $primaNueva;  ?>" checked>
	<input style="display: none;" type="radio" name="formaPago" value="<?php echo $formaPagoN;  ?>" checked>
	<input style="display: none;" type="radio" name="moneda" value="<?php echo $monedaN;  ?>" checked>
	<input style="display: none;" type="radio" name="comentario" value="<?php echo $comentarioActual;  ?>" checked>
</form>
<?php
 echo "<script> document.forms['miformulario'].submit(); </script>";
?>
