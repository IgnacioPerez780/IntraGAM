<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$ramo = $_POST['ramo'];
$agente = $_POST['agente'];
$periodoInd = $_POST['periodoInd'];
$periodoSemInd1 = $_POST['date1Sind'];
$periodoSemInd2 = $_POST['date2Sind'];
$periodoMensualInd = $_POST['periodoMensualInd'];
$periodoCuatrimestralInd = $_POST['periodoCuatrimestralInd'];
$periodoSemestralInd = $_POST['periodoSemestralInd'];
$añoInd = $_POST['añoInd'];

$consulta = "SELECT id FROM datos_agente WHERE nombre = '$agente'";
$resultAgente = mysqli_query($conexion, $consulta);
$agente = mysqli_fetch_array($resultAgente);
$id_agente = $agente[0];

/*  echo $id_agente . '<br>';*/
if ($periodoMensualInd == "1") {
    $meses = "ENERO";
}
if ($periodoMensualInd == "2") {
    $meses = "FEBRERO";
}
if ($periodoMensualInd == "3") {
    $meses = "MARZO";
}
if ($periodoMensualInd == "4") {
    $meses = "ABRIL";
}
if ($periodoMensualInd == "5") {
    $meses = "MAYO";
}
if ($periodoMensualInd == "6") {
    $meses = "JUNIO";
}
if ($periodoMensualInd == "7") {
    $meses = "JULIO";
}
if ($periodoMensualInd == "8") {
    $meses = "AGOSTO";
}
if ($periodoMensualInd == "9") {
    $meses = "SEPTIEMBRE";
}
if ($periodoMensualInd == "10") {
    $meses = "OCTUBRE";
}
if ($periodoMensualInd == "11") {
    $meses = "NOVIEMBRE";
}
if ($periodoMensualInd == "12") {
    $meses = "DICIEMBRE";
}


/*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
if ($periodoInd == "1") {
    $day = "01";
    $year = $_POST['añoInd'];
    $month = $_POST['periodoMensualInd'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha1 = $date->format('Y-m-d');

    $day2 = "31";
    $date1 = new DateTime($year . '-' . $month . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    /*echo $fecha;*/
    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTE*/
if ($periodoInd == "4") {
    $day = "01";
    $mes = $_POST['periodoCuatrimestralInd'];
    $year = $_POST['añoInd'];

    if ($mes == "1") {
        $f1 = '01';
        $f2 = '04';
        $day2 = "30";
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*      echo $datosAgente . '<br>';*/
        }
    }

    if ($mes == "2") {
        $f1 = '05';
        $f2 = '08';
        $day2 = '31';
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*   echo $datosAgente . '<br>';*/
        }
    }

    if ($mes == "3") {
        $f1 = '09';
        $f2 = '12';
        $day2 = '31';
        $date = new DateTime($year . '-' . $f1 . '-' . $day);
        $fecha1 = $date->format('Y-m-d');

        $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
if ($periodoInd == "5") {
    $day = "01";
    $mes = $_POST['periodoSemestralInd'];
    $year = $_POST['añoInd'];

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
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE ANUAL*/
if ($periodoInd == "6") {
    $day = "01";
    $year = $_POST['añoInd'];

    $f1 = '01';
    $f2 = '12';
    $day2 = "31";
    $date = new DateTime($year . '-' . $f1 . '-' . $day);
    $fecha1 = $date->format('Y-m-d');

    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}
?>

</div>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="containerSInd"></div>

<script type="text/javascript">
    // GRAFICA PARA EL TOTAL DE TRAMITES
    Highcharts.chart('containerSInd', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'column'
        },
        title: {
            text: 'TOTAL DE TRAMITES <?php if ($periodoInd == "1") {
                                            echo "EN " . $meses . " " . $añoInd;
                                        }
                                        if ($periodoInd == "7") {
                                            $dateSem1 = date_create($periodoSemInd1);
                                            $seman1Ind = date_format($dateSem1, "d-m-Y");
                                            $dateSem2 = date_create($periodoSemInd2);
                                            $seman2Ind = date_format($dateSem2, "d-m-Y");
                                            echo "DESDE " . $seman1Ind . " HASTA " . $seman2Ind;
                                        }
                                        if ($periodoInd == "4") {
                                            echo "CUATRIMESTRE " . $periodoCuatrimestralInd . " AÑO " . $añoInd;
                                        }
                                        if ($periodoInd == "5") {
                                            echo "SEMESTRE " . $periodoSemestralInd . " AÑO " . $añoInd;
                                        }
                                        if ($periodoInd == "6") {
                                            echo $añoInd;
                                        }   ?>'
        },
        subtitle: {
            text: 'Total:  <?php

                            /*ESTE CODIGO ES PARA MOSTRAR SEMANAL*/
                            if ($periodoInd == "7") {
                                $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];
                                    echo $datosAgente . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
                            if ($periodoInd == "1") {
                                $day = "01";
                                $year = $_POST['añoInd'];
                                $month = $_POST['periodoMensualInd'];
                                $date = new DateTime($year . '-' . $month . '-' . $day);
                                $fecha = $date->format('Y-m-d');
                                /*echo $fecha;*/
                                $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];

                                    echo $datosAgente . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTE*/
                            if ($periodoInd == "4") {
                                $day = "01";
                                $mes = $_POST['periodoCuatrimestralInd'];
                                $year = $_POST['añoInd'];

                                if ($mes == "1") {
                                    $f1 = '01';
                                    $f2 = '04';
                                    $day2 = "30";
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }

                                if ($mes == "2") {
                                    $f1 = '05';
                                    $f2 = '08';
                                    $day2 = '31';
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }

                                if ($mes == "3") {
                                    $f1 = '09';
                                    $f2 = '12';
                                    $day2 = '31';
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
                            if ($periodoInd == "5") {
                                $day = "01";
                                $mes = $_POST['periodoSemestralInd'];
                                $year = $_POST['añoInd'];

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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
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
                                    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE ANUAL*/
                            if ($periodoInd == "6") {
                                $day = "01";
                                $year = $_POST['añoInd'];
                                $f1 = '01';
                                $f2 = '12';
                                $day2 = "31";
                                $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                $fecha1 = $date->format('Y-m-d');

                                $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                $fecha2 = $date1->format('Y-m-d');
                                $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];

                                    echo $datosAgente . '<br>';
                                }
                            }
                            ?>'
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
        colors: ['#5499C7 ', '#7DCEA0 ', '#F8C471 ', '#C39BD3'],
        series: [
            <?php

            if ($periodoInd == "1") {
                $day = "01";
                $year = $_POST['añoInd'];
                $month = $_POST['periodoMensualInd'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaProspectos = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            } else {
                $consultaProspectos = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoInd == "1") {
                $day = "01";
                $year = $_POST['añoInd'];
                $month = $_POST['periodoMensualInd'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');
                $consultaCitas = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            } else {
                $consultaCitas = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoInd == "1") {
                $day = "01";
                $year = $_POST['añoInd'];
                $month = $_POST['periodoMensualInd'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');
                $consultaEntrevista = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            } else {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            if ($periodoInd == "1") {
                $day = "01";
                $year = $_POST['añoInd'];
                $month = $_POST['periodoMensualInd'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');
                $consultaDaños = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND id_agente = '$id_agente'";
                $resultDaños = mysqli_query($conexion, $consultaDaños);
                $daños = mysqli_fetch_array($resultDaños);
                $datosDaños = $daños[0];
            } else {
                $consultaDaños = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                $resultDaños = mysqli_query($conexion, $consultaDaños);
                $daños = mysqli_fetch_array($resultDaños);
                $datosDaños = $daños[0];
            }

            // GRAFICAS PARA CONSULTA SEMANAL
            if ($periodoInd == "7") {
                $consultaProspectos = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoInd == "7") {
                $consultaCitas = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoInd == "7") {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            if ($periodoInd == "7") {
                $consultaDaños = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND id_agente = '$id_agente'";
                $resultDaños = mysqli_query($conexion, $consultaDaños);
                $daños = mysqli_fetch_array($resultDaños);
                $datosDaños = $daños[0];
            }


            ?> {
                name: "",
                colorByPoint: true,
                data: [{
                        name: "VIDA",
                        y: <?php echo "$datosProspectos"; ?>
                    },
                    {
                        name: "GMM",
                        y: <?php echo "$datosCitas"; ?>
                    },
                    {
                        name: "AUTOS",
                        y: <?php echo "$datosEntrevista"; ?>
                    },

                    {
                        name: "DAÑOS",
                        y: <?php echo "$datosDaños"; ?>
                    }
                ]
            }
        ],
        drilldown: {

            series: [{
                    name: "VIDA",
                    id: "",
                    colors: ["#ffff"],
                    data: [
                        <?php

                        $consultaFecha = "SELECT producto FROM folios_s WHERE linea_s = 'VIDA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
                        $resultFecha = mysqli_query($conexion, $consultaFecha);
                        while ($fecha = mysqli_fetch_array($resultFecha)) {
                            $datosFecha = $fecha[0];

                        ?>[
                                9 /*"<?php echo $fecha['Producto']  ?> "*/ ,
                                9 /* <?php echo $fecha['producto'] ?>*/
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

                        $consultaFecha = "SELECT fecha, SUM(resultado_cita) FROM resultados INNER JOIN agente ON resultados.nombreAgente = agente.nombreAgente AND id_agente.GDD = '$nombre' AND resultados.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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

                        $consultaFecha = "SELECT fecha, SUM(resultado_entrevista) FROM resultados INNER JOIN agente ON resultados.nombreAgente = agente.nombreAgente AND id_agente.GDD = '$nombre' AND resultados.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY fecha";
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