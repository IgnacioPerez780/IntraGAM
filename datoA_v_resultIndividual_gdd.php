<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$periodoIndividual = $_POST['periodoInd_v'];
$periodoSemInd1 = $_POST['date1Sind_v'];
$periodoSemInd2 = $_POST['date2Sind_v'];
$periodoMind = $_POST['periodoMensualInd_v'];
$periodoTind = $_POST['periodoTrimestralInd_v'];
$periodoSind = $_POST['periodoSemestralInd_v'];
$yearInd = $_POST['yearIndividual_v'];
$agente = $_POST['agente_v'];

$sqlAgente = "SELECT id FROM datos_agente WHERE nombre = '$agente'";
$resultAgente = mysqli_query($conexion, $sqlAgente);
$agente = mysqli_fetch_array($resultAgente);
$id_agente = $agente[0];

?>

<!-- TABLA PARA PRIMA ACOMULADA EN LAS ALTAS DE POLIZA -->
<table class="table table-hove table-condensed table-bordered text-center" id="tabla_primaAcomulada">
    <thead>
        <tr>
            <td colspan=3 style="background: #7196d0;color: #FFFFFF;">PRIMA ANUALIZADA</td>
        </tr>
    </thead>
    <tbody>
        <tr style="background:#FFFFFF;">
            <td rowspan=2 style="width: 240px;">
                <small>
                    <label class="labelAltP"><b>TERMINADO CON PÓLIZA</b></label>
                </small>
            </td>
            <td style="width:210px;background:#555859;color:#FFFFFF;">
                <small>
                    <label class="labelP">PESOS</label>
                </small>
            </td>
            <td style="width:210px;background:#555859;color:#FFFFFF;">
                <small>
                    <label class="labelD">DOLARES</label>
                </small>
            </td>
        </tr>
        <tr style="background: #FFFFFF;">
            <!-- PESOS -->
            <td>
                <small>
                    <!-- SEMANAL -->
                    <?php
                    if ($periodoIndividual == "semanalIndV") {
                        $sqlPrimaSem = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                        $resultPrimaSem = mysqli_query($conexion, $sqlPrimaSem);
                        while ($verPrimaSem = mysqli_fetch_array($resultPrimaSem)) {
                            $datoPrimaSem = $verPrimaSem[0];
                    ?>
                            <label class="gmPesos">$<?= $datoPrimaSem . '<br>'; ?></label>
                            <?php
                        }
                        // MENSUAL
                    } elseif ($periodoIndividual == "mensualIndV") {
                        $dayIndM = "01";
                        $yearIndM = $_POST['yearIndividual_v'];
                        $monthIndM = $_POST['periodoMensualInd_v'];

                        $sqlPrimaM = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND MONTH(fl.fecha)='$monthIndM' AND YEAR(fl.fecha)='$yearIndM' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                        $resultPrimaM = mysqli_query($conexion, $sqlPrimaM);
                        while ($verPrimaM = mysqli_fetch_array($resultPrimaM)) {
                            $datoPrimaM = $verPrimaM[0];
                    ?>
                            <label class="gmPesos">$<?= $datoPrimaM . '<br>'; ?></label>
                            <?php
                        }
                        // TRIMESTRAL
                    } elseif ($periodoIndividual == "trimestralIndV") {
                        $dayIndividualT = '01';
                        $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                        $yearIndividualT = $_POST['yearIndividual_v'];

                        if ($monthIndividualT == "primerTind_v") {
                            $f1Tind = '01';
                            $f2Tind = '03';
                            $day2 = "31";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT1 = mysqli_query($conexion, $sqlPrimaT1);
                            while ($verPrimaT1 = mysqli_fetch_array($resultPrimaT1)) {
                                $datoPrimaT1 = $verPrimaT1[0];
                            ?>
                                <label class="gmPesos">$<?= $datoPrimaT1 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualT == "segundoTind_v") {
                            $f1Tind = '04';
                            $f2Tind = '06';
                            $day2 = "30";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT2 = mysqli_query($conexion, $sqlPrimaT2);
                            while ($verPrimaT2 = mysqli_fetch_array($resultPrimaT2)) {
                                $datoPrimaT2 = $verPrimaT2[0];
                            ?>
                                <label class="gmPesos">$<?= $datoPrimaT2 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualT == "tercerTind_v") {
                            $f1Tind = '07';
                            $f2Tind = '09';
                            $day2 = "30";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT3 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT3 = mysqli_query($conexion, $sqlPrimaT3);
                            while ($verPrimaT3 = mysqli_fetch_array($resultPrimaT3)) {
                                $datoPrimaT3 = $verPrimaT3[0];
                            ?>
                                <label class="gmPesos">$<?= $datoPrimaT3 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualT == "cuartoTind_v") {
                            $f1Tind = '10';
                            $f2Tind = '12';
                            $day2 = "31";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT4 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT4 = mysqli_query($conexion, $sqlPrimaT4);
                            while ($verPrimaT4 = mysqli_fetch_array($resultPrimaT4)) {
                                $datoPrimaT4 = $verPrimaT4[0];
                            ?>
                                <label class="gmPesos">$<?= $datoPrimaT4 . '<br>'; ?></label>
                            <?php
                            }
                        }
                        // SEMESTRAL
                    } elseif ($periodoIndividual == "semestralIndV") {
                        $dayIndividualS = "01";
                        $yearIndividualS = $_POST['yearIndividual_v'];
                        $monthIndividualS = $_POST['periodoSemestralInd_v'];

                        if ($monthIndividualS == "primerSind_v") {
                            $fSind1 = '01';
                            $fSind2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                            $fechaIndividualS1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                            $fechaIndividualS2 = $date2->format('Y-m-d');
                            $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                            $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                            $sqlPrimaS1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                            $resultPrimaS1 = mysqli_query($conexion, $sqlPrimaS1);
                            while ($verPrimaS1 = mysqli_fetch_array($resultPrimaS1)) {
                                $datoPrimaS1 = $verPrimaS1[0];
                            ?>
                                <label class="gmPesos">$<?= $datoPrimaS1 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualS == "segundoSind_v") {
                            $fSind1 = '07';
                            $fSind2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                            $fechaIndividualS1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                            $fechaIndividualS2 = $date2->format('Y-m-d');
                            $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                            $resultFechaSind  = date('Y-m-d', $nuevaFechaSind);

                            $sqlPrimaS2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                            $resultPrimaS2 = mysqli_query($conexion, $sqlPrimaS2);
                            while ($verPrimaS2 = mysqli_fetch_array($resultPrimaS2)) {
                                $datoPrimaS2 = $verPrimaS2[0];
                            ?>
                                <label class="gmPesos">$<?= $datoPrimaS2 . '<br>'; ?></label>
                            <?php
                            }
                        }
                        // ANUAL
                    } elseif ($periodoIndividual == "anualIndV") {
                        $dayIndividualY = "01";
                        $yearIndividualY = $_POST['yearIndividual_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                        $fechaIndividualY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                        $fechaIndividualY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlPrimaY = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND pe.moneda='PESOS' AND fl.id_agente='$id_agente'";
                        $resultPrimaY = mysqli_query($conexion, $sqlPrimaY);
                        while ($verPrimaY = mysqli_fetch_array($resultPrimaY)) {
                            $datoPrimaY = $verPrimaY[0];
                            ?>
                            <label class="gmPesos">$<?= $datoPrimaY . '<br>'; ?></label>
                    <?php
                        }
                    }
                    ?>
                </small>
            </td>

            <!-- DOLARES -->
            <td>
                <small>
                    <!-- SEMANAL -->
                    <?php
                    if ($periodoIndividual == "semanalIndV") {
                        $sqlPrimaSem = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                        $resultPrimaSem = mysqli_query($conexion, $sqlPrimaSem);
                        while ($verPrimaSem = mysqli_fetch_array($resultPrimaSem)) {
                            $datoPrimaSem = $verPrimaSem[0];
                    ?>
                            <label class="gmDolares">$<?= $datoPrimaSem . '<br>'; ?></label>
                            <?php
                        }
                        // MENSUAL
                    } elseif ($periodoIndividual == "mensualIndV") {
                        $dayIndM = "01";
                        $yearIndM = $_POST['yearIndividual_v'];
                        $monthIndM = $_POST['periodoMensualInd_v'];
                        $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                        $fechaIndM = $date->format('Y-m-d');

                        $sqlPrimaM = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND MONTH(fl.fecha)='$monthIndM' AND YEAR(fl.fecha)='$yearIndM' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                        $resultPrimaM = mysqli_query($conexion, $sqlPrimaM);
                        while ($verPrimaM = mysqli_fetch_array($resultPrimaM)) {
                            $datoPrimaM = $verPrimaM[0];
                    ?>
                            <label class="gmDolares">$<?= $datoPrimaM . '<br>'; ?></label>
                            <?php
                        }
                        // TRIMESTRAL
                    } elseif ($periodoIndividual == "trimestralIndV") {
                        $dayIndividualT = '01';
                        $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                        $yearIndividualT = $_POST['yearIndividual_v'];

                        if ($monthIndividualT == "primerTind_v") {
                            $f1Tind = '01';
                            $f2Tind = '03';
                            $day2 = "31";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT1 = mysqli_query($conexion, $sqlPrimaT1);
                            while ($verPrimaT1 = mysqli_fetch_array($resultPrimaT1)) {
                                $datoPrimaT1 = $verPrimaT1[0];
                            ?>
                                <label class="gmDolares">$<?= $datoPrimaT1 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualT == "segundoTind_v") {
                            $f1Tind = '04';
                            $f2Tind = '06';
                            $day2 = "30";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT2 = mysqli_query($conexion, $sqlPrimaT2);
                            while ($verPrimaT2 = mysqli_fetch_array($resultPrimaT2)) {
                                $datoPrimaT2 = $verPrimaT2[0];
                            ?>
                                <label class="gmDolares">$<?= $datoPrimaT2 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualT == "tercerTind_v") {
                            $f1Tind = '07';
                            $f2Tind = '09';
                            $day2 = "30";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT3 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT3 = mysqli_query($conexion, $sqlPrimaT3);
                            while ($verPrimaT3 = mysqli_fetch_array($resultPrimaT3)) {
                                $datoPrimaT3 = $verPrimaT3[0];
                            ?>
                                <label class="gmDolares">$<?= $datoPrimaT3 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualT == "cuartoTind_v") {
                            $f1Tind = '10';
                            $f2Tind = '12';
                            $day2 = "31";
                            $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                            $fecha1Tind = $date->format('Y-m-d');

                            $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                            $fecha2Tind = $date1->format('Y-m-d');
                            $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                            $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                            $sqlPrimaT4 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                            $resultPrimaT4 = mysqli_query($conexion, $sqlPrimaT4);
                            while ($verPrimaT4 = mysqli_fetch_array($resultPrimaT4)) {
                                $datoPrimaT4 = $verPrimaT4[0];
                            ?>
                                <label class="gmDolares">$<?= $datoPrimaT4 . '<br>'; ?></label>
                            <?php
                            }
                        }
                        // SEMESTRAL
                    } elseif ($periodoIndividual == "semestralIndV") {
                        $dayIndividualS = "01";
                        $yearIndividualS = $_POST['yearIndividual_v'];
                        $monthIndividualS = $_POST['periodoSemestralInd_v'];

                        if ($monthIndividualS == "primerSind_v") {
                            $fSind1 = '01';
                            $fSind2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                            $fechaIndividualS1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                            $fechaIndividualS2 = $date2->format('Y-m-d');
                            $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                            $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                            $sqlPrimaS1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                            $resultPrimaS1 = mysqli_query($conexion, $sqlPrimaS1);
                            while ($verPrimaS1 = mysqli_fetch_array($resultPrimaS1)) {
                                $datoPrimaS1 = $verPrimaS1[0];
                            ?>
                                <label class="gmDolares">$<?= $datoPrimaS1 . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthIndividualS == "segundoSind_v") {
                            $fSind1 = '07';
                            $fSind2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                            $fechaIndividualS1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                            $fechaIndividualS2 = $date2->format('Y-m-d');
                            $nuevaFechaSInd = strtotime('+1 day', strtotime($fechaIndividualS2));
                            $resultFechaSInd = date('Y-m-d', $nuevaFechaSInd);

                            $sqlPrimaS2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                            $resultPrimaS2 = mysqli_query($conexion, $sqlPrimaS2);
                            while ($verPrimaS2 = mysqli_fetch_array($resultPrimaS2)) {
                                $datoPrimaS2 = $verPrimaS2[0];
                            ?>
                                <label class="gmDolares">$<?= $datoPrimaS2 . '<br>'; ?></label>
                            <?php
                            }
                        }
                        // ANUAL
                    } elseif ($periodoIndividual == "anualIndV") {
                        $dayIndividualY = "01";
                        $yearIndividualY = $_POST['yearIndividual_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                        $fechaIndividualY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                        $fechaIndividualY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlPrimaY = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND pe.moneda='DLLS' AND fl.id_agente='$id_agente'";
                        $resultPrimaY = mysqli_query($conexion, $sqlPrimaY);
                        while ($verPrimaY = mysqli_fetch_array($resultPrimaY)) {
                            $datoPrimaY = $verPrimaY[0];
                            ?>
                            <label class="gmDolares">$<?= $datoPrimaY . '<br>'; ?></label>
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
<table class="table table-hove table-condensed table-bordered text-center">
    <tr>
        <td colspan=8 style="background-color:#7196D0;color: white;">
            RESULTADOS ADICIONALES
        </td>
    </tr>
    <tr  style="background-color:#555859;color:#FFFFFF;">
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

    <!-- TIPO DE SOLICITUD / ALTA DE POLIZA-->
    <tr style="background: #FFFFFF;">
        <td class="tipoSolicitud">
            <small class="altaPoliza">
                <b>ALTA DE PÓLIZA</b>
            </small>
        </td>

        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO DE FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
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
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente'";
                    $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                    while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                        $datoEstadoS = $verEstadoS[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
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
            <small class="altaPoliza">
                <b>MOVIMIENTOS</b>
            </small>
        </td>

        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');
                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO DE FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
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
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente'";
                    $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                    while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                        $datoEstadoS = $verEstadoS[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>

    <!-- TIPO DE SOLICITUD / PAGOS-->
    <tr style="background: #FFFFFF;">
        <td class="tipoSolicitud">
            <small class="altaPoliza">
                <b>PAGOS</b>
            </small>
        </td>

        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente' ORDER BY estado";
                    $resultEstadoY = mysqli_query($conexion, $sqlEstadoY);
                    while ($verEstadoY = mysqli_fetch_array($resultEstadoY)) {
                        $datoEstadoY = $verEstadoY[0];
                        echo $datoEstadoY . '<br>';
                    }
                }
                ?>
            </small>
        </td>

        <!-- NÚMERO DE FOLIOS -->
        <td class="nFolio">
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                            echo $datoEstadoT . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente' GROUP BY estado ORDER BY estado";
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
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoM = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente'";
                    $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                    while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                        $datoEstadoS = $verEstadoS[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>
        </td>
    </tr>

    <!-- TOTAL DE FOLIOS ENTRE LOS TIPOS DE SOLICITUD -->
    <tr style="background: #FFFFFF;">
        <td colspan=3>
            <p class="tFoliosAcomulados">TOTAL:</p>
        </td>
        <td>
            <small>
                <?php
                if ($periodoIndividual == "semanalIndV") {
                    $sqlEstadoSem = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualIndV") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual_v'];
                    $monthIndM = $_POST['periodoMensualInd_v'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(id) FROM folios WHERE MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND id_agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "trimestralIndV") {
                    $dayIndividualT = '01';
                    $monthIndividualT = $_POST['periodoTrimestralInd_v'];
                    $yearIndividualT = $_POST['yearIndividual_v'];

                    if ($monthIndividualT == "primerTind_v") {
                        $f1Tind = '01';
                        $f2Tind = '03';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "segundoTind_v") {
                        $f1Tind = '04';
                        $f2Tind = '06';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "tercerTind_v") {
                        $f1Tind = '07';
                        $f2Tind = '09';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualT == "cuartoTind_v") {
                        $f1Tind = '10';
                        $f2Tind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualT . '-' . $f1Tind . '-' . $dayIndividualT);
                        $fecha1Tind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualT . '-' . $f2Tind . '-' . $day2);
                        $fecha2Tind = $date1->format('Y-m-d');

                        $nuevaFechaTind = strtotime('+1 day', strtotime($fecha2Tind));
                        $resultFechaTind = date('Y-m-d', $nuevaFechaTind);

                        $sqlEstadoT = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fecha1Tind' AND '$resultFechaTind' AND id_agente = '$id_agente'";
                        $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                        while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                            $datoEstadoT = $verEstadoT[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralIndV") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual_v'];
                    $monthIndividualS = $_POST['periodoSemestralInd_v'];

                    if ($monthIndividualS == "primerSind_v") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind_v") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND id_agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualIndV") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual_v'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(id) FROM folios WHERE fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND id_agente = '$id_agente'";
                    $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                    while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                        $datoEstadoS = $verEstadoS[0];
                        ?>
                        <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                <?php
                    }
                }
                ?>
            </small>

        </td>
    </tr>
</table>


<?php
if ($datoEstadoSem == 0 && $datoEstadoT == 0 && $datoEstadoS == 0 && $datoEstadoY == 0 && is_null($datoPrimaSem) && is_null($datoPrimaM) && is_null($datoPrimaT1) && is_null($datoPrimaT2) && is_null($datoPrimaT3) && is_null($datoPrimaT4) && is_null($datoPrimaS1) && is_null($datoPrimaS2) && is_null($datoPrimaAn)) {
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