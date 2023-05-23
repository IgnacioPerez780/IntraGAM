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
        <title>Material de apoyo</title>
</head>

<body>

</html>

<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();

if (isset($_GET)) {
    $id = 0;
    $ruta = '';
    $id = $_GET['id'];
    $ruta = $_GET['ruta'];

    $eliminar = "DELETE FROM material_vida WHERE id_archivo = '" . $id . "'";

    $resultado = mysqli_query($conexion, $eliminar);

    if ($resultado) {
        unlink($ruta);
        echo '<script type="text/javascript">
                jQuery(function(){   
                    swal({
                        title: "¡Aceptado!",
                        text: "Material de apoyo eliminado con éxito",
                        type: "success",
                    }, 
                    function(){
                        window.location.href = "material_c.php";
                    })
                });
            </script>';
    } else {
        echo '<script type="text/javascript">
                jQuery(function(){   
                    swal({
                        title: "¡Error!",
                        text: "No se pudo eliminar material, intente más tarde",
                        type: "error",
                    }, 
                    function(){
                        window.location.href = "material_c.php";
                    })
                });
            </script>';
    }
}

?>