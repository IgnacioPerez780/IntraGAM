<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();


$fec1 = $_POST['date1T'];
$fec2 = $_POST['date2T'];

echo "Resultados de la b&uacute;squeda entre las fechas <b>" . $fec1 . "</b> / <b>" . $fec2 . "</b> de <b>TODOS LOS CONSULTORES</b><br>";

?>

<figure class="highcharts-figure">
    <div id="Todos"></div>
</figure>


<!-- TABLA CAROLINA -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background: #7196d0; color: #FFFFFF;">
            CAROLINA HERNANDEZ MORA
        </td>
    </tr>
    <tr style="background: #555859; color: #FFFFFF;">
        <td>
            Usuario
        </td>
        <td>
            Fecha
        </td>

        <td>
            Inicios de Sesi&oacute;n
        </td>

        <td>
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- FECHA -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- INICIOS DE SESIÓN -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>

    </td>

    <!-- MIN. DE SESION -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

</table>

<!-- TABLA DANTE -->

<table class="table table-hove table-condensed text-center" style="border-radius: 20px !important;">
    <tr>
        <td colspan=4 style="background: #7196d0; color: #FFFFFF;">
            DANTE VILLEGAS FONSECA
        </td>
    </tr>
    <tr style="background: #555859; color: #FFFFFF;">
        <td>
            Usuario
        </td>
        <td>
            Fecha
        </td>

        <td>
            Inicios de Sesi&oacute;n
        </td>

        <td>
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Dante V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- FECHA -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Dante V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- INICIOS DE SESIÓN -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Dante V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- MIN. DE SESION -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Dante V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>
</table>

<!-- TABLA DIANA -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background: #7196d0; color: #FFFFFF;">
            DIANA CASTRO GARCIA
        </td>
    </tr>
    <tr style="background: #555859; color: #FFFFFF;">
        <td>
            Usuario
        </td>
        <td>
            Fecha
        </td>

        <td>
            Inicios de Sesi&oacute;n
        </td>

        <td>
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Diana C' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- FECHA -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Diana C' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>

    </td>

    <!-- INICIOS DE SESIÓN -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Diana C' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>

    </td>

    <!-- MIN. DE SESION -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Diana C' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>
</table>

<!-- TABLA GIOVANNI -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background: #7196d0; color: #FFFFFF;">
            GIOVANNI JOSUE MEJIA COLMENARES
        </td>
    </tr>
    <tr style="background: #555859; color: #FFFFFF;">
        <td>
            Usuario
        </td>
        <td>
            Fecha
        </td>

        <td>
            Inicios de Sesi&oacute;n
        </td>

        <td>
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- FECHA -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>

    </td>

    <!-- INICIOS DE SESIÓN -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>

    </td>

    <!-- MIN. DE SESION -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>
</table>

<!-- TABLA KARLA -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background: #7196d0; color: #FFFFFF;">
            KARLA BAHENA
        </td>
    </tr>
    <tr style="background: #555859; color: #FFFFFF;">
        <td>
            Usuario
        </td>
        <td>
            Fecha
        </td>

        <td>
            Inicios de Sesi&oacute;n
        </td>

        <td>
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Karla B' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);

            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- FECHA -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Karla B' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- INICIOS DE SESIÓN -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Karla B' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- MIN. DE SESION -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Karla B' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>
</table>

<!-- TABLA VERONICA -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background: #7196d0; color: #FFFFFF;">
            VERONICA SANCHEZ MONTESINOS
        </td>
    </tr>
    <tr style="background: #555859; color: #FFFFFF;">
        <td>
            Usuario
        </td>
        <td>
            Fecha
        </td>

        <td>
            Inicios de Sesi&oacute;n
        </td>

        <td>
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- FECHA -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- INICIOS DE SESIÓN -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>

    <!-- MIN. DE SESION -->
    <td>
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
            $result3V = mysqli_query($conexion, $sql3V);
            while ($ver3V = mysqli_fetch_array($result3V)) {
                $datos3V = $ver3V[0];

                if ($fec1 == '' or $fec2 == '') {
                } else {
                    echo $datos3V . '<br>';
                }
            }
            ?>
        </small>
    </td>
</table>