<?php

//Determinara si la variable traida del formulario es definida o null
if(isset($_POST['btnreload'])){
  if ($negocio=='null') {
    echo "<p class='error'> * Seleciona producto </p>";
  }
}
?>
