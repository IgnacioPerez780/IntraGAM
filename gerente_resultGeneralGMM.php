<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_SESSION['gdd'];
$ramo = $_POST['ramo'];
$periodoGeneral = $_POST['periodoGeneral'];
$periodoSemG1 = $_POST['date1Sg'];
$periodoSemG2 = $_POST['date2Sg'];
$periodoMensual = $_POST['periodoMensual'];
$periodoCuatrimestral = $_POST['periodoCuatrimestral'];
$periodoSemestral = $_POST['periodoSemestral'];
$año = $_POST['año'];

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

$consultaGDD = "SELECT * FROM datos_operativos WHERE nomusuario = '$nombre'";
$resultGDD = mysqli_query($conexion, $consultaGDD);
while ($gdd = mysqli_fetch_array($resultGDD)) {
    $idGDD = $gdd[0];
    // echo "$idGDD";
}

$consultaMaster = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD'";
$resultadoM  = mysqli_query($conexion, $consultaMaster);
while ($AG = mysqli_fetch_array($resultadoM)) {
    $idAG = $AG[0];
    /*echo "$idAG";*/
}


if ($_POST['periodoGeneral'] != "Seleccione:") {
    /* echo "$periodoGeneral";*/
}
if ($_POST['periodoMensual'] != "Seleccione:") {
    /*echo "$periodoMensual";*/
}
if ($_POST['periodoCuatrimestral'] != "Seleccione:") {
    /*echo "$periodoCuatrimestral";*/
}
if ($_POST['periodoSemestral'] != "Seleccione:") {
    /*echo "$periodoCuatrimestral";*/
}
if ($_POST['año']) {
    /*echo "$año";*/
}


/*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
if ($periodoGeneral == "1") {
    $day = "01";
    $year = $_POST['año'];
    $month = $_POST['periodoMensual'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha = $date->format('Y-m-d');
    /*echo $fecha;*/

    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTRE*/
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /* echo $datosAgente . '<br>';*/
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /* echo $datosAgente . '<br>';*/
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

?>

</div>

<?php
$consultaProducto = "SELECT DISTINCT(producto) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA NACIONAL'";
$resultProducto = mysqli_query($conexion, $consultaProducto);
while ($producto = mysqli_fetch_array($resultProducto)) {
    $datosProducto = $producto[0];
    // echo $datosProducto . '<br>';

    $consultaProduct = "SELECT COUNT(producto) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
    $resultProduct = mysqli_query($conexion, $consultaProduct);
    while ($product = mysqli_fetch_array($resultProduct)) {
        $datosProduct = $product[0];
        // echo $datosProduct . '<br>';
    }
}
?>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="container7"></div>

<script type="text/javascript">
    // GRAFICA PARA EL TOTAL DE TRAMITES ENTRE FECHAS
    Highcharts.chart('container7', {
        chart: {
            backgroundColor: '#f6f8f7',
            type: 'column'
        },
        title: {
            text: 'TOTAL DE TRAMITES <?php if ($periodoGeneral == "1") {
                                            echo "EN " . $meses . " " . $año;
                                        }
                                        if ($periodoGeneral == "7") {
                                            $dateSem1 = date_create($periodoSemG1);
                                            $seman1G = date_format($dateSem1, "d-m-Y");
                                            $dateSem2 = date_create($periodoSemG2);
                                            $seman2G = date_format($dateSem2, "d-m-Y");
                                            echo "DESDE " . $seman1G . " HASTA " . $seman2G;
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
                                $consultaSem = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                                $resutlSem = mysqli_query($conexion, $consultaSem);
                                while ($verSemana = mysqli_fetch_array($resutlSem)) {
                                    $datoSemanal = $verSemana[0];
                                    echo $datoSemanal . '<br>'; // Total mostrado en la primera grafica de lado izquierdo
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
                                $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                                $resultAgente = mysqli_query($conexion, $consultaAgente);
                                while ($agente = mysqli_fetch_array($resultAgente)) {
                                    $datosAgente = $agente[0];
                                    echo $datosAgente . '<br>';
                                }
                            }

                            /*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTRE*/
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                    $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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

                                $consultaAgente = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND fecha BETWEEN '$fecha1' AND '$fecha2' ";
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
            if ($periodoGeneral == "1") {
                $day = "01";
                $year = $_POST['año'];
                $month = $_POST['periodoMensual'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaProspectos = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            } else {
                $consultaProspectos = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
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

                $consultaCitas = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            } else {
                $consultaCitas = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoGeneral == "1") {
                $day = "01";
                $year = $_POST['año'];
                $month = $_POST['periodoMensual'];
                $date = new DateTime($year . '-' . $month . '-' . $day);
                $fecha = $date->format('Y-m-d');

                $consultaEntrevista = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND  MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            } else {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }

            // MUESTRA LOS DATOS SE LA SELECCION SEMANAL
            if ($periodoGeneral == "7") {
                $consultaProspectos = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                $resultProspectos = mysqli_query($conexion, $consultaProspectos);
                $prospectos = mysqli_fetch_array($resultProspectos);
                $datosProspectos = $prospectos[0];
            }

            if ($periodoGeneral == "7") {
                $consultaCitas = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                $resultCitas = mysqli_query($conexion, $consultaCitas);
                $citas = mysqli_fetch_array($resultCitas);
                $datosCitas = $citas[0];
            }

            if ($periodoGeneral == "7") {
                $consultaEntrevista = "SELECT COUNT(*) FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                $resultEntrevista = mysqli_query($conexion, $consultaEntrevista);
                $entrevista = mysqli_fetch_array($resultEntrevista);
                $datosEntrevista = $entrevista[0];
            }
            ?> {
                name: "",
                colorByPoint: true,
                data: [{
                        name: "ALTA POLIZA NACIONAL",
                        y: <?php echo $datosProspectos; ?>
                    },
                    {
                        name: "ALTA POLIZA INTERNACIONAL",
                        y: <?php echo $datosCitas; ?>
                    },
                    {
                        name: "MOVIMIENTOS",
                        y: <?php echo $datosEntrevista; ?>
                    }
                ]
            }
        ],
        drilldown: {

            series: [{
                    name: "ALTA POLIZA NACIONAL",
                    id: "",
                    colors: ["#ffff"],
                    data: [
                        <?php

                        $consultaFecha = "SELECT producto FROM folios_g INNER JOIN datos_agente ON folios_g.agente=datos_agente.id WHERE gdd = '$idGDD' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
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