<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();


$fec1 = $_POST['date1T'];
$fec2 = $_POST['date2T'];

echo "Resultados de la b&uacute;squeda entre las fechas <b>" . $fec1 . "</b> / <b>" . $fec2 . "</b> de <b>TODOS LOS TIEMPOS DE SESIÓN</b><br>";

?>



<!-- TABLA CAROLINA -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            CAROLINA HERNANDEZ MORA
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            DANTE VILLEGAS FONSECA
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
        <td colspan=4 style="background:#7196d0;color:#fff;">
            DIANA CASTRO GARCIA
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
        <td colspan=4 style="background:#7196d0;color:#fff;">
            GIOVANNI JOSUE MEJIA COLMENARES
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
        <td colspan=4 style="background:#7196d0;color:#fff;">
            KARLA BAHENA
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
        <td colspan=4 style="background:#7196d0;color:#fff;">
            VERONICA SANCHEZ MONTESINOS
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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
    <td style="background: #fff;">
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

<!-- TABLA MANUEL -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            MANUEL RAMÍREZ
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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

<!-- TABLA MARTIN -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            MARTIN GALVÁN
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Martin G' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Martin G' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Martin G' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Martin G' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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

<!-- TABLA NANCY -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            NANCY ORTIZ
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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

<!-- TABLA DANIELA -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            DANIELA VILLEDA
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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

<!-- TABLA OMAR -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            OMAR SANTOS
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Omar S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Omar S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Omar S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Omar S' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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

<!-- TABLA ROBERTO -->

<table class="table table-hove table-condensed text-center">
    <tr>
        <td colspan=4 style="background:#7196d0;color:#fff;">
            ROBERTO RODRÍGUEZ
        </td>
    </tr>
    <tr>
        <td style="background:#555859;color:#fff;">
            Usuario
        </td>
        <td style="background:#555859;color:#fff;">
            Fecha
        </td>

        <td style="background:#555859;color:#fff;">
            Inicios de Sesi&oacute;n
        </td>

        <td style="background:#555859;color:#fff;">
            Min. De Sesi&oacute;n
        </td>
    </tr>

    <!-- USUARIO -->
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT Consultor as mi_contador FROM tiemposesion WHERE Consultor = 'Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT fecha as mi_contador FROM tiemposesion WHERE Consultor = 'Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT COUNT(*) as mi_contador FROM tiemposesion WHERE Consultor = 'Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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
    <td style="background: #fff;">
        <small>
            <?php
            $sql3V = "SELECT SUM(tiempoTotal) as mi_contador FROM tiemposesion WHERE Consultor = 'Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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