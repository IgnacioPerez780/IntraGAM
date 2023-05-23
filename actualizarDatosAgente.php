<?php 
include 'app/conexion.php';
$conexion = conexion();

?>

<head>
  
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>


<?php


$nomusuario = $_POST['nomusuario'];


$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$celular = $_POST['celular'];
$cua = $_POST['cuaAnterior'];
$correos = $_POST['correos'];
$correog = $_POST['correog'];
$correoa = $_POST['correoa'];
$correo = $_POST['correo'];
$rfc = $_POST['rfc'];
$v1 = $_POST['imagen'];


$fecha = date("Y-m-d H:i:s");

/*VARIABLES ANTERIORES
*/
$nombreAnterior = $_POST['nombreAnterior'];
$direccionAnterior = $_POST['direccionAnterior'];
$celularAnterior = $_POST['celularAnterior'];
$cuaAnterior = $_POST['cuaAnterior'];
$correosAnterior = $_POST['correosAnterior'];
$correogAnterior = $_POST['correogAnterior'];
$correoaAnterior = $_POST['correoaAnterior'];
$correoAnterior = $_POST['correoAnterior'];
$rfcAnterior = $_POST['rfcAnterior'];


/*

  $mod = "SELECT * FROM fotosPerfil WHERE nomusuario = '$nomusuario' ";
                        $resultTE = mysqli_query($conexion, $mod);
                        while ($modificacion = mysqli_fetch_array($resultTE)) {

                          $nombre = $modificacion['nomusuario'];
*/














/*VALIDAR SI SE CAMBIO  EL NOMBRE
*/if ($nombreAnterior != $nombre) {
  
$n = "Nombre:";
  $consulta = "INSERT INTO cambiosperfil   (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $nombreAnterior', '$nombre', '$fecha')";

$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}


/*VALIDAR SI SE CAMBIO  LA DIRECCIÓN
*/if ($direccionAnterior != $direccion) {
  
  
$n = "Direccion:";
  $consulta2 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $direccionAnterior', '$direccion', '$fecha')";

$resultado2 = mysqli_query( $conexion, $consulta2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}





/*VALIDAR SI SE CAMBIO EL CELULAR
*/if ($rfcAnterior != $rfc) {
    
$n = "RFC:";

  $consultarfc = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $rfcAnterior', '$rfc', '$fecha')";

$resultadorfc = mysqli_query( $conexion, $consultarfc ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}



/*VALIDAR SI SE CAMBIO EL CELULAR
*/if ($celularAnterior != $celular) {
  
  
$n = "Celular:";
  $consulta3 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $celularAnterior', '$celular', '$fecha')";

$resultado3 = mysqli_query( $conexion, $consulta3 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}


/*VALIDAR SI SE CAMBIO EL CELULAR
*/if ($cuaAnterior != $cua) {
  
  
$n = "CUA:";
  $consulta4 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $cuaAnterior', '$cua', '$fecha')";

$resultado4 = mysqli_query( $conexion, $consulta4 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}



/*VALIDAR SI SE CAMBIO correo vida
*/if ($correoAnterior != $correo) {
  
  
$n = "C. Vida:";
  $consulta5 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $correoAnterior', '$correo', '$fecha')";

$resultado5 = mysqli_query( $conexion, $consulta5 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}


/*VALIDAR SI SE CAMBIO correo g
*/if ($correogAnterior != $correog) {
  
$n = "C. GMM:";
  $consulta6 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $correogAnterior', '$correog', '$fecha')";

$resultado6 = mysqli_query( $conexion, $consulta6 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}

/*VALIDAR SI SE CAMBIO correo a
*/if ($correoaAnterior != $correoa) {
  
$n = "C. Autos:";
  $consulta7 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $correoaAnterior', '$correoa', '$fecha')";

$resultado7 = mysqli_query( $conexion, $consulta7 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}


/*VALIDAR SI SE CAMBIO correo s
*/if ($correosAnterior != $correos) {
  
$n = "C. Siniestros:";
  $consulta8 = "INSERT INTO cambiosperfil  (nomusuario, anterior, actual, fecha) VALUES ('$nomusuario','$n $correosAnterior', '$correos', '$fecha')";

$resultado8 = mysqli_query( $conexion, $consulta8 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}



/*VALIDACION PARA VER SI SE CAMBIO LA IMAGEN
*/
$v1 = $_FILES['archivo']['name'];
$ruta = "fotosPerfil/".$v1;

if ($v1 == "") {

 $sql3 = "UPDATE datos_agente SET nombre = '$nombre', direccion = '$direccion',  rfc = '$rfc', celular = '$celular', cua = '$cua', correos = '$correos', correog = '$correog', correoa = '$correoa', correo = '$correo'  WHERE nomusuario= '$nomusuario' ";
$update = mysqli_query( $conexion, $sql3 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

} else { 
/*CONSULTA PARA MODIFICAR LA TABLA 
*/$sql2 = "UPDATE datos_agente SET nombre = '$nombre', direccion = '$direccion', rfc = '$rfc', celular = '$celular', cua = '$cua', correos = '$correos', correog = '$correog', correoa = '$correoa', correo = '$correo', fotoPerfil = '$ruta'  WHERE nomusuario= '$nomusuario' ";
$updateSql2 = mysqli_query( $conexion, $sql2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");



$ruta_carpeta = "fotosPerfil/"; //ruta para guardar los archivos en el servidor
$nombre_archivo = basename($_FILES["archivo"]["name"]); //se coloca el nombre del archivo
$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo; //se guarda el archivo con la ruta asignada

move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta_guardar_archivo);



}




                   $mod = "SELECT * FROM fotosPerfil WHERE nomusuario = '$nomusuario' ";
                        $resultTE = mysqli_query($conexion, $mod);
                            $modificacion = mysqli_fetch_array($resultTE);

                            $existe = $modificacion['nomusuario'];
                           
                      



if ($existe != $nomusuario) {

 $foto = "INSERT INTO fotosPerfil (nomusuario, fotoPerfil, actualizado) VALUES ('$nomusuario','$ruta', '$fecha')";

$rfoto = mysqli_query( $conexion, $foto ) or die ( "Algo ha ido mal en la consulta a la base de datos");

}

if ($existe == $nomusuario && $v1 != "") { 
                 
/*CONSULTA PARA MODIFICAR LA TABLA 
*/$name = "UPDATE fotosPerfil SET  fotoPerfil = '$ruta'  WHERE nomusuario = '$nomusuario' ";
$updatename = mysqli_query( $conexion, $name ) or die ( "Algo ha ido mal en la consulta a la base de datos");



}






    



?>


<script type="text/javascript">


  Swal.fire({
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
})



</script>
<form name="miformulario" action="editarDatosAgente.php" method="POST">
  <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>
</form>
<?php
 echo "<script> document.forms['miformulario'].submit(); </script>";
 ?>