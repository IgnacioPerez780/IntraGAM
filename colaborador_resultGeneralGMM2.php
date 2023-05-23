<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_SESSION['nombreGerente'];
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
if ($_POST['periodoBimestral'] != "Seleccione:") {
    /*echo "$periodoBimestral";*/
}
if ($_POST['periodoTrimestral'] != "Seleccione:") {
    /*echo "$periodoTrimestral";*/
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

    $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];
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
    $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
    <button id="botonVIDA" type="button" class="btn btn-default" onclick="NACIONAL();">NACIONALES</button>
    <button id="botonGMM" type="button" class="btn btn-default" onclick="INTERNACIONAL();">INTERNACIONALES</button>
    <button id="botonAUTOS" type="button" class="btn btn-default" onclick="MOVIMIENTOS();">MOVIMIENTOS</button>
</div>

<!-- DIVS PARA LOS GRAFICOS -->
<div id="container6"></div>
<div id="container5" style="display: none; height: 700px;"></div>
<div id="container4" style="display: none;"></div>
<div id="graficaAnualGMM"></div>


<script type="text/javascript">
    // GRAFICA PARA ALTA POLIZA NACIONAL
    Highcharts.chart('container6', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE ALTA PÓLIZA NACIONAL <?php if ($periodoGeneral == "7") {
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
            text: ''
        },
        xAxis: {
            categories: [<?php

                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '1'";
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
            color: '#85C1E9 ',
            name: 'NEGOCIOS',
            data: [
                <?php

                $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '1'";
                $resultProducto = mysqli_query($conexion, $consultaProducto);
                while ($producto = mysqli_fetch_array($resultProducto)) {
                    $datosProducto = $producto[0];

                    // GRAFICA EN ALTA POLIZA NACIONAL LAS FECHAS ELEGIDAS EN LA SEMANA
                    if ($periodoGeneral == "7") {
                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$periodoSem1' AND '$periodoSem2'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];
                ?>[
                                "<?php echo $datosProducto; ?> ",
                                <?php echo $datosProduct; ?>
                            ],
                        <?php
                        }
                    } else {
                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA ALTA POLIZA INTERNACIONAL
    Highcharts.chart('container4', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE ALTA PÓLIZA INTERNACIONAL <?php if ($periodoGeneral == "7") {
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
                                                                echo "CUATRIMESTE " . $periodoCuatrimestral . " AÑO " . $año;
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

                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '2'";
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
                // GRAFICA EN ALTA POLIZA INTERNACIONAL LAS FECHAS ELEGIDAS EN LA SEMANA
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        
                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fecha BETWEEN '$periodoSem1' AND '$periodoSem2'";
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
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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
    Highcharts.chart('container5', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar',
            zoom: '-10px'
        },
        title: {
            text: 'PRODUCTOS DE MOVIMIENTOS <?php if ($periodoGeneral == "7") {
                                                $dateSem1 = date_create($periodoSem1);
                                                $seman1G = date_format($dateSem1, "d-m-Y");
                                                $dateSem2 = date_create($periodoSem2);
                                                $seman2G = date_format($dateSem2, "d-m-Y");
                                                echo "DESDE " . $seman1G . " HASTA " . $seman2G;
                                            }
                                            if ($periodoGeneral == "1") {
                                                echo "MES " . $meses . " AÑO " . $año;
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
                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '3'";
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
            color: '#F8C471',
            name: 'NEGOCIOS',
            data: [
                <?php
                // GRAFICA EN MOVIMIENTOS LAS FECHAS ELEGIDAS EN LA SEMANA
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '3'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSem1' AND '$periodoSem2'";
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];

                ?>[
                                "<?php echo $datosProducto;   ?> ",
                                <?php echo $datosProduct;  ?>
                            ],
                        <?php
                        }
                    }
                } else {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '3'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
                        }
                        $resultProduct = mysqli_query($conexion, $consultaProduct);
                        while ($product = mysqli_fetch_array($resultProduct)) {
                            $datosProduct = $product[0];

                        ?>[
                                "<?php echo $datosProducto;   ?> ",
                                <?php echo $datosProduct;  ?>
                            ],
                <?php
                        }
                    }
                }
                ?>
            ]
        }]
    });

    // GRAFICA QUE MUESTRA EL TOTAL POR MES DE LOS TIPOS DE SOLICITUD
    Highcharts.chart('graficaAnualGMM', {
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
            name: 'ALTAS POLIZA NACIONAL ',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA NACIONAL' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }, {
            name: 'ALTA POLIZA INTERNACIONAL',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
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
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_g WHERE t_solicitud = 'MOVIMIENTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
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

    function NACIONAL() {
        document.getElementById("container6").style.display = "block";
        document.getElementById("container4").style.display = "none";
        document.getElementById("container5").style.display = "none";
    }

    function INTERNACIONAL() {
        document.getElementById("container6").style.display = "none";
        document.getElementById("container4").style.display = "block";
        document.getElementById("container5").style.display = "none";
    }

    function MOVIMIENTOS() {
        document.getElementById("container6").style.display = "none";
        document.getElementById("container4").style.display = "none";
        document.getElementById("container5").style.display = "block";
    }
</script>