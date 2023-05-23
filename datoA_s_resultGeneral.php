<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$periodoGen = $_POST['periodoGeneral'];
$periodoSemG1 = $_POST['date1Sg'];
$periodoSemG2 = $_POST['date2Sg'];
$periodoMg = $_POST['periodoMensualG'];
$periodoCg = $_POST['periodoCuatrimestralG'];
$periodoSg = $_POST['periodoSemestralG'];
$yearG = $_POST['yearGeneral'];

?>

<!-- TABLA PARA MONTO ACOMULADO EN GMM -->
<table class="table table-hove table-condensed table-bordered text-center" id="tabla_montoR">
    <thead>
        <tr>
            <td colspan=3 style="background: #7196d0;color: #FFFFFF;">MONTO RECLAMADO</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan=2 style="width: 275px; background-color:#FFFFFF;">
                <small>
                    <label class="tGmm">GASTOS MÉDICOS MAYORES</label>
                </small>
            </td>
            <td style="width:275px;background-color:#555859;color:#FFFFFF;">
                <small>
                    <label class="labelGmm">TOTAL</label>
                </small>
            </td>
        </tr>

        <!-- MONTO -->
        <tr style="background-color:#FFFFFF;">
            <td>
                <small>
                    <!-- SEMANAL -->
                    <?php
                    if ($periodoGen == "semanal") {
                        $sqlEstadoSem = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS prima FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                    ?>
                            <label class="gmPesos">$<?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                        }
                        //MENSUAL 
                    } elseif ($periodoGen == "mensual") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral'];
                        $monthGeneralM = $_POST['periodoMensualG'];
                        $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                        $fechaGeneralM = $date->format('Y-m-d');

                        $sqlEstadoM = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM'";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                    ?>
                            <label class="gmPesos">$<?= $datoEstadoM . '<br>'; ?></label>
                            <?php
                        }
                        // CUATRIMESTRAL
                    } elseif ($periodoGen == "cuatrimestral") {
                        $dayGeneralC = '01';
                        $monthGeneralC = $_POST['periodoCuatrimestralG'];
                        $yearGeneralC = $_POST['yearGeneral'];

                        if ($monthGeneralC == "primerCg") {
                            $f1Cg = '01';
                            $f2Cg = '04';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                            $fecha1Cg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                            $fecha2Cg = $date1->format('Y-m-d');

                            $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                            $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                            $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg'";
                            $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                            while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                                $datoEstadoC = $verEstadoC[0];
                            ?>
                                <label class="gmPesos">$<?= $datoEstadoC . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralC == "segundoCg") {
                            $f1Cg = '05';
                            $f2Cg = '08';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                            $fecha1Cg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                            $fecha2Cg = $date1->format('Y-m-d');

                            $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                            $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                            $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg'";
                            $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                            while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                                $datoEstadoC = $verEstadoC[0];
                            ?>
                                <label class="gmPesos">$<?= $datoEstadoC . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralC == "terceroCg") {
                            $f1Cg = '09';
                            $f2Cg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                            $fecha1Cg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                            $fecha2Cg = $date1->format('Y-m-d');

                            $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                            $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                            $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg'";
                            $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                            while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                                $datoEstadoC = $verEstadoC[0];
                            ?>
                                <label class="gmPesos">$<?= $datoEstadoC . '<br>'; ?></label>
                            <?php
                            }
                        }
                        // SEMESTRAL
                    } elseif ($periodoGen == "semestral") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral'];
                        $monthGeneralS = $_POST['periodoSemestralG'];

                        if ($monthGeneralS == "primerSg") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');

                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg'";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="gmPesos">$<?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralS == "segundoSg") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');

                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg'";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="gmPesos">$<?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        }
                        // ANUAL
                    } elseif ($periodoGen == "anual") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');

                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT FORMAT(SUM(REPLACE(total,',', '')),2) AS total FROM folios_s WHERE linea_s = 'GMM' AND (NOT estado = 'CANCELADO') AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY'";
                        $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                        while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                            $datoEstadoY = $verEstadoY[0];
                            ?>
                            <label class="gmPesos">$<?= $datoEstadoY . '<br>'; ?></label>
                    <?php
                        }
                    }
                    ?>
                </small>
            </td>

        </tr>
    </tbody>
</table>

<!-- TABLA CON RESULTADOS ADICIONALES -->
<table class="table table-hove table-condensed table-bordered text-center" id="resultAdicionales">
    <tr>
        <td colspan=8 style="background: #7196d0;color: #FFFFFF;">
            RESULTADOS ADICIONALES
        </td>
    </tr>
    <tr style="background-color:#555859;color:#FFFFFF;">
        <td style="font-size:14px;">
            LÍNEA DE NEGOCIO
        </td>
        <td style="font-size:14px;">
            ESTATUS
        </td>
        <td style="font-size:14px;">
            NRO. DE FOLIOS
        </td>
        <td style="font-size:14px;">
            TOTAL DE FOLIOS
        </td>
    </tr>

    <!-- TIPO DE SOLICITUD / GMM -->
    <tr style="background-color:#FFFFFF;">
        <td class="lineaNegocio">
            <small class="gmm">
               <b>GASTOS MÉDICOS MAYORES</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") { 
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);


                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {

                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' GROUP BY estado ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- TOTAL DE FOLIOS -->
        <td class="tFolios">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoY . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>

    <!-- TIPO DE SOLICITUD / AUTOS -->
    <tr style="background-color:#FFFFFF;">
        <td class="lineaNegocio">
            <small class="autos">
                <b>AUTOS</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);


                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {

                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' GROUP BY estado ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- TOTAL DE FOLIOS -->
        <td class="tFolios">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoY . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>

    <!-- TIPO DE SOLICITUD / VIDA -->
    <tr style="background-color:#FFFFFF;">
        <td class="lineaNegocio">
            <small class="vida">
                <b>VIDA</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);


                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {

                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' GROUP BY estado ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- TOTAL DE FOLIOS -->
        <td class="tFolios">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoY . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>

    <!-- TIPO DE SOLICITUD / DANOS -->
    <tr style="background-color:#FFFFFF;">
        <td class="lineaNegocio">
            <small class="danos">
                <b>DAÑOS</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);


                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {

                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];

                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];

                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' GROUP BY estado ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];

                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- TOTAL DE FOLIOS -->
        <td class="tFolios">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoY . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>

    <!-- TOTAL DE FOLIOS ENTRE LAS LINEAS DE NEGOCIO -->
    <tr style="background-color:#FFFFFF;">
        <td colspan=3>
            <p class="tFoliosAcomulados">TOTAL:</p>
        </td>
        <td>
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(id) FROM folios_s WHERE DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];
                    $date = new DateTime($yearGeneralM . '-' . $monthGeneralM . '-' . $dayGeneralM);
                    $fechaGeneralM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(id) FROM folios_s WHERE MONTH(fecha) = '$monthGeneralM' AND YEAR(fecha) = '$yearGeneralM' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoGen == "cuatrimestral") {
                    $dayGeneralC = '01';
                    $monthGeneralC = $_POST['periodoCuatrimestralG'];
                    $yearGeneralC = $_POST['yearGeneral'];

                    if ($monthGeneralC == "primerCg") {
                        $f1Cg = '01';
                        $f2Cg = '04';
                        $day2 = "30";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(id) FROM folios_s WHERE fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "segundoCg") {
                        $f1Cg = '05';
                        $f2Cg = '08';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(id) FROM folios_s WHERE fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralC == "terceroCg") {
                        $f1Cg = '09';
                        $f2Cg = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralC . '-' . $f1Cg . '-' . $dayGeneralC);
                        $fecha1Cg = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralC . '-' . $f2Cg . '-' . $day2);
                        $fecha2Cg = $date1->format('Y-m-d');

                        $nuevaFechaCg = strtotime('+1 day', strtotime($fecha2Cg));
                        $resultFechaCg = date('Y-m-d', $nuevaFechaCg);

                        $sqlEstadoC = "SELECT COUNT(id) FROM folios_s WHERE fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "semestral") {
                    $dayGeneralS = "01";
                    $yearGeneralS = $_POST['yearGeneral'];
                    $monthGeneralS = $_POST['periodoSemestralG'];

                    if ($monthGeneralS == "primerSg") {
                        $fSg1 = '01';
                        $fSg2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(id) FROM folios_s WHERE fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthGeneralS == "segundoSg") {
                        $fSg1 = '07';
                        $fSg2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                        $fechaGeneralSg1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                        $fechaGeneralSg2 = $date2->format('Y-m-d');

                        $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                        $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                        $sqlEstadoS = "SELECT COUNT(id) FROM folios_s WHERE fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoGen == "anual") {
                    $dayGeneralY = "01";
                    $yearGeneralY = $_POST['yearGeneral'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                    $fechaGeneralY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                    $fechaGeneralY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(id) FROM folios_s WHERE fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoY . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>
</table>

<?php
if ($datoEstadoSem == 0 && $datoEstadoM == 0 && $datoEstadoC == 0 && $datoEstadoS == 0 && $datoEstadoY == 0) {
    // echo '<script>alert("\t No hay datos para mostrar en la consulta solicitada.");</script>';
    echo '<script>
	swal({
                  title: "¡Sin Datos!",
                  text: "No hay datos para mostrar en la consulta solicitada",
                  type: "error",
                  allowOutsideClick: false
                });
                hasError = true;
  </script>';
}
?>