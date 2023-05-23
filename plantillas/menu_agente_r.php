<?php
    error_reporting(E_ALL);
    session_start();
    $nomusuario = $_SESSION['nomusuario'];
    $id = $_SESSION['id_usuario'];
    $base_url = "http://".$_SERVER['HTTP_HOST']."/sistemas/";    
?>
<!DOCTYPE html>
    <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
         
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agente GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/gam.ico">
    </head>
    <body>
<!-- <script src="<?php  echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
<script src="<?php  echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php  echo $base_url ?>librerias/alertify/alertify.js"></script>
 --><nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">GAM</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li><a><span class="glyphicon glyphicon-user"></span> Bienvenido  <?php echo $nomusuario ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    $sql = "SELECT COUNT(*) FROM notificaciones1 WHERE contador='1' and id_agente='$id'";
                    $result = mysqli_query($conexion,$sql);
                    while($ver=mysqli_fetch_row($result)){
                        $datos = $ver[0];
                ?>
                <li><a href="notificacionesa.php"><span class="glyphicon glyphicon-bell"></span><?php echo $datos; }?></a></li>

            <li><a href="menu_agente.php">Volver al menú</a></li>    
            <li><a href="actualizar_pass.php">Cambiar Contraseña</a></li>
            <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
