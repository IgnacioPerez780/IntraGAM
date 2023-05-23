<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();
$_SESSION['promocion'] = "promocion";

//Evita acceder al portal con el redireccionamiento de páginas
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
    <link rel="stylesheet" type="text/css" href="css/tabla_menu_promocion.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_img_menu_promocion.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_generales_menu.css">
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
// Cabecera que mostrara para el agente en el ramo de autos
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else {
    include('plantillas/cabecera_general_menuP.php');
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

    <!-- TABLA / Menu para promocion -->
    <div class="container">
        <table class="table text-center">
            <tr>
                <td rowspan=3 id="td_vida_p">
                    <a href="consultor.php" style="color:white">
                        <div class="div_vida">
                            <button type="button">
                                <label>VIDA</label>
                                <img class="img_vida" src="img/Vida x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td id="td_autos_p">
                    <a href="autoscon.php" style="color:white">
                        <div class="div_auto">
                            <button type="button">
                                <label>AUTOS</label>
                                <img class="img_auto" src="img/Autos x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td rowspan=2 id="td_apoyo">
                    <a href="material_c.php" style="color:white">
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
                <td rowspan=2 id="td_siniestros_p">
                    <a href="siniestroscon.php" style="color:white">
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
                <td rowspan=2 id="td_respaldosD">
                    <a href="resp_digitales.php" style="color:white">
                        <div class="div_respaldoD">
                            <button type="button">
                                <label>RESP. DIGITALES</label>
                                <img class="img_respaldoD" src="img/Respaldo Digital .png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan=2 id="td_gmm_p">
                    <a href="gmmcon.php" style="color:white">
                        <div class="div_gmm">
                            <label class="gmm"> GASTOS MÉDICOS MAYORES</label><br>
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