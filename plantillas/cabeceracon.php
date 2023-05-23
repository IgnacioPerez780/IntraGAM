<?php
    error_reporting(E_ALL);
    session_start();
    include_once "app/conexion.php";
    $conexion=conexion();
    $nomusuario = $_SESSION['nomusuario'];
    if ($nomusuario == null || $nomusuario =$nomusuario){

     }

?>

<!DOCTYPE html>
    <html>
    <head>
         <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Consultor GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="libreri/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/gam.ico">
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
            <a class="navbar-brand">GAM</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li><a><span class="glyphicon glyphicon-user"></span> Bienvenido  <?php echo $nomusuario ?></a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right">

            <li><a href="consultor1.php">Regresar</a></li>
            <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
