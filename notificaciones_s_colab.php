<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

//Para no loguearse sin haber iniciado sesion
if (!isset($_SESSION['nomusuario']))
  header('location: index.php');

//Inactividad de la sesion 
if (isset($_SESSION['logged_in'])) {
  //Tiempo a medir en segundos (25 minutos)
  $inactive = 1500;
  //Verifica si $_SESSION["timeout"] esta configurado
  if (isset($_SESSION["timeout"])) {
    //Calcula el tiempo de vida en la sesion abierta
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
      //Destruye la sesion en dado caso de superar el tiempo de inactividad
      session_destroy();
      //Usuarios que se les medira el tiempo de sesion en la plataforma
      date_default_timezone_set('America/Mexico_City');
      $hoy = date("Y-m-d");
      $nomusuario = $_SESSION['nomusuario'];
      $fecha1 = $_COOKIE["tiempo"];
      $fecha2 = date("H:i");
      $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
      $tiempoTotal = ($tiempo / 60 . " Minutos");
      if ($nomusuario == "Manuel R") {
        $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha) values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
        $inserT = mysqli_query($conexion, $ti);
      }
?>
      <script>
        window.location = 'index.php';
      </script>
<?php

    }
  }
  $_SESSION["timeout"] = time();
}

if ($_SESSION['logged_in'] == 1) {
} else header('location: index.php');

// Se obtiene la zona horaria de Mexico
date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/alertify.min.js"></script>
  <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
  <!--librerias de bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <!--hojas de estilo-->
  <link rel="stylesheet" href="css/alertify.core.css">
  <link rel="stylesheet" href="css/alertify.default.css">
  <link rel="stylesheet" href="css/hoja_notificaciones.css">

</head>

<?php
// Tipo de cabecera que debera mostrar dependiendo que rol acceda
if ($_SESSION['rol'] == '1') {
  header('location: index.php');
  exit;
} else {
  include('plantillas/cabecera_s_colab.php');
}
?>

<body>

  <!-- Incluye y evalua el archivo especificado -->
  <div class="container">
    <?php include('componentes/tabla_noti_s_colab.php'); ?>
    <div id="tabla"></div>
  </div>

  <!--anexe para el refresh-->
  <form method="post" action="siniestros_colab.php">
    <input type="hidden" onclick="window.opener.location.reload(); window.close();">
  </form>

  <!-- Librerias -->
  <footer>
    <script src="js/index.js"></script>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
  </footer>
</body>

</html>