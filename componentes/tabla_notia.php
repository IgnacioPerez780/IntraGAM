<?php
  error_reporting(0);
  include '../app/conexion.php';
  $conexion = conexion();
  $nomusuario = $_SESSION['nomusuario'];
  $id = $_SESSION['id_usuario'];
  $base_url = "HTTPS://".$_SERVER['HTTP_HOST']."/sistemas/";

  $fecha_actual = date("d-m-Y",$time);
  $GLOBALS['fecharet'] = $GLOBALS['fecha_actual'];
?>

<div class="row">
    <div class="col-sm-12">
    <h2>Mis notificaciones</h2>
        <table data-order='[[1, "desc"]]' class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoad"><!--Data-order ordenamiento de descendente a ascendente-->
            <thead>
                <tr>
          <td align="center" width="1000px"><b>TIPO</b></td>
          <td align="center" width="20px"><b>DETALLES</b></td>

                </tr>
            </thead>
            <tbody>
        <?php
          $sql = "SELECT * FROM notificaciones1 WHERE contador = '1' and id_agente='$id' ORDER BY id DESC";


          $result = mysqli_query($conexion,$sql);
          while($ver=mysqli_fetch_row($result)){

              $datos = $ver[0]."||".
                       $ver[1]."||".
                       $ver[2]."||".
                       $ver[3]."||".
                       $ver[4]."||".
                       $ver[5]."||".
                       $ver[6]."||".
                       $ver[7];
        ?>
            <tr>
                <td align="center" width="1000px"><small>
                  
                  <?php

                  if($ver[5]=="COMENTARIO"){?>

                    <b><?php echo $ver[2]; ?></b> agregó un nuevo <b><?php echo $ver[5]; ?></b> al folio <b><?php echo $ver[1]; ?></b>, con estatus <b><?php echo $ver[3]; ?></b> el día <b><?php echo $ver[4]; ?></b>

                    <?php

                  }else if($ver[5]=="ARCHIVO"){?>
                    
                    <b><?php echo $ver[2]; ?></b> adjuntó un nuevo <b><?php echo $ver[5]; ?></b> al folio <b><?php echo $ver[1]; ?></b>, con estatus <b><?php echo $ver[3]; ?></b> el día <b><?php echo $ver[4]; ?></b>


                    <?php

                  }else if($ver[5]=="TRAMITE"){?>

                    <b><?php echo $ver[2]; ?></b> te generó un nuevo <b><?php echo $ver[5]; ?></b> el día <b><?php echo $ver[4]; ?></b> y le fue asignado el folio <b><?php echo $ver[1]; ?></b> 

                    <?php

                  }else if($ver[5]=="VALIDADO"){?>

                    <b><?php echo $ver[2]; ?></b> <b>VALIDÓ</b> un archivo adjunto al folio <b><?php echo $ver[1]; ?></b> el día <b><?php echo $ver[4]; ?></b>

                    <?php
                  }

                  ?>


                </small></td> <!--FOLIO-->

                <td align="center" width="20px">
                    <form class="" action="seguimiento.php?id=<?php  echo $ver[1]; ?>" method="post">
                      <button class="btn btn-warning glyphicon glyphicon-align-justify" value="<?php echo $ver[1]; ?>" id="id" name="id"></button> <!--DETALLES-->
                    </form>

                </td>
            </tr>
      <?php
        }
      ?>
             </tbody>
        </table>
    </div>
</div>
<footer>
    <script src="<?php  echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="<?php  echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php  echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php  echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaDinamicaLoad').DataTable({
                        stateSave: true,
                stateDuration: -1,
                stateDuration: 60 * 25,
            language:{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
    },


        });
    });
</script>
</footer>
