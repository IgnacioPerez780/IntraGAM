<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();
$_SESSION['gdd'] = "gdd";

//Evita acceder al portal con el redireccionamiento de páginas
if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}

//Inactividad de la sesion 
if (isset($_SESSION['logged_in'])) {
    //Tiempo a medir en segundos (25 minutos)
    $inactive = 1500;
    //Verifica si $_SESSION["timeout"] esta configurado
    if (isset($_SESSION["timeout"])) {
        //Calcula el tiempo de vida en la sesion abierta
        $sessionTTL = time() - $_SESSION["timeout"];
        if ($sessionTTL > $inactive) {
            //Destruye la sesion en dado caso de superar el tiempo de inactividad
            session_destroy();
            //Usuarios que se les medira el tiempo de sesion en la plataforma
            date_default_timezone_set('America/Mexico_City');
            $hoy = date("Y-m-d");
            $nomusuario = $_SESSION['nomusuario'];
            $fecha1 = $_COOKIE["tiempo"];
            $fecha2 = date("H:i");
            $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
            $tiempoTotal = ($tiempo / 60 . " Minutos");
            if ($nomusuario == "Veronica S" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R" || $nomusuario == "Roberto R" || $nomusuario == "Omar S" || $nomusuario == "Martin G" || $nomusuario == "Nancy O" || $nomusuario == "Daniela V") {
                $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha) values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
                $inserT = mysqli_query($conexion, $ti);
            }
?>
            <script>
                window.location = 'index.php';
            </script>
<?php
        }
    }
    $_SESSION["timeout"] = time();
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" type="text/css" href="css/estilos_generales_menu.css">
    <link rel="stylesheet" type="text/css" href="css/tabla_menu_gdd.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_img_menu_gdd.css">
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<?php
// Cabecera que mostrara para los gdd
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else {
    include('plantillas/cabecera_general_gdd.php');
}
?>

<body>

    <!-- Barra de los inconos de las redes sociales -->
    <div class="wrapper">
        <ul class="iconBar">
            <li class="facebook">
                <a target="_blank" href="https://www.facebook.com/asesoresgam780">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    <div class="slider">
                        <p>facebook</p>
                    </div>
                </a>
            </li>
            <li class="twitter">
                <a target="_blank" href="https://twitter.com/asesoresgam780">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <div class="slider">
                        <p>twitter</p>
                    </div>
                </a>
            </li>

            <li class="instagram">
                <a target="_blank" href="https://www.instagram.com/asesoresgam780/">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <div class="slider">
                        <p>instagram</p>
                    </div>
                </a>
            </li>
            <li class="youtube">
                <a target="_blank" href="https://www.youtube.com/channel/UCtiG8e0Uufo4moCzM-R0Tpw/featured">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                    <div class="slider">
                        <p>youtube</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <!-- TABLA / Menu para gdd-->
    <div class="container">
        <table class="table text-center">
            <tr>
                <td rowspan=3 id="td_vida_colaborador">
                    <a href="colaborador_g.php" style="color:white">
                        <div class="div_vida">
                            <button type="button">
                                <label>VIDA</label>
                                <img class="img_vida" src="img/Vida x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td id="td_autos_colaborador">
                    <a href="autos_colab_g.php" style="color:white">
                        <div class="div_auto">
                            <button type="button">
                                <label>AUTOS</label>
                                <img class="img_auto" src="img/Autos x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td rowspan=2 id="td_apoyo">
                    <a href="material_gdd.php" style="color:white">
                        <div class="div_apoyo">
                            <button type="button">
                                <label>MAT. DE APOYO</label>
                                <img class="img_m_apoyo" src="img/Material de apoyo.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td rowspan=2 id="td_siniestros_colaborador">
                    <a href="siniestros_colab_g.php" style="color:white">
                        <div class="div_siniestros">
                            <label class="labelSiniestros"> SINIESTROS</label><br>
                            <button type="button">
                                <img class="img_siniestros" src="img/Siniestros x4.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td rowspan=2 id="td_mesaControl">
                    <a href="estadisticas_gam_gdd.php" style="color:white">
                        <div class="div_mesaControl">
                            <button type="button">
                                <label>ESTADÍSTICAS DE CTRL</label>
                                <img class="img_mesaControl" src="img/Estadísticas.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan=2 id="td_gmm_colaborador">
                    <a href="gmm_colab_g.php" style="color:white">
                        <div class="div_gmm">
                            <label class="labelGmm"> GASTOS MÉDICOS MAYORES</label><br>
                            <button type="button">
                                <img class="img_gmm" src="img/GMM x4.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>