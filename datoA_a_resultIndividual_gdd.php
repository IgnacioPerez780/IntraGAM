<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$periodoIndividual = $_POST['periodoInd'];
$periodoSemInd1 = $_POST['date1Sind'];
$periodoSemInd2 = $_POST['date2Sind'];
$periodoMind = $_POST['periodoMensualInd'];
$periodoCind = $_POST['periodoCuatrimestralInd'];
$periodoSind = $_POST['periodoSemestralInd'];
$yearInd = $_POST['yearIndividual'];
$agente = $_POST['agente'];

$sqlAgente = "SELECT id FROM datos_agente WHERE nombre = '$agente'";
$resultAgente = mysqli_query($conexion, $sqlAgente);
$agente = mysqli_fetch_array($resultAgente);
$id_agente = $agente[0];

?>

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

    <!-- TIPO DE SOLICITUD / NUEVO NEGOCIO-->
    <tr style="background: #FFFFFF;">
        <td class="tipoSolicitud">
            <small class="nNegocio">
                <b>NUEVO NEGOCIO</b>
            </small>
        </td>
        <!-- ESTATUS -->
        <td class="estatus">
            <small>
                <?php
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente' ORDER BY estado";
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
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
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
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente'";
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
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente' ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];

                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente' ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];

                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT DISTINCT(estado) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente' ORDER BY estado";
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
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                        echo $datoEstadoSem . '<br>';
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                        echo $datoEstadoM . '<br>';
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                            echo $datoEstadoC . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {
                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                            echo $datoEstadoS . '<br>';
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoY = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente' GROUP BY estado ORDER BY estado";
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
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente'";
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

    <!-- TOTAL DE FOLIOS ENTRE TODOS LOS TIPOS DE SOLICITUD -->
    <tr style="background: #FFFFFF;">
        <td colspan=3>
            <p class="tFoliosAcomulados">TOTAL:</p>
        </td>
        <td>
            <small>
                <?php
                if ($periodoIndividual == "semanalInd") {
                    $sqlEstadoSem = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente'";
                    $resultEstadoSem = mysqli_query($conexion, $sqlEstadoSem);
                    while ($verEstadoSem = mysqli_fetch_array($resultEstadoSem)) {
                        $datoEstadoSem = $verEstadoSem[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoSem . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "mensualInd") {
                    $dayIndM = "01";
                    $yearIndM = $_POST['yearIndividual'];
                    $monthIndM = $_POST['periodoMensualInd'];
                    $date = new DateTime($yearIndM . '-' . $monthIndM . '-' . $dayIndM);
                    $fechaIndM = $date->format('Y-m-d');

                    $sqlEstadoM = "SELECT COUNT(*) FROM folios_a WHERE MONTH(fecha) = '$monthIndM' AND YEAR(fecha) = '$yearIndM' AND agente = '$id_agente'";
                    $resultEstadoM = mysqli_query($conexion, $sqlEstadoM);
                    while ($verEstadoM = mysqli_fetch_array($resultEstadoM)) {
                        $datoEstadoM = $verEstadoM[0];
                ?>
                        <label class="totalFolios"><?= $datoEstadoM . '<br>'; ?></label>
                        <?php
                    }
                } elseif ($periodoIndividual == "cuatrimestralInd") {
                    $dayIndividualC = '01';
                    $monthIndividualC = $_POST['periodoCuatrimestralInd'];
                    $yearIndividualC = $_POST['yearIndividual'];

                    if ($monthIndividualC == "primerCind") {
                        $f1Cind = '01';
                        $f2Cind = '04';
                        $day2 = "30";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualC == "segundoCind") {
                        $f1Cind = '05';
                        $f2Cind = '08';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualC == "tercerCind") {
                        $f1Cind = '09';
                        $f2Cind = '12';
                        $day2 = "31";
                        $date = new DateTime($yearIndividualC . '-' . $f1Cind . '-' . $dayIndividualC);
                        $fecha1Cind = $date->format('Y-m-d');

                        $date1 = new DateTime($yearIndividualC . '-' . $f2Cind . '-' . $day2);
                        $fecha2Cind = $date1->format('Y-m-d');

                        $nuevaFechaCind = strtotime('+1 day', strtotime($fecha2Cind));
                        $resultFechaCind = date('Y-m-d', $nuevaFechaCind);

                        $sqlEstadoC = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1Cind' AND '$resultFechaCind' AND agente = '$id_agente'";
                        $resultEstadoC = mysqli_query($conexion, $sqlEstadoC);
                        while ($verEstadoC = mysqli_fetch_array($resultEstadoC)) {
                            $datoEstadoC = $verEstadoC[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoC . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "semestralInd") {

                    $dayIndividualS = "01";
                    $yearIndividualS = $_POST['yearIndividual'];
                    $monthIndividualS = $_POST['periodoSemestralInd'];

                    if ($monthIndividualS == "primerSind") {
                        $fSind1 = '01';
                        $fSind2 = '06';
                        $day2 = '30';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    } elseif ($monthIndividualS == "segundoSind") {
                        $fSind1 = '07';
                        $fSind2 = '12';
                        $day2 = '31';
                        $date = new DateTime($yearIndividualS . '-' . $fSind1 . '-' . $dayIndividualS);
                        $fechaIndividualS1 = $date->format('Y-m-d');

                        $date2 = new DateTime($yearIndividualS . '-' . $fSind2 . '-' . $day2);
                        $fechaIndividualS2 = $date2->format('Y-m-d');

                        $nuevaFechaSind = strtotime('+1 day', strtotime($fechaIndividualS2));
                        $resultFechaSind = date('Y-m-d', $nuevaFechaSind);

                        $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fechaIndividualS1' AND '$resultFechaSind' AND agente = '$id_agente'";
                        $resultEstadoS = mysqli_query($conexion, $sqlEstadoS);
                        while ($verEstadoS = mysqli_fetch_array($resultEstadoS)) {
                            $datoEstadoS = $verEstadoS[0];
                        ?>
                            <label class="totalFolios"><?= $datoEstadoS . '<br>'; ?></label>
                        <?php
                        }
                    }
                } elseif ($periodoIndividual == "anualInd") {
                    $dayIndividualY = "01";
                    $yearIndividualY = $_POST['yearIndividual'];

                    $f1Y = '01';
                    $f2Y = '12';
                    $day2 = "31";
                    $date = new DateTime($yearIndividualY . '-' . $f1Y . '-' . $dayIndividualY);
                    $fechaIndividualY1 = $date->format('Y-m-d');

                    $date1 = new DateTime($yearIndividualY . '-' . $f2Y . '-' . $day2);
                    $fechaIndividualY2 = $date1->format('Y-m-d');

                    $nuevaFechaY = strtotime('+1 day', strtotime($fechaIndividualY2));
                    $resultFechaY = date('Y-m-d', $nuevaFechaY);

                    $sqlEstadoS = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fechaIndividualY1' AND '$resultFechaY' AND agente = '$id_agente'";
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