<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" type="text/css" href="css/tabla_menu_digitalizacion.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_img_menu_digitalizacion.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_generales_menu.css">
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php 
// Cabecera que mostrara para el menu de cartera
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else {
    include('plantillas/cabecera_general_menuCartera.php');
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

   <!-- TABLA / Menu para cartera -->
    <div class="container">
        <table class="table text-center">
            <tr>
                <td id="td_vida_consultor">
                    <a href="colaborador_g.php" style="color:white">
                        <div class="div_vida">
                            <button type="button">
                                <label>VIDA</label>
                                <img class="img_vida" src="img/Vida x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td colspan=2 id="td_siniestros_consultor">
                    <a href="siniestros_colab_g.php" style="color:white">
                        <div class="div_siniestros">
                            <label class="labelSiniestros">SINIESTROS</label><br>
                            <button type="button">
                                <img class="img_siniestros" src="img/Siniestros x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td id="td_autos_consultor">
                    <a href="autos_colab_g.php" style="color:white">
                        <div class="div_auto">
                            <button type="button">
                                <label>AUTOS</label>
                                <img class="img_auto" src="img/Autos x4.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan=2 id="td_gmm_consultor">
                    <a href="gmm_colab_g.php" style="color:white">
                        <div class="div_gmm">
                            <button type="button">
                                <label>GASTOS MÉDICOS MAYORES</label>
                                <img class="img_gmm" src="img/GMM x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td colspan=2 id="td_digitalizacion_cartera">
                    <a href="digitalizacion_cartera.php" style="color:white">
                        <div class="div_digitalizacion">
                            <label>DIGITALIZACIÓN</label><br>
                            <button type="button">
                                <img class="img_m_digitalizacion" src="img/digitalizacion.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>