<?php

session_start();
include ('app/conexion.php');
$conexion = conexion();
date_default_timezone_set("America/Mexico_City");
/*SE INSERTAN LAS RESPUESTAS A LA BASE DE DATOS */

$nombreContratante = $_POST['nombreContratante'];
$numeroP = $_POST['numeroP'];
$id = $_POST['id'];
$vigencia = $_POST['vigencia'];
$primaNeta = $_POST['primaNeta'];
$formaPago = $_POST['formaPago'];
$moneda = $_POST['moneda'];
$agente = $_POST['agente'];

$comentario = $_POST['comentario'];

echo "Enviando datos......";



$v1 = $_FILES['archivo']['name'];

$ruta = "archivos_digitalizacion_pymes/".$v1;

$fecha = date("Y-m-d H:i:s");

$consulta = "INSERT INTO archivos_digitalizacion_pymes (nombreContratante, numeroP, urlArchivo, id_contratante, fecha) VALUES ('$nombreContratante','$numeroP', '$ruta', '$id', '$fecha')";
$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

mysqli_close( $conexion );

$ruta_carpeta = "archivos_digitalizacion_pymes/"; //ruta para guardar los archivos en el servidor
$nombre_archivo = basename($_FILES["archivo"]["name"]); //se coloca el nombre del archivo
$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo; //se guarda el archivo con la ruta asignada

move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta_guardar_archivo);


?>


<form name="miformulario" action="detalles_py.php" method="POST">
	 <input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>
	 <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nombreContratante;  ?>" checked>
	  <input style="display: none;" type="radio" name="agente" value="<?php echo $agente;  ?>" checked>
	 <input style="display: none;" type="radio" name="numeroP" value="<?php echo $numeroP;  ?>" checked>
	 <input style="display: none;" type="radio" name="vigencia" value="<?php echo $vigencia;  ?>" checked>
	 <input style="display: none;" type="radio" name="primaNeta" value="<?php echo $primaNeta;  ?>" checked>
	 <input style="display: none;" type="radio" name="formaPago" value="<?php echo $formaPago;  ?>" checked>
     <input style="display: none;" type="radio" name="moneda" value="<?php echo $moneda;  ?>" checked>
      <input style="display: none;" type="radio" name="comentario" value="<?php echo $comentario;  ?>" checked>
</form>
<?php
 echo "<script> document.forms['miformulario'].submit(); </script>";
?>
<!-- <script type="text/javascript">
    window.onload=function(){
                // Una vez cargada la página, el formulario se enviara automáticamente.
		document.forms["miformulario"].submit();
    }
    </script> -->