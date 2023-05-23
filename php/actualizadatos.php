<?php
// se incluye la conexión //
include '../app/conexion.php';
$conexion = conexion();
// se crean las variables que van a recibir los valores//
  $id = $_POST['id'];
  $fec = $_POST['fecha'];
  $neg = $_POST['negocio'];
  $t_s = $_POST['t_solicitud'];
  $pro = $_POST['producto'];
  $ran = $_POST['rango'];
  $moa = $_POST['moneda'];
  $pri = $_POST['prima'];
  $pol = $_POST['poliza'];
  $mov = $_POST['movimiento'];
  $mon = $_POST['monto'];
  $con = $_POST['contratante'];
  $pad = $_POST['prioridad'];
  $com = $_POST['comentarios'];
  $est = $_POST['estado'];
  $monp = $_POST['monedap'];
  $monpa = $_POST[' moneda_pagos']; //hay cambio aqui y en la consulta moneda_pagos
  // variable que hace el update en la base con los nuevos datos //
  $sql ="UPDATE folios set fecha='$fec',
                           negocio='$neg',
                           t_solicitud='$t_s',
                           producto='$pro',
                           rango='$ran',
                           moneda='$moa',
                           prima='$pri',
                           poliza='$pol',
                           movimiento='$mov',
                           monto='$mon',
                           contratante='$con',
                           prioridad='$pad',
                           comentarios='$com',
                           estado='$est',
                           monp='$monedap',
                           monpa='$moneda_pagos'
        where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
