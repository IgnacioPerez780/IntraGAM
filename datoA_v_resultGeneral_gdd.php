<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$periodoGen = $_POST['periodoGeneral_v'];
$periodoSemG1 = $_POST['date1Sg_v'];
$periodoSemG2 = $_POST['date2Sg_v'];
$periodoMg = $_POST['periodoMensualG_v'];
$periodoTg = $_POST['periodoTrimestralG_v'];
$periodoSg = $_POST['periodoSemestralG_v'];
$yearG = $_POST['yearGeneral_v'];
$id = $_SESSION['id_usuario'];

?>

<!-- TABLA PARA ANUALIZADA -->
<div class="container">
    <div class="row">
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
                            if ($periodoGen == "semanalV") {
                                $sqlPrimaSem = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                $resultPrimaSem = mysqli_query($conexion, $sqlPrimaSem);
                                while ($verPrimaSem = mysqli_fetch_array($resultPrimaSem)) {
                                    $datoPrimaSem = $verPrimaSem[0];
                            ?>
                                    <label class="gmPesos">$<?= $datoPrimaSem . '<br>'; ?></label>
                                <?php
                                }
                                // MENSUAL 
                            } elseif ($periodoGen == "mensualV") {
                                $dayGeneralM = "01";
                                $yearGeneralM = $_POST['yearGeneral_v'];
                                $monthGeneralM = $_POST['periodoMensualG_v'];

                                $sqlPrimaM = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND MONTH(fl.fecha)='$monthGeneralM' AND YEAR(fl.fecha)='$yearGeneralM' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                $resultPrimaM = mysqli_query($conexion, $sqlPrimaM);
                                while ($verPrimaM = mysqli_fetch_array($resultPrimaM)) {
                                    $datoPrimaM = $verPrimaM[0];
                                ?>
                                    <label class="gmPesos">$<?= $datoPrimaM . '<br>'; ?></label>
                                    <?php
                                }
                                // TRIMESTRAL 
                            } elseif ($periodoGen == "trimestralV") {
                                $dayGeneralT = '01';
                                $monthGeneralT = $_POST['periodoTrimestralG_v'];
                                $yearGeneralT = $_POST['yearGeneral_v'];

                                if ($monthGeneralT == "primerTg_v") {
                                    $f1Tg = '01';
                                    $f2Tg = '03';
                                    $day2 = "31";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT1 = mysqli_query($conexion, $sqlPrimaT1);
                                    while ($verPrimaT1 = mysqli_fetch_array($resultPrimaT1)) {
                                        $datoPrimaT1 = $verPrimaT1[0];
                                    ?>
                                        <label class="gmPesos">$<?= $datoPrimaT1 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralT == "segundoTg_v") {
                                    $f1Tg = '04';
                                    $f2Tg = '06';
                                    $day2 = "30";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT2 = mysqli_query($conexion, $sqlPrimaT2);
                                    while ($verPrimaT2 = mysqli_fetch_array($resultPrimaT2)) {
                                        $datoPrimaT2 = $verPrimaT2[0];
                                    ?>
                                        <label class="gmPesos">$<?= $datoPrimaT2 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralT == "terceroTg_v") {
                                    $f1Tg = '07';
                                    $f2Tg = '09';
                                    $day2 = "30";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT3 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT3 = mysqli_query($conexion, $sqlPrimaT3);
                                    while ($verPrimaT3 = mysqli_fetch_array($resultPrimaT3)) {
                                        $datoPrimaT3 = $verPrimaT3[0];
                                    ?>
                                        <label class="gmPesos">$<?= $datoPrimaT3 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralT == "cuartoTg_v") {
                                    $f1Tg = '10';
                                    $f2Tg = '12';
                                    $day2 = "31";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT4 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT4 = mysqli_query($conexion, $sqlPrimaT4);
                                    while ($verPrimaT4 = mysqli_fetch_array($resultPrimaT4)) {
                                        $datoPrimaT4 = $verPrimaT4[0];
                                    ?>
                                        <label class="gmPesos">$<?= $datoPrimaT4 . '<br>'; ?></label>
                                    <?php
                                    }
                                }
                                // SEMESTRAL
                            } elseif ($periodoGen == "semestralV") {
                                $dayGeneralS = "01";
                                $yearGeneralS = $_POST['yearGeneral_v'];
                                $monthGeneralS = $_POST['periodoSemestralG_v'];

                                if ($monthGeneralS == "primerSg_v") {
                                    $fSg1 = '01';
                                    $fSg2 = '06';
                                    $day2 = '30';
                                    $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                                    $fechaGeneralSg1 = $date->format('Y-m-d');

                                    $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                                    $fechaGeneralSg2 = $date2->format('Y-m-d');
                                    $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                                    $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                                    $sqlPrimaS1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaS1 = mysqli_query($conexion, $sqlPrimaS1);
                                    while ($verPrimaS1 = mysqli_fetch_array($resultPrimaS1)) {
                                        $datoPrimaS1 = $verPrimaS1[0];
                                    ?>
                                        <label class="gmPesos">$<?= $datoPrimaS1 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralS == "segundoSg_v") {
                                    $fSg1 = '07';
                                    $fSg2 = '12';
                                    $day2 = '31';
                                    $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                                    $fechaGeneralSg1 = $date->format('Y-m-d');

                                    $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                                    $fechaGeneralSg2 = $date2->format('Y-m-d');
                                    $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                                    $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                                    $sqlPrimaS2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaS2 = mysqli_query($conexion, $sqlPrimaS2);
                                    while ($verPrimaS2 = mysqli_fetch_array($resultPrimaS2)) {
                                        $datoPrimaS2 = $verPrimaS2[0];
                                    ?>
                                        <label class="gmPesos">$<?= $datoPrimaS2 . '<br>'; ?></label>
                                    <?php
                                    }
                                }
                                // ANUAL
                            } elseif ($periodoGen == "anualV") {
                                $dayGeneralY = "01";
                                $yearGeneralY = $_POST['yearGeneral_v'];

                                $f1Y = '01';
                                $f2Y = '12';
                                $day2 = "31";
                                $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                                $fechaGeneralY1 = $date->format('Y-m-d');

                                $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                                $fechaGeneralY2 = $date1->format('Y-m-d');
                                $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                                $resultFechaY = date('Y-m-d', $nuevaFechaY);

                                $sqlPrimaAn = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND pe.moneda='PESOS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                $resultPrimaAn = mysqli_query($conexion, $sqlPrimaAn);
                                while ($verPrimaAn = mysqli_fetch_array($resultPrimaAn)) {
                                    $datoPrimaAn = $verPrimaAn[0];
                                    ?>
                                    <label class="gmPesos">$<?= $datoPrimaAn . '<br>'; ?></label>
                            <?php
                                }
                            }
                            ?>
                        </small>
                    </td>

                    <!-- DOLARES -->
                    <td >
                        <small>
                            <?php
                            if ($periodoGen == "semanalV") {
                                $sqlPrimaSem = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                $resultPrimaSem = mysqli_query($conexion, $sqlPrimaSem);
                                while ($verPrimaSem = mysqli_fetch_array($resultPrimaSem)) {
                                    $datoPrimaM = $verPrimaSem[0];
                            ?>
                                    <label class="gmDolares">$<?= $datoPrimaM . '<br>'; ?></label>
                                <?php
                                }
                                // MENSUAL
                            } elseif ($periodoGen == "mensualV") {
                                $dayGeneralM = "01";
                                $yearGeneralM = $_POST['yearGeneral_v'];
                                $monthGeneralM = $_POST['periodoMensualG_v'];

                                $sqlPrimaM = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND MONTH(fl.fecha)='$monthGeneralM' AND YEAR(fl.fecha)='$yearGeneralM' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                $resultPrimaM = mysqli_query($conexion, $sqlPrimaM);
                                while ($verPrimaM = mysqli_fetch_array($resultPrimaM)) {
                                    $datoPrimaM = $verPrimaM[0];
                                ?>
                                    <label class="gmDolares">$<?= $datoPrimaM . '<br>'; ?></label>
                                    <?php
                                }
                                // TRIMESTRAL
                            } elseif ($periodoGen == "trimestralV") {
                                $dayGeneralT = '01';
                                $monthGeneralT = $_POST['periodoTrimestralG_v'];
                                $yearGeneralT = $_POST['yearGeneral_v'];

                                if ($monthGeneralT == "primerTg_v") {
                                    $f1Tg = '01';
                                    $f2Tg = '03';
                                    $day2 = "31";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT1 = mysqli_query($conexion, $sqlPrimaT1);
                                    while ($verPrimaT1 = mysqli_fetch_array($resultPrimaT1)) {
                                        $datoPrimaT1 = $verPrimaT1[0];
                                    ?>
                                        <label class="gmDolares">$<?= $datoPrimaT1 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralT == "segundoTg_v") {
                                    $f1Tg = '04';
                                    $f2Tg = '06';
                                    $day2 = "30";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT2 = mysqli_query($conexion, $sqlPrimaT2);
                                    while ($verPrimaT2 = mysqli_fetch_array($resultPrimaT2)) {
                                        $datoPrimaT2 = $verPrimaT2[0];
                                    ?>
                                        <label class="gmDolares">$<?= $datoPrimaT2 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralT == "terceroTg_v") {
                                    $f1Tg = '07';
                                    $f2Tg = '09';
                                    $day2 = "30";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT3 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT3 = mysqli_query($conexion, $sqlPrimaT3);
                                    while ($verPrimaT3 = mysqli_fetch_array($resultPrimaT3)) {
                                        $datoPrimaT3 = $verPrimaT3[0];
                                    ?>
                                        <label class="gmDolares">$<?= $datoPrimaT3 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralT == "cuartoTg_v") {
                                    $f1Tg = '10';
                                    $f2Tg = '12';
                                    $day2 = "31";
                                    $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                                    $fecha1Tg = $date->format('Y-m-d');

                                    $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                                    $fecha2Tg = $date1->format('Y-m-d');
                                    $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                                    $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                                    $sqlPrimaT4 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaT4 = mysqli_query($conexion, $sqlPrimaT4);
                                    while ($verPrimaT4 = mysqli_fetch_array($resultPrimaT4)) {
                                        $datoPrimaT4 = $verPrimaT4[0];
                                    ?>
                                        <label class="gmDolares">$<?= $datoPrimaT4 . '<br>'; ?></label>
                                    <?php
                                    }
                                }
                                // SEMESTRAL
                            } elseif ($periodoGen == "semestralV") {
                                $dayGeneralS = "01";
                                $yearGeneralS = $_POST['yearGeneral_v'];
                                $monthGeneralS = $_POST['periodoSemestralG_v'];

                                if ($monthGeneralS == "primerSg_v") {
                                    $fSg1 = '01';
                                    $fSg2 = '06';
                                    $day2 = '30';
                                    $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                                    $fechaGeneralSg1 = $date->format('Y-m-d');

                                    $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                                    $fechaGeneralSg2 = $date2->format('Y-m-d');
                                    $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                                    $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                                    $sqlPrimaS1 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaS1 = mysqli_query($conexion, $sqlPrimaS1);
                                    while ($verPrimaS1 = mysqli_fetch_array($resultPrimaS1)) {
                                        $datoPrimaS1 = $verPrimaS1[0];
                                    ?>
                                        <label class="gmDolares">$<?= $datoPrimaS1 . '<br>'; ?></label>
                                    <?php
                                    }
                                } elseif ($monthGeneralS == "segundoSg_v") {
                                    $fSg1 = '07';
                                    $fSg2 = '12';
                                    $day2 = '31';
                                    $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                                    $fechaGeneralSg1 = $date->format('Y-m-d');

                                    $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                                    $fechaGeneralSg2 = $date2->format('Y-m-d');

                                    $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                                    $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                                    $sqlPrimaS2 = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                    $resultPrimaS2 = mysqli_query($conexion, $sqlPrimaS2);
                                    while ($verPrimaS2 = mysqli_fetch_array($resultPrimaS2)) {
                                        $datoPrimaS2 = $verPrimaS2[0];
                                    ?>
                                        <label class="gmDolares">$<?= $datoPrimaS2 . '<br>'; ?></label>
                                    <?php
                                    }
                                }
                                // ANUAL
                            } elseif ($periodoGen == "anualV") {
                                $dayGeneralY = "01";
                                $yearGeneralY = $_POST['yearGeneral_v'];

                                $f1Y = '01';
                                $f2Y = '12';
                                $day2 = "31";
                                $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                                $fechaGeneralY1 = $date->format('Y-m-d');

                                $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                                $fechaGeneralY2 = $date1->format('Y-m-d');
                                $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                                $resultFechaY = date('Y-m-d', $nuevaFechaY);

                                $sqlPrimaAn = "SELECT FORMAT(SUM(REPLACE(pe.primaAnual,',', '')),2) AS anualizada FROM polizasemitidas pe, folios fl, datos_agente da WHERE fl.estado='TERMINADO CON POLIZA' AND fl.id=pe.folio AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND pe.moneda='DLLS' AND da.id=fl.id_agente AND da.gdd='$id'";
                                $resultPrimaAn = mysqli_query($conexion, $sqlPrimaAn);
                                while ($verPrimaAn = mysqli_fetch_array($resultPrimaAn)) {
                                    $datoPrimaAn = $verPrimaAn[0];
                                    ?>
                                    <label class="gmDolares">$<?= $datoPrimaAn . '<br>'; ?></label>
                            <?php
                                }
                            }
                            ?>
                        </small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>


<!-- TABLA CON RESULTADOS ADICIONALES -->
<div class="container">
    <table class="table table-hove table-condensed table-bordered text-center" id="resultAdicionales">
        <tr>
            <td colspan=8 style="background-color:#7196D0;color: white;">
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                            echo $datoEstadoSem . '<br>';
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                            echo $datoEstadoM . '<br>';
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');

                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');

                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                            echo $datoEstadoSem . '<br>';
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                            echo $datoEstadoM . '<br>';
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                    ?>
                            <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                            <?php
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'ALTA DE POLIZA' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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

        <!-- TIPO DE SOLICITUD / MOVIMIENTOS-->
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                            echo $datoEstadoSem . '<br>';
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                            echo $datoEstadoM . '<br>';
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');

                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');

                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                            echo $datoEstadoSem . '<br>';
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                            echo $datoEstadoM . '<br>';
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                    ?>
                            <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                            <?php
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'MOVIMIENTOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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

        <!-- TIPO DE SOLICITUD / PAGOS-->
        <tr style="background: #FFFFFF;">
            <td class="tipoSolicitud">
                <small class="pagos">
                    <b>PAGOS</b>
                </small>
            </td>
            <!-- ESTATUS -->
            <td class="estatus">
                <small>
                    <?php
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                            echo $datoEstadoSem . '<br>';
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                            echo $datoEstadoM . '<br>';
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');

                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');

                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT DISTINCT(fl.estado) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                            echo $datoEstadoSem . '<br>';
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                            echo $datoEstadoM . '<br>';
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                                echo $datoEstadoT . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                                echo $datoEstadoS . '<br>';
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' GROUP BY estado ORDER BY estado";
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
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                    ?>
                            <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                            <?php
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.t_solicitud = 'PAGOS' AND fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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

        <!-- TOTAL DE FOLIOS ENTRE TODAS LAS SOLICITUDES -->
        <tr style="background: #FFFFFF;">
            <td colspan=3>
                <p class="tFoliosAcomulados">TOTAL:</p>
            </td>
            <td>
                <small>
                    <?php
                    if ($periodoGen == "semanalV") {
                        $sqlEstadoSem = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                        while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                            $datoEstadoSem = $verEstadoSem[0];
                    ?>
                            <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($periodoGen == "mensualV") {
                        $dayGeneralM = "01";
                        $yearGeneralM = $_POST['yearGeneral_v'];
                        $monthGeneralM = $_POST['periodoMensualG_v'];

                        $sqlEstadoM = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE MONTH(fl.fecha) = '$monthGeneralM' AND YEAR(fl.fecha) = '$yearGeneralM' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                        $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                        while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                            $datoEstadoM = $verEstadoM[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                            <?php
                        }
                    } elseif ($periodoGen == "trimestralV") {
                        $dayGeneralT = '01';
                        $monthGeneralT = $_POST['periodoTrimestralG_v'];
                        $yearGeneralT = $_POST['yearGeneral_v'];

                        if ($monthGeneralT == "primerTg_v") {
                            $f1Tg = '01';
                            $f2Tg = '03';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "segundoTg_v") {
                            $f1Tg = '04';
                            $f2Tg = '06';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "terceroTg_v") {
                            $f1Tg = '07';
                            $f2Tg = '09';
                            $day2 = "30";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralT == "cuartoTg_v") {
                            $f1Tg = '10';
                            $f2Tg = '12';
                            $day2 = "31";
                            $date = new DateTime($yearGeneralT . '-' . $f1Tg . '-' . $dayGeneralT);
                            $fecha1Tg = $date->format('Y-m-d');

                            $date1 = new DateTime($yearGeneralT . '-' . $f2Tg . '-' . $day2);
                            $fecha2Tg = $date1->format('Y-m-d');
                            $nuevaFechaTg = strtotime('+1 day', strtotime($fecha2Tg));
                            $resultFechaTg = date('Y-m-d', $nuevaFechaTg);

                            $sqlEstadoT = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fecha1Tg' AND '$resultFechaTg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
                            $resultEstadoT = mysqli_query($conexion, $sqlEstadoT);
                            while ($verEstadoT = mysqli_fetch_array($resultEstadoT)) {
                                $datoEstadoT = $verEstadoT[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoT . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "semestralV") {
                        $dayGeneralS = "01";
                        $yearGeneralS = $_POST['yearGeneral_v'];
                        $monthGeneralS = $_POST['periodoSemestralG_v'];

                        if ($monthGeneralS == "primerSg_v") {
                            $fSg1 = '01';
                            $fSg2 = '06';
                            $day2 = '30';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        } elseif ($monthGeneralS == "segundoSg_v") {
                            $fSg1 = '07';
                            $fSg2 = '12';
                            $day2 = '31';
                            $date = new DateTime($yearGeneralS . '-' . $fSg1 . '-' . $dayGeneralS);
                            $fechaGeneralSg1 = $date->format('Y-m-d');

                            $date2 = new DateTime($yearGeneralS . '-' . $fSg2 . '-' . $day2);
                            $fechaGeneralSg2 = $date2->format('Y-m-d');
                            $nuevaFechaSg = strtotime('+1 day', strtotime($fechaGeneralSg2));
                            $resultFechaSg = date('Y-m-d', $nuevaFechaSg);

                            $sqlEstadoS = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fechaGeneralSg1' AND '$resultFechaSg' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY fl.estado";
                            $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                            while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                                $datoEstadoS = $verEstadoS[0];
                            ?>
                                <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                            <?php
                            }
                        }
                    } elseif ($periodoGen == "anualV") {
                        $dayGeneralY = "01";
                        $yearGeneralY = $_POST['yearGeneral_v'];

                        $f1Y = '01';
                        $f2Y = '12';
                        $day2 = "31";
                        $date = new DateTime($yearGeneralY . '-' . $f1Y . '-' . $dayGeneralY);
                        $fechaGeneralY1 = $date->format('Y-m-d');

                        $date1 = new DateTime($yearGeneralY . '-' . $f2Y . '-' . $day2);
                        $fechaGeneralY2 = $date1->format('Y-m-d');
                        $nuevaFechaY = strtotime('+1 day', strtotime($fechaGeneralY2));
                        $resultFechaY = date('Y-m-d', $nuevaFechaY);

                        $sqlEstadoY = "SELECT COUNT(*) FROM folios fl, datos_agente da WHERE fl.fecha BETWEEN '$fechaGeneralY1' AND '$resultFechaY' AND da.id=fl.id_agente AND da.gdd='$id' ORDER BY estado";
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
</div>

<?php
if ($datoEstadoSem == 0 && $datoEstadoM == 0 && $datoEstadoT == 0 && $datoEstadoS == 0 && $datoEstadoY == 0 && is_null($datoPrimaSem) && is_null($datoPrimaM) && is_null($datoPrimaT1) && is_null($datoPrimaT2) && is_null($datoPrimaT3) && is_null($datoPrimaT4) && is_null($datoPrimaS1) && is_null($datoPrimaS2) && is_null($datoPrimaAn)) {
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