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


$consulta = "SELECT id FROM datos_agente WHERE nombre = '$agente_v'";
$resultAgente = mysqli_query($conexion, $consulta);
$agente_v = mysqli_fetch_array($resultAgente);
$id_agente = $agente_v[0];

/* echo $id_agente . '<br>';*/

if ($_POST['periodoInd_v'] != "Seleccione:") {
    /* echo "$periodoInd_v";*/
}
if ($_POST['periodoMensualInd_v'] != "Seleccione:") {
    /*echo "$periodoMensualInd_v";*/
}
if ($_POST['periodoTrimestralInd_v'] != "Seleccione:") {
    /*echo "$periodoTrimestralInd_v";*/
}
if ($_POST['añoInd_v']) {
    /*echo "$añoInd_v";*/
}

/*ESTE CODIGO ES PARA MOSTRAR MENSUAL*/
if ($periodoInd_v == "1ind_v") {
    $day = "01";
    $year = $_POST['añoInd_v'];
    $month = $_POST['periodoMensualInd_v'];
    $date = new DateTime($year . '-' . $month . '-' . $day);
    $fecha1 = $date->format('Y-m-d');

    $day2 = "31";
    $date1 = new DateTime($year . '-' . $month . '-' . $day2);
    $fecha2 = $date1->format('Y-m-d');
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

/*ESTE CODIGO ES PARA MOSTRAR SEMESTRAL*/
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
<!-- BOTONES PARA CAMBIO DE GRAFICAS -->
<div class="btn-group">
    <br><br><br>
    <button id="botonVIDA" type="button" class="btn btn-default" onclick="POLIZAS();">ALTAS DE POLIZA</button>
    <button id="botonGMM" type="button" class="btn btn-default" onclick="MOVIMIENTOS();">MOVIMIENTOS</button>
    <button id="botonAUTOS" type="button" class="btn btn-default" onclick="PAGOS();">PAGOS</button>
</div>

<div id="container2Ind"></div>
<div id="container3Ind" style="display: none; height: auto;"></div>
<div id="container4Ind" style="display: none;"></div>


<script type="text/javascript">
    // GRAFICA PARA ALTAS DE POLIZA
    Highcharts.chart('container2Ind', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS ALTA DE POLIZA <?php if ($periodoInd_v == "1ind_v") {
                                                echo "MES " . $meses . " AÑO " . $añoInd_v;
                                            }
                                            if ($periodoInd_v == "7ind_v") {
                                                $dateSem1 = date_create($periodoSemInd1_v);
                                                $seman1Ind = date_format($dateSem1, "d-m-Y");
                                                $dateSem2 = date_create($periodoSemInd2_v);
                                                $seman2Ind = date_format($dateSem2, "d-m-Y");
                                                echo "DESDE  " . $seman1Ind . " HASTA " . $seman2Ind;
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
            text: ''
        },
        xAxis: {
            categories: [<?php
                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '1'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($producto = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $producto[0];

                                $consultaProduct = "SELECT COUNT(producto) FROM folios WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                                $resultProduct = mysqli_query($conexion, $consultaProduct);
                                while ($product = mysqli_fetch_array($resultProduct)) {
                                    $datosProduct = $product[0]; ?>

                        ' <?php echo $datosProducto;  ?>', <?php }
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
            color: '#5DADE2 ',
            name: 'NEGOCIOS',
            data: [
                <?php

                if ($periodoInd_v == "7ind_v") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA DE POLIZA' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v' AND id_agente = '$id_agente'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct;   ?>
                            ],
                        <?php
                        }
                    }
                } else {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA DE POLIZA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND id_agente = '$id_agente'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                        ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct;   ?>
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
    Highcharts.chart('container3Ind', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS MOVIMIENTOS <?php if ($periodoInd_v == "1ind_v") {
                                                echo "MES " . $meses . " AÑO " . $añoInd_v;
                                            }
                                            if ($periodoInd_v == "7ind_v") {
                                                $dateSem1 = date_create($periodoSemInd1_v);
                                                $seman1Ind = date_format($dateSem1, "d-m-Y");
                                                $dateSem2 = date_create($periodoSemInd2_v);
                                                $seman2Ind = date_format($dateSem2, "d-m-Y");
                                                echo "DESDE  " . $seman1Ind . " HASTA " . $seman2Ind;
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
            text: ''
        },
        xAxis: {
            categories: [<?php
                            if ($periodoInd_v == "7ind_v") {
                                $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '2'";
                                $resultProducto = mysqli_query($conexion, $consultaProducto);
                                while ($producto = mysqli_fetch_array($resultProducto)) {
                                    $datosProducto = $producto[0];

                                    $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v' AND id_agente = '$id_agente'";
                                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                                    while ($product = mysqli_fetch_array($resultProduct)) {
                                        $datosProduct = $product[0];
                                        if ($datosProduct >= "1") {
                            ?>[
                                    "<?php echo $datosProducto; ?> ",
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

                                    if ($periodoInd_v == "1_v") {
                                        $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'  AND id_agente = '$id_agente'";
                                    } else {
                                        $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
                                    }
                                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                                    while ($product = mysqli_fetch_array($resultProduct)) {
                                        $datosProduct = $product[0];

                                        if ($datosProduct >= '1') { ?>

                                ' <?php echo $datosProducto; ?>', <?php }
                                                                }
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
            color: '#58D68D',
            name: 'NEGOCIOS',
            data: [
                <?php

                if ($periodoInd_v == "7ind_v") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto WHERE id_tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v'  AND id_agente = '$id_agente'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            if ($datosProduct >= '1') {

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

                        $consultaProduct = "SELECT COUNT(movimiento) FROM folios WHERE movimiento = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                            if ($datosProduct >= '1') {
                            ?>[
                                    "<?php echo $datosProducto; ?> ",
                                    <?php echo $datosProduct; ?>
                                ],
                <?php
                            }
                        }
                    }
                }
                ?>


            ]
        }]
    });

    // GRAFICA PARA TIPO DE MONEDA EN PAGOS
    Highcharts.chart('container4Ind', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'TIPO DE MONEDA PAGOS  <?php if ($periodoInd_v == "1ind_v") {
                                                echo "MES " . $meses . " AÑO " . $añoInd_v;
                                            }
                                            if ($periodoInd_v == "7ind_v") {
                                                $dateSem1 = date_create($periodoSemInd1_v);
                                                $seman1Ind = date_format($dateSem1, "d-m-Y");
                                                $dateSem2 = date_create($periodoSemInd2_v);
                                                $seman2Ind = date_format($dateSem2, "d-m-Y");
                                                echo "DESDE  " . $seman1Ind . " HASTA " . $seman2Ind;
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

                if ($periodoInd_v == "7ind_v") {
                    $consultaProducto = "SELECT DISTINCT(moneda_pagos) FROM folios WHERE t_solicitud = 'PAGOS'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(moneda_pagos) FROM folios WHERE moneda_pagos = '$datosProducto' AND t_solicitud = 'PAGOS' AND DATE(fecha) BETWEEN '$periodoSemInd1_v' AND '$periodoSemInd2_v'  AND id_agente = '$id_agente'";
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

                        $consultaProduct = "SELECT COUNT(moneda_pagos) FROM folios WHERE moneda_pagos = '$datosProducto' AND t_solicitud = 'PAGOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND id_agente = '$id_agente'";
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

    function POLIZAS() {
        document.getElementById("container2Ind").style.display = "block";
        document.getElementById("container3Ind").style.display = "none";
        document.getElementById("container4Ind").style.display = "none";

    }

    function MOVIMIENTOS() {
        document.getElementById("container2Ind").style.display = "none";
        document.getElementById("container3Ind").style.display = "block";
        document.getElementById("container4Ind").style.display = "none";

    }

    function PAGOS() {
        document.getElementById("container2Ind").style.display = "none";
        document.getElementById("container3Ind").style.display = "none";
        document.getElementById("container4Ind").style.display = "block";

    }
</script>