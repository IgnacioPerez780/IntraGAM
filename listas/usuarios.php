<div class="box-body">
	<div class="box-body table-responsive no-padding">
		<table id="example1" class="table table-bordered table-hover">
			<thead>
				<tr>
  					<th>Nombre</th>
  					<th>Apellido Paterno</th>
  					<th>Apellido Materno</th>
  					<th>Correo</th>
  					<th>Telefono</th>
  					<th>Extencion</th>
            <th>Nombre Usuario</th>
  					<th>Tipo de usuario</th>
  					<th>Linea de negocio</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                    include"../app/conexion.php";
                    $conexion=conexion();
                    $query ="SELECT do.nombre, do.apellido_paterno, do.apellido_materno, do.correo, do.telefono, do.extension,do.nomusuario 
                    			tu.descripcion, ln.nombre AS linea_negocio
							FROM datos_operativos AS do, tipo_usuario AS tu, linea_negocio AS ln
							WHERE do.id_tipo_usuario = tu.id
							AND do.id_linea_negocio = ln.id;"
							;
                    $resultado = $conexion->query($query);
                    while ($row=$resultado->fetch_assoc())
                    {
                ?>
                    <tr>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido_paterno']; ?></td>
                        <td><?php echo $row['apellido_materno']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['extension']; ?></td>
                        <td><?php echo $row['nomusuario']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['linea_negocio']; ?></td>
                    </tr>
                <?php
                    }
                ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	$(function () {
	    $('#example1').DataTable({
	      	"language": {
            	"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          	}
	    })
  	})
</script>