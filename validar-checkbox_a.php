<!DOCTYPE html>
<html>

<head>
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="img/gam.ico">
    <title>Agente GAM</title>
</head>

<body>

</html>

<?php

include 'app/conexion.php';
$conexion = conexion();

if ($conexion) {
    mysqli_select_db($conexion, "ventana2");
}

//Datos del formulario
$checkbox = $_POST['condiciones'];

//Asigna la clave del elemento actual a la variable $key en cada iteracion.
foreach ($checkbox as $key => $value) {
    $ficha2 = "INSERT INTO terminos_a SET conformidad_a='$value' ";
    $ejecutar_insertar_ficha2 = mysqli_query($conexion, $ficha2);
}

//Si ingresa de forma correcta el foreach lanza la alerta para validacion de lo que se acaba de realizar
echo '<script type="text/javascript">
	jQuery(function(){   
		swal({
			title: "¡Folio Finalizado!",
			text: "Terminos y condiciones aceptados",
			type: "success",
		}, 
		function(){
			window.location.href = "seguimiento_a_a.php?id=' . $value . '";
		})
	});
  </script>';

?>