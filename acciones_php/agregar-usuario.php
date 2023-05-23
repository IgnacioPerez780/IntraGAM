<?php  
	include '../app/conexion.php';
    $conexion = conexion();
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $telefono = $_POST['telefono'];
    $extencion = $_POST['extencion'];
    $nomusuario = $_POST['nomusuario'];
    $tipo_linea_negocio = $_POST['tipo_linea_negocio'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena_encryptada = password_hash($contrasena, PASSWORD_DEFAULT);
    $insertar = "INSERT INTO datos_operativos(nombre, apellido_paterno, apellido_materno, correo, password, telefono, extension,nomusuario, id_tipo_usuario, id_linea_negocio) VALUES ('$nombre','$apellido_paterno', '$apellido_materno', '$correo','$contrasena_encryptada','$telefono', '$extencion','$nomusuario', '$tipo_usuario', '$tipo_linea_negocio')";
    $verificar = mysqli_query($conexion, "SELECT nomusuario FROM datos_operativos WHERE nomusuario = '$nomusuario'");
    if (mysqli_num_rows($verificar) > 0)
    {
        echo '<script> 
                alert("El usuario ya esta registrado.");
                window.history.go(-1);
             </script>
             ';
        exit;
    }
    $resultado = mysqli_query($conexion, $insertar);
    if($resultado)
        $correcto = "Datos guardados con éxito.";
    else 
       	$error = "Lo sentimos, el registro falló. Por favor vuelva a intentarlo.";
    if (isset($error))
	{
	?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> <?php echo $error; ?>
            <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                        $(this).remove(); 
                    });
                }, 6000);
            </script>
		</div>
		<?php
	}
	if (isset($correcto))
	{
	?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Bien hecho!</strong> <?php echo $correcto; ?>
            <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                        $(this).remove(); 
                    });
                }, 6000);
            </script>
		</div>
	<?php
	}
?>