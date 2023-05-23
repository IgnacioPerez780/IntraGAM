<?php
error_reporting(E_ALL);
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
} else header('location: index.php');
$nomusuario = $_SESSION['nomusuario'];
$ids = isset($_GET['id']) ? $_GET['id'] : 1;
//var_dump($ids);
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$id_archivo = isset($_GET['id_archivo']) ? $_GET['id_archivo'] : 0;
//var_dump($_GET['id_archivo']);
$datos_archivo = array();
if (isset($_GET['id_archivo'])) {
    if (isset($_FILES)) {
        var_dump($_FILES);
    }
    if ($id_archivo != 0) {
        $query = "SELECT
                        id as id_archivo , fk_folio as folio, nombre as nombre
                    FROM archivos_g
                    WHERE id = '$id_archivo'";

        $resultado = $conexion->query($query);
        while ($ver = mysqli_fetch_object($resultado)) {
            $datos_archivo = [
                'id_archivo' => $ver->id_archivo,
                'folio' => $ver->folio,
                'nombre' =>  $ver->nombre
            ];
        }
    }
    var_dump($datos_archivo['nombre']);
}


$sql1 = "select * from estado order by nombre";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
    $combobit1 = "";
    while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
        $combobit1 .= " <option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
    }
}

$consulta2 = "select * from validar_archivos_g";
$resultados = mysqli_query($conexion, $consulta2);
$categorias = array();
while ($c = mysqli_fetch_assoc($resultados)) {
    $categorias[] = $c['id_archivo'];
}

$consulta3 = "select * from terminos_g";
$resultados2 = mysqli_query($conexion, $consulta3);
$categorias2 = array();
while ($c = mysqli_fetch_assoc($resultados2)) {
    $categorias2[] = $c['conformidad_g'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
    <!--agregado-->
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones3.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="librerias/datatable/buttons/jszip.min.js"></script>
    <script src="librerias/datatable/buttons/pdfmake.min.js"></script>
    <script src="librerias/datatable/buttons/vfs_fonts.js"></script>
    <link href="styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400' rel='stylesheet' type='text/css'>
    <!--LIBRERIAS DE SWEETALERT-->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- HOJAS DE ESTILO -->
<!--    <link rel="stylesheet" href="css/hoja_seguimientos.css">-->
    <link rel="stylesheet" href="css/main_vida.css">
    <!-- JS - BARRA DE PROGRESO-->
    <script src="js/main_gmm_consultor.js"></script>
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
<!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


<?php 
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else {
    include('plantillas/cabecera_gmm_colab.php');
}
?>





             <!--DESPUES DE LAS CABECERAS ^^^^^^^^^^^^^^^^^^^^^^-->
    <link rel="stylesheet" href="css/hoja_seguimientos.css">
</head>



<body <?php if (in_array($ids, $categorias2)) {
            echo 'onload="conformidad_g()"';
        } ?>>

    <div class="container">
        <div class="col-sm-12">
            <table class="table table-condensed table-bordered" id="tablaDinamicaLoad">
                <tbody>
                    <tr>
                        <td colspan="8" align="center" class="seguimiento">
                            <b>
                                <h2>
                                    <p style="color: #FFFFFF" ;>Seguimiento de <?php echo $nomusuario; ?></p>
                                </h2>
                            </b>
                        </td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM folios_g where id='$ids'";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($result)) {
                        $datos = $ver[0] . "||" .
                            $ver[1] . "||" .
                            $ver[2] . "||" .
                            $ver[3] . "||" .
                            $ver[4] . "||" .
                            $ver[5] . "||" .
                            $ver[6] . "||" .
                            $ver[7] . "||" .
                            $ver[8] . "||" .
                            $ver[9] . "||" .
                            $ver[10] . "||" .
                            $ver[11] . "||" .
                            $ver[12] . "||" .
                            $ver[13] . "||" .
                            $ver[14] . "||" .
                            $ver[15];

                    ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" class="nombreAgente"><b>
                                    <h4>Nombre del Agente:
                                        <?php
                                        $agente = "SELECT nombre FROM datos_agente WHERE id='$ver[15]'";
                                        $agenter = mysqli_query($conexion, $agente);
                                        while ($agentenom = mysqli_fetch_row($agenter)) {
                                            $datosa = $agentenom[0];
                                            echo $agentenom[0];
                                        }
                                        ?>
                                    </h4>
                                </b>
                            </td>
                        </tr>

                        <?php if ($ver[14] == 'CANCELADO' || $ver[14] == 'RECHAZO DE SUSCRIPCION') { ?>

                            <!-- INICIO DATOS GENERALES -->
                            <?php if ($ver[3] == "MOVIMIENTOS") { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center"><?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Contratante:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                                    <td colspan="1" align="center"><b>Póliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center"><b>Tipo de Movimiento:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[4]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <?php if ($ver[11] == "ALTA") { ?>
                                    <tr>
                                        <td colspan="1" align="center"><b>Prioridad:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                        <td colspan="1" align="center"><b>Motivo:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                        <td colspan="1" align="center"><b>Comentarios:</b></td>
                                        <td colspan="3" align="center"><?php echo $ver[13]; ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="1" align="center"><b>Prioridad:</b></td>
                                        <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                        <td colspan="1" align="center"><b>Comentarios:</b></td>
                                        <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="1" align="center"><b>Folio GNP:</b></td>
                                    <td colspan="1" align="center"><b><?php echo $ver[6]; ?></b></td>
                                    <td colspan="3" align="center" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <!-- CIERRE / CONDICION MOVIMIENTOS -->
                            <?php } else if ($ver[3] == "ALTA POLIZA NACIONAL") { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center"><?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Contratante:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                                    <td colspan="1" align="center"><b>Póliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center"><b>Producto:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[4]; ?></td>
                                    <td colspan="1" align="center"><b>Folio:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <?php if ($ver[11] == "ALTA") { ?>
                                    <tr>
                                        <td colspan="1" align="center"><b>Prioridad:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                        <td colspan="1" align="center"><b>Motivo:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                        <td colspan="1" align="center"><b>Comentarios:</b></td>
                                        <td colspan="3" align="center"><?php echo $ver[13]; ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="1" align="center"><b>Prioridad:</b></td>
                                        <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                        <td colspan="1" align="center"><b>Comentarios:</b></td>
                                        <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" bgcolor="#eeefef"></td>
                                    <?php if (is_null($ver[7]) || $ver[7] == "null") { ?>
                                        <td colspan="1" align="center"><b>Moneda:</b></td>
                                        <td colspan="1" align="center"><?php echo "---"; ?></td>
                                    <?php } else { ?>
                                        <td colspan="1" align="center"><b>Moneda:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[7]; ?></td>
                                    <?php } ?>
                                    <td colspan="1" align="center"><b>Prima:</b></td>
                                    <td colspan="1" align="center">$ <?php echo $ver[9]; ?></td>
                                    <td colspan="2" align="center" bgcolor="#eeefef"></td>
                                </tr>
                                <!-- CIERRE / CONDICION APN -->
                            <?php } else if ($ver[3] == "ALTA POLIZA INTERNACIONAL") { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center"><?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Contratante:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                                    <td colspan="1" align="center"><b>Póliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center"><b>Producto:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[4]; ?></td>
                                    <td colspan="1" align="center"><b>Folio:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <?php if ($ver[11] == "ALTA") { ?>
                                    <tr>
                                        <td colspan="1" align="center"><b>Prioridad:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                        <td colspan="1" align="center"><b>Motivo:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                        <td colspan="1" align="center"><b>Comentarios:</b></td>
                                        <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="1" align="center"><b>Prioridad:</b></td>
                                        <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                        <td colspan="1" align="center"><b>Comentarios:</b></td>
                                        <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" bgcolor="#eeefef"></td>
                                    <?php if (is_null($ver[8]) || $ver[8] == "null") { ?>
                                        <td colspan="1" align="center"><b>Moneda:</b></td>
                                        <td colspan="1" align="center"><?php echo "---"; ?></td>
                                    <?php } else { ?>
                                        <td colspan="1" align="center"><b>Moneda:</b></td>
                                        <td colspan="1" align="center"><?php echo $ver[8]; ?></td>
                                    <?php } ?>
                                    <td colspan="1" align="center"><b>Prima:</b></td>
                                    <td colspan="1" align="center">$ <?php echo $ver[9]; ?></td>
                                    <td colspan="2" align="center" bgcolor="#eeefef"></td>
                                </tr>
                                <!-- CIERRE / CONDICION API -->
                            <?php } ?>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>

                            <!-- INICIO DE DOCUMENTOS -->
                            <tr>
                                <td colspan="8" align="center" class="documentos"> <b>
                                        <p style="color:#FFFFFF" ;>DOCUMENTOS</p>
                                    </b></td>
                            </tr>
                            <tr align="center" class="datosDocument">
                                <td colspan="1"><b>Usuario</td>
                                <td colspan="3"><b>Nombre de Archivo</td>
                                <td colspan="1"><b>Ver</td>
                                <td colspan="1"><b>Descargar</td>
                                <td colspan="1"><b>¿Aprobado?</td>
                                <td colspan="1"><b>Fecha de carga</td>
                            </tr>

                            <form class="" action="validar_g.php" method="post">
                                <?php
                                $query = "SELECT id,nombre, fk_folio, fecha_creacion, nomusuario FROM archivos_g WHERE fk_folio = '$ids' order by id desc";
                                $resultado = $conexion->query($query);
                                while ($row = mysqli_fetch_row($resultado)) {
                                ?>
                                    <tr>
                                        <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                        <td colspan="3" align="center"><?php echo $row[1]; ?></td>
                                        <td colspan="1" align="center"> <a href="../sistemas/archivos_g/<?php echo $row[1]; ?>" target=" _blank">
                                                <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                        </td>
                                        <td colspan="1" align="center">
                                            <a href="../sistemas/archivos_g/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                                <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                                        </td>

                                        <td colspan="1" align="center">
                                            <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                            <input type="text" hidden="" id="nmu" name="nmu" value="<?php echo "$nomusuario"; ?>">
                                            <input disabled type="checkbox" class="checkbox" name="valido[<?php echo $row[0]; ?>]" value="<?php echo $row[0]; ?>" <?php if (in_array($row[0], $categorias)) {
                                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                                    } ?>>
                                        </td>
                                        <td colspan="1" align="center">
                                            <?php echo $row[3]; ?>
                                        </td>
                                    </tr>

                                <?php } ?>
                                <tr>
                                    <td colspan="8" align="center">
                                        <div>
                                            <input type="submit" id="notificar" value="Notificar Documentos" disabled />
                                        </div>
                                    </td>
                                </tr>
                            </form>

                            <form enctype="multipart/form-data" id="filesformg">
                                <tr>
                                    <td colspan="9" align="center" class="agregar"><b>
                                            <p style="color: #FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                        </b></td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <div class="form-1-2">
                                            <input id="agregar1" type="file" name="file[]" accept=".pdf" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <?php
                                        if ($ver[3] == "MOVIMIENTOS") { ?>
                                            <select type="text" name="tipo" value="" id="tipo" disabled>
                                                <option value="">Seleccione:</option>
                                                <option value="articulo_492">Articulo 492</option>
                                                <option value="caratula_de_otra_compañia_aseguradora">Caratula de otra compañia aseguradora</option>
                                                <option value="carta_aclaratoria">Carta Aclaratoria</option>
                                                <option value="cat">CAT</option>
                                                <option value="comprobante_salida_de_empresa">Comprobante salida de empresa</option>
                                                <option value="cuestionario_ocupacion_o_deportivo">Cuestionario ocupacion y/o deportivo</option>
                                                <option value="documentos_adicionales">Documentos Adicionales</option>
                                                <option value="formato_de_traspaso">Formato de Traspaso</option>
                                                <option value="h107">H-107</option>
                                                <option value="solicitud_de_movimientos_conexion">Solicitud de Movimientos Conexion</option>
                                                <option value="caratula_poliza">Caratula de de Póliza</option>
                                                <option value="recibo">Recibo</option>
                                                <option value="factura">Factura</option>
                                                <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                                            </select>
                                        <?php  } else { ?>
                                            <!-- FIN DEL IF DE LA LINEA 374 -->
                                            <select type="text" name="tipo" value="" id="tipo" disabled>
                                                <option value="">Seleccione:</option>
                                                <option value="articulo_492">Articulo 492</option>
                                                <option value="caratula_de_otra_compañia_aseguradora">Caratula de otra compañia aseguradora</option>
                                                <option value="carta_aclaratoria">Carta Aclaratoria</option>
                                                <option value="comprobante_salida_de_empresa">Comprobante salida de empresa</option>
                                                <option value="cotizacion">Cotizacion</option>
                                                <option value="cuestionario_ocupacion_o_deportivo">Cuestionario ocupacion y/o deportivo</option>
                                                <option value="declaracion_de_salud">Declaracion de Salud</option>
                                                <option value="formato_alta_grupo">Formato Alta Grupo</option>
                                                <option value="identificacion">Identificacion</option>
                                                <option value="informacion_medica">Informacion Medica</option>
                                                <option value="solicitud_gmm">Solicitud de GMM</option>
                                                <option value="caratula_poliza">Caratula de de Póliza</option>
                                                <option value="recibo">Recibo</option>
                                                <option value="factura">Factura</option>
                                                <option value="solicitudes_adicionales">Solicitudes Adicionales</option>

                                            </select>
                                        <?php  } ?>
                                        <!-- FIN DEL ELSE -->
                                        <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                    </td>
                                </tr>
                                <tr class="barraProgresoT">
                                    <td colspan="10">
                                        <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                        <div class="barra">
                                            <div class="barra_azul" id="barra_estado">
                                                <span></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <div class="acciones">
                                            <button type="submit" onclick="return subir()" class="btn btn-primary" disabled>Subir Archivo</button>
                                            <input type="button" class="btn btn-danger" id="cancelar" value="Cancelar" disabled>
                                        </div>
                                    </td>
                                </tr>
                            </form>

                            <tr class="comentarios">
                                <td><b>
                                        <p>USUARIO</p>
                                    </b></td>
                                <td colspan="5"><b>
                                        <p>OBSERVACIONES</p>
                                    </b></td>
                                <td><b>
                                        <p>ESTADO</p>
                                    </b></td>
                                <td><b>
                                        <p>FECHA Y HORA</p>
                                    </b></td>
                            </tr>
                            <tr>
                                <?php
                                $sql = "SELECT * FROM comentarios_g WHERE folio='$ids' ORDER BY fecha_comentario DESC";
                                $result = mysqli_query($conexion, $sql);
                                while ($ver1 = mysqli_fetch_row($result)) {
                                    $datos1 = $ver1[0] . "||" .
                                        $ver1[1] . "||" .
                                        $ver1[2] . "||" .
                                        $ver1[3] . "||" .
                                        $ver1[4] . "||" .
                                        $ver1[5];
                                ?>
                                    <td style="width: 15%;">
                                        <b>
                                         <!-- AQUI EMPIEZA EL CODIGO PARA MOSTRAR LA IMAGEN CON EL NOMBRE DEL USUARIO -->
                            <?php
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'   ";
                                $result2 = mysqli_query($conexion, $CONSULTA);
                                while ($prueba = mysqli_fetch_row($result2)) {
                                    $datos221 = $prueba[2];
                                     $data = $prueba[1];
                            ?>
                                    




         <a  style="color: black"
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="bottom" 
               data-html="true" 
              data-title="  <?php  $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE = mysqli_query($conexion, $mod);
                                                $modificacion = mysqli_fetch_array($resultTE);

                                          


                                                $mod2 = "SELECT * FROM datos_agente WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE2 = mysqli_query($conexion, $mod2);
                                                $modificacion2 = mysqli_fetch_array($resultTE2);

                                             ?>
                  <div style='width:350px; overflow:350px;' >

                  <div style='width:240px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>
                    <strong>
                        <?php  

                        if(empty($modificacion['nombre']))
                            {
                                echo $modificacion2['nombre'];
                            }else{ 
                        echo $modificacion['nombre']; 
                         }?>
                        <br>
                        <?php    if(empty($modificacion['puesto']))
                            {
                                $porciones = explode(",", $modificacion2['correo']);
                               echo $porciones[0];


                            }else{ 
                        echo $modificacion['puesto']; 
                         ?>
                        <br>
                        <?php 
                        echo $modificacion['correo']; 
                         } ?>
                         <br>
                        <?php    if(empty($modificacion['telefono']))
                            {
                                echo $modificacion2['celular'];
                            }else{ 
                        echo $modificacion['telefono']; 
                       echo $extension = " Ext ";
                        echo $modificacion['extension'];
                         }     ?>
                         
                    </strong>
 
                </div>


                <div style='background:#F2F2F2;line-height:30px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>

                          <?php     if(isset($modificacion['extension']))
                            { ?>
                    <br>
                        <?php } ?>
                     <img style='; margin-right: 15px; margin-bottom:10px; width: 100px; height: 100px; border-radius: 120px;' src='<?php echo $datos221;  ?>'> 
                    </div>

                  
                         <div style='width:350px;background:#F2F2F2; background-color:#F5CBA7  ; line-height:30px;'>Tocando vidas</div>

                

                </div>



                                              <?php 
                                               ?>
            
                    "> <!-- SE CIERRA LA ETIQUETA A CON EL TOOLTIP -->


                                              <img class="imgUsuario_seg" src="<?php echo $datos221;  ?>">

                                                 <p id="<?php echo $data; ?>"  style="display: none;"><?php echo $ver1[4]; ?></p>
                            <?php } ?>

                            <p class="nombreUsuario"><?php echo $ver1[4]; ?></p></a>
                           

                            <!-- TERMINA EL CODIGO -->
                                        </b>
                                    </td>
                                    <td colspan="5" align="center"><?php echo $ver1[2]; ?></td>
                                    <td align="center"><b><?php echo $ver1[5]; ?></b></td>
                                    <td align="center"><b><?php echo $ver1[1]; ?></b></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr class="observaciones">
                            <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                            <td colspan="4" align="center">
                                <textarea disabled id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
                                <?php
                                $este = "SELECT estado from folios_g where id='$ids'";
                                $est1e = mysqli_query($conexion, $este);
                                while ($ver3e = mysqli_fetch_row($est1e)) {
                                    $datos2e = $ver3e[0];
                                ?>
                                    <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2e"; ?>">
                                <?php
                                }
                                ?>
                            </td>
                            <td colspan="2" align="center">
                            </td>
                        </tr>
                        <tr class="observaciones">
                            <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                            <td colspan="2" align="center">
                                <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                                    <option value="Seleccione">Seleccione:</option>
                                    <?php

                                    if ($ver[3] == 'MOVIMIENTOS') {
                                        if ($ver[14] == "ENVIADO") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="RECHAZO DE SUSCRIPCON">RECHAZO DE SUSCRIPCON</option>
                                        <?php
                                        }

                                        if ($ver[14] == "PROCESO") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "REPROCESO") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "TERMINADO") { ?>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "TERMINADO CON POLIZA") { ?>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "ACTIVADO MED") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "ACTIVADO GNP") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "ACTIVADO FLT") { ?>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "CASO ESPECIAL") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }
                                    } else {
                                        if ($ver[14] == "ENVIADO") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "PROCESO") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "REPROCESO") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "TERMINADO") { ?>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "TERMINADO CON POLIZA") { ?>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "ACTIVADO MED") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "ACTIVADO GNP") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "ACTIVADO FLT") { ?>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="PROCESO">PROCESO</option>
                                            <option value="REPROCESO">REPROCESO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                        <?php
                                        }

                                        if ($ver[14] == "CASO ESPECIAL") { ?>
                                            <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                            <option value="ACTIVADO MED">ACTIVADO MED</option>
                                            <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                            <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                            <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td colspan="2" align="center"><b>Asignar folio GNP:</b></td>
                            <td colspan="2" align="center"><input type="text" value="<?php echo $ver[6]; ?>" id="fgnp" name="fgnp" disabled></td>
                        </tr>
                        <tr class="observaciones">
                            <td colspan="2" align="center"><b></b></td>
                            <td colspan="2" align="center">

                            </td>

                            <td colspan="2" align="center"><b>Asignar póliza GNP:</b></td>
                            <td colspan="2" align="center"><input type="text" value="<?php echo  $ver[5]; ?>" id="poliza" name="poliza" disabled></td>
                        </tr>
                        <tr class="observaciones">
                            <td colspan="8" align="center">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar3" disabled></button>
                            </td>
                        </tr>

                        <!-- CIERRE / CONDICION CANCELADOS Y RECHAZOS  -->
                    <?php } ?>

                    <!-- ENTRAN TODOS LOS ESTADOS MENOS CANCELADOS, RECHAZADOS Y TERMINADOS -->
                    <?php if ($ver[14] == 'ACTIVADO MED' || $ver[14] == 'ACTIVADO FLT' || $ver[14] == 'ACTIVADO GNP' || $ver[14] == 'CASO ESPECIAL' || $ver[14] == 'PROCESO' || $ver[14] == 'REPROCESO' || $ver[14] == 'ENVIADO') { ?>

                        <!-- INICIO DATOS GENERALES -->
                        <?php if ($ver[3] == "MOVIMIENTOS") { ?>
                            <tr>
                                <td align="center"><b>Folio:</b></td>
                                <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                                <td align="center"><b>Línea de Negocio:</b></td>
                                <td align="center"><?php echo $ver[2]; ?></td>
                                <td align="center"><b>Fecha Solicitud:</b></td>
                                <td align="center"><?php echo $ver[1]; ?></td>
                                <td align="center"><b>Estado:</b></td>
                                <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><b>Contratante:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                                <td colspan="1" align="center"><b>Póliza:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[3]; ?></td>
                                <td colspan="1" align="center"><b>Tipo de Movimiento:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[4]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <?php if ($ver[11] == "ALTA") { ?>
                                <tr>
                                    <td colspan="1" align="center"><b>Prioridad:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" align="center"><b>Motivo:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                    <td colspan="1" align="center"><b>Comentarios:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="1" align="center"><b>Prioridad:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" align="center"><b>Comentarios:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" bgcolor="#eeefef"></td>
                                <td colspan="1" align="center"><b>Folio GNP:</b></td>
                                <td colspan="1" align="center"><b><?php echo $ver[6]; ?></b></td>
                                <td colspan="3" align="center" bgcolor="#eeefef"></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <!-- CIERRE / CONDICION MOVIMIENTOS -->
                        <?php } else if ($ver[3] == "ALTA POLIZA NACIONAL") { ?>
                            <tr>
                                <td align="center"><b>Folio:</b></td>
                                <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                                <td align="center"><b>Línea de Negocio:</b></td>
                                <td align="center"><?php echo $ver[2]; ?></td>
                                <td align="center"><b>Fecha Solicitud:</b></td>
                                <td align="center"><?php echo $ver[1]; ?></td>
                                <td align="center"><b>Estado:</b></td>
                                <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><b>Contratante:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                                <td colspan="1" align="center"><b>Póliza:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[3]; ?></td>
                                <td colspan="1" align="center"><b>Producto:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[4]; ?></td>
                                <td colspan="1" align="center"><b>Folio GNP:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <?php if ($ver[11] == "ALTA") { ?>
                                <tr>
                                    <td colspan="1" align="center"><b>Prioridad:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" align="center"><b>Motivo:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                    <td colspan="1" align="center"><b>Comentarios:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="1" align="center"><b>Prioridad:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" align="center"><b>Comentarios:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" bgcolor="#eeefef"></td>
                                <?php if (is_null($ver[7]) || $ver[7] == "null") { ?>
                                    <td colspan="1" align="center"><b>Moneda:</b></td>
                                    <td colspan="1" align="center"><?php echo "---"; ?></td>
                                <?php } else { ?>
                                    <td colspan="1" align="center"><b>Moneda:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[7]; ?></td>
                                <?php } ?>
                                <td colspan="1" align="center"><b>Prima:</b></td>
                                <td colspan="1" align="center">$ <?php echo $ver[9]; ?></td>
                                <td colspan="2" align="center" bgcolor="#eeefef"></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <!-- CIERRE / CONDICION APN -->
                        <?php } else if ($ver[3] == "ALTA POLIZA INTERNACIONAL") { ?>
                            <tr>
                                <td align="center"><b>Folio:</b></td>
                                <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                                <td align="center"><b>Línea de Negocio:</b></td>
                                <td align="center"><?php echo $ver[2]; ?></td>
                                <td align="center"><b>Fecha Solicitud:</b></td>
                                <td align="center"><?php echo $ver[1]; ?></td>
                                <td align="center"><b>Estado:</b></td>
                                <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><b>Contratante:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                                <td colspan="1" align="center"><b>Póliza:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[3]; ?></td>
                                <td colspan="1" align="center"><b>Producto:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[4]; ?></td>
                                <td colspan="1" align="center"><b>Folio:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <?php if ($ver[11] == "ALTA") { ?>
                                <tr>
                                    <td colspan="1" align="center"><b>Prioridad:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" align="center"><b>Motivo:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                    <td colspan="1" align="center"><b>Comentarios:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="1" align="center"><b>Prioridad:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" align="center"><b>Comentarios:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" bgcolor="#eeefef"></td>
                                <?php if (is_null($ver[8]) || $ver[8] == "null") { ?>
                                    <td colspan="1" align="center"><b>Moneda:</b></td>
                                    <td colspan="1" align="center"><?php echo "---"; ?></td>
                                <?php } else { ?>
                                    <td colspan="1" align="center"><b>Moneda:</b></td>
                                    <td colspan="1" align="center"><?php echo $ver[8]; ?></td>
                                <?php } ?>
                                <td colspan="1" align="center"><b>Prima:</b></td>
                                <td colspan="1" align="center">$ <?php echo $ver[9]; ?></td>
                                <td colspan="2" align="center" bgcolor="#eeefef"></td>
                            </tr>
                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>
                            <!-- CIERRE / CONDICION API -->
                        <?php } ?>

                        <!-- INICIO DE DOCUMENTOS -->
                        <tr>
                            <td colspan="8" align="center" class="documentos"> <b>
                                    <p style="color:#FFFFFF" ;>DOCUMENTOS</p>
                                </b></td>
                        </tr>
                        <tr align="center" class="datosDocument">
                            <td colspan="1"><b>Usuario</td>
                            <td colspan="3"><b>Nombre de Archivo</td>
                            <td colspan="1"><b>Ver</td>
                            <td colspan="1"><b>Descargar</td>
                            <td colspan="1"><b>¿Aprobado?</td>
                            <td colspan="1"><b>Fecha de carga</td>
                        </tr>
                        <form class="" action="validar_g.php" method="post">
                            <?php
                            $query = "SELECT id,nombre, fk_folio, fecha_creacion, nomusuario FROM archivos_g WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {
                            ?>
                                <tr>
                                    <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                    <td colspan="3" align="center"><?php echo $row[1]; ?></td>
                                    <td colspan="1" align="center"> <a href="../sistemas/archivos_g/<?php echo $row[1]; ?>" target=" _blank">
                                            <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                    </td>
                                    <td colspan="1" align="center">
                                        <a href="../sistemas/archivos_g/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                            <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                                    </td>

                                    <td colspan="1" align="center">
                                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                        <input type="text" hidden="" id="nmu" name="nmu" value="<?php echo "$nomusuario"; ?>">
                                        <input disabled type="checkbox" class="checkbox" name="valido[<?php echo $row[0]; ?>]" value="<?php echo $row[0]; ?>" <?php if (in_array($row[0], $categorias)) {
                                                                                                                                                            echo 'checked="checked"';
                                                                                                                                                        } ?>>
                                    </td>
                                    <td colspan="1" align="center">
                                        <?php echo $row[3]; ?>
                                    </td>
                                </tr>

                            <?php } ?>
                            <tr>
                                <td colspan="8" align="center">
                                    <div>
                                        <input type="submit" id="notificar" value="Notificar Documentos" disabled/>
                                    </div>
                                </td>
                            </tr>
                        </form>

                        <form enctype="multipart/form-data" id="filesformg">
                            <tr>
                                <td colspan="9" align="center" class="agregar"><b>
                                        <p style="color: #FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                    </b></td>
                            </tr>
                            <tr>
                                <td colspan="9" align="center">
                                    <div class="form-1-2">
                                        <input id="agregar1" type="file" name="file[]" accept=".pdf" disabled>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" align="center">
                                    <?php
                                    if ($ver[3] == "MOVIMIENTOS") { ?>
                                        <select type="text" name="tipo" value="" id="tipo" disabled>
                                            <option value="">Seleccione:</option>
                                            <option value="articulo_492">Articulo 492</option>
                                            <option value="caratula_de_otra_compañia_aseguradora">Caratula de otra compañia aseguradora</option>
                                            <option value="carta_aclaratoria">Carta Aclaratoria</option>
                                            <option value="cat">CAT</option>
                                            <option value="comprobante_salida_de_empresa">Comprobante salida de empresa</option>
                                            <option value="cuestionario_ocupacion_o_deportivo">Cuestionario ocupacion y/o deportivo</option>
                                            <option value="documentos_adicionales">Documentos Adicionales</option>
                                            <option value="formato_de_traspaso">Formato de Traspaso</option>
                                            <option value="h107">H-107</option>
                                            <option value="solicitud_de_movimientos_conexion">Solicitud de Movimientos Conexion</option>
                                            <option value="caratula_poliza">Caratula de de Póliza</option>
                                            <option value="recibo">Recibo</option>
                                            <option value="factura">Factura</option>
                                            <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                                        </select>
                                    <?php  } else { ?>
                                        <!-- FIN DEL IF DE LA LINEA 374 -->
                                        <select type="text" name="tipo" value="" id="tipo" disabled>
                                            <option value="">Seleccione:</option>
                                            <option value="articulo_492">Articulo 492</option>
                                            <option value="caratula_de_otra_compañia_aseguradora">Caratula de otra compañia aseguradora</option>
                                            <option value="carta_aclaratoria">Carta Aclaratoria</option>
                                            <option value="comprobante_salida_de_empresa">Comprobante salida de empresa</option>
                                            <option value="cotizacion">Cotizacion</option>
                                            <option value="cuestionario_ocupacion_o_deportivo">Cuestionario ocupacion y/o deportivo</option>
                                            <option value="declaracion_de_salud">Declaracion de Salud</option>
                                            <option value="formato_alta_grupo">Formato Alta Grupo</option>
                                            <option value="identificacion">Identificacion</option>
                                            <option value="informacion_medica">Informacion Medica</option>
                                            <option value="solicitud_gmm">Solicitud de GMM</option>
                                            <option value="caratula_poliza">Caratula de de Póliza</option>
                                            <option value="recibo">Recibo</option>
                                            <option value="factura">Factura</option>
                                            <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                                        </select>
                                    <?php  } ?>
                                    <!-- FIN DEL ELSE -->
                                    <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                                    <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                </td>
                            </tr>
                            <tr class="barraProgresoT">
                                <td colspan="10">
                                    <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                    <div class="barra">
                                        <div class="barra_azul" id="barra_estado">
                                            <span></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" align="center">
                                    <div class="acciones">
                                        <button type="submit" onclick="return subir()" class="btn btn-primary" id="subirArchivo" disabled>Subir Archivo</button>
                                        <input type="button" class="btn btn-danger" id="cancelar" value="Cancelar" disabled>
                                    </div>
                                </td>
                            </tr>
                        </form>

                        <tr class="comentarios">
                            <td><b>
                                    <p>USUARIO</p>
                                </b></td>
                            <td colspan="5"><b>
                                    <p>OBSERVACIONES</p>
                                </b></td>
                            <td><b>
                                    <p>ESTADO</p>
                                </b></td>
                            <td><b>
                                    <p>FECHA Y HORA </p>
                                </b></td>
                        </tr>
                        <tr>
                            <?php
                            $sql = "SELECT * FROM comentarios_g WHERE folio='$ids' ORDER BY fecha_comentario DESC";
                            $result = mysqli_query($conexion, $sql);
                            while ($ver1 = mysqli_fetch_row($result)) {
                                $datos1 = $ver1[0] . "||" .
                                    $ver1[1] . "||" .
                                    $ver1[2] . "||" .
                                    $ver1[3] . "||" .
                                    $ver1[4] . "||" .
                                    $ver1[5];
                            ?>
                                <td style="width: 15%;">
                                    <b>
                                       <!-- AQUI EMPIEZA EL CODIGO PARA MOSTRAR LA IMAGEN CON EL NOMBRE DEL USUARIO -->
                            <?php
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'   ";
                                $result2 = mysqli_query($conexion, $CONSULTA);
                                while ($prueba = mysqli_fetch_row($result2)) {
                                    $datos221 = $prueba[2];
                                     $data = $prueba[1];
                            ?>
                                    




          <a  style="color: black"
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="bottom" 
               data-html="true" 
              data-title="  <?php  $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE = mysqli_query($conexion, $mod);
                                                $modificacion = mysqli_fetch_array($resultTE);

                                          


                                                $mod2 = "SELECT * FROM datos_agente WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE2 = mysqli_query($conexion, $mod2);
                                                $modificacion2 = mysqli_fetch_array($resultTE2);

                                             ?>
                  <div style='width:350px; overflow:350px;' >

                  <div style='width:240px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>
                    <strong>
                        <?php  

                        if(empty($modificacion['nombre']))
                            {
                                echo $modificacion2['nombre'];
                            }else{ 
                        echo $modificacion['nombre']; 
                         }?>
                        <br>
                        <?php    if(empty($modificacion['puesto']))
                            {
                                $porciones = explode(",", $modificacion2['correo']);
                               echo $porciones[0];


                            }else{ 
                        echo $modificacion['puesto']; 
                         ?>
                        <br>
                        <?php 
                        echo $modificacion['correo']; 
                         } ?>
                         <br>
                        <?php    if(empty($modificacion['telefono']))
                            {
                                echo $modificacion2['celular'];
                            }else{ 
                        echo $modificacion['telefono']; 
                       echo $extension = " Ext ";
                        echo $modificacion['extension'];
                         }     ?>
                         
                    </strong>
 
                </div>


                <div style='background:#F2F2F2;line-height:30px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>

                          <?php     if(isset($modificacion['extension']))
                            { ?>
                    <br>
                        <?php } ?>
                     <img style='; margin-right: 15px; margin-bottom:10px; width: 100px; height: 100px; border-radius: 120px;' src='<?php echo $datos221;  ?>'> 
                    </div>

                  
                         <div style='width:350px;background:#F2F2F2; background-color:#F5CBA7  ; line-height:30px;'>Tocando vidas</div>

                

                </div>



                                              <?php 
                                               ?>
            
                    "> <!-- SE CIERRA LA ETIQUETA A CON EL TOOLTIP -->


                                              <img class="imgUsuario_seg" src="<?php echo $datos221;  ?>">

                                                 <p id="<?php echo $data; ?>"  style="display: none;"><?php echo $ver1[4]; ?></p>
                            <?php } ?>

                            <p class="nombreUsuario"><?php echo $ver1[4]; ?></p></a>
                           

                            <!-- TERMINA EL CODIGO -->
                                    </b>
                                </td>
                                <td colspan="5" align="center"><?php echo $ver1[2]; ?></td>
                                <td align="center"><b><?php echo $ver1[5]; ?></b></td>
                                <td align="center"><b><?php echo $ver1[1]; ?></b></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr class="observaciones">
                        <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                        <td colspan="4" align="center">
                            <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
                            <?php
                            $este = "SELECT estado from folios_g where id='$ids'";
                            $est1e = mysqli_query($conexion, $este);
                            while ($ver3e = mysqli_fetch_row($est1e)) {
                                $datos2e = $ver3e[0];
                            ?>
                                <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2e"; ?>">
                            <?php
                            }
                            //var_dump($datos2e);
                            ?>
                        </td>
                        <td colspan="2" align="center">
                            <!--<button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar"></button>-->
                        </td>
                    </tr>
                    <tr class="observaciones">
                        <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                        <td colspan="2" align="center">
                            <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                                <option value="Seleccione">Seleccione:</option>
                                <?php

                                if ($ver[3] == 'MOVIMIENTOS') {
                                    if ($ver[14] == "ENVIADO") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "PROCESO") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "REPROCESO") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "TERMINADO") { ?>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "TERMINADO CON POLIZA") { ?>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "ACTIVADO MED") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "ACTIVADO GNP") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "ACTIVADO FLT") { ?>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "CASO ESPECIAL") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }
                                } else {
                                    if ($ver[14] == "ENVIADO") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "PROCESO") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "REPROCESO") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "TERMINADO") { ?>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "TERMINADO CON POLIZA") { ?>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "ACTIVADO MED") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "ACTIVADO GNP") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "ACTIVADO FLT") { ?>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="REPROCESO">REPROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                    <?php
                                    }

                                    if ($ver[14] == "CASO ESPECIAL") { ?>
                                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                        <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td colspan="2" align="center"><b>Asignar folio GNP:</b></td>
                        <td colspan="2" align="center"><input type="text" value="<?php echo $ver[6]; ?>" id="fgnp" name="fgnp" disabled></td>
                    </tr>
                    <tr class="observaciones">
                        <td colspan="2" align="center"><b></b></td>
                        <td colspan="2" align="center">

                        </td>

                        <td colspan="2" align="center"><b>Asignar póliza GNP:</b></td>
                        <td colspan="2" align="center"><input type="text" value="<?php echo  $ver[5]; ?>" id="poliza" name="poliza" disabled></td>
                    </tr>
                    <tr class="observaciones">
                        <td colspan="8" align="center">
                            <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar3"></button>
                        </td>
                    </tr>
                    <!-- CIERRE / CONDICION TODOS LOS ESTADOS -->
                <?php } ?>

                <!-- TERMINADO Y TERMINADO CON POLIZA -->
                <?php if ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA') { ?>

                    <!-- INICIO DATOS GENERALES -->
                    <?php if ($ver[3] == "MOVIMIENTOS") { ?>
                        <tr>
                            <td align="center"><b>Folio:</b></td>
                            <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                            <td align="center"><b>Línea de Negocio:</b></td>
                            <td align="center"><?php echo $ver[2]; ?></td>
                            <td align="center"><b>Fecha Solicitud:</b></td>
                            <td align="center"><?php echo $ver[1]; ?></td>
                            <td align="center"><b>Estado:</b></td>
                            <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><b>Contratante:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                            <td colspan="1" align="center"><b>Póliza:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[3]; ?></td>
                            <td colspan="1" align="center"><b>Tipo de Movimiento:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[4]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <?php if ($ver[11] == "ALTA") { ?>
                            <tr>
                                <td colspan="1" align="center"><b>Prioridad:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                <td colspan="1" align="center"><b>Motivo:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                <td colspan="1" align="center"><b>Comentarios:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[13]; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="1" align="center"><b>Prioridad:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                <td colspan="1" align="center"><b>Comentarios:</b></td>
                                <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center" bgcolor="#eeefef"></td>
                            <td colspan="1" align="center"><b>Folio GNP:</b></td>
                            <td colspan="1" align="center"><b><?php echo $ver[6]; ?></b></td>
                            <td colspan="3" align="center" bgcolor="#eeefef"></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <!-- CIERRE / CONDICION MOVIMIENTOS -->
                    <?php } else if ($ver[3] == "ALTA POLIZA NACIONAL") { ?>
                        <tr>
                            <td align="center"><b>Folio:</b></td>
                            <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                            <td align="center"><b>Línea de Negocio:</b></td>
                            <td align="center"><?php echo $ver[2]; ?></td>
                            <td align="center"><b>Fecha Solicitud:</b></td>
                            <td align="center"><?php echo $ver[1]; ?></td>
                            <td align="center"><b>Estado:</b></td>
                            <td align="center" <?php
                                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                endif; ?>><b><?php echo $ver[14] ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><b>Contratante:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                            <td colspan="1" align="center"><b>Póliza:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                            <td colspan="2" align="center"><?php echo $ver[3]; ?></td>
                            <td colspan="1" align="center"><b>Producto:</b></td>
                            <td colspan="1" align="center"><?php echo $ver[4]; ?></td>
                            <td colspan="1" align="center"><b>Folio:</b></td>
                            <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <?php if ($ver[11] == "ALTA") { ?>
                            <tr>
                                <td colspan="1" align="center"><b>Prioridad:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                <td colspan="1" align="center"><b>Motivo:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                <td colspan="1" align="center"><b>Comentarios:</b></td>
                                <td colspan="3" align="center"><?php echo $ver[13]; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="1" align="center"><b>Prioridad:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                <td colspan="1" align="center"><b>Comentarios:</b></td>
                                <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" bgcolor="#eeefef"></td>
                            <?php if (is_null($ver[7]) || $ver[7] == "null") { ?>
                                <td colspan="1" align="center"><b>Moneda:</b></td>
                                <td colspan="1" align="center"><?php echo "---"; ?></td>
                            <?php } else { ?>
                                <td colspan="1" align="center"><b>Moneda:</b></td>
                                <td colspan="1" align="center"><b><?php echo $ver[7]; ?></b></td>
                            <?php } ?>
                            <td colspan="1" align="center"><b>Prima:</b></td>
                            <td colspan="1" align="center">$ <?php echo $ver[9]; ?></td>
                            <td colspan="2" align="center" bgcolor="#eeefef"></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <!-- CIERRE / CONDICION APN-->
                    <?php } else if ($ver[3] == "ALTA POLIZA INTERNACIONAL") { ?>
                        <tr>
                            <td align="center"><b>Folio:</b></td>
                            <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FG<?php echo "$ids"; ?></td>
                            <td align="center"><b>Línea de Negocio:</b></td>
                            <td align="center"><?php echo $ver[2]; ?></td>
                            <td align="center"><b>Fecha Solicitud:</b></td>
                            <td align="center"><?php echo $ver[1]; ?></td>
                            <td align="center"><b>Estado:</b></td>
                            <td align="center" <?php
                                            if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                            elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                            elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                            elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                            elseif ($ver[14] == 'CASO ESPECIAL') : ?> bgcolor="#B0B8B8" <?php
                                            elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                            elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                            elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                            elseif ($ver[14] == 'RECHAZO DE SUSCRIPCION') : ?> bgcolor="#E65370" <?php
                                            elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                            endif; ?>><b><?php echo $ver[14] ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><b>Contratante:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[10]; ?></td>
                            <td colspan="1" align="center"><b>Póliza:</b></td>
                            <td colspan="3" align="center"><?php echo $ver[5]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="center"><b>Tipo Solicitud:</b></td>
                            <td colspan="2" align="center"><?php echo $ver[3]; ?></td>
                            <td colspan="1" align="center"><b>Producto:</b></td>
                            <td colspan="1" align="center"><?php echo $ver[4]; ?></td>
                            <td colspan="1" align="center"><b>Folio:</b></td>
                            <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <?php if ($ver[11] == "ALTA") { ?>
                            <tr>
                                <td colspan="1" align="center"><b>Prioridad:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[11]; ?></td>
                                <td colspan="1" align="center"><b>Motivo:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[12]; ?></td>
                                <td colspan="1" align="center"><b>Comentarios:</b></td>
                                <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="1" align="center"><b>Prioridad:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[11]; ?></td>
                                <td colspan="1" align="center"><b>Comentarios:</b></td>
                                <td colspan="4" align="center"><?php echo $ver[13]; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" bgcolor="#eeefef"></td>
                            <?php if (is_null($ver[8]) || $ver[8] == "null") { ?>
                                <td colspan="1" align="center"><b>Moneda:</b></td>
                                <td colspan="1" align="center"><?php echo "---"; ?></td>
                            <?php } else { ?>
                                <td colspan="1" align="center"><b>Moneda:</b></td>
                                <td colspan="1" align="center"><?php echo $ver[8]; ?></td>
                            <?php } ?>
                            <td colspan="1" align="center"><b>Prima:</b></td>
                            <td colspan="1" align="center">$ <?php echo $ver[9]; ?></td>
                            <td colspan="2" align="center" bgcolor="#eeefef"></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                        </tr>
                        <!-- CIERRE / CONDICION API-->
                    <?php } ?>
                    
                    <!-- INICIO DE DOCUMENTOS -->
                    <tr>
                        <td colspan="8" align="center" class="documentos"> <b>
                                <p style="color:#FFFFFF" ;>DOCUMENTOS</p>
                            </b></td>
                    </tr>
                    <tr align="center" class="datosDocumentos">
                        <td colspan="1"><b>Usuario</td>
                        <td colspan="3"><b>Nombre de Archivo</td>
                        <td colspan="1"><b>Ver</td>
                        <td colspan="1"><b>Descargar</td>
                        <td colspan="1"><b>¿Aprobado?</td>
                        <td colspan="1"><b>Fecha de carga</td>
                    </tr>   
                    <form class="" action="validar_g.php" method="post">
                        <?php
                                $query = "SELECT id,nombre, fk_folio, fecha_creacion, nomusuario FROM archivos_g WHERE fk_folio = '$ids' order by id desc";
                                $resultado = $conexion->query($query);
                                while ($row = mysqli_fetch_row($resultado)) {
                        ?>
                            <tr>
                                <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                <td colspan="3" align="center"><?php echo $row[1]; ?></td>
                                <td colspan="1" align="center"> <a href="../sistemas/archivos_g/<?php echo $row[1]; ?>" target=" _blank">
                                        <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                </td>
                                <td colspan="1" align="center">
                                    <a href="../sistemas/archivos_g/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                                </td>

                                <td colspan="1" align="center">
                                    <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                    <input type="text" hidden="" id="nmu" name="nmu" value="<?php echo "$nomusuario"; ?>">
                                    <input type="checkbox" class="checkbox" name="valido[<?php echo $row[0]; ?>]" value="<?php echo $row[0]; ?>" <?php if (in_array($row[0], $categorias)) {
                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                    } ?>>
                                </td>
                                <td colspan="1" align="center">
                                    <?php echo $row[3]; ?>
                                </td>
                            </tr>

                        <?php } ?>
                        <tr>
                            <td colspan="8" align="center">
                                <div>
                                    <input type="submit" id="notificar" value="Notificar Documentos" />
                                </div>
                            </td>
                        </tr>
                    </form> 
                    <form enctype="multipart/form-data" id="filesformg">
                        <tr>
                            <td colspan="9" align="center" class="agregar"><b>
                                    <p style="color: #FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                </b></td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <div class="form-1-2">
                                    <input id="agregar1" type="file" name="file[]" accept=".pdf">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <?php
                                if ($ver[3] == "MOVIMIENTOS") { ?>
                                    <select type="text" name="tipo" value="" id="tipo">
                                        <option value="">Seleccione:</option>
                                        <option value="articulo_492">Articulo 492</option>
                                        <option value="caratula_de_otra_compañia_aseguradora">Caratula de otra compañia aseguradora</option>
                                        <option value="carta_aclaratoria">Carta Aclaratoria</option>
                                        <option value="cat">CAT</option>
                                        <option value="comprobante_salida_de_empresa">Comprobante salida de empresa</option>
                                        <option value="cuestionario_ocupacion_o_deportivo">Cuestionario ocupacion y/o deportivo</option>
                                        <option value="documentos_adicionales">Documentos Adicionales</option>
                                        <option value="formato_de_traspaso">Formato de Traspaso</option>
                                        <option value="h107">H-107</option>
                                        <option value="solicitud_de_movimientos_conexion">Solicitud de Movimientos Conexion</option>
                                        <option value="caratula_poliza">Caratula de de Póliza</option>
                                        <option value="recibo">Recibo</option>
                                        <option value="factura">Factura</option>
                                        <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                                    </select>
                                <?php  } else { ?>
                                    <!-- FIN DEL IF DE LA LINEA 374 -->
                                    <select type="text" name="tipo" value="" id="tipo">
                                        <option value="">Seleccione:</option>
                                        <option value="articulo_492">Articulo 492</option>
                                        <option value="caratula_de_otra_compañia_aseguradora">Caratula de otra compañia aseguradora</option>
                                        <option value="carta_aclaratoria">Carta Aclaratoria</option>
                                        <option value="comprobante_salida_de_empresa">Comprobante salida de empresa</option>
                                        <option value="cotizacion">Cotizacion</option>
                                        <option value="cuestionario_ocupacion_o_deportivo">Cuestionario ocupacion y/o deportivo</option>
                                        <option value="declaracion_de_salud">Declaracion de Salud</option>
                                        <option value="formato_alta_grupo">Formato Alta Grupo</option>
                                        <option value="identificacion">Identificacion</option>
                                        <option value="informacion_medica">Informacion Medica</option>
                                        <option value="solicitud_gmm">Solicitud de GMM</option>
                                        <option value="caratula_poliza">Caratula de de Póliza</option>
                                        <option value="recibo">Recibo</option>
                                        <option value="factura">Factura</option>
                                        <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                                    </select>
                                <?php  } ?>
                                <!-- FIN DEL ELSE -->
                                <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                                <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                            </td>
                        </tr>
                        <tr class="barraProgresoT">
                            <td colspan="10">
                                <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                <div class="barra">
                                    <div class="barra_azul" id="barra_estado">
                                        <span></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <div class="acciones">
                                    <button type="submit" onclick="return subir()" class="btn btn-primary" id="subirArchivo" disabled>Subir Archivo</button>
                                    <input type="button" class="btn btn-danger" id="cancelar" value="Cancelar" disabled>
                                </div>
                            </td>
                        </tr>
                    </form>
                    <tr class="comentarios">
                        <td><b>
                                <p>USUARIO</p>
                            </b></td>
                        <td colspan="5"><b>
                                <p>OBSERVACIONES</p>
                            </b></td>
                        <td><b>
                                <p>ESTADO</p>
                            </b></td>
                        <td><b>
                                <p>FECHA Y HORA</p>
                            </b></td>
                    </tr>
                    <tr>
                        <?php
                            $sql = "SELECT * FROM comentarios_g WHERE folio='$ids' ORDER BY fecha_comentario DESC";
                            $result = mysqli_query($conexion, $sql);
                            while ($ver1 = mysqli_fetch_row($result)) {
                                $datos1 = $ver1[0] . "||" .
                                    $ver1[1] . "||" .
                                    $ver1[2] . "||" .
                                    $ver1[3] . "||" .
                                    $ver1[4] . "||" .
                                    $ver1[5];
                        ?>
                            <td style="width: 15%;">
                                <b>
                                   <!-- AQUI EMPIEZA EL CODIGO PARA MOSTRAR LA IMAGEN CON EL NOMBRE DEL USUARIO -->
                            <?php
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'   ";
                                $result2 = mysqli_query($conexion, $CONSULTA);
                                while ($prueba = mysqli_fetch_row($result2)) {
                                    $datos221 = $prueba[2];
                                     $data = $prueba[1];
                            ?>
                                    




            <a  style="color: black"
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="bottom" 
               data-html="true" 
              data-title="  <?php  $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE = mysqli_query($conexion, $mod);
                                                $modificacion = mysqli_fetch_array($resultTE);

                                          


                                                $mod2 = "SELECT * FROM datos_agente WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE2 = mysqli_query($conexion, $mod2);
                                                $modificacion2 = mysqli_fetch_array($resultTE2);

                                             ?>
                  <div style='width:350px; overflow:350px;' >

                  <div style='width:240px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>
                    <strong>
                        <?php  

                        if(empty($modificacion['nombre']))
                            {
                                echo $modificacion2['nombre'];
                            }else{ 
                        echo $modificacion['nombre']; 
                         }?>
                        <br>
                        <?php    if(empty($modificacion['puesto']))
                            {
                                $porciones = explode(",", $modificacion2['correo']);
                               echo $porciones[0];


                            }else{ 
                        echo $modificacion['puesto']; 
                         ?>
                        <br>
                        <?php 
                        echo $modificacion['correo']; 
                         } ?>
                         <br>
                        <?php    if(empty($modificacion['telefono']))
                            {
                                echo $modificacion2['celular'];
                            }else{ 
                        echo $modificacion['telefono']; 
                       echo $extension = " Ext ";
                        echo $modificacion['extension'];
                         }     ?>
                         
                    </strong>
 
                </div>


                <div style='background:#F2F2F2;line-height:30px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>

                          <?php     if(isset($modificacion['extension']))
                            { ?>
                    <br>
                        <?php } ?>
                     <img style='; margin-right: 15px; margin-bottom:10px; width: 100px; height: 100px; border-radius: 120px;' src='<?php echo $datos221;  ?>'> 
                    </div>

                  
                         <div style='width:350px;background:#F2F2F2; background-color:#F5CBA7  ; line-height:30px;'>Tocando vidas</div>

                

                </div>



                                              <?php 
                                               ?>
            
                    "> <!-- SE CIERRA LA ETIQUETA A CON EL TOOLTIP -->


                                              <img class="imgUsuario_seg" src="<?php echo $datos221;  ?>">

                                                 <p id="<?php echo $data; ?>"  style="display: none;"><?php echo $ver1[4]; ?></p>
                            <?php } ?>

                            <p class="nombreUsuario"><?php echo $ver1[4]; ?></p></a>
                           

                            <!-- TERMINA EL CODIGO -->
                                </b>
                            </td>
                            <td colspan="5" align="center"><?php echo $ver1[2]; ?></td>
                            <td align="center"><b><?php echo $ver1[5]; ?></b></td>
                            <td align="center"><b><?php echo $ver1[1]; ?></b></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                </tr>
                <tr class="observaciones">
                    <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                    <td colspan="4" align="center">
                        <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
                        <?php
                            $este = "SELECT estado from folios_g where id='$ids'";
                            $est1e = mysqli_query($conexion, $este);
                            while ($ver3e = mysqli_fetch_row($est1e)) {
                                $datos2e = $ver3e[0];
                        ?>
                            <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2e"; ?>">
                        <?php
                            }
                            //var_dump($datos2e);
                        ?>
                    </td>
                    <td colspan="2" align="center">
                        <!--<button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar"></button>-->
                    </td>
                </tr>
                <tr class="observaciones">
                    <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                    <td colspan="2" align="center">
                        <select type="text" name="estado" value="" id="estado" class="form-control input-sm">
                            <option value="Seleccione">Seleccione:</option>
                            <?php

                            if ($ver[3] == 'MOVIMIENTOS') {
                                if ($ver[14] == "ENVIADO") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "PROCESO") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "REPROCESO") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "TERMINADO") { ?>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "TERMINADO CON POLIZA") { ?>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "ACTIVADO MED") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "ACTIVADO GNP") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "ACTIVADO FLT") { ?>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "CASO ESPECIAL") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }
                            } else {
                                if ($ver[14] == "ENVIADO") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "PROCESO") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "REPROCESO") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "TERMINADO") { ?>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "TERMINADO CON POLIZA") { ?>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "ACTIVADO MED") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "ACTIVADO GNP") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "ACTIVADO FLT") { ?>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                                <?php
                                }

                                if ($ver[14] == "CASO ESPECIAL") { ?>
                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                    <option value="RECHAZO DE SUSCRIPCION">RECHAZO DE SUSCRIPCION</option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td colspan="2" align="center"><b>Asignar folio GNP:</b></td>
                    <td colspan="2" align="center"><input type="text" value="<?php echo $ver[6]; ?>" id="fgnp" name="fgnp"></td>
                </tr>
                <tr class="observaciones">
                    <td colspan="2" align="center"><b></b></td>
                    <td colspan="2" align="center">

                    </td>

                    <td colspan="2" align="center"><b>Asignar póliza GNP:</b></td>
                    <td colspan="2" align="center"><input type="text" value="<?php echo  $ver[5]; ?>" id="poliza" name="poliza"></td>
                </tr>
                <tr class="observaciones">
                    <td colspan="8" align="center">
                        <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar3"></button>
                    </td>
                </tr>
                    <!-- CIERRE / CONDICION TERMINADOS -->
                <?php } ?>

                <!-- CIERRE DEL WHILE DE LA LINEA 178 -->
            <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
     $('[rel="tooltip"]').tooltip();
  });
    $(document).ready(function() {
        $('#guardar3').click(function() {
            var comentario = document.getElementById('observaciones').value;
            var estado = document.getElementById('estado').value;
            var folio = document.getElementById('fgnp').value;
            var poliza = document.getElementById('poliza').value;

            if (estado == 'Seleccione') {
                if (comentario.length == 0) {
                    swal({
                        title: "¡Error!",
                        text: "Ingresa un comentario para continuar",
                        type: "error",
                        customClass: 'swal-wide',
                        allowOutsideClick: false
                    });
                    hasError = true;
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'ACTIVADO FLT') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'ACTIVADO GNP') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'ACTIVADO MED') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }
            
            if (estado == 'CASO ESPECIAL') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'INCOMPLETO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'PROCESO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else if(folio == '---'){
                    alertify.alert("Asigna el Folio GNP correspondiente.");                    
                }else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'PROCESO GNP') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'REPROCESO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'TERMINADO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'TERMINADO CON POLIZA') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else if(poliza == '---'){
                    alertify.alert("Asigna la Póliza GNP correspondiente.");
                }else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'CANCELADO' || estado == 'RECHAZO DE SUSCRIPCION') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");
                } else {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success', //Estilo del boton de aceptar
                            cancelButton: 'btn btn-danger', //Estilo del boton de cancelar
                        },

                        buttonsStyling: false,
                        allowOutsideClick: false //no permite que cierre la ventana a menos que se acepte una condición 
                    })

                    swalWithBootstrapButtons.fire({
                        title: '¿Estas seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '¡Estoy seguro! ',
                        cancelButtonText: '¡Voy a pensarlo!',
                        reverseButtons: true //posicion de los botones

                    }).then((result) => {

                        if (result.value) {

                            guardar3();
                            location.reload();
                            location.reload();


                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {

                            swalWithBootstrapButtons.fire(

                                'IntraGAM informa',
                                '¡Tú trámite esta a salvo!',
                                'success'
                            )
                            return false;
                        }
                    });

                }

            }
        });
    });
</script>
<script type="text/javascript">
    function subir() {
        var agregar1 = document.getElementById("agregar1").value;
        var tipo = document.getElementById("tipo").value;

        if (agregar1 == null || agregar1 == 0) {
            alertify.alert('ERROR: Seleccione algun archivo por favor.');
            return false;
        } else if (tipo == null || tipo == 0) {
            alertify.alert('ERROR: Seleccione alguna opción del combo por favor.');
            return false;
        } else {
            $("#cancelar").prop("disabled", false);
            $(".barraProgresoT").removeClass("barraProgresoT");
        }
    }
</script>


<!--VALIDACION DE CONFORMIDAD-->
<script type="text/javascript">
    function conformidad_g() {

        var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".checkbox");

        for (var i = 0; i < tabla.length; i++) {
            tabla[i].disabled = true;

        }
        var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".btn");

        for (var i = 0; i < tabla.length; i++) {
            tabla[i].disabled = true;
            tabla[i].checked = true;
        }
        document.getElementById("agregar1").disabled = true;
        document.getElementById("observaciones").disabled = true;
        document.getElementById("tipo").disabled = true;
        document.getElementById("estado").disabled = true;
        document.getElementById("fgnp").disabled = true;
        document.getElementById("poliza").disabled = true;
        document.getElementById("notificar").disabled = true;

    }
</script>

<!-- TAMAÑO DE ARCHIVOS -->
<script type="text/javascript"> 
    $('#agregar1').bind('change', function() {
        if(this.files[0].size > 5000000){ //De KB A BYTES
            alertify.alert('Solo se permiten archivos menores a 5 MB. <br> Te recomendamos comprimirlos en ¡LovePDF ó Smallpdf.');
            document.getElementById("agregar1").value = "";
            $("#subirArchivo").prop("disabled", true);
            return false;
        } else {
            $("#subirArchivo").prop("disabled", false);
        }
        
    });
</script> 
</html>