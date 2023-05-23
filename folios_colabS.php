<?php
include 'app/conexion.php';
$conexion = conexion();

date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);

//INACTIVIDAD DE SESIÓN
if (isset($_SESSION['logged_in'])) {
    $inactive = 1500;
    if (isset($_SESSION["timeout"])) {
        // calculate the session's "time to live"
        $sessionTTL = time() - $_SESSION["timeout"];
        if ($sessionTTL > $inactive) {
            session_destroy();
            date_default_timezone_set('America/Mexico_City');
            $hoy = date("Y-m-d");
            $nomusuario = $_SESSION['nomusuario'];
            $fecha1 = $_COOKIE["tiempo"];
            $fecha2 = date("H:i");
            $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
            $tiempoTotal = ($tiempo / 60 . " Minutos");
            if ($nomusuario == "Veronica S" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R") {

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
    <script src="js/registro_foliosColab.js"></script>

    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_general_folios.css">

</head>

<?php

include('plantillas/cabecera_s_colab.php');
if ($_SESSION['logged_in'] == 1 && '4'  == $_SESSION['rol']) {
} else {
    header('location: index.php');
}
?>

<body>

    <form method="POST" onsubmit="return enviarSiniestros()" class="formFolios">
        <div class="container">
            <label>N&uacute;mero de P&oacute;liza:</label>
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">

                            <input type="text" class="form-control" id="poliza" value="<?php if (isset($_SESSION['poliza'])) {
                                                                                            echo $_SESSION['poliza'];
                                                                                        }    ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <label>Nombre del asegurado:</label>
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