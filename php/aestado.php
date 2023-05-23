<?php

// incluir conexión //
include '../app/conexion.php';
$conexion = conexion();

// variables que guardan el id y el estado //
  $id = $_POST['id'];
  $est = $_POST['estado'];
// consulta que hace el update a la tabla folios //
  $sql ="UPDATE folios set estado='$est'
        where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
