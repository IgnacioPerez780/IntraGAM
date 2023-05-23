<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
session_start();


if ($_SESSION['logged_in'] <> TRUE) {
  header('location: index.php');
  exit;
}

$nomusuario = $_SESSION['nomusuario'];
if ($nomusuario == "Leticia H" or $nomusuario == "Claudia E") {
?>


  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <!-- HOJAS DE ESTILO -->
    
    <link rel="stylesheet" href="css/hoja_detallesRespaldos.css">

    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Minified JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- DATATABLES -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

  </head>

  <?php
  include('plantillas/digitalizacion_py.php');
  $nombreContratante =  $_POST['nombreContratante'];
  $agente =  $_POST['agente'];
  $numeroP  = $_POST['numeroP'];
  $vigencia = $_POST['vigencia'];
  $primaNeta = $_POST['primaNeta'];
  $formaPago = $_POST['formaPago'];
  $moneda =  $_POST['moneda'];
  $id  = $_POST['id'];
  $comentario  = $_POST['comentario'];
  $fecha  = $_POST['fecha'];
  $numeroPAnterior  = $_POST['numeroPAnterior'];
  ?>

  <body>

    <!-- SECCION PARA ULTIMOS CAMBIOS -->
    <div class="container">
      <div class="row">
        <table class="table" cellspacing="0">
          <tr class="ultimosC_prom">
            <td>
              ÚLTIMOS CAMBIOS:
              <?php
              $mod = "SELECT COUNT(id_contratante) FROM cambios_digitalizacion_pymes WHERE id_contratante = '$id' ORDER BY fecha DESC";
              $resultTE = mysqli_query($conexion, $mod);
              while ($modificacion = mysqli_fetch_array($resultTE)) {
                echo  $modificacion['COUNT(id_contratante)'];
              }
              ?>
            </td>
          </tr>

          <?php

          $mod = "SELECT * FROM cambios_digitalizacion_pymes WHERE id_contratante = '$id' ORDER BY fecha DESC";
          $resultTE = mysqli_query($conexion, $mod);
          while ($modificacion = mysqli_fetch_array($resultTE)) {

          ?>

            <tr class="infoCambios_prom">
              <td scope="row">
                <?php
                if ($modificacion['nombreActual'] != $modificacion['nombreContratanteAnterior']) {
                  echo '<li>' . $modificacion['nombreContratanteAnterior'] . " cambio a ";
                  echo $modificacion['nombreActual'];
                ?>
                <?php } ?>
                
                <?php
                if ($modificacion['primaNetaActual'] != $modificacion['primaNetaAnterior']) {
                  echo '<li>CAMBIO DE PRIMA: ' . '<b>$' . $modificacion['primaNetaAnterior'] . '</b> a ';
                  echo '<b>$' . $modificacion['primaNetaActual'] . '</b>';
                ?>
                <?php } ?>

                <?php
                if ($modificacion['vigenciaAnterior'] != $modificacion['vigenciaActual']) {
                  $modificacion5 = date("d/m/Y", strtotime(utf8_decode($modificacion['vigenciaAnterior'])));
                  echo '<li>CAMBIO VIGENCIA: ' . '<b>' . $modificacion5 . "</b> al ";
                  echo '<b>' . $newDate = date("d/m/Y", strtotime(utf8_decode($modificacion['vigenciaActual']))) . '</b>';
                ?>
                <?php } ?>

                <?php
                if ($modificacion['formaPagoActual'] != $modificacion['formaPagoAnterior']) {
                  echo '<li>CAMBIO PAGO: <b>' . $modificacion['formaPagoAnterior'] . '</b> a ';
                  echo '<b>' . $modificacion['formaPagoActual'] . '</b>';
                ?>
                <?php } ?>

                <?php
                if ($modificacion['monedaActual'] != $modificacion['monedaAnterior']) {
                  echo '<li>CAMBIO MONEDA: <b>' . $modificacion['monedaAnterior'] . '</b> a ';
                  echo '<b>' . $modificacion['monedaActual'] . '</b>';
                ?>
                <?php } ?>
           
                <?php
                if ($modificacion['comentarioActual'] != $modificacion['comentarioAnterior']) {
                  echo '<li>CAMBIO DE COMENTARIO: <b>' . $modificacion['comentarioAnterior'];
                ?>
                <?php } ?>

                <label class="datoModificado_prom">
                  <?php echo "Modificado: ";  ?>
                  <?php echo $newDate = date("d/m/Y h:i a", strtotime(utf8_decode($modificacion['fecha']))); ?>
                </label>
              </td>

            <tr class="separacion">
              <td></td>
            </tr>

            </tr>

          <?php } ?>
        </table>
      </div>

      <!-- NOMBRE DEL AGENTE / TABLA CON DATOS -->
      <div class="datosAg_prom">
        <label>
          <h2>
            <?php echo "$nombreContratante"; ?>
          </h2>
        </label>
        <button title="Editar Datos" type="button" data-toggle="modal" data-target="#modalEditar" class="btnEditar_prom">
          <!-- ICONO  EDITAR-->
          <svg id="_x31__x2C_5" enable-background="new 0 0 36 36" height="55" viewBox="0 0 36 36" width="55" xmlns="http://www.w3.org/2000/svg">
            <g>
              <path d="m8.377 4.167c6.917 0 11.667-3.583 15-3.583s10.333 1.916 10.333 17.249-9.417 17.583-13.083 17.583c-17.167.001-24.5-31.249-12.25-31.249z" fill="#efefef" />
            </g>
            <g>
              <path d="m29.5 11c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5 1.5.673 1.5 1.5-.673 1.5-1.5 1.5zm0-2c-.275 0-.5.224-.5.5s.225.5.5.5.5-.224.5-.5-.225-.5-.5-.5z" fill="#a4afc1" />
            </g>
            <g>
              <path d="m20.277 26.25h-11.527c-1.1 0-2-.9-2-2v-15.5c0-1.1.9-2 2-2h11.5c1.1 0 2 .9 2 2l.027 15.497c.001 1.105-.895 2.003-2 2.003z" fill="#f3f3f1" />
            </g>
            <g>
              <circle cx="14.5" cy="11" fill="#2fdf84" r="1.25" />
            </g>
            <g>
              <path d="m17.75 18v-1.25c0-1.105-.895-2-2-2h-2.5c-1.105 0-2 .895-2 2v1.25z" fill="#2fdf84" />
            </g>
            <g>
              <path d="m21.601 28.58-3.351.67.67-3.351 7.372-7.372c.37-.37.97-.37 1.34 0l1.34 1.34c.37.37.37.97 0 1.34z" fill="#2fdf84" />
            </g>
            <g>
              <path d="m9 24.25v-15.5c0-1.1.9-2 2-2h-2.25c-1.1 0-2 .9-2 2v15.5c0 1.1.9 2 2 2h2.25c-1.1 0-2-.9-2-2z" fill="#d5dbe1" />
            </g>
            <g>
              <path d="m15.5 11c0-.19.049-.365.125-.526-.2-.425-.625-.724-1.125-.724-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25c.5 0 .925-.299 1.125-.724-.076-.161-.125-.336-.125-.526z" fill="#00b871" />
            </g>
            <g>
              <path d="m15.5 14.75h-2.25c-1.105 0-2 .895-2 2v1.25h2.25v-1.25c0-1.105.895-2 2-2z" fill="#00b871" />
            </g>
            <g>
              <path d="m21.17 25.899 6.917-6.917-.455-.455c-.37-.37-.97-.37-1.34 0l-7.372 7.372-.67 3.351 2.344-.469z" fill="#00b871" />
            </g>
            <g>
              <path d="m18.25 30c-.197 0-.389-.078-.53-.22-.178-.177-.254-.432-.205-.677l.67-3.351c.029-.146.101-.279.205-.383l7.372-7.372c.662-.661 1.738-.661 2.4 0l1.341 1.341c.662.662.662 1.739 0 2.401l-7.372 7.372c-.104.105-.238.176-.383.205l-3.351.67c-.049.009-.098.014-.147.014zm1.36-3.731-.404 2.025 2.024-.405 7.212-7.211c.065-.066.065-.214 0-.28l-1.341-1.34c-.076-.076-.203-.077-.279 0z" />
            </g>
            <g>
              <path d="m10 19.5h9v1.5h-9z" />
            </g>
            <g>
              <path d="m10 22.5h8v1.5h-8z" />
            </g>
            <g>
              <path d="m14.5 13c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-2.5c-.275 0-.5.224-.5.5s.225.5.5.5.5-.224.5-.5-.225-.5-.5-.5z" />
            </g>
            <g>
              <path d="m18.5 18h-1.5v-1.25c0-.689-.561-1.25-1.25-1.25h-2.5c-.689 0-1.25.561-1.25 1.25v1.25h-1.5v-1.25c0-1.517 1.233-2.75 2.75-2.75h2.5c1.517 0 2.75 1.233 2.75 2.75z" />
            </g>
            <g>
              <path d="m16 27h-7.25c-1.517 0-2.75-1.233-2.75-2.75v-15.5c0-1.517 1.233-2.75 2.75-2.75h11.5c1.517 0 2.75 1.233 2.75 2.75v9.25h-1.5v-9.25c0-.689-.561-1.25-1.25-1.25h-11.5c-.689 0-1.25.561-1.25 1.25v15.5c0 .689.561 1.25 1.25 1.25h7.25z" />
            </g>
          </svg>
        </button>
      </div>

      <!-- TABLA / DATOS -->
      <div class="tablaDatos_prom">
        <table class="table table-hovered table-condensed" style="border-style: none;">
          <td colspan=3 class="agente_prom">
            <label><?php echo "$agente"; ?> </label>
          </td>

          </tr>
          <tr>
            <td style="background-color: #fff;">
              <p>PÓLIZA</p>
            </td>
            <td style="background-color: #fff;">
              <p>PRIMA</p>
            </td>
            <td style="background-color: #fff;">
              <p>VIGENCIA</p>
            </td>
          </tr>
          <tr>
            <td class="poliza_prom">
              <?php echo "$numeroP"; ?>
            </td>
            <td class="prima_prom">
              <?php echo "$" . "$primaNeta"; ?>
            </td>
            <td class="vigencia_prom">
              <?php echo $newDate3 = date("d/m/Y", strtotime(utf8_decode($vigencia))); ?>
            </td>
          </tr>
          <tr>
            <td colspan=3 style="background-color: #fff;">
              <p>COMENTARIO</p>
            </td>
          </tr>
          <tr>
            <td colspan=3 class="coment_prom">
              <?php echo $comentario; ?>
            </td>
          </tr>
        </table>
      </div>

      <!-- TABLA / DATOS ARCHIVOS -->
      <div class="tablaDatosA_prom">
        <table class="table-striped" cellspacing="0">
          <tr class="cabeceraT_prom">
            <td>
              Fecha de carga
            </td>
            <td style="width: 400px;">
              Archivo
            </td>
            <td style="width: 170px;">
              Póliza
            </td>
            <td style="width: 100px;">
              Eliminar
            </td>
          </tr>

          <tr>
            <?php
            $i = 1;
            $archivo = "SELECT * FROM archivos_digitalizacion_pymes WHERE nombreContratante = '$nombreContratante' AND id_contratante = '$id'  ";
            $resultT = mysqli_query($conexion, $archivo);
            while ($archivos = mysqli_fetch_array($resultT)) {
              $urlArchivo = $archivos['urlArchivo'];
              $i++;
               $extension = substr($archivos['urlArchivo'], -3);
            ?>

              <td class="fechaCarga_prom">
                <?php echo $newDate2 = date("d/m/Y h:i a", strtotime(utf8_decode($archivos['fecha']))); ?>
              </td>

              <td class="archivoCargado_prom">
                <a href="../sistemas/<?php echo $urlArchivo ?>" target="ar">
                             
                             
               <?php if ($extension == "pdf" || $extension == "PDF") { ?>
                    <img  width="12" height="16"   src="img/icono_pdf.png">
                  </svg>

                <?php }


                if ($extension == "lsx" || $extension == "lsm"  || $extension == "xls"){ 


                 ?>

                 <img  width="17" height="17"   src="img/icono_xlsx.png">



               <?php } 

                if ($extension == "ocx" ){ 

                 ?>

               <img  width="17" height="17"   src="img/icono_word.png">




               <?php } 

                if ($extension == "png" || extension == "jpg" ){ 

                 ?>

               <img  width="17" height="17"   src="img/icono_imagen.png">




               <?php } ?>
                  <?php echo  $sub2 = substr($urlArchivo, 30) ?>
                </a>
              </td>

              <td class="poliza_arch">
                <?php echo $archivos['numeroP']; ?>
              </td>


              <td class="eliminarA_prom">
                <!--   FORMULARIO PARA ELIMINAR ARCHIVO -->
                <form id="<?php echo $i; ?>" method="POST" action="eliminarArchivo_py.php">

                  <!-- Datos del archivo-->
                  <input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>
                  <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nombreContratante;  ?>" checked>
                  <input style="display: none;" type="radio" name="numeroP" value="<?php echo $numeroP;  ?>" checked>
                  <input style="display: none;" type="radio" name="vigencia" value="<?php echo $vigencia;  ?>" checked>
                  <input style="display: none;" type="radio" name="primaNeta" value="<?php echo $primaNeta;  ?>" checked>
                  <input style="display: none;" type="radio" name="url" value="<?php echo $archivos['urlArchivo'];  ?>" checked>
                  <input style="display: none;" type="radio" name="fecha" value="<?php echo $archivos['fecha'];  ?>" checked>
                  <input style="display: none;" type="radio" name="comentario" value="<?php echo $comentario;  ?>" checked>
                  <input style="display: none;" type="radio" name="formaPago" value="<?php echo $formaPago;  ?>" checked>
                  <input style="display: none;" type="radio" name="moneda" value="<?php echo $moneda;  ?>" checked>
                  <input style="display: none;" type="radio" name="agente" value="<?php echo $agente;  ?>" checked>

                  <button id="<?php echo $i; ?>" type="button" class="btnEliminar_prom">
                    <span class="btn btn-danger glyphicon glyphicon-trash"></span>
                  </button>
                </form>

                <!-- ESTA FUNCIO DEBE IR AQUI DENTRO DEL CICLO -->
                <script type="text/javascript">
                  var myEl = document.getElementById('<?php echo $i; ?>');

                  myEl.addEventListener('click', function() {
                    swal({
                        title: "¿Eliminar permanentemente?",
                        text: "No se podra recuperar el archivo",
                        type: "error",
                        showCancelButton: true,
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Eliminar",
                        closeOnConfirm: false,
                        customClass: "Custom_Cancel"

                      },
                      function() {
                        document.getElementById('<?php echo $i; ?>').submit();
                        return false;
                      });
                  }, false);
                </script>
              </td>
          </tr>
        <?php } ?>
        </table>
      </div>

      <?php if ($urlArchivo > "0") { ?>
        <div>

          
          
                     
         <iframe id="ar" name="ar" <?php 
                                              if ($extension == "pdf" ) { 

           ?> src="../sistemas/<?php echo $urlArchivo ?>"
         <?php }  else {  ?>
                src="https://docs.google.com/viewer?url=../sistemas/<?php echo $urlArchivo ?>f&embedded=true"

              <?php } ?>
             title="Archivo" width="94%" height="450">
          </iframe>
        </div>
      <?php } ?>

    </div>

    <!-- CARGAR NUEVO ARCHIVO -->
    <div class="container">
      <div class="panelSubirA_prom">
        <div class="panel-heading">
          <h4> Subir un archivo</h4>
        </div>
        <div class="panel-body">
          <form method="POST" action="digitalizar_archivo_py.php" enctype="multipart/form-data">

            <!-- DATOS ADICIONALES-->
            <input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>
            <input style="display: none;" type="radio" name="agente" value="<?php echo $agente;  ?>" checked>
            <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nombreContratante;  ?>" checked>
            <input style="display: none;" type="radio" name="numeroP" value="<?php echo $numeroP;  ?>" checked>
            <input style="display: none;" type="radio" name="vigencia" value="<?php echo $vigencia;  ?>" checked>
            <input style="display: none;" type="radio" name="primaNeta" value="<?php echo $primaNeta;  ?>" checked>
            <input style="display: none;" type="radio" name="formaPago" value="<?php echo $formaPago;  ?>" checked>
            <input style="display: none;" type="radio" name="moneda" value="<?php echo $moneda;  ?>" checked>
            <input style="display: none;" type="radio" name="comentario" value="<?php echo $comentario;  ?>" checked>
            <input  class="selectArch_prom" type="file" name="archivo" required="" accept="application/pdf">
            <input class="btn btn-primary" type="submit" name="" value="ENVIAR" style="float: right;">
          </form>
        </div>
      </div>
    </div>

    <!-- MODAL PARA EDITAR LOS DATOS -->
    <div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="tareas" action="editarDatos_py.php" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Editar campos</h4>
            </div>
            <div class="modal-body">
              <label>Nombre actual:</label>
              <input type="text" class="form-control" name="nuevoNombre" style="resize: none;" rows="1" placeholder="Nuevo nombre" onkeyup="mayusculas(this);" value="<?php echo $nombreContratante; ?>">

              <label>Póliza actual:</label>
              <input type="text" class="form-control" name="nuevaP" style="resize: none;" rows="1" placeholder="Nueva poliza" onkeyup="mayusculas(this);" value="<?php echo $numeroP;  ?>">

              <label>Vigencia:</label>
              <input type="date" class="form-control" name="nuevaV" style="resize: none;" value="<?php echo $vigencia;  ?>">

              <label>Prima Actual:</label>
              <input type="text" name="primaNueva" value="<?php echo $primaNeta;  ?>" class="number form-control input-sm" id="prima1" placeholder="Escribe la prima correspondiente" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />

              <label>Forma de Pago:</label>
              <select class="form-control input-sm" id="formaPagoN" name="formaPagoN">
                <option value="MENSUAL">MENSUAL</option>
                <option value="TRIMESTRAL">TRIMESTRAL</option>
                <option value="SEMESTRAL">SEMESTRAL</option>
                <option value="ANUAL">ANUAL</option>
              </select>

              <label>Moneda:</label>
              <select class=" form-control input-sm" id="monedaN" name="monedaN">
                <option value="PESOS">PESOS</option>
                <option value="DOLARES">DOLARES</option>
              </select>

              <label>Comentario:</label>
              <textarea name="comentarioActual" class="number form-control input-sm" rows="5" onkeyup="mayusculas(this);"><?php echo "$comentario";  ?></textarea>

              <input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>
              <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nombreContratante;  ?>" checked>
              <input style="display: none;" type="radio" name="agente" value="<?php echo $agente;  ?>" checked>
              <input style="display: none;" type="radio" name="vigencia" value="<?php echo $vigencia;  ?>" checked>
              <input style="display: none;" type="radio" name="numeroP" value="<?php echo $numeroP;  ?>" checked>
              <input style="display: none;" type="radio" name="primaNeta" value="<?php echo $primaNeta;  ?>" checked>
              <input style="display: none;" type="radio" name="formaPago" value="<?php echo $formaPago;  ?>" checked>
              <input style="display: none;" type="radio" name="moneda" value="<?php echo $moneda;  ?>" checked>
              <input style="display: none;" type="radio" name="comentarioAnterior" value="<?php echo $comentario;  ?>" checked>

              <div class="modal-footer">
                <input class="btn btn-info" type="submit" name="" value="ACTUALIZAR">
                <input class="btn btn-danger" type="submit" name="" data-dismiss="modal" value="CANCELAR">
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>

  </body>

  </html>


<?php
} else {
  echo "<script> window.location='index.php'; </script>";
  header('location: index.php');
  exit;
}
?>

<script type="text/javascript">
  /* FORMATO DE MONEDA SEPARADO POR */
  $('input.number').keyup(function(event) {
    // skip for arrow keys
    if (event.which >= 37 && event.which <= 40) {
      event.preventDefault();
    }
    $(this).val(function(index, value) {
      return value
        .replace(/\D/g, "")
        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  });

  function mayusculas(e) {
    e.value = e.value.toUpperCase();
  }

  $(document).ready(function() {
    var formaPago = "<?= $formaPago ?>";
    $('#formaPagoN').val(formaPago);
    var moneda = "<?= $moneda ?>";
    $('#monedaN').val(moneda);
  });
</script>