<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$periodoGeneral_v = $_POST['periodoGeneral_v'];
$periodoSemG1_v = $_POST['date1Sg_v'];
$periodoSemG2_v = $_POST['date2Sg_v'];
$periodoMensual_v = $_POST['periodoMensual_v'];
$periodoTrimestral_v = $_POST['periodoTrimestral_v'];
$periodoSemestral_v = $_POST['periodoSemestral_v'];
$año_v = $_POST['año_v'];
$fecha = $periodoSemG1_v;
$fechaComoEntero = strtotime($fecha);
$anioSemanal = date("Y", $fechaComoEntero);

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


// ESTE CODIGO ES PARA MOSTRAR MENSUAL
if ($periodoGeneral_v == "1_v") {
    $day = "01";
    $year = $_POST['año_v'];
    $month = $_POST['periodoMensual_v'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha1 = $date->format('Y-m-d');
    $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
    $nuevafecha2 = date('Y-m-d', $nuevafecha2);

    if ($month == "1") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "2") {
        $day2 = "29";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "3") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "4") {
        $day2 = "30";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "5") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "6") {
        $day2 = "30";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "7") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "8") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    if ($month == "9") {
        $day2 = "30";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }
    if ($month == "10") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }
    if ($month == "11") {
        $day2 = "30";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }
    if ($month == "12") {
        $day2 = "31";
        $date1 = new DateTime($year . '-' . $month . '-' . $day2);
        $fecha2 = $date1->format('Y-m-d');
        $nuevafecha2 = strtotime('+1 day', strtotime($fecha2));
        $nuevafecha2 = date('Y-m-d', $nuevafecha2);
    }

    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN  '$fecha1' AND '$nuevafecha2'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];
    }
}

// ESTE CODIGO ES PARA LA PARTE DE TRIMESTRAL
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

        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
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
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
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
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
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
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
        }
    }
}

// ESTE CODIGO ES PARA LA PARTE SEMESTRAL
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
        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
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

        $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
        }
    }
}

// ESTE CODIGO ES PARA LA PARTE ANUAL
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
    $consultaAgente = "SELECT COUNT(*) FROM folios WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];
    }
}

?>
<!-- BOTONES PARA CAMBIO DE GRAFICA -->
<div class="btn-group">
    <br>
    <button id="botonVIDA" type="button" class="btn btn-default" onclick="POLIZAS();">ALTAS DE POLIZA</button>
    <button id="botonGMM" type="button" class="btn btn-default" onclick="MOVIMIENTOS();">MOVIMIENTOS</button>
    <button id="botonAUTOS" type="button" class="btn btn-default" onclick="PAGOS();">PAGOS</button>
</div>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="containerV1"></div>
<div id="containerV2" style="display: none; height: 800px;"></div>
<div id="containerV3" style="display: none;"></div>
<div id="containerV4"></div>

<script type="text/javascript">
    // GRAFICA PARA MOSTRAR ALTA DE POLIZA
    Highcharts.chart('containerV1', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE ALTA DE PÓLIZA <?php if ($periodoGeneral_v == "1_v") {
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
            text: ''
        },
        xAxis: {
            categories: [<?php
                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '1'";
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
            color: '#5499C7 ',
            name: 'NEGOCIOS',
            data: [
                <?php
                if ($periodoGeneral_v == "7_v") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA DE POLIZA' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
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
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        if ($periodoGeneral_v == "1_v") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA MOSTRAR MOVIMIENTOS
    Highcharts.chart('containerV2', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTO DE MOVIMIENTOS <?php if ($periodoGeneral_v == "1_v") {
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
            text: ''
        },
        xAxis: {
            categories: [<?php

                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '2'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($producto = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $producto[0];
                                if ($periodoGeneral_v == "1_v") {
                                    $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                                } else {
                                    $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                                }
                                if ($periodoGeneral_v == "7_v") {
                                    $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
                                }
                                $resultProduct = mysqli_query($conexion, $consultaProduct);
                                while ($product = mysqli_fetch_array($resultProduct)) {
                                    $datosProduct = $product[0];
                                    if ($datosProduct >= '1') { ?>

                            ' <?php echo $datosProducto; ?>', <?php }
                                                            }
                                                        } ?>
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
                overflow: 'justify <br>'
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
            x: -30,
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
            color: '#7DCEA0',
            name: 'NEGOCIOS',
            data: [
                <?php
                // GRAFICA PARA MOVIMIENTOS / SEMANAL
                if ($periodoGeneral_v == "7_v") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            if ($datosProduct >= "1") {
                ?>[
                                    "<?php echo $datosProducto; ?> ",
                                    <?php echo $datosProduct; ?>
                                ],
                            <?php
                            }
                        }
                    }
                } else {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        if ($periodoGeneral_v == "1_v") {
                            $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            if ($datosProduct >= "1") { ?>[
                                    "<?php echo $datosProducto; ?> ",
                                    <?php
                                    echo $datosProduct;
                                    ?>
                                ],
                <?php     }
                        }
                    }
                }
                ?>
            ]
        }]
    });

    // GRAFICA PARA MOSTRAR PAGOS
    Highcharts.chart('containerV3', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'TIPO DE MONEDA EN PAGOS <?php if ($periodoGeneral_v == "1_v") {
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
            text: ''
        },
        xAxis: {
            categories: [<?php

                            $consultaProducto = "SELECT DISTINCT(moneda_pagos) FROM folios WHERE t_solicitud = 'PAGOS'";
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
                overflow: 'justify <br>'
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
            x: -30,
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
            color: '#F8C471 ',
            name: 'NEGOCIOS',
            data: [
                <?php
                // GRAFICA PARA TIPO DE MONEDA / SEMANAL
                if ($periodoGeneral_v == "7_v") {
                    $consultaProducto = "SELECT DISTINCT(moneda_pagos) FROM folios WHERE t_solicitud = 'PAGOS'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];


                        $consultaProduct = "SELECT COUNT(moneda_pagos) FROM folios WHERE moneda_pagos = '$datosProducto' AND t_solicitud = 'PAGOS' AND DATE(fecha) BETWEEN '$periodoSemG1_v' AND '$periodoSemG2_v'";
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
                    $consultaProducto = "SELECT DISTINCT(moneda_pagos) FROM folios WHERE t_solicitud = 'PAGOS'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        if ($periodoGeneral_v == "1_v") {
                            $consultaProduct = "SELECT COUNT(moneda_pagos) FROM folios WHERE moneda_pagos = '$datosProducto' AND t_solicitud = 'PAGOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(moneda_pagos) FROM folios WHERE moneda_pagos = '$datosProducto' AND t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA TOTAL DE TRAMITES POR MES
    Highcharts.chart('containerV4', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'line'
        },
        title: {
            text: 'TOTAL DE TRAMITES POR MES EN <?php if ($periodoGeneral_v == "7_v") {
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
            name: 'ALTAS DE POLIZA',
            data: [
                <?php
                if ($periodoGeneral_v == "7_v") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'ALTA DE POLIZA' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
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
                if ($periodoGeneral_v == "7_v") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }, {
            name: 'PAGOS',
            data: [
                <?php
                if ($periodoGeneral_v == "7_v") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios WHERE t_solicitud = 'PAGOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
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

    function POLIZAS() {
        document.getElementById("containerV1").style.display = "block";
        document.getElementById("containerV2").style.display = "none";
        document.getElementById("containerV3").style.display = "none";

    }

    function MOVIMIENTOS() {
        document.getElementById("containerV1").style.display = "none";
        document.getElementById("containerV2").style.display = "block";
        document.getElementById("containerV3").style.display = "none";

    }

    function PAGOS() {
        document.getElementById("containerV1").style.display = "none";
        document.getElementById("containerV2").style.display = "none";
        document.getElementById("containerV3").style.display = "block";

    }
</script>