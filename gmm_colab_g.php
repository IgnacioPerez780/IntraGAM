<?php

error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}

//INACTIVIDAD DE SESION
if (isset($_SESSION['logged_in'])) {
    // set time-out period (in seconds)
    $inactive = 1500;
    // check to see if $_SESSION["timeout"] is set
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
            if ($nomusuario == "Veronica S" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R" || $nomusuario == "Roberto R" || $nomusuario == "Omar S" || $nomusuario == "Martin G" || $nomusuario == "Nancy O") {
                $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
            values
            ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
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
} else {
    header('location: index.php');
}

date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);

$sql1 = "select * from tipo_solicitud_gmm";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
    $combobit1 = "";
    while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
        $combobit1 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
    }
}

$sql2 = "select * from producto_gmm where tipo_solicitud='1'";
$result2 = $conexion->query($sql2);
if ($result2->num_rows > 0) {
    $combobit2 = "";
    while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
        $combobit2 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql3 = "select * from producto_gmm where tipo_solicitud='2'";
$result3 = $conexion->query($sql3);
if ($result3->num_rows > 0) {
    $combobit3 = "";
    while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
        $combobit3 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql4 = "select * from producto_gmm where tipo_solicitud='3'";
$result4 = $conexion->query($sql4);
if ($result4->num_rows > 0) {
    $combobit4 = "";
    while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
        $combobit4 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql5 = "select * from motivo";
$result5 = $conexion->query($sql5);
if ($result5->num_rows > 0) {
    $combobit5 = "";
    while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
        $combobit5 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
    }
}


$sql6 = "select * from datos_agente order by nombre";
$result6 = $conexion->query($sql6);
if ($result6->num_rows > 0) {
    $combobit6 = "";
    while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
        $combobit6 .= " <option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--ALERTAS PARA MENSAJES DE VALIDACION-->
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
    <link rel="stylesheet" href="css/hoja_general_gmm.css">
</head>

<?php
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '6') {
    include('plantillas/cabecera_gmm_colab_g.php');
} else if ($_SESSION['rol'] == '8') {
    include('plantillas/cabecera_cartera_g.php');
}
?>

<body>

    <div class="container">
        <?php include('componentes/tabla_g_colab_g.php'); ?>
        <div id="tabla"></div>
    </div>

</body>


</html>