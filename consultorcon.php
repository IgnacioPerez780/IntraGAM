<?php
    include 'app/conexion.php';
    $conexion = conexion();

    include('plantillas/cabeceracon.php');
    if ( $_SESSION['logged_in'] == 1 && '2'  == $_SESSION['rol'] || $_SESSION['logged_in'] == 1 && '3' == $_SESSION['rol'] ){} else header('location: index.php');
      $fechaactual=date('Y-m-d');

      $sql="select * from linea_negocio";
      $result = $conexion->query($sql);

      if($result->num_rows > 0){
	       $combobit="";
	       while ($row= $result->fetch_array(MYSQLI_ASSOC)) {
		     $combobit.=" <option value='".$row['nombre']."'>".$row['nombre']."</option>";
	       }
      }

      $sql1="select * from tipo_solicitud";
      $result1 = $conexion->query($sql1);

      if($result1->num_rows > 0){
	       $combobit1="";
	       while ($row= $result1->fetch_array(MYSQLI_ASSOC)) {
		     $combobit1.=" <option value='".$row['tipo']."'>".$row['tipo']."</option>";
	       }
      }

      $sql2="select * from moneda";
      $result2 = $conexion->query($sql2);

      if($result2->num_rows > 0){
	       $combobit2="";
	       while ($row= $result2->fetch_array(MYSQLI_ASSOC)) {
		     $combobit2.=" <option value='".$row['tipo']."'>".$row['tipo']."</option>";
	       }
      }

      $sql3="select * from rango";
      $result3 = $conexion->query($sql3);

      if($result3->num_rows > 0){
	       $combobit3="";
	       while ($row= $result3->fetch_array(MYSQLI_ASSOC)) {
		     $combobit3.=" <option value='".$row['tiporan']."'>".$row['tiporan']."</option>";
	       }
      }

      $sql4="select * from producto where id_tipo_solicitud='1'";
      $result4 = $conexion->query($sql4);

      if($result4->num_rows > 0){
	       $combobit4="";
	       while ($row= $result4->fetch_array(MYSQLI_ASSOC)) {
		     $combobit4.=" <option value='".$row['producto']."'>".$row['producto']."</option>";
	       }
      }

      $sql5="select * from producto where id_tipo_solicitud='2'";
      $result5 = $conexion->query($sql5);

      if($result5->num_rows > 0){
	       $combobit5="";
	       while ($row= $result5->fetch_array(MYSQLI_ASSOC)) {
		     $combobit5.=" <option value='".$row['producto']."'>".$row['producto']."</option>";
	       }
      }

      $sql6="select * from estado";
      $result6 = $conexion->query($sql6);

      if($result6->num_rows > 0){
	       $combobit6="";
	       while ($row= $result6->fetch_array(MYSQLI_ASSOC)) {
		     $combobit6.=" <option value='".$row['nombre']."'>".$row['nombre']."</option>";
	       }
      }
 ?>
 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>ADP</title>
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.2.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>

  <script src="librerias/datatable/buttons/dataTables.buttons.min.js"></script>	<script src="librerias/datatable/buttons/"></script>
  <script src="librerias/datatable/buttons/jszip.min.js"></script>
  <script src="librerias/datatable/buttons/pdfmake.min.js"></script>
  <script src="librerias/datatable/buttons/vfs_fonts.js"></script>
  <script src="librerias/datatable/buttons/buttons.html5.min.js"></script>

 </head>

 <body>

 	<div class="container">
 		<div id="tabla"></div>
 	</div>

  <!-- Modal para registros nuevos -->
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alta Folio GAM</h4>
      </div>
      <div class="modal-body">
          <label>Fecha</label>
          <input type="date" name="" value="<?php echo $fechaactual; ?>" id="fecha" class="form-control input-sm" disabled>
          <label>Linea de negocio:</label>
          <select type="text" name="" value="" id="negocio" class="form-control input-sm">
            <option  value="Seleccionar:">---</option>
            <?php echo $combobit; ?>
          </select>
          <label>Tipo de Solicitud:</label>
          <select type="text" name="t_solicitud" value="" id="t_solicitud" onChange="mostrar();"class="form-control input-sm">
            <option  value="Seleccionar:">---</option>
            <?php echo $combobit1; ?>
          </select>
          <script>
            function mostrar(){
              var opcion = document.getElementById("t_solicitud").value;
              // alert(opcion);
              if(opcion=="ALTA DE PÓLIZA"){
                document.getElementById('t_nuevo').style.display = 'block';
                document.getElementById('t_movimiento').style.display = 'none';
                document.getElementById('t_pago').style.display = 'none';
              }else if (opcion=="MOVIMIENTOS") {
                document.getElementById('t_movimiento').style.display = 'block';
                document.getElementById('t_nuevo').style.display = 'none';
                document.getElementById('t_pago').style.display = 'none';
              }else if (opcion=="PAGOS") {
                document.getElementById('t_pago').style.display = 'block';
                document.getElementById('t_nuevo').style.display = 'none';
                document.getElementById('t_movimiento').style.display = 'none';
              }else{
                document.getElementById('t_nuevo').style.display = 'none';
                document.getElementById('t_movimiento').style.display = 'none';
                document.getElementById('t_pago').style.display = 'none';
              }
            }
          </script>
          <div id="t_nuevo" name="t_nuevo" style="display:none;">
              <label>Producto:</label>
              <select type="text" name="" value="" id="producto" class="form-control input-sm">
                <option  value="Seleccionar:">---</option>
                <?php echo $combobit4; ?>
              </select>
              <label>Rango:</label>
              <select type="text" name="" value="" id="rango" class="form-control input-sm">
                <option  value="Seleccionar:">---</option>
                <?php echo $combobit3; ?>
              </select>
              <label>Moneda:</label>
              <select type="text" name="" value="" id="moneda" class="form-control input-sm">
                <option  value="Seleccionar:">---</option>
                <?php echo $combobit2; ?>
              </select>
              <label>Prima:</label>
              <input type="text" name="" value="" id="prima" class="form-control input-sm">
          </div>
          <div id="t_movimiento" name="t_movimiento" style="display:none;">
              <label>Poliza:</label>
              <input type="text" name="" value="" id="m_poliza" class="form-control input-sm">
              <label>Tipo de movimiento:</label>
              <select type="text" name="" value="" id="movimiento" class="form-control input-sm">
                <option  value="Seleccionar:">---</option>
                <?php echo $combobit5; ?>
              </select>
          </div>
          <div id="t_pago" name="t_pago" style="display:none;">
              <label>Poliza:</label>
              <input type="text" name="" value="" id="poliza" class="form-control input-sm">
              <label>Moneda:</label>
              <select type="text" name="" value="" id="moneda" class="form-control input-sm">
                <option  value="Seleccionar:">---</option>
                <?php echo $combobit2; ?>
              </select>
              <label>Monto:</label>
              <input type="text" name="" value="" id="monto" class="form-control input-sm">
          </div>
          <label>Contratante:</label>
          <input type="text" name="" value="" id="contratante" class="form-control input-sm">
          <label>Prioridad:</label>
          <input type="text" name="" value="" id="prioridad" class="form-control input-sm">
          <label>Comentarios:</label>
          <input type="text" name="" value="" id="comentarios" class="form-control input-sm">
          <label>Estado:</label>
          <input type="text" name="" value="ENVIADO" id="estado" class="form-control input-sm" disabled>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarfolio">
        Crear
        </button>
      </div>
    </div>
  </div>
</div>

  <!-- Modal para edicion de datos -->
    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Seguimiento</h4>
          </div>
          <div class="modal-body">
            <input type="text" hidden="" id="idpersona" name="">
            <label>Fecha</label>
  					<input type="date" name="" value="<?php echo $fechaactual; ?>" id="fechau" class="form-control input-sm" disabled>
  					<label>Linea de negocio:</label>
  					<select type="text" name="" value="" id="negociou" class="form-control input-sm" disabled>
              <option  value="Seleccionar:">---</option>
              <?php echo $combobit; ?>
            </select>
          	<label>Tipo de Solicitud:</label>
  					<select type="text" name="t_solicitud" value="" id="t_solicitudu" onChange="mostrar();"class="form-control input-sm" disabled>
              <option  value="Seleccionar:">---</option>
              <?php echo $combobit1; ?>
            </select>
                <label>Producto:</label>
                <select type="text" name="" value="" id="productou" class="form-control input-sm" disabled>
                  <option  value="Seleccionar:">---</option>
                  <?php echo $combobit4; ?>
                </select>
                <label>Rango:</label>
                <select type="text" name="" value="" id="rangou" class="form-control input-sm" disabled>
                  <option  value="Seleccionar:">---</option>
                  <?php echo $combobit3; ?>
                </select>
                <label>Moneda:</label>
                <select type="text" name="" value="" id="monedau" class="form-control input-sm" disabled>
                  <option  value="Seleccionar:">---</option>
                  <?php echo $combobit2; ?>
                </select>
                <label>Prima:</label>
                <input type="text" name="" value="" id="primau" class="form-control input-sm" disabled>


                <label>Poliza:</label>
                <input type="text" name="" value="" id="m_polizau" class="form-control input-sm" disabled>
                <label>Tipo de movimiento:</label>
                <select type="text" name="" value="" id="movimientou" class="form-control input-sm" disabled>
                  <option  value="Seleccionar:">---</option>
                  <?php echo $combobit5; ?>
                </select>

                <label>Poliza:</label>
                <input type="text" name="" value="" id="polizau" class="form-control input-sm" disabled>
                <label>Moneda:</label>
                <select type="text" name="" value="" id="monedau" class="form-control input-sm" disabled>
                  <option  value="Seleccionar:">---</option>
                  <?php echo $combobit2; ?>
                </select>
                <label>Monto:</label>
                <input type="text" name="" value="" id="montou" class="form-control input-sm" disabled>

            <label>Contratante:</label>
  					<input type="text" name="" value="" id="contratanteu" class="form-control input-sm" disabled>
            <label>Prioridad:</label>
  					<input type="text" name="" value="" id="prioridadu" class="form-control input-sm" disabled>
            <label>Comentarios:</label>
  					<input type="text" name="" value="" id="comentariosu" class="form-control input-sm" disabled>
            <label>Estado:</label>
            <select type="text" name="" value="" id="estadou" class="form-control input-sm">
              <option  value="Seleccionar:">---</option>
              <?php echo $combobit6; ?>
            </select>
          </div>
          <div class="modal-footer">
              <!--<button type="button" class="btn btn-danger" id="eliminar" data-dismiss="modal">Eliminar</button>-->
            <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
          </div>
        </div>
      </div>
    </div>

 </body>
 </html>

 <script type="text/javascript">
  $(document).ready(function(){
    $('#tabla').load('componentes/tablaconsultor.php');
  });
 </script>
 <script type="text/javascript">
     $(document).ready(function(){
         $('#actualizadatos').click(function(){
           actualizadatosconsultor();
         });
     });
 </script>
<?php include('plantillas/pie-pagina.php'); ?>
