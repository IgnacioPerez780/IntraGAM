<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_SESSION['nombreGerente'];
$periodoGeneral = $_POST['periodoGeneral'];
$periodoSemG1 = $_POST['date1Sg'];
$periodoSemG2 = $_POST['date2Sg'];
$periodoMensual = $_POST['periodoMensual'];
$periodoCuatrimestral = $_POST['periodoCuatrimestral'];
$periodoSemestral = $_POST['periodoSemestral'];
$año = $_POST['año'];

$fecha = $periodoSemG1;
$fechaComoEntero = strtotime($fecha);
$anioSemanal = date("Y", $fechaComoEntero);

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
    $fecha1 = $date->format('Y-m-d');

    $day2 = "31";
    $date1 = new DateTime($year . '-' . $month . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    /*echo $fecha;*/

    $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
    $consultaAgente = "SELECT COUNT(*) FROM folios_a WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];
        /* echo $datosAgente . '<br>';*/
    }
}
?>

<!-- BOTONES PARA CAMBIO DE GRAFICA -->
<div class="btn-group">
    <br><br>
    <button id="botonVIDA" type="button" class="btn btn-default" onclick="NUEVO();">NUEVOS NEGOCIOS</button>
    <button id="botonGMM" type="button" class="btn btn-default" onclick="MOVIMIENTOS();">MOVIMIENTOS</button>
    <button id="botonP" type="button" class="btn btn-default" onclick="PRIORIDAD();">PRIORIDAD</button>
</div>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="containerA2"></div>
<div id="containerA3" style="display: none;"></div>
<div id="containerA4" style="display: none;"></div>
<div id="containerA5"></div>

<script type="text/javascript">
    // GRAFICA PARA NUEVOS NEGOCIOS
    Highcharts.chart('containerA2', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE NUEVOS NEGOCIOS <?php if ($periodoGeneral == "1") {
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
            text: ''
        },
        xAxis: {
            categories: [<?php

                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto_autos WHERE tipo_solicitud = '1'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($producto = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $producto[0]; ?>

                    ' <?php echo $datosProducto; ?>', <?php } ?>
            ],

            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Tramites generados',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: false,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            color: '#85C1E9 ',
            name: 'NEGOCIOS',
            data: [
                <?php
                // GRAFICA SEMANAL / NUEVO NEGOCIO
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_autos WHERE tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        if ($periodoGeneral == "7") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_a WHERE producto = '$datosProducto' AND t_solicitud = 'NUEVO NEGOCIO' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];

                ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct; ?>
                            ],
                        <?php
                        }
                    }
                } else {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_autos WHERE tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_a WHERE producto = '$datosProducto' AND t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_a WHERE producto = '$datosProducto' AND t_solicitud = 'NUEVO NEGOCIO' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];

                        ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct; ?>
                            ],
                <?php
                        }
                    }
                }
                ?>


            ]
        }]
    });

    // GRAFICA PARA MOVIMIENTOS
    Highcharts.chart('containerA3', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE MOVIMIENTOS <?php if ($periodoGeneral == "1") {
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
            text: ''
        },
        xAxis: {
            categories: [<?php

                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto_autos WHERE tipo_solicitud = '2'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($producto = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $producto[0]; ?>

                    ' <?php echo $datosProducto ?>', <?php } ?>
            ],

            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Tramites generados',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: false,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            color: '#58D68D',
            name: 'NEGOCIOS',
            data: [
                <?php
                // GRAFICA SEMANAL / MOVIMIENTOS
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_autos WHERE tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        if ($periodoGeneral == "7") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_a WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct; ?>
                            ],
                        <?php
                        }
                    }
                } else {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_autos WHERE tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_a WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_a WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];

                        ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct; ?>
                            ],
                <?php
                        }
                    }
                }
                ?>
            ]
        }]
    });

    // GRAFICA PARA TIPO DE PRIORIDAD
    Highcharts.chart('containerA4', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'PRIORIDAD <?php if ($periodoGeneral == "1") {
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
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'ALTA',
                color: '#F5B7B1',
                y: <?php
                    // GRAFICA SEMANAL / PRIORIDAD ALTA
                    if ($periodoGeneral == "7") {
                        $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE prioridad = 'ALTA' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            echo "$datosProduct";
                        }
                    } else {
                        if ($periodoGeneral == "1") {

                            $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE prioridad = 'ALTA'  AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE prioridad = 'ALTA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            echo "$datosProduct";
                        }
                    }
                    ?>,
                sliced: true,
                selected: true
            }, {
                name: 'NORMAL',
                color: '#58D68D',
                y: <?php
                    // GRAFICA SEMANAL / PRIORIDAD NORMAL
                    if ($periodoGeneral == "7") {
                        $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE prioridad = 'NORMAL' AND DATE(fecha) BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            echo "$datosProduct";
                        }
                    } else {
                        if ($periodoInd == "1") {
                            $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE prioridad = 'NORMAL'  AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND agente = '$id_agente'";
                        } else {
                            $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE prioridad = 'NORMAL' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            echo "$datosProduct";
                        }
                    }
                    ?>
            }]
        }]
    });

    // GRAFICA TOTAL DE TRAMITES POR MES
    Highcharts.chart('containerA5', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'line'
        },
        title: {
            text: 'TOTAL DE TRAMITES POR MES EN <?php if ($periodoGeneral == "7") {
                                                    echo $anioSemanal;
                                                } else {
                                                    echo $year;
                                                }
                                                ?> '
        },
        subtitle: {
            text: 'IntraGAM'
        },
        xAxis: {
            categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
        },
        yAxis: {
            title: {
                text: 'Tramites'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'NUEVO NEGOCIO ',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    } ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'NUEVO NEGOCIO' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }, {
            name: 'MOVIMIENTOS',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_a WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }]
    });

    function NUEVO() {
        document.getElementById("containerA2").style.display = "block";
        document.getElementById("containerA3").style.display = "none";
        document.getElementById("containerA4").style.display = "none";
    }

    function MOVIMIENTOS() {
        document.getElementById("containerA2").style.display = "none";
        document.getElementById("containerA3").style.display = "block";
        document.getElementById("containerA4").style.display = "none";
    }

    function PRIORIDAD() {
        document.getElementById("containerA2").style.display = "none";
        document.getElementById("containerA3").style.display = "none";
        document.getElementById("containerA4").style.display = "block";
    }
</script>