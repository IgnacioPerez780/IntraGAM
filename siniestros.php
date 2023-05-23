<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
session_start();

if ($_SESSION['logged_in'] <> TRUE) {
  header('location: index.php');
  exit;
}

//INACTIVIDAD DE SESION
if (isset($_SESSION['logged_in'])) {
  // set time-out period (in seconds)
  $inactive = 1500;

  // check to see if $_SESSION["timeout"] is set
  if (isset($_SESSION["timeout"])) {
    // calculate the session's "time to live"
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
      session_destroy();

?>
      <script>
        window.location = 'index.php';
      </script>
<?php

    }
  }

  $_SESSION["timeout"] = time();
}


if ($_SESSION['logged_in'] == 1) {
} else {
  header('location: index.php');
}
date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);


$sql = "select * from tipo_siniestros";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
  $combobit = "";
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $combobit .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
  }
}


$sql1 = "select * from tipo_solicitud_s where ts='1'";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
  $combobit1 = "";
  while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
    $combobit1 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
  }
}

$sql2 = "select * from tipo_solicitud_s where ts='2'";
$result2 = $conexion->query($sql2);
if ($result2->num_rows > 0) {
  $combobit2 = "";
  while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
    $combobit2 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
  }
}

$sql3 = "select * from tipo_solicitud_s where ts='3'";
$result3 = $conexion->query($sql3);
if ($result3->num_rows > 0) {
  $combobit3 = "";
  while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
    $combobit3 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
  }
}

$sql4 = "select * from tipo_solicitud_s where ts='4'";
$result4 = $conexion->query($sql4);
if ($result4->num_rows > 0) {
  $combobit4 = "";
  while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
    $combobit4 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <!--ALERTAS PARA MENSAJES DE VALIDACION-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/alertify.min.js"></script>
  <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
  <!--librerias de bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <!--hojas de estilo-->
  <link rel="stylesheet" href="css/alertify.core.css">
  <link rel="stylesheet" href="css/alertify.default.css">
  <link rel="stylesheet" href="css/hoja_general_siniestros.css">
  <!-- LIBRERIAS DE ALERTAS  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  
  <!-- Chatra {literal}
<script>
    (function(d, w, c) {
        w.ChatraID = 'nhpkGLxTvJKpwhFt8';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = 'https://call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
</script>
 /Chatra {/literal} -->
  
</head>

<?php
include('plantillas/cabecera_agente_s.php');
?>

<body>

  <div class="container">
    <?php include('componentes/tabla_s_a.php'); ?>
    <div id="tabla"></div>
  </div>


  <!-- Modal para registros nuevos -->
  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Alta Folio GAM</h4>
        </div>
        <div class="modal-body">
          <label>Fecha</label>
          <input type="text" name="" value="<?php echo $fechaactual = date("Y-m-d", $time); ?>" id="fecha" class="form-control input-sm" disabled>

          <label>Línea de Siniestro:</label>
          <select type="text" name="negocio" value="" id="negocio" onChange="mostrar();" class="form-control input-sm">
            <option value="" selected disabled hidden>Seleccione:</option>
            <?php echo $combobit; ?>
          </select>

          <script>
            function mostrar() {
              var opcion = document.getElementById("negocio").value;

              if (opcion == "GMM") {
                document.getElementById('GMM').style.display = 'block';
                document.getElementById('VIDA').style.display = 'none';
                document.getElementById('AUTOS').style.display = 'none';
                document.getElementById('DAÑOS').style.display = 'none';
              } else if (opcion == "VIDA") {
                document.getElementById('GMM').style.display = 'none';
                document.getElementById('VIDA').style.display = 'block';
                document.getElementById('AUTOS').style.display = 'none';
                document.getElementById('DAÑOS').style.display = 'none';
              } else if (opcion == "AUTOS") {
                document.getElementById('GMM').style.display = 'none';
                document.getElementById('VIDA').style.display = 'none';
                document.getElementById('AUTOS').style.display = 'block';
                document.getElementById('DAÑOS').style.display = 'none';
              } else if (opcion == "DAÑOS") {
                document.getElementById('GMM').style.display = 'none';
                document.getElementById('VIDA').style.display = 'none';
                document.getElementById('AUTOS').style.display = 'none';
                document.getElementById('DAÑOS').style.display = 'block';
              } else {
                document.getElementById('GMM').style.display = 'none';
                document.getElementById('VIDA').style.display = 'none';
                document.getElementById('AUTOS').style.display = 'none';
                document.getElementById('DAÑOS').style.display = 'none';
              }
            }
          </script>

          <div id="GMM" name="GMM" style="display: none;">
            <label>Tipo de Solicitud:</label>
            <select type="text" name="t_solicitud_GMM" value="" id="t_solicitud_s" class="form-control input-sm">
              <option value="" selected disabled hidden>Seleccione:</option>
              <?php echo $combobit1; ?>
            </select>

            <label>Contratante:</label>
            <input type="text" name="contratante" value="" id="contratante" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">

            <label>Afectado:</label>
            <input type="text" name="afectado" value="" id="afectado" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de Póliza:</label>
            <input type="text" name="num_poliza" value="" id="num_poliza" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Total:</label>
            <input type="text" name="" value="" id="total" class="form-control input-sm" placeholder="#####">

            <label>Gastos no cubiertos:</label>
            <input type="text" name="" value="" id="gastos" class="form-control input-sm" placeholder="#####">

            <label>Monto Procedente:</label>
            <input type="text" name="" value="" id="monto" class="form-control input-sm" placeholder="#####">

            <label>Número de QR:</label>
            <input type="text" name="num_qr" value="" id="num_qr" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de Reclamación:</label>
            <input type="text" name="num_reclamacion" value="" id="num_reclamacion" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de Folio:</label>
            <input type="text" name="num_folio" value="" id="num_folio" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Descripción concreta y detallada:</label>
            <input type="text" name="descripcion" value="" id="descripcion" class="form-control input-sm" placeholder="Ingrese una Descripción" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
          </div>

          <div id="VIDA" name="VIDA" style="display: none;">
            <label>Tipo de Solicitud:</label>
            <select type="text" name="t_solicitud_v" value="" id="t_solicitud_v" class="form-control input-sm">
              <option value="" selected disabled hidden>Seleccione:</option>
              <?php echo $combobit2; ?>
            </select>

            <label>Contratante:</label>
            <input type="text" name="contratantev" value="" id="contratantev" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">

            <label>Número de Póliza:</label>
            <input type="text" name="num_polizav" value="" id="num_polizav" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Descripción concreta y detallada:</label>
            <input type="text" name="descripcionv" value="" id="descripcionv" class="form-control input-sm" placeholder="Ingrese una Descripción" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
          </div>

          <div id="AUTOS" name="AUTOS" style="display: none;">
            <label>Tipo de Solicitud:</label>
            <select type="text" name="t_solicitud_a" value="" id="t_solicitud_a" class="form-control input-sm">
              <option value="" selected disabled hidden>Seleccione:</option>
              <?php echo $combobit3; ?>
            </select>

            <label>Contratante:</label>
            <input type="text" name="contratantea" value="" id="contratantea" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">

            <label>Número de Póliza:</label>
            <input type="text" name="num_polizaa" value="" id="num_polizaa" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de Siniestro:</label>
            <input type="text" name="num_siniestroa" value="" id="num_siniestroa" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de QR:</label>
            <input type="text" name="num_qra" value="" id="num_qra" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Descripción concreta y detallada:</label>
            <input type="text" name="descripciona" value="" id="descripciona" class="form-control input-sm" placeholder="Ingrese una Descripción" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
          </div>

          <div id="DAÑOS" name="DAÑOS" style="display: none;">
            <label>Tipo de Solicitud:</label>
            <select type="text" name="t_solicitud_d" value="" id="t_solicitud_d" class="form-control input-sm">
              <option value="" selected disabled hidden>Seleccione:</option>
              <?php echo $combobit4; ?>
            </select>

            <label>Contratante:</label>
            <input type="text" name="contratanted" value="" id="contratanted" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">

            <label>Número de Póliza:</label>
            <input type="text" name="num_polizad" value="" id="num_polizad" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de Siniestro:</label>
            <input type="text" name="num_siniestrod" value="" id="num_siniestrod" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Número de QR:</label>
            <input type="text" name="num_qrd" value="" id="num_qrd" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

            <label>Descripción concreta y detallada:</label>
            <input type="text" name="descripciond" value="" id="descripciond" class="form-control input-sm" placeholder="Ingrese una Descripción" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
          </div>

          <label>Estado:</label>
          <input type="text" name="" value="ENVIADO" id="estado" class="form-control input-sm" disabled>
        </div>
        <div class="modal-footer">
          <button href="#" class="btn btn-primary" type="button" id="guardar-form" onclick="return validar()" id="btnreload"> Crear</button>
        </div>

        <!-- VALIDACION DE CAMPOS PARA EL MODAL -->
        <script type="text/javascript">
          function validar() {
            var linea_de_negocio = document.getElementById("negocio").value;
            var t_solicitud_g = document.getElementById("t_solicitud_s").value;
            var total = document.getElementById("total").value;
            var gastos = document.getElementById("gastos").value;
            var monto = document.getElementById("monto").value;
            var contratante_g = document.getElementById("contratante").value;
            var afectado = document.getElementById("afectado").value;
            var num_poliza_g = document.getElementById("num_poliza").value;
            var num_qr_g = document.getElementById("num_qr").value;
            var num_reclamacion = document.getElementById("num_reclamacion").value;
            var num_folio = document.getElementById("num_folio").value;
            var descripcion_g = document.getElementById("descripcion").value;
            var t_solicitud_v = document.getElementById("t_solicitud_v").value;
            var contratante_v = document.getElementById("contratantev").value;
            var num_poliza_v = document.getElementById("num_polizav").value;
            var t_solicitud_a = document.getElementById("t_solicitud_a").value;
            var contratante_a = document.getElementById("contratantea").value;
            var num_poliza_a = document.getElementById("num_polizaa").value;
            var num_siniestro_a = document.getElementById("num_siniestroa").value;
            var descripcion_v = document.getElementById("descripcionv").value;
            var num_qr_a = document.getElementById("num_qra").value;
            var descripcion_a = document.getElementById("descripciona").value;
            var t_solicitud_d = document.getElementById("t_solicitud_d").value;
            var contratante_d = document.getElementById("contratanted").value;
            var num_poliza_d = document.getElementById("num_polizad").value;
            var num_siniestro_d = document.getElementById("num_siniestrod").value;
            var num_qr_d = document.getElementById("num_qrd").value;
            var descripcion_d = document.getElementById("descripciond").value;
            // Primeros campos de validacion
            if (linea_de_negocio.length == 0) {
              swal({
                title: "¡Error!",
                text: "¡Seleccione alguna opción del combo Línea de Siniestro!",
                type: "error",
                customClass: 'swal-wide',
                allowOutsideClick: false
              });
              hasError = true;
              // Linea de siniestro / GMM
            } else if (linea_de_negocio == "GMM") {
              if (t_solicitud_g.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Seleccione alguna opción del combo Tipo de Solicitud",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (contratante_g.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Nombre del Contratante",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (afectado.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Nombre del Afectado",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_poliza_g.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Póliza correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true
              } else if (total.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Total correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (gastos.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese la cantidad de Gastos no cubiertos correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (monto.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Monto Procedente correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_qr_g.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número QR correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_reclamacion.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Reclamación correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_folio.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Folio correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (descripcion_g.length >= 1 || /^\s+$/.test(descripcion_g)) {
                swal({
                    title: "¡Recuerda!",
                    text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "Corregir",
                    confirmButtonColor: "#449d44",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    customClass: "Custom_Cancel"
                  },
                  function() {
                    $guarda = (guardarsiniestro() + actualizar());
                  });
              } else if (descripcion_g.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese una Descripción para continuar",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              }
              // Linea de siniestro / VIDA
            } else if (linea_de_negocio == "VIDA") {
              if (t_solicitud_v.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Seleccione alguna opción del combo Tipo de Solicitud",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (contratante_v.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Nombre del Contratante",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_poliza_v.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Póliza correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true
              } else if (descripcion_v.length >= 1 || /^\s+$/.test(descripcion_v)) {
                swal({
                    title: "¡Recuerda!",
                    text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "Corregir",
                    confirmButtonColor: "#449d44",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    customClass: "Custom_Cancel"
                  },
                  function() {
                    $guarda = (guardarsiniestro() + actualizar());
                  });
              } else if (descripcion_v.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese una Descripción para continuar",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              }
              // Linea de siniestro / AUTOS
            } else if (linea_de_negocio == "AUTOS") {
              if (t_solicitud_a.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Seleccione alguna opción del combo Tipo de Solicitud",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (contratante_a.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Nombre del Contratante",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_poliza_a.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Póliza correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_siniestro_a.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Siniestro correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_qr_a.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de QR correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (descripcion_a.length >= 1 || /^\s+$/.test(descripcion_a)) {
                swal({
                    title: "¡Recuerda!",
                    text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "Corregir",
                    confirmButtonColor: "#449d44",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    customClass: "Custom_Cancel"
                  },
                  function() {
                    $guarda = (guardarsiniestro() + actualizar());
                  });
              } else if (descripcion_a.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese una Descripción para continuar",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              }
              // Línea de siniestro / DAÑOS
            } else if (linea_de_negocio == "DAÑOS") {
              if (t_solicitud_d.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Seleccione alguna opción del combo Tipo de Solicitud",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (contratante_d.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Nombre del Contratante",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_poliza_d.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Póliza correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_siniestro_d.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de Siniestro correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (num_qr_d.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese el Número de QR correspondiente",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              } else if (descripcion_d.length >= 1 || /^\s+$/.test(descripcion_d)) {
                swal({
                    title: "¡Recuerda!",
                    text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "Corregir",
                    confirmButtonColor: "#449d44",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    customClass: "Custom_Cancel"
                  },
                  function() {
                    $guarda = (guardarsiniestro() + actualizar());
                  });
              } else if (descripcion_d.length == 0) {
                swal({
                  title: "¡Error!",
                  text: "Ingrese una Descripción para continuar",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
              }
            }
          }
        </script>

        <script>
          function guardarsiniestro() {
            var archivos_pdf = [];
            fecha = $('#fecha').val();
            negocio = $('#negocio').val();
            t_solicitud_s = $('#t_solicitud_s').val();
            t_solicitud_v = $('#t_solicitud_v').val();
            t_solicitud_a = $('#t_solicitud_a').val();
            t_solicitud_d = $('#t_solicitud_d').val();
            total = $('#total').val();
            gastos = $('#gastos').val();
            monto = $('#monto').val();
            contratante = $('#contratante').val();
            contratantev = $('#contratantev').val();
            contratantea = $('#contratantea').val();
            contratanted = $('#contratanted').val();
            afectado = $('#afectado').val();
            num_poliza = $('#num_poliza').val();
            num_polizav = $('#num_polizav').val();
            num_polizaa = $('#num_polizaa').val();
            num_polizad = $('#num_polizad').val();
            num_siniestro = $('#num_siniestro').val();
            num_siniestroa = $('#num_siniestroa').val();
            num_siniestrod = $('#num_siniestrod').val();
            num_qr = $('#num_qr').val();
            num_qra = $('#num_qra').val();
            num_qrd = $('#num_qrd').val();
            num_reclamacion = $('#num_reclamacion').val();
            num_folio = $('#num_folio').val();
            descripcion = $('#descripcion').val();
            descripcionv = $('#descripcionv').val();
            descripciona = $('#descripciona').val();
            descripciond = $('#descripciond').val();
            estado = $('#estado').val();

            //se incerto otro cambio aqui moneda_pagos

            guardarfolio = "true";
            var cadena = "fecha=" + fecha +
              "&negocio=" + negocio +
              "&t_solicitud_s=" + t_solicitud_s +
              "&t_solicitud_v=" + t_solicitud_v +
              "&t_solicitud_a=" + t_solicitud_a +
              "&t_solicitud_d=" + t_solicitud_d +
              "&total=" + total +
              "&gastos=" + gastos +
              "&monto=" + monto +
              "&contratante=" + contratante +
              "&contratantev=" + contratantev +
              "&contratantea=" + contratantea +
              "&contratanted=" + contratanted +
              "&num_poliza=" + num_poliza +
              "&num_polizav=" + num_polizav +
              "&num_polizaa=" + num_polizaa +
              "&num_polizad=" + num_polizad +
              "&num_siniestro=" + num_siniestro +
              "&num_siniestroa=" + num_siniestroa +
              "&num_siniestrod=" + num_siniestrod +
              "&num_qr=" + num_qr +
              "&num_qra=" + num_qra +
              "&num_qrd=" + num_qrd +
              "&num_reclamacion=" + num_reclamacion +
              "&num_folio=" + num_folio +
              "&descripcion=" + descripcion +
              "&descripcionv=" + descripcionv +
              "&descripciona=" + descripciona +
              "&descripciond=" + descripciond +
              "&estado=" + estado +
              "&afectado=" + afectado +
              '&guardar=' + 'v';

            if (window.FormData) {
              formdata = new FormData();
            }

            formdata.append("datos", cadena);
            $.ajax({
              url: 'php/agregarfolio_s_agente.php',
              type: 'POST',
              contentType: false,
              data: formdata,
              processData: false,
              cache: false,
              success: function(resultado) {
                $('#guardar-form').removeAttr("disabled");
              },
              error: function() {
                alert("Algo ha fallado.");
              }
            });

          }
        </script>
        <script>
          function actualizar(segs) {
            setTimeout(function() {
              location.reload();
            }, parseInt(segs) * 1000);
          }
        </script>
      </div>
    </div>
  </div>
  <footer>
    <script src="js/index.js"></script>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {


        $('#MyAutomatic').modal('show')

        $('#tabla_agentes').DataTable({});
        $('#tabla_agentes').on('click', 'tbody tr', function(e) {
          console.log(this);
        });

      });

      /*FUNCIONES PARA FORMATO DE MONEDA*/

      $("#total").on({
        "focus": function(event) {
          $(event.target).select();
        },
        "keyup": function(event) {
          $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "")
              .replace(/([0-9])([0-9]{2})$/, '$1.$2')
              .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
          });
        }
      });

      $("#gastos").on({
        "focus": function(event) {
          $(event.target).select();
        },
        "keyup": function(event) {
          $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "")
              .replace(/([0-9])([0-9]{2})$/, '$1.$2')
              .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
          });
        }
      });
      $("#monto").on({
        "focus": function(event) {
          $(event.target).select();
        },
        "keyup": function(event) {
          $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "")
              .replace(/([0-9])([0-9]{2})$/, '$1.$2')
              .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
          });
        }
      });
    </script>
  </footer>
</body>

</html>