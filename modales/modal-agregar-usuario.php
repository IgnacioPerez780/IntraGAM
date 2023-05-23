<div class="modal fade" id="agregar_usuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  	<span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Registra un nuevo usuario</h4>
            </div>
            <form id="guardar_usuario">
            	<div class="modal-body">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe el nombre">
                            </div>
                            <div class="col-md-6">
                                <label>Apellido Paterno</label>
                                <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Escribe el apellido paterno">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Apellido Materno</label>
                                <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Escribe el apellido materno">
                            </div>
                            <div class="col-md-6">
                                <label>Tipo de usuario</label>
                                <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                                    <?php
                                        include"app/conexion.php";
                                        $conexion=conexion();
                                        $query ="SELECT id, descripcion FROM tipo_usuario";
                                        $resultado = $conexion->query($query);
                                        while ($row=$resultado->fetch_assoc()) 
                                        {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['descripcion']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Escribe el telefono">
                            </div>
                            <div class="col-md-6">
                                <label>Extencion</label>
                                <input type="text" class="form-control" name="extencion" id="extencion" placeholder="Escribe la extencion">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tipo de linea de negocio</label>
                                <select class="form-control" name="tipo_linea_negocio" id="tipo_linea_negocio">
                                    <?php
                                        $query ="SELECT id, nombre FROM linea_negocio";
                                        $resultado = $conexion->query($query);
                                        while ($row=$resultado->fetch_assoc()) 
                                        {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php
                                        }
                                        mysqli_close($conexion);
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Correo electronico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Escribe el correo">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Escribe la contraseña">
                        </div>
                        <div  class="form-group">
                                        <label>Usuario</label>
                                        <input type="text" class="form-control" name="nomusuario" id="nomusuario" placeholder="Escribe tu usuario">
                                    </div>
                    </div>
                    <div class="modal-footer">
		                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar sin guardar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
		            </div>
            	</div>
	        </form>
        </div>
    </div>
</div>