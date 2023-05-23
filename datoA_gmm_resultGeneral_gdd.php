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
$id = $_SESSION['id_usuario'];

?>

<!-- TABLA PARA PRIMA ACOMULADA EN LAS ALTAS DE POLIZA -->
<table class="table table-hove table-condensed table-bordered text-center" id="tabla_primaAcomuladaGmm">
    <tr>
        <td colspan=3 style="background: #7196d0;color: #FFFFFF;">PRIMA ACOMULADA</td>
    </tr>
    <tr>
        <td rowspan=5 style="width: 210px;background-color:#FFFFFF;">
            <small>
                <label class="labelAltPGmm"><b>ALTAS DE PÓLIZA</b></label>
            </small>
        </td>
        <td style="width: 210px;background-color:#555859;color:#FFFFFF;">
            <small>
                <label class="labelP" style="color: white;">NACIONAL</label>
            </small>
        </td>
        <td style="width: 210px;background-color:#555859;color:#FFFFFF;">
            <small>
                <label class="labelD" style="color: white;">INTERNACIONAL</label>
            </small>
        </td>
    </tr>

    <!-- ALTA DE POLIZAS -->
    <tr style="background-color:#FFFFFF;">
        <!-- NACIONAL -->
        <td>
            <small>
                <!-- SEMANAL -->
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="gmPesos">$<?= $datoEstadoSem . '<br>'; ?></label>
                    <?php
                    }
                    // MENSUAL
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id'";
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

                        $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id'";
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

                        $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg'AND da.id=fl.agente AND da.gdd='$id'";
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

                        $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id'";
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

                        $sqlEstadoS = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id'";
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

                        $sqlEstadoS = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id'";
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

                    $sqlEstadoY = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_apn = 'PESOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id'";
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

        <!-- INTERNACIONAL -->
        <td>
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="gmDolares">$<?= $datoEstadoSem . '<br>'; ?></label>
                    <?php
                    }
                    // MENSUAL
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                    ?>
                        <label class="gmDolares">$<?= $datoEstadoM . '<br>'; ?></label>
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

                        $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="gmDolares">$<?= $datoEstadoC . '<br>'; ?></label>
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

                        $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="gmDolares">$<?= $datoEstadoC . '<br>'; ?></label>
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

                        $sqlEstadoC = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="gmDolares">$<?= $datoEstadoC . '<br>'; ?></label>
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

                        $sqlEstadoS = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="gmDolares">$<?= $datoEstadoS . '<br>'; ?></label>
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

                        $sqlEstadoS = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND moneda_api = 'PESOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg'AND da.id=fl.agente AND da.gdd='$id'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="gmDolares">$<?= $datoEstadoS . '<br>'; ?></label>
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

                    $sqlEstadoY = "SELECT FORMAT(SUM(REPLACE(fl.prima,',', '')),2) AS prima FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND (NOT fl.estado = 'CANCELADO') AND moneda_api = 'PESOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id'";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        ?>
                        <label class="gmDolares">$<?= $datoEstadoY . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>


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
            TIPO DE SOLICITUD
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

    <!-- TIPO DE SOLICITUD / ALTA POLIZA NACIONAL -->
    <tr style="background: #FFFFFF;">
        <td class="tipoSolicitud">
            <small class="altaPolizaN">
                <b>ALTA PÓLIZA NAL.</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA NACIONAL' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

    <!-- TIPO DE SOLICITUD / ALTA POLIZA INTL-->
    <tr style="background: #FFFFFF;">
        <td class="tipoSolicitud">
            <small class="altaPolizaI">
                <b>ALTA PÓLIZA INTL.</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

    <!-- TIPO DE SOLICITUD / MOVIMIENTOS -->
    <tr style="background: #FFFFFF;">
        <td class="tipoSolicitud">
            <small class="movimientos">
               <b>MOVIMIENTOS</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT DISTINCT(fl.estado) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoGen == "mensual") {
                    $dayGeneralM = "01";
                    $yearGeneralM = $_POST['yearGeneral'];
                    $monthGeneralM = $_POST['periodoMensualG'];

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' GROUP BY fl.estado ORDER BY fl.estado";
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
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

    <!-- TOTAL DE FOLIOS ENTRE LAS SOLICITUDES -->
    <tr style="background: #FFFFFF;">
        <td colspan=3>
            <p class="tFoliosAcomulados">TOTAL:</p>
        </td>
        <td>
            <small>
                <?php
                if ($periodoGen == "semanal") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE DATE(fl.fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Cg' AND '$resultFechaCg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_g fl, datos_agente da WHERE fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.agente AND da.gdd='$id' ORDER BY fl.estado";
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