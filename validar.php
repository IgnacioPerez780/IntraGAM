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
    <title>Consultor GAM</title>
</head>

<body>

</html>

<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();

//Datos del formulario
$idf = $_POST['idf'];
$nomusuario = $_POST['nmu'];

//Devuelve el momento actual medido como el número de segundos
$time = time();

//Variables definidas
$fecha_actual = date("Y-m-d H:i:s", $time);
$tipoa = "VALIDADO";
$contador = "1";
$estado = "";


//Bucle que permitira recorrer el contenido de archivos validados que sean cargados por agente o consultor
foreach ($_POST['valido'] as $idvalido) {
    $id = "select id_agente from folios where id='$idf'";
    $reid = mysqli_query($conexion, $id);
    while ($verid = mysqli_fetch_row($reid)) {
        $did = $verid[0];
        $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$estado','$fecha_actual','$tipoa','$contador','$did')";
        $resultc = mysqli_query($conexion, $cont);
    }

    $consulta = "insert into validar_archivos set idarchivo='$idvalido'";
    mysqli_query($conexion, $consulta);
}

//Alerta para notificar que la subida de archivos ha sido aprobada
echo '<script type="text/javascript">
	jQuery(function(){   
		swal({
			title: "¡Notificando!",
			text: "Documentos Aprobados",
			type: "success",
		}, 
		function(){
			window.location.href = "seguimientocon.php?id=' . $idf . '";
		})
	});
  </script>';
?>