<?php
error_reporting(2);
session_start();

// Redirecciona si el usuario ingresado no es el correcto 
if (isset($_SESSION['logged_in']) === true)
    header('location: dashboard.php');


// Inicia conexion
if (isset($_POST['enviar'])) {
    include 'app/conexion.php';
    $conexion = conexion();

    if (isset($_POST['nomusuario']) && !empty($_POST['nomusuario']) && isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {
        $nomusuario = htmlentities(addslashes($_POST['nomusuario']));
        $contrasena = htmlentities($_POST['contrasena']);
        $contrasena = hash("sha512", $contrasena);
        $consulta_nombre = "SELECT do.id, do.correo, do.nomusuario, do.id_tipo_usuario
             FROM datos_operativos as do WHERE do.nomusuario='$nomusuario' and do.password = '$contrasena'
              UNION ALL 
             select da.id, da.correo, da.nomusuario, da.id_tipo_usuario from datos_agente  as da 
             WHERE da.nomusuario='$nomusuario' and da.password = '$contrasena'";
        //echo "query: <br>".$consulta_nombre . "<br>";
        $resultado_consulta = mysqli_query($conexion, $consulta_nombre);
        $inicio = mysqli_fetch_array($resultado_consulta);
        //var_dump($sesion);die()
        if (mysqli_num_rows($resultado_consulta) > 0) {
            session_start();
            $_SESSION['nomusuario'] = $inicio['nomusuario'];
            $_SESSION['rol'] = $inicio['id_tipo_usuario'];
            $_SESSION['id_usuario'] = $inicio['id'];
            $_SESSION['logged_in'] = true;

            if ($inicio['id_tipo_usuario'] == 1) {
                header("location: menu_agente.php");
            } else if ($inicio['id_tipo_usuario'] == 4) { //Se agrega linea para el usuario colaborador
                date_default_timezone_set('America/Mexico_City');
                $fecha = date("H:i");
                setcookie("tiempo", $fecha);
                header("location: menu_colaborador.php");
            } else if ($inicio['id_tipo_usuario'] == 5) { //Se agrega linea para el usuario coordinacion Agentes
                header("location: material_c.php");
            } else if ($inicio['id_tipo_usuario'] == 6) { //SE AGREGA LINEA PARA EL USUARIO GDD
                /* SE AGREGA COKKIE PARA MEDIR TIEMPO DEL GDD*/
                date_default_timezone_set('America/Mexico_City');
                $fecha = date("H:i");
                setcookie("tiempo", $fecha);
                header("location: menu_gdd.php");
            } else if ($inicio['id_tipo_usuario'] == 7) { //Se agrega linea registros de actividad en el Portal 
                header("location: actividad_portal.php");
            } else if ($inicio['id_tipo_usuario'] == 8) { // Se agrega linea para digitalizacion
                header("location: menu_cartera.php");
            } else if ($inicio['id_tipo_usuario'] == 9) { // Se agrega linea para promocion
                header("location: menu_p.php");
            } else {
                /*Se crea la cookie para medir tiempo de sesion */
                date_default_timezone_set('America/Mexico_City');
                $fecha = date("H:i");
                setcookie("tiempo", $fecha);
                header("location: menu_consultor.php");
            }
        } else {
            echo "<link rel='icon' type='image/x-icon' href='img/logo_intra1.ico'>
                  <svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
                    <symbol id='exclamation-triangle-fill' fill='currentColor' viewBox='0 0 16 16'>
                    <path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                    </symbol>
                  </svg>

                  <div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/>
                    <div class='textAlert'>
                        ¡Datos Incorrectos!
                    </div>
                    </svg>
                 </div>";
            session_destroy();
        }
    }
    mysqli_close($conexion);
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Intra GAM</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
    <link rel="stylesheet" href="css/hoja_index.css">

    <!-- Libraries for modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">

    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>

<body>

    <!-- Formulario para ingreso -->
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>¡Bienvenido!</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <a target="_blank" href="https://www.facebook.com/asesoresgam780"><span><i class="fab fa-facebook-square"></i></span></a>
                        <a target="_blank" href="https://twitter.com/asesoresgam780"><span><i class="fab fa-twitter-square"></i></span></a>
                        <a target="_blank" href="https://www.instagram.com/asesoresgam780/"><span><i class="fab fa-instagram-square"></i></span></a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Usuario" name="nomusuario" id="nomusuario" required>

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <a href="#" class="toggle_hide_password">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" id="contrasena" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="enviar" class="btn float-right login_btn">Ingresar</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <a class="enlaceAviso" target="_blank" href="aviso-de-privacidad.php">Aviso de Privacidad</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de pagina -->
    <footer align="center">
        <div class="container text-center" align="center">
            <span>&#9400 2019 Grupo Administrativo Mexicano S.A de C.V | Todos los derechos reservados</span>
        </div>
    </footer>


    <script>
        //Tiempo de visualizacion en alerta
        window.setTimeout(function() {
                $(".alert").fadeTo(300, 0).slideUp(300, function() {
                    $(this).remove();
                });
            },
            3000);

        // Visualizar password con icono 
        $(document).ready(function() {
            // target the link
            $(".toggle_hide_password").on('click', function(e) {
                e.preventDefault()
                // get input group of clicked link
                var input_group = $(this).closest('.input-group')
                // find the input, within the input group
                var input = input_group.find('input.form-control')
                // find the icon, within the input group
                var icon = input_group.find('i')
                // toggle field type
                input.attr('type', input.attr("type") === "text" ? 'password' : 'text')
                // toggle icon class
                icon.toggleClass('fa-eye-slash fa-eye')
            })
        })
    </script>
</body>

</html>