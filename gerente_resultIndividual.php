<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$agente_v = $_POST['agente_v'];
$periodoInd_v = $_POST['periodoInd_v'];
$periodoSemInd1_v = $_POST['date1Sind_v'];
$periodoSemInd2_v = $_POST['date2Sind_v'];
$periodoMensualInd_v = $_POST['periodoMensualInd_v'];
$periodoTrimestralInd_v = $_POST['periodoTrimestralInd_v'];
$periodoSemestralInd_v = $_POST['periodoSemestralInd_v'];
$añoInd_v = $_POST['añoInd_v'];

$consulta = "SELECT id FROM datos_agente WHERE nombre = '$agente_v'";
$resultAgente = mysqli_query($conexion, $consulta);
$agente_v = mysqli_fetch_array($resultAgente);
$id_agente = $agente_v[0];

/* echo $id_agente . '<br>';*/


if ($periodoMensualInd_v == "1") {
    $meses = "ENERO";
}
if ($periodoMensualInd_v == "2") {
    $meses = "FEBRERO";
}
if ($periodoMensualInd_v == "3") {
    $meses = "MARZO";
}
if ($periodoMensualInd_v == "4") {
    $meses = "ABRIL";
}
if ($periodoMensualInd_v == "5") {
    $meses = "MAYO";
}
if ($periodoMensualInd_v == "6") {
    $meses = "JUNIO";
}
if ($periodoMensualInd_v == "7") {
    $meses = "JULIO";
}
if ($periodoMensualInd_v == "8") {
    $meses = "AGOSTO";
}
if ($periodoMensualInd_v == "9") {
    $meses = "SEPTIEMBRE";
}
if ($periodoMensualInd_v == "10") {
    $meses = "OCTUBRE";
}
if ($periodoMensualInd_v == "11") {
    $meses = "NOVIEMBRE";
}
if ($periodoMensualInd_v == "12") {
    $meses = "DICIEMBRE";
}



/*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
if ($periodoInd_v == "1ind_v") {
    $day = "01";
    $year = $_POST['añoInd_v'];
    $month = $_POST['periodoMensualInd_v'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha = $date->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    /*echo $fecha;*/

    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE TRIMESTRAL*/
if ($periodoInd_v == "3ind_v") {
    $day = "01";
    $mes = $_POST['periodoTrimestralInd_v'];
    $year = $_POST['añoInd_v'];

    if ($mes == "1") {
        $f1 = '01';
        $f2 = '03';
        $day2 = "31";
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }

    if ($mes == "2") {
        $f1 = '04';
        $f2 = '06';
        $day2 = '30';
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }

    if ($mes == "3") {
        $f1 = '07';
        $f2 = '09';
        $day2 = '30';
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*   echo $datosAgente . '<br>';*/
        }
    }

    if ($mes == "4") {
        $f1 = '10';
        $f2 = '12';
        $day2 = '31';
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*           echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE SEMESTRE*/
if ($periodoInd_v == "5ind_v") {
    $day = "01";
    $mes = $_POST['periodoSemestralInd_v'];
    $year = $_POST['añoInd_v'];

    if ($mes == "1") {
        $f1 = '01';
        $f2 = '06';
        $day2 = "30";
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /* echo $datosAgente . '<br>';*/
        }
    }

    if ($mes == "2") {
        $f1 = '07';
        $f2 = '12';
        $day2 = '31';
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE ANUAL*/
if ($periodoInd_v == "6ind_v") {
    $day = "01";
    $year = $_POST['añoInd_v'];

    $f1 = '01';
    $f2 = '12';
    $day2 = "31";
    $date = new DateTime($year . '-' . $f1 . '-' . $day);
    $fecha1 = $date->format('Y-m-d');

    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

?>
</div>

<div id="container"></div>


<script type="text/javascript">
    // GRAFICA PARA TOTAL DE TRAMITES
    Highcharts.chart('container', {
        chart: {
            backgroundColor: '#f6f8f7',
            type: 'column'
        },
        title: {
            text: 'TOTAL DE TRAMITES <?php if ($periodoInd_v == "1ind_v") {
                                            echo "EN " . $meses . " " . $añoInd_v;
                                        }
                                        if ($periodoInd_v == "7ind_v") {
                                            $dateSem1 = date_create($periodoSemInd1_v);
                                            $seman1Ind_v = date_format($dateSem1, "d-m-Y");
                                            $dateSem2 = date_create($periodoSemInd2_v);
                                            $seman2Ind_v = date_format($dateSem2, "d-m-Y");
                                            echo "DESDE " . $seman1Ind_v . " HASTA " . $seman2Ind_v;
                                        }
                                        if ($periodoInd_v == "3ind_v") {
                                            echo "TRIMESTRE " . $periodoTrimestralInd_v . " AÑO " . $añoInd_v;
                                        }
                                        if ($periodoInd_v == "5ind_v") {
                                            echo "SEMESTRE " . $periodoSemestralInd_v . " AÑO " . $añoInd_v;
                                        }
                                        if ($periodoInd_v == "6ind_v") {
                                            echo $añoInd_v;
                                        }   ?>'
        },
        subtitle: {
            text: 'Total: <?php
                            /*ESTE CODIGO ES PARA MOSTRAR SEMANAL*/
                            if ($periodoInd_v == "7ind_v") {
                                $consultSem = "SELECT COUNT(*) FROM folios WHERE DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v' AND id_agente = '$id_agente'";
                                $resultSem = mysqli_query($conexion, $consultSem);
                                while ($verSemana = mysqli_fetch_array($resultSem)) {
                                    $datoSemanal = $verSemana[0];

                                    echo $datoSemanal . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
                            if ($periodoInd_v == "1ind_v") {
                                $day = "01";
                                $year = $_POST['añoInd_v'];
                                $month = $_POST['periodoMensualInd_v'];
                                $date = new DateTime($year . '-' . $month . '-' . $day);
                                $fecha = $date->format('Y-m-d');
                                /*echo $fecha;*/

                                $consultaAgente = "SELECT COUNT(*) FROM folios WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];

                                    echo $datosAgente . '<br>';
                                }
                            }

                            /* ESTE CODIGO ES PARA LA PARTE DE TRIMESTRAL */
                            if ($periodoInd_v == "3ind_v") {
                                $day = "01";
                                $mes = $_POST['periodoTrimestralInd_v'];
                                $year = $_POST['añoInd_v'];
                                if ($mes == "1") {
                                    $f1 = '01';
                                    $f2 = '03';
                                    $day2 = "31";
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }

                                if ($mes == "2") {
                                    $f1 = '04';
                                    $f2 = '06';
                                    $day2 = '30';
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }

                                if ($mes == "3") {
                                    $f1 = '07';
                                    $f2 = '09';
                                    $day2 = '30';
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }

                                if ($mes == "4") {
                                    $f1 = '10';
                                    $f2 = '12';
                                    $day2 = '31';
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
                            if ($periodoInd_v == "5ind_v") {
                                $day = "01";
                                $mes = $_POST['periodoSemestralInd_v'];
                                $year = $_POST['añoInd_v'];

                                if ($mes == "1") {
                                    $f1 = '01';
                                    $f2 = '06';
                                    $day2 = "30";
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');

                                    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$fecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }

                                if ($mes == "2") {
                                    $f1 = '07';
                                    $f2 = '12';
                                    $day2 = '31';
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');

                                    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$fecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE ANUAL*/
                            if ($periodoInd_v == "6ind_v") {
                                $day = "01";
                                $year = $_POST['añoInd_v'];

                                $f1 = '01';
                                $f2 = '12';
                                $day2 = "31";
                                $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                $fecha1 = $date->format('Y-m-d');

                                $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                $fecha2 = $date1->format('Y-m-d');

                                $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$fecha2' AND id_agente = '$id_agente'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];

                                    echo $datosAgente . '<br>';
                                }
                            } ?>'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} </b><br/>'
        },
        colors: ['#5499C7 ', '#7DCEA0 ', '#F8C471 '],
        series: [
            <?php

            if ($periodoInd_v == "1ind_v") {
                $day = "01";
                $year = $_POST['añoInd_v'];
                $month = $_POST['periodoMensualInd_v'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaProspectos = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'  AND id_agente = '$id_agente'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            } else {
                $consultaProspectos = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoInd_v == "1ind_v") {
                $day = "01";
                $year = $_POST['añoInd_v'];
                $month = $_POST['periodoMensualInd_v'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaCitas = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'  AND id_agente = '$id_agente'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            } else {
                $consultaCitas = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoInd_v == "1ind_v") {
                $day = "01";
                $year = $_POST['añoInd_v'];
                $month = $_POST['periodoMensualInd_v'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaEntrevista = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'  AND id_agente = '$id_agente'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            } else {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            // GRAFICAS PARA MOSTRAR DATOS SEMANALES
            if ($periodoInd_v == "7ind_v") {
                $consultaProspectos = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v' AND id_agente = '$id_agente'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoInd_v == "7ind_v") {
                $consultaCitas = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v' AND id_agente = '$id_agente'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoInd_v == "7ind_v") {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v' AND id_agente = '$id_agente'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            ?> {
                name: "",
                colorByPoint: true,
                data: [{
                        name: "ALTAS DE POLIZA",
                        y: <?php echo "$datosProspectos"; ?>
                    },
                    {
                        name: "MOVIMIENTOS",
                        y: <?php echo "$datosCitas"; ?>
                    },
                    {
                        name: "PAGOS",
                        y: <?php echo "$datosEntrevista"; ?>
                    }
                ]
            }
        ],
        drilldown: {

            series: [{
                    name: "ALTAS DE POLIZA",
                    id: "ALTAS DE POLIZA",
                    colors: ["#ffff"],
                    data: [
                        <?php

                        $consultaFecha = "SELECT  COUNT(DISTINCT producto) FROM folios WHERE t_solicitud = 'ALTAS DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
                        $resultFecha = mysqli_query($conexion, $consultaFecha);
                        while ($fecha = mysqli_fetch_array($resultFecha)) {
                            $datosFecha = $fecha[0];

                        ?>[
                                9 /*" <?php echo $fecha['DISTINCT(producto)']  ?> "*/ ,
                                <?php echo $fecha[' COUNT(DISTINCT producto)'] ?>
                            ],
                        <?php
                        }
                        ?>


                    ]
                },
                {
                    name: "Citas",
                    id: "Citas",
                    data: [
                        <?php

                        $consultaFecha = "SELECT fecha, SUM(resultado_cita) FROM resultados INNER JOIN agente ON resultados.nombreAgente = agente.nombreAgente AND agente.GDD = '$nombre' AND resultados.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
                        $resultFecha = mysqli_query($conexion, $consultaFecha);
                        while ($fecha = mysqli_fetch_array($resultFecha)) {
                            $datosFecha = $fecha[0];

                        ?>[
                                " <?php echo $fecha['fecha']  ?> ",
                                <?php echo $fecha['SUM(resultado_cita)'] ?>
                            ],
                        <?php
                        }
                        ?>
                    ]
                },
                {
                    name: "Entrevistas",
                    id: "Entrevistas",
                    data: [
                        <?php

                        $consultaFecha = "SELECT fecha, SUM(resultado_entrevista) FROM resultados INNER JOIN agente ON resultados.nombreAgente = agente.nombreAgente AND agente.GDD = '$nombre' AND resultados.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
                        $resultFecha = mysqli_query($conexion, $consultaFecha);
                        while ($fecha = mysqli_fetch_array($resultFecha)) {
                            $datosFecha = $fecha[0];

                        ?>[
                                " <?php echo $fecha['fecha']  ?> ",
                                <?php echo $fecha['SUM(resultado_entrevista)'] ?>
                            ],
                        <?php
                        }
                        ?>
                    ]
                }
            ]
        }
    });
</script>

<?php
if ($datoSemanal == 0 && $datosAgente == 0) {
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