<?php
error_reporting(0);
session_start();
$nomusuario = $_SESSION['nomusuario'];
$id = $_SESSION['id_usuario'];
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/sistemas/";


$gdd = $_SESSION['gdd'];
$promocion = $_SESSION['promocion'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Menú GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
</head>

<body>
    <!-- Enlaces principales para navegar por el portal -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img <?php if ($x == "1") { ?> <?php } ?> class="iconoIntra" src="img/logo_intra1.ico">
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!-- Permiten al usuario enviar informacion al servidor web -->
                    <form id="usuarioEditar" method="POST" action="editarDatosConsultor.php">
                        <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>
                    </form>
                    <!-- Foto de perfil para el usuario -->
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
                    <!-- Dependiendo del rol que acceda estara mostrando un menu diferente -->
                    <?php if ($x == "1") {
                    ?>
                        <li><a <?php
                                if ($nomusuario == "Miriam M" || $nomusuario == "Angeles C") {
                                ?> href="menu_cartera.php" <?php }
                                                        if ($gdd == "gdd") {
                                                            ?> href="menu_gdd.php" <?php }
                                                        if ($promocion == "promocion") {
                                                            ?> href="menu_p.php" <?php }
                                                        if ($nomusuario == "Gabriela M") {
                                                            ?> href="actividad_portal.php" <?php }
                                                        if ($nomusuario == "Yazmin A") {
                                                            ?> href="material_c.php" <?php }
                                                        if ($nomusuario == "Manuel R" || $nomusuario == "Miguel Z" || $nomusuario == "Miguel S") {
                                                            ?> href="menu_colaborador.php" <?php } ?> href="menu_consultor.php"><span class="glyphicon glyphicon-chevron-left"></span> Regresar</a></li>
                    <?php } else {  ?>
                        <li><a href="actualizar_pass1.php"><span class="glyphicon glyphicon-lock"></span> Cambiar Contraseña</a></li>
                    <?php } ?>
                    <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>

                </ul>
            </div>
        </div>
    </nav>