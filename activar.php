<?php
include 'app/conexion.php';
$conexion = conexion();
error_reporting(E_ALL);
session_start();
$id = $_SESSION['id_usuario'];
$carpeta = $_SESSION['nomusuario'];

$nom = "SELECT nomusuario FROM datos_operativos WHERE id = '$id'";
$nomr = $conexion->query($nom);
if ($row = mysqli_fetch_row($nomr)) {
  $nomusu = $row[0];
}

if ($_SESSION['logged_in'] == 1 && '2'  == $_SESSION['rol'] || $_SESSION['logged_in'] == 1 && '3' == $_SESSION['rol']) {
} else header('location: index.php');
$fechaactual = date('Y-m-d');

//INACTIVIDAD DE SESION
if (isset($_SESSION['logged_in'])) {
  $inactive = 1500;
  if (isset($_SESSION["timeout"])) {
    // calculate the session's "time to live"
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
      session_destroy();
      date_default_timezone_set('America/Mexico_City');
      $hoy = date("Y-m-d");
      $nomusuario = $_SESSION['nomusuario'];
      $fecha1 = $_COOKIE["tiempo"];
      $fecha2 = date("H:i");
      $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
      $tiempoTotal = ($tiempo / 60 . " Minutos");
      if ($nomusuario == "Veronica S" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Giovanni M" || $nomusuario == "Manuel R" || $nomusuario == "Roberto R" || $nomusuario == "Omar S" || $nomusuario == "Martin G" || $nomusuario == "Nancy O") {

        $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
                              values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
        $inserT = mysqli_query($conexion, $ti);
      }

?>
      <script>
        window.location = 'index.php';
      </script>
<?php

    }
  }
  $_SESSION["timeout"] = time();
}

?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
  <script src="librerias/jquery-3.2.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/datatable/buttons/"></script>
  <script src="librerias/datatable/buttons/jszip.min.js"></script>
  <script src="librerias/datatable/buttons/pdfmake.min.js"></script>
  <script src="librerias/datatable/buttons/vfs_fonts.js"></script>
  <!-- LIBRERIAS DE ALERTAS  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="icon" type="image/x-icon" href="img/gam.ico">
  <!-- HOJAS DE ESTILO -->
  <link rel="stylesheet" href="css/hoja_activacion_folios.css">

</head>

<?php
include('plantillas/cabecera.php');
?>

<body>

  <div class="container">
    <?php include('componentes/tabla_acti.php'); ?>
  </div>

  <!--Conexion -->
  <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Activar Folio</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden="" id="nomusu" name="nomusu" value="<?php echo "$nomusu"; ?>">
          <input type="text" hidden="" id="folio" name="folio" value="">
          <label>Motivo:</label>
          <select type="text" name="tipo" value="" id="tipo" class="form-control input-sm">
            <option hidden selected value="Selecciona">Selecciona:</option>
            <option value="Interno">Interno</option>
            <option value="Otro">Otro</option>
          </select>

          <label>Justificar:</label>
          <textarea name="motivo" id="motivo" rows="10" cols="10" class="form-control" style="text-align:justify;" placeholder="Indica el motivo por el cual se reactivará el folio" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>

          <label>Password:</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="modal-footer">
            <button href="#" class="btn btn-primary" type="button" id="guardar-form" onclick="return validar()" id="btnreload"> ACTIVAR</button>
          </div>

          <script type="text/javascript">
            function validar() {
              var tipo = document.getElementById("tipo").value;
              var motivo = document.getElementById("motivo").value;
              var password = document.getElementById("password").value;
              if (tipo == "Selecciona") {
                swal({
                  title: "¡Error!",
                  text: "Seleccione una opción del combo Motivo",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
                return false;
              } else if (motivo == null || motivo == 0) {
                swal({
                  title: "¡Error!",
                  text: "Justifica el motivo para la activación del folio",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
                return false;
              } else if (password != "GAM33") {
                swal({
                  title: "¡Error!",
                  text: "Contraseña incorrecta",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                hasError = true;
                return false;
              } else {
                $reactivar = (reactivar1());
              }
            }
          </script>

        </div>
      </div>
    </div>
  </div>

  <script>
    function reactivar(datos) {
      d = datos.split('||');
      $('#folio').val(d[0]);
    }
  </script>
  <script>
    function reactivar1() {

      folio = $('#folio').val();
      nomusu = $('#nomusu').val();
      tipo = $('#tipo').val();
      motivo = $('#motivo').val();

      cadena = "folio=" + folio + "&nomusu=" + nomusu + "&tipo=" + tipo + "&motivo=" + motivo;

      $.ajax({
        type: 'POST',
        url: 'php/reactivar.php',
        data: cadena,
        success: function(r) {
          if (r == 1) {
            jQuery(function() {
              swal({
                  title: "¡Excelente!",
                  text: "El folio ha quedado reactivado con éxito",
                  type: "success",
                },
                function() {
                  window.location.reload(true);
                })
            });
            // alertify.alert("REACTIVADO CON EXITO");
            //           window.location.reload(true);
            //           //actualizar();
          } else {
            alertify.error("Fallo el Servidor :(");
          }
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

  <footer>
    <script src="js/index.js"></script>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        $('#cnx').click(function() {
          reload();
        });

      });
    </script>
  </footer>
</body>

</html>