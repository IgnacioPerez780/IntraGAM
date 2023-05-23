<?php
error_reporting(E_ALL);
session_start();
include 'app/conexion.php';
$conexion = conexion();

//Para no loguearse sin haber iniciado sesion
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
            if ($nomusuario == "Karla M" || $nomusuario == "Christian C" || $nomusuario == "Veronica S" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R") {
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

// Array asociativo que contiene las variables de sesion disponibles
if ($_SESSION['logged_in'] == 1) {
} else {
    header('location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Material de apoyo</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- JS -->
    <script src="js/subir_archivo.js"></script>
    <!-- JS - BARRA DE PROGRESO-->
    <script src="js/main_materialA.js"></script>

    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_general_material.css">
    <link rel="stylesheet" href="css/main_materialA.css">
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
</head>

<?php
// Tipo de cabecera que debera mostrar dependiendo que rol acceda
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '3' || $_SESSION['rol'] == '2') {
    include('plantillas/m_consultor.php');
} else if ($_SESSION['rol'] == '5') {
    include('plantillas/m_coordinador.php');
} else if ($_SESSION['rol'] == '9') {
    include('plantillas/m_promocion.php');
}
?>

<body>

    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <!-- TABLA CAMPANIAS -->
                <table class="table table-striped table-bordered text-center" id="tablaCampC">
                    <tr>
                        <td colspan=4 class="tdCampania">
                            <p class="titulo"><strong>CAMPA&Ntilde;AS</strong></p>
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
                        <td class="tdEliminar">
                            <p><strong>Eliminar</strong></p>
                        </td>
                    </tr>
                    <?php
                    $sql = "SELECT * from material_camp";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td class="archivoCargado"><?php echo $mostrar['urlArchivo'] ?></td>

                            <!-- VER ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank">
                                    <span class="btn btn-primary glyphicon glyphicon-file"></span>
                                </a>
                            </td>

                            <!-- DESCARGAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>

                            <!-- ELIMINAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="eliminarMaterial.php?id=<?php echo $mostrar['id_archivo']; ?>&ruta=<?php echo $mostrar['urlArchivo']; ?>">
                                    <span class="btn btn-danger glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan=4 class="tdCargarNuvC">
                            <p class="titulo"><strong>CARGAR NUEVO MATERIAL</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <form action="" id="materialB" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-1-2">
                                                <input type="file" class="form-control" name="archivo" id="archivo" accept=".pdf, .jpg, .png, .gif, .jpeg" />
                                            </div>
                                        </div>
                                        <div colspan="10" class="barraProgresoT">
                                            <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                            <div class="barra">
                                                <div class="barra_azul" id="barra_estado">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="acciones">
                                            <button type="submit" class="btn btn-primary" onclick="return alerta();" id="subir">Cargar archivo</button>
                                            <input type="button" class="btn btn-danger" id="cancelar" value="Cancelar" disabled>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                </table>

                <!-- TABLA CIRCULARES GMM -->
                <table class="table table-striped table-bordered text-center" id="tablaCirGmmC">
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
                        <td class="tdEliminar">
                            <p><strong>Eliminar</strong></p>
                        </td>
                    </tr>
                    <?php
                    $sql = "SELECT * from material_gmm";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td class="archivoCargado"><?php echo $mostrar['urlArchivo'] ?></td>

                            <!-- VER ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank">
                                    <span class="btn btn-primary glyphicon glyphicon-file"></span>
                                </a>
                            </td>

                            <!-- DESCARGAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>

                            <!-- ELIMINAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="eliminarMaterialGmm.php?id=<?php echo $mostrar['id_archivo']; ?>&ruta=<?php echo $mostrar['urlArchivo']; ?>">
                                    <span class="btn btn-danger glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan=4 class="tdCargarNuvG">
                            <p class="titulo"><strong>CARGAR NUEVO MATERIAL</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <form action="" id="materialGmm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-1-2">
                                                <input type="file" class="form-control" name="archivo" id="archivoGmm" accept=".pdf, .jpg, .png, .gif, .jpeg" />
                                            </div>
                                        </div>
                                        <div colspan="10" class="barraProgresoTGmm">
                                            <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                            <div class="barra">
                                                <div class="barra_azul" id="barra_estadoGmm">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="acciones">
                                            <button type="submit" class="btn btn-primary" onclick="return alertaGmm();" id="subir">Cargar archivo</button>
                                            <input type="button" class="btn btn-danger" id="cancelarGmm" value="Cancelar" disabled>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                </table>

                <!-- TABLA CIRCULARES VIDA -->
                <table class="table table-striped table-bordered text-center" id="tablaCirVidaC">
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
                        <td class="tdEliminar">
                            <p><strong>Eliminar</strong></p>
                        </td>
                    </tr>
                    <?php
                    $sql = "SELECT * from material_vida";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td class="archivoCargado"><?php echo $mostrar['urlArchivo'] ?></td>

                            <!-- VER ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank">
                                    <span class="btn btn-primary glyphicon glyphicon-file"></span>
                                </a>
                            </td>

                            <!-- DESCARGAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>

                            <!-- ELIMINAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="eliminarMaterialVida.php?id=<?php echo $mostrar['id_archivo']; ?>&ruta=<?php echo $mostrar['urlArchivo']; ?>">
                                    <span class="btn btn-danger glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan=4 class="tdCargarNuvV">
                            <p class="titulo"><strong>CARGAR NUEVO MATERIAL</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <form action="" id="materialVida" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-1-2">
                                                <input type="file" class="form-control" name="archivo" id="archivoVida" accept=".pdf, .jpg, .png, .gif, .jpeg" />
                                            </div>
                                        </div>
                                        <div colspan="10" class="barraProgresoTVida">
                                            <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                            <div class="barra">
                                                <div class="barra_azul" id="barra_estadoVida">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="acciones">
                                            <button type="submit" class="btn btn-primary" onclick="return alertaVida();" id="subir">Cargar archivo</button>
                                            <input type="button" class="btn btn-danger" id="cancelarVida" value="Cancelar" disabled>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                </table>

                <!-- TABLA OTROS -->
                <table class="table table-striped table-bordered text-center" id="tablaOtrosC">
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
                        <td class="tdEliminar">
                            <p><strong>Eliminar</strong></p>
                        </td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM material_otros";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td class="archivoCargado"><?php echo $mostrar['urlArchivo'] ?></td>

                            <!-- VER ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank">
                                    <span class="btn btn-primary glyphicon glyphicon-file"></span>
                                </a>
                            </td>

                            <!-- DESCARGAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="../sistemas/<?php echo $mostrar['urlArchivo'] ?>" target=" _blank" download="<?php echo $mostrar['urlArchivo'] ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                                </a>
                            </td>

                            <!-- ELIMINAR ARCHIVO -->
                            <td colspan="1" align="center">
                                <a href="eliminarMaterialOtros.php?id=<?php echo $mostrar['id_archivo']; ?>&ruta=<?php echo $mostrar['urlArchivo']; ?>">
                                    <span class="btn btn-danger glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan=4 class="tdCargarNuvO">
                            <p class="titulo"><strong>CARGAR NUEVO MATERIAL</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <form action="" id="materialOtros" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-1-2">
                                                <input type="file" class="form-control" name="archivo" id="archivoOtros" accept=".pdf, .jpg, .png, .gif, .jpeg" />
                                            </div>
                                        </div>
                                        <div colspan="10" class="barraProgresoTOtros">
                                            <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                            <div class="barra">
                                                <div class="barra_azul" id="barra_estadoOtros">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="acciones">
                                            <button type="submit" class="btn btn-primary" onclick="return alertaOtros();" id="subir">Cargar archivo</button>
                                            <input type="button" class="btn btn-danger" id="cancelarOtros" value="Cancelar" disabled>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <!-- SECCION DE COMENTARIOS -->
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered text-center" id="tablaComentarios">
                <tr>
                    <td colspan=4 class="tdInfoAdicional">
                        <p class="titulo"><strong>INFORMACI&Oacute;N ADICIONAL</strong></p>

                    </td>
                </tr>

                <tr>
                    <td class="usuarioC">
                        <p><strong>Usuario</strong></p>
                    </td>
                    <td class="gamInformaC">
                        <p><strong>GAM Informa</strong></p>
                    </td>
                    <td class="fechaHoraC">
                        <p><strong>Fecha y Hora</strong></p>
                    </td>
                    <td class="eliminarComent">
                        <p><strong>Eliminar</strong></p>
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
                        <td class="comentGamInf"><?php echo $ver1[2]; ?></td>

                        <!-- FECHA Y HORA -->
                        <td><b><?php echo $ver1[1]; ?></b></td>

                        <!-- ELIMINAR COMENTARIO-->

                        <td>
                            <a href="eliminarInfo.php?id=<?php echo $ver1[0]; ?>">
                                <span class="btn btn-danger glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                </tr>
            <?php
                    }
            ?>

            <!-- SECCIÓN PARA AGREGAR LA INFORMACIÓN O COMENTARIOS -->

            <tr>

                <form method="POST" action="php/gamInforma.php">
                    <td class="comenAgregar">
                        <p class="infoAgregar"><strong>Agregar informaci&oacute;n:</strong></p>
                    </td>
                    <td bgcolor="#dad4d3" class="textArea">
                        <textarea name="comentario" id="comentario" type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
                    </td>

                    <td class="info" colspan="2">
                        <button type="submit" class="btn btn-warning glyphicon glyphicon-ok" id="cargarInfo" onclick="return validar();"></button>
                    </td>
                </form>

            </tr>
            </table>
        </div>
    </div>


</body>

</html>