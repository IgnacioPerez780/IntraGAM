<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);

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
            if ($nomusuario == "Christian C" || $nomusuario == "Veronica S" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R") {
                $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
                    values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
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
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!-- JS -->
    <script src="js/registro_folios_g.js"></script>
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_general_folios.css">

</head>

<?php
// Tipo de cabecera que debera mostrar dependiendo que rol acceda
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '3' || $_SESSION['rol'] == '2') {
    include('plantillas/cabecera_gmm_c.php');
} else if ($_SESSION['rol'] == '9') {
    include('plantillas/cabecera_promocion_g.php');
}
?>

<body>
    <!-- Consulta de la busqueda con numero de folio -->
    <form method="POST" onsubmit="return enviar()" class="formFolios">
        <div class="container">
            <label>N&uacute;mero de Folio:</label>
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- Busca la informacion a traves del requests que el usuario hace durante la visita al sitio -->
                            <input type="text" class="form-control" id="poliza" value="<?php if (isset($_SESSION['poliza'])) {
                                                                                            echo $_SESSION['poliza'];
                                                                                        }    ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Consulta de la busqueda con nombre del agente -->
        <div class="container">
            <label>Nombre del agente:</label>
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="asegurado" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="<?php if (isset($_SESSION['asegurado'])) {
                                                                                                                                                                                                    echo $_SESSION['asegurado'];
                                                                                                                                                                                                }    ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-md-2'>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Consultar</button>
                </div>
            </div>
        </div>
    </form>

    <div class="container">
        <p id="respT"></p>
    </div>

    <!--Librerias-->
    <footer>
        <script src="js/index.js"></script>
        <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
        <script src="js/funciones.js"></script>
        <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cnx').click(function() {
                    //reload();
                });

            });
        </script>
    </footer>
</body>

</html>