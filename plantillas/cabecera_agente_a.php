<?php
error_reporting(0);
session_start();
include_once "app/conexion.php";
$nomusuario = $_SESSION['nomusuario'];
$id = $_SESSION['id_usuario'];
$base_url = "https://" . $_SERVER['HTTP_HOST'] . "/sistemas/";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="euc-jp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agente GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
</head>

<body>
    <!-- Barra de navegacion -->
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
                    <li>
                        <!-- Permiten al usuario enviar informacion al servidor web -->
                        <form id="usuarioEditar" method="POST" action="editarDatosAgente.php">
                            <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>
                        </form>
                        <?php
                        //Query para mostrar el nombre del agente que se loguee 
                        $mod = "SELECT * FROM datos_agente WHERE nomusuario = '$nomusuario' ";
                        $resultTE = mysqli_query($conexion, $mod);
                        while ($modificacion = mysqli_fetch_array($resultTE)) {
                        ?>
                            <!-- Foto de perfil para el usuario -->
                            <a class="aImgUsuario" href="#" onclick="javascript:document.getElementById('usuarioEditar').submit(); return false;">
                                <img class="imgUsuario" src="<?php echo $modificacion['fotoPerfil'];  ?>"> Bienvenido <?php echo $nomusuario ?>
                            </a>
                    </li>
                <?php
                        }
                ?>
                </span>
                </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    //Query para las notificaciones
                    $sql = "SELECT COUNT(*) FROM notificaciones1_a WHERE contador='1' and id_agente='$id'";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($result)) {
                        $datos = $ver[0];
                    ?>
                        <li><a href="notificacionesa_a.php" title="Notificaciones"><span class="glyphicon glyphicon-bell"></span><?php echo $datos;
                                                                                                                                } ?></a></li>
                        <li><a href="menu_agente.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Men&uacute;</a></li>
                        <li><a href="autosa.php"><span class="glyphicon glyphicon-chevron-left"></span> Regresar</a></li>
                        <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>