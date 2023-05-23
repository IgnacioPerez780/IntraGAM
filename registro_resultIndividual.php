<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_POST['seleccion2'];
$fec1 = $_POST['date1'];
$fec2 = $_POST['date2'];

echo "Resultados de la b&uacute;squeda entre las fechas <b>" . $fec1 . "</b> / <b>" . $fec2 . "</b> de <b>$nombre</b><br>";

?>

<figure class="highcharts-figure">
    <div id="Carolina"></div>
</figure>


<table class="table text-center" id="sesiones">
    <thead>
        <tr>
            <td style="background:#7196d0;color:#fff;">Total Inicios de Sesi&oacute;n</td>
            <td style="background:#7196d0;color:#fff;">Total Min. De Sesi&oacute;n</td>
        </tr>
    </thead>

    <tbody>

        <!-- TOTAL INICIOS DE SESION -->
        <td style="background: #fff;">
            <small>
                <?php

                if ($nombre == 'ROBERTO RODRIGUEZ') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'CAROLINA HERNANDEZ MORA') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'DANTE VILLEGAS FONSECA') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Dante V' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'DIANA CASTRO GARCIA') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Diana C' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'GIOVANNI JOSUE MEJIA COLMENARES') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'KARLA BAHENA') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Karla B' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'VERONICA SANCHEZ MONTESINOS') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'MANUEL RAMIREZ') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'MARTÍN GALVÁN') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Martin G' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'NANCY ORTIZ ROJAS') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'OMAR SANTOS') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Omar S' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                } else if ($nombre == 'DANIELA VILLEDA GALLEGOS') {
                    $sql2 = "SELECT COUNT(id) FROM tiemposesion WHERE Consultor='Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result2 = mysqli_query($conexion, $sql2);
                    while ($ver2 = mysqli_fetch_row($result2)) {
                        $datos2 = $ver2[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos2;
                    }
                }

                ?>
            </small>
        </td>

        <!-- TOTAL MIN DE SESION -->
        <td style="background: #fff;">
            <small>
                <?php

                if ($nombre == 'ROBERTO RODRIGUEZ') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'CAROLINA HERNANDEZ MORA') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'DANTE VILLEGAS FONSECA') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Dante V' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'DIANA CASTRO GARCIA') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Diana C' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'GIOVANNI JOSUE MEJIA COLMENARES') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'KARLA BAHENA') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Karla B' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'VERONICA SANCHEZ MONTESINOS') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'MANUEL RAMIREZ') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'MARTÍN GALVÁN') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Martin G' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'NANCY ORTIZ ROJAS') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'OMAR SANTOS') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Omar S' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                } else if ($nombre == 'DANIELA VILLEDA GALLEGOS') {
                    $sql3 = "SELECT SUM(tiempoTotal) FROM tiemposesion WHERE Consultor='Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2'";
                    $result3 = mysqli_query($conexion, $sql3);
                    while ($ver3 = mysqli_fetch_row($result3)) {
                        $datos3 = $ver3[0];
                    }

                    if ($fec1 == '' or $fec2 == '') {
                        echo "0";
                    } else {
                        echo $datos3;
                    }
                }
                ?>
            </small>
        </td>

    </tbody>

</table>

<table class="table text-center">
    <thead>
        <tr class="datos">
            <td>Usuario</td>
            <td>Fecha</td>
            <td>Hora Inicial de Sesi&oacute;n</td>
            <td>Hora Final de Sesi&oacute;n</td>
            <td>Min. de Sesi&oacute;n</td>
        </tr>
    </thead>

    <!-- RESTO DEL REGISTRO -->
    <tbody class="resultados">
        <?php
        if ($nombre == 'ROBERTO RODRIGUEZ') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Roberto R' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);
            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
        ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>
                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'CAROLINA HERNANDEZ MORA') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Carolina H' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);

            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {

                ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'DANTE VILLEGAS FONSECA') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Dante V' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);

            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'DIANA CASTRO GARCIA') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Diana C' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);

            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {

                ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'GIOVANNI JOSUE MEJIA COLMENARES') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Giovanni M' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);

            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {

                ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'KARLA BAHENA') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Karla B' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);

            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {

                ?>

                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>

                <?php

                }
            }
        } else if ($nombre == 'VERONICA SANCHEZ MONTESINOS') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Veronica S' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);

            while ($row = $resultado->fetch_assoc()) {
                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>

                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'MANUEL RAMIREZ') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Manuel R' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);
            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'MARTÍN GALVÁN') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Martin G' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);
            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>

                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php

                }
            }
        } else if ($nombre == 'NANCY ORTIZ ROJAS') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Nancy O' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);
            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>
                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>
                <?php
                }
            }
        } else if ($nombre == 'OMAR SANTOS') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Omar S' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);
            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>

                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>

                <?php
                }
            }
        } else if ($nombre == 'DANIELA VILLEDA GALLEGOS') {
            $sql = "SELECT * FROM tiemposesion WHERE Consultor ='Daniela V' AND fecha BETWEEN '$fec1' AND '$fec2'";
            $resultado = mysqli_query($conexion, $sql);
            while ($row = $resultado->fetch_assoc()) {

                if ($row['Consultor'] == '' or $row['fecha'] == '' or $row['tiempoTotal'] == '') {
                } else {
                ?>

                    <tr>
                        <td>
                            <small>
                                <?php echo $row['Consultor']; ?>
                            </small>

                        </td>

                        <td>
                            <small>
                                <?php echo $row['fecha']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraInicio']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['HoraFin']; ?>
                            </small>
                        </td>

                        <td>
                            <small>
                                <?php echo $row['tiempoTotal']; ?>
                            </small>
                        </td>

                    </tr>

        <?php
                }
            }
        }
        ?>


    </tbody>

</table>