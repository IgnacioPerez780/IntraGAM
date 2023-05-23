<?php
error_reporting(0);
session_start();
include_once "app/conexion.php";
$conexion = conexion();

if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
}

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}

$nomusuario = $_SESSION['nomusuario'];

if ($_SESSION['logged_in'] == 1) {
} else header('location: index.php');


$x = 1;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Actualizar Contraseña</title>
    <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="libreri/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_password.css">

    <!-- JS -->
    <script src="js/actualizaciones_password.js"></script>
</head>

<?php
include('plantillas/cabecera_general_menuC.php');
?>

<body class="hold-transition skin-blue sidebar-mini">

    <!-- ACTUALIZAR PASSWORD -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Cambio de contraseña</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-sm-offset-3">
                <p class="text-center">Su contraseña no puede ser la misma que su nombre de usuario</p>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <input type="password" class="form-control" name="contrasena_actual" id="contrasena_actual" placeholder="Ingresa tu contraseña actual" required>

                    <input type="password" class="form-control" name="password1" id="password1" placeholder="Ingresa tu nueva contraseña" autocomplete="off" required>
                    <span class="fa fa-fw fa-eye password-icon show-password"></span>
                    <div class="row">
                        <div class="col-sm-6">
                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Caracteres mínimo<br>
                            <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Una letra mayúscula
                        </div>
                        <div class="col-sm-6">
                            <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Una letra minúscula <br>
                            <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Un número
                        </div>
                    </div>

                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirma tu contraseña" autocomplete="off" required>
                    <div class="row">
                        <div class="col-sm-12">
                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Las contraseñas coinciden
                        </div>
                    </div>

                    <div class="vPassword">
                        <input type="checkbox" onclick="myFunction()">Ver Contraseña
                    </div>

                    <button type="submit" class="btn btn-primary btn-load btn-lg col-xs-12 " name="enviar" id="actualizarPass" disabled>Actualizar</button>
                </form>
            </div>
        </div>
    </div>

</html>

<?php
if (isset($_POST['enviar'])) {
    $contrasena_actual = htmlentities($_POST['contrasena_actual']);
    $contrasena_actual = hash("sha512", $contrasena_actual);

    $nuevo_password = htmlentities($_POST['password1']);
    $nuevo_password = hash("sha512", $nuevo_password);
    $contrasena_encryptada = htmlentities($_POST['password2']);
    $contrasena_encryptada = hash("sha512", $contrasena_encryptada);
    $actualizar = "UPDATE datos_operativos SET password = '$contrasena_encryptada' WHERE nomusuario='$nomusuario'";

    $verificar = mysqli_query($conexion, "SELECT password FROM datos_operativos WHERE password='$contrasena_actual';");

    if (mysqli_num_rows($verificar) > 0) {
        $res = mysqli_query($conexion, $actualizar);
        if ($res) {
            echo '<script> 
            jQuery(function () {
                swal({
                    title: "¡Validado!",
                    text: "Contraseña actualizada con éxito",
                    type: "success",
                },
                    function () {
                        window.location.href = "material_c.php";
                    })
            });
            </script> ';
        } else {
            echo '<script> 
            swal({
                title: "¡Error!",
                text: "Problemas con el servidor, intentelo más tarde",
                type: "error",
                allowOutsideClick: false
            });
            hasError = true;
            </script> ';
        }
    } else {
        echo '<script> 
            jQuery(function () {
                swal({
                    title: "¡Error!",
                    text: "La contraseña actual no coincide, intentelo nuevamente",
                    type: "error",
                },
                    function () {
                        window.location.href = "actualizar_passCa.php";
                    })
            });
            </script> ';
    }
}

?>