<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();


$fec1 = $_POST['date1K'];
$fec2 = $_POST['date2K'];

echo "Resultados de la b&uacute;squeda entre las fechas <b>" . $fec1 . "</b> / <b>" . $fec2 . "</b> del Consultor <b>KARLA BAHENA</b><br>";

?>

<figure class="highcharts-figure">
    <div id="Karla B"></div>
</figure>


<table class="table table-hove table-condensed text-center" id="sesionI_k">
    <thead>
        <tr style="background: #7196d0; color: #FFFFFF;">
            <td>Total Inicios de Sesi&oacute;n</td>
            <td>Total Min. De Sesi&oacute;n</td>
        </tr>
    </thead>
    <tbody>

        <td>
            <small>
                <?php
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

                ?>
            </small>
        </td>

        <td>
            <small>
                <?php
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


                ?>
            </small>
        </td>

    </tbody>

</table>

<table class="table table-striped text-center">
    <thead>
        <tr style="background: #7196d0; color: #FFFFFF;">
            <td>Usuario</td>
            <td>Fecha</td>
            <td>Hora Inicial de Sesi&oacute;n</td>
            <td>Hora Final de Sesi&oacute;n</td>
            <td>Min. de Sesi&oacute;n</td>
        </tr>
    </thead>
    <tbody>
        <?php

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
        <?php }
        } ?>


    </tbody>

</table>