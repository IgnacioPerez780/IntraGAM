<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_SESSION['gdd'];
$ramo = $_POST['ramo'];
$periodoGeneral = $_POST['periodoGeneral'];
$periodoSem1 = $_POST['date1Sg'];
$periodoSem2 = $_POST['date2Sg'];
$periodoMensual = $_POST['periodoMensual'];
$periodoCuatrimestral = $_POST['periodoCuatrimestral'];
$periodoSemestral = $_POST['periodoSemestral'];
$año = $_POST['año'];

$fecha = $periodoSem1;
$fechaComoEntero = strtotime($fecha);
$anioSemanal = date("Y", $fechaComoEntero);

$consultaGDD = "SELECT * FROM datos_operativos WHERE nomusuario = '$nombre'";
$resultGDD = mysqli_query($conexion, $consultaGDD);
while ($gdd = mysqli_fetch_array($resultGDD)) {
    $idGDD = $gdd[0];
    /*    echo "$idGDD";*/
}

$consultaMaster = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD'";
$resultadoM  = mysqli_query($conexion, $consultaMaster);
while ($AG = mysqli_fetch_array($resultadoM)) {
    $idAG = $AG[0];
    /* echo "$idAG";*/
}

if ($periodoMensual == "1") {
    $meses = "ENERO";
}
if ($periodoMensual == "2") {
    $meses = "FEBRERO";
}
if ($periodoMensual == "3") {
    $meses = "MARZO";
}
if ($periodoMensual == "4") {
    $meses = "ABRIL";
}
if ($periodoMensual == "5") {
    $meses = "MAYO";
}
if ($periodoMensual == "6") {
    $meses = "JUNIO";
}
if ($periodoMensual == "7") {
    $meses = "JULIO";
}
if ($periodoMensual == "8") {
    $meses = "AGOSTO";
}
if ($periodoMensual == "9") {
    $meses = "SEPTIEMBRE";
}
if ($periodoMensual == "10") {
    $meses = "OCTUBRE";
}
if ($periodoMensual == "11") {
    $meses = "NOVIEMBRE";
}
if ($periodoMensual == "12") {
    $meses = "DICIEMBRE";
}

/*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
if ($periodoGeneral == "1") {
    $day = "01";
    $year = $_POST['año'];
    $month = $_POST['periodoMensual'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha = $date->format('Y-m-d');
    /*echo $fecha;*/

    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTE*/
if ($periodoGeneral == "4") {
    $day = "01";
    $mes = $_POST['periodoCuatrimestral'];
    $year = $_POST['año'];

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

        $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
if ($periodoGeneral == "5") {
    $day = "01";
    $mes = $_POST['periodoSemestral'];
    $year = $_POST['año'];

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

        $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE ANUAL*/
if ($periodoGeneral == "6") {
    $day = "01";
    $year = $_POST['año'];

    $f1 = '01';
    $f2 = '12';
    $day2 = "31";
    $date = new DateTime($year . '-' . $f1 . '-' . $day);
    $fecha1 = $date->format('Y-m-d');

    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

?>

</div>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="containerAInd"></div>
<script type="text/javascript">
    // GRAFICA PARA TOTAL DE TRAMITES
    Highcharts.chart('containerAInd', {
        chart: {
            backgroundColor: '#f6f8f7',
            type: 'column'
        },
        title: {
            text: 'TOTAL DE TRAMITES <?php if ($periodoGeneral == "7") {
                                            $dateSem1 = date_create($periodoSem1);
                                            $seman1G = date_format($dateSem1, "d-m-Y");
                                            $dateSem2 = date_create($periodoSem2);
                                            $seman2G = date_format($dateSem2, "d-m-Y");
                                            echo "DESDE " . $seman1G . " HASTA " . $seman2G;
                                        }
                                        if ($periodoGeneral == "1") {
                                            echo "EN " . $meses . " " . $año;
                                        }
                                        if ($periodoGeneral == "4") {
                                            echo "CUATRIMESTRE " . $periodoCuatrimestral . " AÑO " . $año;
                                        }
                                        if ($periodoGeneral == "5") {
                                            echo "SEMESTRE " . $periodoSemestral . " AÑO " . $año;
                                        }
                                        if ($periodoGeneral == "6") {
                                            echo $año;
                                        }   ?>'
        },
        subtitle: {
            text: 'Total:  <?php
                            /*ESTE CODIGO ES PARA MOSTRAR SEMANAL*/
                            if ($periodoGeneral == "7") {
                                $consultSem = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$periodoSem1' AND '$periodoSem2'";
                                $resultSem = mysqli_query($conexion, $consultSem);
                                while ($verSemana = mysqli_fetch_array($resultSem)) {
                                    $datosSemanal = $verSemana[0];

                                    echo $datosSemanal . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
                            if ($periodoGeneral == "1") {
                                $day = "01";
                                $year = $_POST['año'];
                                $month = $_POST['periodoMensual'];
                                $date = new DateTime($year . '-' . $month . '-' . $day);
                                $fecha = $date->format('Y-m-d');
                                /*echo $fecha;*/

                                $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];

                                    echo $datosAgente . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTE*/
                            if ($periodoGeneral == "4") {
                                $day = "01";
                                $mes = $_POST['periodoCuatrimestral'];
                                $year = $_POST['año'];

                                if ($mes == "1") {
                                    $f1 = '01';
                                    $f2 = '04';
                                    $day2 = "30";
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE SEMESTRAL*/
                            if ($periodoGeneral == "5") {
                                $day = "01";
                                $mes = $_POST['periodoSemestral'];
                                $year = $_POST['año'];

                                if ($mes == "1") {
                                    $f1 = '01';
                                    $f2 = '06';
                                    $day2 = "30";
                                    $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                    $fecha1 = $date->format('Y-m-d');

                                    $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                    $fecha2 = $date1->format('Y-m-d');

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
                                    $resultAgente = mysqli_query($conexion, $consultaAgente);
                                    while ($agente = mysqli_fetch_array($resultAgente)) {
                                        $datosAgente = $agente[0];

                                        echo $datosAgente . '<br>';
                                    }
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE ANUAL*/
                            if ($periodoGeneral == "6") {
                                $day = "01";
                                $year = $_POST['año'];

                                $f1 = '01';
                                $f2 = '12';
                                $day2 = "31";
                                $date = new DateTime($year . '-' . $f1 . '-' . $day);
                                $fecha1 = $date->format('Y-m-d');

                                $date1 = new DateTime($year . '-' . $f2 . '-' . $day2);
                                $fecha2 = $date1->format('Y-m-d');

                                $consultaAgente = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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
        colors: ['#5499C7 ', '#7DCEA0 '],
        series: [
            <?php

            if ($periodoGeneral == "1") {
                $day = "01";
                $year = $_POST['año'];
                $month = $_POST['periodoMensual'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaProspectos = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'NUEVO NEGOCIO' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            } else {
                $consultaProspectos = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoGeneral == "1") {
                $day = "01";
                $year = $_POST['año'];
                $month = $_POST['periodoMensual'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');
                $consultaCitas = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            } else {
                $consultaCitas = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            // MUESTRA LOS GRAFICOS DE LA SELECCIÓN SEMANAL
            if ($periodoGeneral == "7") {
                $consultaProspectos = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$periodoSem1' AND '$periodoSem2'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoGeneral == "7") {
                $consultaCitas = "SELECT COUNT(*) FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSem1' AND '$periodoSem2'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }
            ?> {
                name: "",
                colorByPoint: true,
                data: [{
                        name: "NUEVO NEGOCIO",
                        y: <?php echo "$datosProspectos"; ?>
                    },
                    {
                        name: "MOVIMIENTOS",
                        y: <?php echo "$datosCitas"; ?>
                    }
                ]
            }
        ],
        drilldown: {

            series: [{
                    name: "NUEVO NEGOCIO",
                    id: "",
                    colors: ["#ffff"],
                    data: [
                        <?php

                        $consultaFecha = "SELECT producto FROM folios_a INNER JOIN datos_agente ON folios_a.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
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