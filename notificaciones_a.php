<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

//Para no loguearse sin haber iniciado sesion
if (!isset($_SESSION['nomusuario']))
    header('location: index.php');

//INACTIVIDAD DE SESION
if (isset($_SESSION['logged_in'])) {

    $inactive = 1500;

    if (isset($_SESSION["timeout"])) {
        // calculate the session's "time to live"
        $sessionTTL = time() - $_SESSION["timeout"];
        if ($sessionTTL > $inactive) {
            session_destroy();

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
date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="gb18030">

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
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else {
    include('plantillas/cabecera_autos_c.php');
}
?>

<body>

    <div class="container">
        <?php include('componentes/tabla_noti_a.php'); ?>
        <div id="tabla"></div>
    </div>

    <!--anexe para el refresh-->
    <form method="post" action="consultor.php">
        <input type="hidden" onclick="window.opener.location.reload(); window.close();">
    </form>

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