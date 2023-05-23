<?php
error_reporting(0);
session_start();
include_once "app/conexion.php";
$conexion = conexion();
$nomusuario = $_SESSION['nomusuario'];
if ($nomusuario == null || $nomusuario = $nomusuario) {
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Colaborador GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
</head>

<body>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="iconoIntra" src="img/logo_intra1.ico">
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                                       <form id="usuarioEditar" method="POST" action="editarDatosConsultor.php">
                        <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>
                    </form>

                    <li><a href="#" class="aImgUsuario" onclick="javascript:document.getElementById('usuarioEditar').submit();return false;" <?php
                                                                                                                                                $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$nomusuario'";
                                                                                                                                                $resultTE = mysqli_query($conexion, $mod);
                                                                                                                                                while ($modificacion = mysqli_fetch_array($resultTE)) {
                                                                                                                                                ?>>
                            <img class="imgUsuario" src="<?php echo $modificacion['fotoPerfil'];  ?>"> Bienvenido <?php echo $nomusuario ?></a></li>
                <?php
                                                                                                                                                }

                ?>


                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="menu_gdd.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a></li>
                    <li><a href="siniestros_colab_g.php"><span class="glyphicon glyphicon-chevron-left"></span> Regresar</a></li>
                    <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>