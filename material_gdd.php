<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
session_start();

//Evita acceder al portal con el redireccionamiento de páginas
if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}


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
            if ($nomusuario == "Roberto R" || $nomusuario == "Omar S" || $nomusuario == "Martin G" || $nomusuario == "Nancy O" || $nomusuario == "Daniela V") {
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Material de apoyo</title>
    <!-- LIBRERIAS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">

    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_general_material.css">

</head>


<?php
// Cabecera que debera mostrar para los gdd
include('plantillas/m_gdd.php');
?>

<body>

    <!-- SECCION MATERIAL DE APOYO -->
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <!-- TABLA CAMPANIAS -->
                <table class="table table-striped table-bordered text-center" id="tablaCamp">
                    <tr>
                        <td colspan=4 class="tdCampania">
                            <p class="titulo"><strong>CAMPAÑAS</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdArchivo">
                            <p><strong>Nombre del archivo</strong></p>
                        </td>
                        <td class="tdVer">
                            <p><strong>Ver</strong></p>
                        </td>
                        <td class="tdDescargar">
                            <p><strong>Descargar</strong></p>
                        </td>

                    </tr>
                    <!-- Muetra el material para campanias -->
                    <?php
                    $sql = "SELECT * from material_camp";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td><?php echo $mostrar['urlArchivo'] ?></td>
                            <td colspan="1" align="center"> <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>

                <!-- TABLA CIRCULARES GMM -->
                <table class="table table-striped table-bordered text-center" id="tablaCirGmm">
                    <tr>
                        <td colspan=4 class="tdCircularGmm">
                            <p class="titulo"><strong>CIRCULARES GASTOS M&Eacute;DICOS MAYORES</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdArchivo">
                            <p><strong>Nombre del archivo</strong></p>
                        </td>
                        <td class="tdVer">
                            <p><strong>Ver</strong></p>
                        </td>
                        <td class="tdDescargar">
                            <p><strong>Descargar</strong></p>
                        </td>

                    </tr>
                    <!-- Muestra el material para gmm -->
                    <?php
                    $sql = "SELECT * from material_gmm";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td><?php echo $mostrar['urlArchivo'] ?></td>
                            <td colspan="1" align="center"> <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>

                <!-- TABLA CIRCULARES VIDA -->
                <table class="table table-striped table-bordered text-center" id="tablaCirVida">
                    <tr>
                        <td colspan=4 class="tdCircularVida">
                            <p class="titulo"><strong>CIRCULARES VIDA</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdArchivo">
                            <p><strong>Nombre del archivo</strong></p>
                        </td>
                        <td class="tdVer">
                            <p><strong>Ver</strong></p>
                        </td>
                        <td class="tdDescargar">
                            <p><strong>Descargar</strong></p>
                        </td>

                    </tr>
                    <!-- Muestra el material para vida -->
                    <?php
                    $sql = "SELECT * from material_vida";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td><?php echo $mostrar['urlArchivo'] ?></td>
                            <td colspan="1" align="center"> <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>

                <!-- TABLA OTROS -->
                <table class="table table-striped table-bordered text-center" id="tablaOtros">
                    <tr>
                        <td colspan=4 class="tdOtros">
                            <p class="titulo"><strong>OTROS</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdArchivo">
                            <p><strong>Nombre del archivo</strong></p>
                        </td>
                        <td class="tdVer">
                            <p><strong>Ver</strong></p>
                        </td>
                        <td class="tdDescargar">
                            <p><strong>Descargar</strong></p>
                        </td>

                    </tr>
                    <!-- Muestra otro tipo de material -->
                    <?php
                    $sql = "SELECT * from material_otros";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td><?php echo $mostrar['urlArchivo'] ?></td>
                            <td colspan="1" align="center"> <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>


    <!-- SECCION DE COMENTARIOS -->
    <div class="container">
        <div class="row">
            <table class="table table-bordered text-center" id="tablaInfoA">
                <tr>
                    <td colspan=4 class="tdInfoAdicional">
                        <p class="titulo"><strong>INFORMACIÓN ADICIONAL</strong></p>

                    </td>
                </tr>

                <tr>
                    <td bgcolor="#e4e2e2" class="usuario">
                        <p><strong>Usuario</strong></p>
                    </td>
                    <td bgcolor="#e4e2e2" class="gamInforma">
                        <p><strong>GAM Informa</strong></p>
                    </td>
                    <td bgcolor="#e4e2e2" class="fechaHora">
                        <p><strong>Fecha y Hora</strong></p>
                    </td>
                </tr>

                <!-- MUESTRA LOS COMENTARIOS ANEXADOS -->
                <tr>
                    <?php
                    $sql = "SELECT * FROM material_apoyo_info ORDER BY fecha_comentario DESC";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver1 = mysqli_fetch_row($result)) {
                        $datos1 = $ver1[0] . "||" .
                            $ver1[1] . "||" .
                            $ver1[2] . "||" .
                            $ver1[3];
                    ?>
                        <!-- USUARIO -->
                        <td><b><?php echo $ver1[3]; ?></b></td>

                        <!-- GAM INFORMA -->
                        <td><?php echo $ver1[2]; ?></td>

                        <!-- FECHA Y HORA -->
                        <td><b><?php echo $ver1[1]; ?></b></td>
                </tr>
            <?php
                    }
            ?>

            </table>
        </div>
    </div>

</body>

</html>