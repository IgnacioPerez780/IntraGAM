<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_SESSION['gdd'];
$ramo = $_POST['ramo'];
$periodoGeneral_v = $_POST['periodoGeneral_v'];
$periodoSemG1_v = $_POST['date1Sg_v'];
$periodoSemG2_v = $_POST['date2Sg_v'];
$periodoMensual_v = $_POST['periodoMensual_v'];
$periodoTrimestral_v = $_POST['periodoTrimestral_v'];
$periodoSemestral_v = $_POST['periodoSemestral_v'];
$año_v = $_POST['año_v'];

$consultaGDD = "SELECT * FROM datos_operativos WHERE nomusuario = '$nombre'";
$resultGDD = mysqli_query($conexion, $consultaGDD);
while ($gdd = mysqli_fetch_array($resultGDD)) {
    $idGDD = $gdd[0];
    // echo "$idGDD";
}

$consultaMaster = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD'";
$resultadoM  = mysqli_query($conexion, $consultaMaster);
while ($AG = mysqli_fetch_array($resultadoM)) {
    $idAG = $AG[0];
    // echo "$idAG";
}


if ($periodoMensual_v == "1") {
    $meses = "ENERO";
}
if ($periodoMensual_v == "2") {
    $meses = "FEBRERO";
}
if ($periodoMensual_v == "3") {
    $meses = "MARZO";
}
if ($periodoMensual_v == "4") {
    $meses = "ABRIL";
}
if ($periodoMensual_v == "5") {
    $meses = "MAYO";
}
if ($periodoMensual_v == "6") {
    $meses = "JUNIO";
}
if ($periodoMensual_v == "7") {
    $meses = "JULIO";
}
if ($periodoMensual_v == "8") {
    $meses = "AGOSTO";
}
if ($periodoMensual_v == "9") {
    $meses = "SEPTIEMBRE";
}
if ($periodoMensual_v == "10") {
    $meses = "OCTUBRE";
}
if ($periodoMensual_v == "11") {
    $meses = "NOVIEMBRE";
}
if ($periodoMensual_v == "12") {
    $meses = "DICIEMBRE";
}
if ($_POST['periodoGeneral_v'] != "Seleccione:") {
    /* echo "$periodoGeneral_v";*/
}

if ($_POST['periodoMensual_v'] != "Seleccione:") {
    /*echo "$periodoMensual_v";*/
}
if ($_POST['periodoTrimestral_v'] != "Seleccione:") {
    /*echo "$periodoTrimestral_v";*/
}
if ($_POST['periodoSemestral_v'] != "Seleccione:") {
    /*echo "$periodoCuatrimestral";*/
}
if ($_POST['año_v']) {
    /*echo "$año_v";*/
}


/*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
if ($periodoGeneral_v == "1_v") {
    $day = "01";
    $year = $_POST['año_v'];
    $month = $_POST['periodoMensual_v'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha = $date->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);

    /*echo $fecha;*/
    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];
        /* echo $datosAgente . '<br>';*/
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE TRIMESTRAL*/
if ($periodoGeneral_v == "3_v") {
    $day = "01";
    $mes = $_POST['periodoTrimestral_v'];
    $year = $_POST['año_v'];

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
        $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*           echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
if ($periodoGeneral_v == "5") {
    $day = "01";
    $mes = $_POST['periodoSemestral_v'];
    $year = $_POST['año_v'];

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
        $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE ANUAL*/
if ($periodoGeneral_v == "6") {
    $day = "01";
    $year = $_POST['año_v'];

    $f1 = '01';
    $f2 = '12';
    $day2 = "31";
    $date = new DateTime($year . '-' . $f1 . '-' . $day);
    $fecha1 = $date->format('Y-m-d');

    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');

    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);

    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

?>
</div>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="container70"></div>
<script type="text/javascript">
    // GRAFICA TOTAL DE TRAMITES
    Highcharts.chart('container70', {
        chart: {
            backgroundColor: '#f6f8f7',
            type: 'column'
        },
        title: {
            text: 'TOTAL DE TRAMITES <?php if ($periodoGeneral_v == "1_v") {
                                            echo "EN " . $meses . " " . $año_v;
                                        }
                                        if ($periodoGeneral_v == "7_v") {
                                            $dateSem1 = date_create($periodoSemG1_v);
                                            $seman1G_v = date_format($dateSem1, "d-m-Y");
                                            $dateSem2 = date_create($periodoSemG2_v);
                                            $seman2G_v = date_format($dateSem2, "d-m-Y");
                                            echo "DESDE " . $seman1G_v . " HASTA " . $seman2G_v;
                                        }
                                        if ($periodoGeneral_v == "3_v") {
                                            echo "TRIMESTRE " . $periodoTrimestral_v . " AÑO " . $año_v;
                                        }
                                        if ($periodoGeneral_v == "5_v") {
                                            echo "SEMESTRE " . $periodoSemestral_v . " AÑO " . $año_v;
                                        }
                                        if ($periodoGeneral_v == "6_v") {
                                            echo $año_v;
                                        }   ?>'
        },
        subtitle: {
            text: 'Total:  <?php
                            /*ESTE CODIGO ES PARA MOSTRAR SEMANAL*/
                            if ($periodoGeneral_v == "7_v") {
                                $consultSem = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
                                $resultSem = mysqli_query($conexion, $consultSem);
                                while ($verSemana = mysqli_fetch_array($resultSem)) {
                                    $datoSemanal = $verSemana[0];
                                    echo $datoSemanal . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
                            if ($periodoGeneral_v == "1_v") {
                                $day = "01";
                                $year = $_POST['año_v'];
                                $month = $_POST['periodoMensual_v'];
                                $date = new DateTime($year . '-' . $month . '-' . $day);
                                $fecha = $date->format('Y-m-d');
                                /*echo $fecha;*/

                                $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];

                                    echo $datosAgente . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE DE TRIMESTRAL*/
                            if ($periodoGeneral_v == "3_v") {
                                $day = "01";
                                $mes = $_POST['periodoTrimestral_v'];
                                $year = $_POST['año_v'];

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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
                            if ($periodoGeneral_v == "5_v") {
                                $day = "01";
                                $mes = $_POST['periodoSemestral_v'];
                                $year = $_POST['año_v'];

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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
                                    $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE ANUAL*/
                            if ($periodoGeneral_v == "6_v") {
                                $day = "01";
                                $year = $_POST['año_v'];

                                $f1 = '01';
                                $f2 = '12';
                                $day2 = "31";
                                $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                $fecha1 = $date->format('Y-m-d');

                                $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                $fecha2 = $date1->format('Y-m-d');
                                $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                                $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                                $consultaAgente = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        colors: ['#5499C7 ', '#7DCEA0 ', '#F8C471 '],
        series: [
            <?php

            if ($periodoGeneral_v == "1_v") {
                $day = "01";
                $year = $_POST['año_v'];
                $month = $_POST['periodoMensual_v'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaProspectos = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA DE POLIZA' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            } else {
                $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                $consultaProspectos = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoGeneral_v == "1_v") {
                $day = "01";
                $year = $_POST['año_v'];
                $month = $_POST['periodoMensual_v'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaCitas = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            } else {
                $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                $consultaCitas = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoGeneral_v == "1_v") {
                $day = "01";
                $year = $_POST['año_v'];
                $month = $_POST['periodoMensual_v'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaEntrevista = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'PAGOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            } else {
                $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
                $nuevafecha2 = date('Y-m-d', $nuevafecha2);
                $consultaEntrevista = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            // GRAFICA DE LA DERECHA PARA MUESTRA DE SELECCION SEMANAL
            if ($periodoGeneral_v == "7_v") {
                $consultaProspectos = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA DE POLIZA' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoGeneral_v == "7_v") {
                $consultaCitas = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoGeneral_v == "7_v") {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios INNER JOIN datos_agente ON folios.id_agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'PAGOS' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            ?> {
                name: "",
                colorByPoint: true,
                data: [{
                        name: "ALTAS DE POLIZA",
                        y: <?php echo "$datosProspectos"; ?>,
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
                    id: "",
                    colors: ["#ffff"],
                    data: [
                        <?php

                        $consultaFecha = "SELECT producto FROM folios WHERE t_solicitud = 'ALTAS DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
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