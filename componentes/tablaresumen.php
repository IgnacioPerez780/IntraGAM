
<?php

  include '../app/conexion.php';
  $conexion = conexion();
  $nomusuario = $_SESSION['nomusuario'];
  $id = $_SESSION['id_usuario'];
  $base_url = "HTTPS://".$_SERVER['HTTP_HOST']."/sistemas/";

?>
<div class="row">
	<div class="col-sm-12">
	<h2>Mis Folios</h2>
		<table class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoad">
			<thead>
				<tr>
          <td align="center" style="vertical-align:middle;"><b>Total</b></td>
          <td align="center" style="vertical-align:middle;"><b>Enviado</b></td>
          <td align="center" style="vertical-align:middle;"><b>Proceso</b></td>
          <td align="center" style="vertical-align:middle;"><b>Activado</b></td>
          <td align="center" style="vertical-align:middle;"><b>Cancelado</b></td>
          <td align="center" style="vertical-align:middle;"><b>Terminado</b></td>
          <td align="center" style="vertical-align:middle;"><b>Terminado con Poliza</b></td>
				</tr>
			</thead>
			
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
			scrollx: true
		});
	});
</script>
</footer>
