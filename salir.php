<?php
include 'app/conexion.php';
$conexion = conexion();
session_start();
date_default_timezone_set('America/Mexico_City');
$hoy = date("Y-m-d");

//Guarda datos de sesion
$nomusuario = $_SESSION['nomusuario'];
//Recuerda la informacion del tiempo que se este en el sistema
$fecha1 = $_COOKIE["tiempo"];
$fecha2 = date("H:i");
$tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
$tiempoTotal = ($tiempo / 60 . " Minutos");
//Usuarios que se les medira el tiempo de sesion en la plataforma
if ($nomusuario == "Karla M" || $nomusuario == "Christian C" || $nomusuario == "Veronica S" || $nomusuario == "Giovanni M" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R" || $nomusuario == "Roberto R" || $nomusuario == "Omar S" || $nomusuario == "Martin G" || $nomusuario == "Nancy O" || $nomusuario == "Daniela V") {
    $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
                    values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
    $inserT = mysqli_query($conexion, $ti);
}
//Destruye la sesion al salir del sistema
session_destroy();
//Redirecciona al index una vez que se salga del sistema
header('location: index.php');
?>