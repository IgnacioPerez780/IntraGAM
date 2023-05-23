<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$nombre = $_SESSION['nombreGerente'];
$periodoGeneral = $_POST['periodoGeneral'];
$periodoMensual = $_POST['periodoMensual'];
$periodoSemG1 = $_POST['date1Sg'];
$periodoSemG2 = $_POST['date2Sg'];
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
    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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

        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
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

    $consultaAgente = "SELECT COUNT(*) FROM folios_s WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

?>




<!-- DIVS PARA LOS GRAFICOS -->
<div class="btn-group">
    <button id="botonVIDA" type="button" class="btn btn-default" onclick="VIDA();">VIDA</button>
    <button id="botonGMM" type="button" class="btn btn-default" onclick="GMM();">GMM</button>
    <button id="botonAUTOS" type="button" class="btn btn-default" onclick="AUTOS();">AUTOS</button>
    <button id="botonDAÑOS" type="button" class="btn btn-default" onclick="DAÑOS();">DAÑOS</button>
</div>

<div id="containerVIDA"></div>
<div id="containerGS2" style="display: none;"></div>
<div id="containerAUTOS" style="display: none;"></div>
<div id="containerDAÑOS" style="display: none;"></div>
<div id="graficaAnualS"></div>


<script type="text/javascript">
    // GRAFICA PARA MOSTRAR LOS DATOS EN VIDA
    Highcharts.chart('containerVIDA', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE VIDA <?php if ($periodoGeneral == "1") {
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

                            $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '2'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $tipo_sol[0]; ?>

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
            color: '#5499C7',
            name: 'NEGOCIOS',
            data: [
                <?php

                // MUESTRA GRAFICA DEL PERIODO SEMANAL
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'VIDA' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
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
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'VIDA' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'VIDA' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA MOSTRAR LOS DATOS EN GMM
    Highcharts.chart('containerGS2', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE GMM <?php if ($periodoGeneral == "1") {
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

                            $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '1'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $tipo_sol[0]; ?>

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
            color: '#7DCEA0',
            name: 'NEGOCIOS',
            data: [
                <?php

                // MUESTRA GRAFICA SEMANAL
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'GMM' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
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
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'GMM' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'GMM' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA MOSTRAR LOS DATOS EN AUTOS
    Highcharts.chart('containerAUTOS', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS EN AUTOS <?php if ($periodoGeneral == "1") {
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

                            $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '3'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $tipo_sol[0]; ?>

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
                // MUESTRA GRAFICA SEMANAL
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '3'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'AUTOS' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
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
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '3'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'AUTOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'AUTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA MOSTRAR LOS DATOS EN DAÑOS
    Highcharts.chart('containerDAÑOS', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE DAÑOS <?php if ($periodoGeneral == "1") {
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

                            $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '4'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $tipo_sol[0]; ?>

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
            color: '#C39BD3',
            name: 'NEGOCIOS',
            data: [
                <?php
                // MUESTRA GRAFICA SEMANAL
                if ($periodoGeneral == "7") {
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '4'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'DAÑOS' AND fecha BETWEEN '$periodoSemG1' AND '$periodoSemG2'";
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
                    $consultaProducto = "SELECT tipo FROM tipo_solicitud_s WHERE ts = '4'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($tipo_sol = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $tipo_sol[0];

                        if ($periodoGeneral == "1") {
                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'DAÑOS' AND MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year'";
                        } else {

                            $consultaProduct = "SELECT COUNT(tipo_sol) FROM folios_s WHERE tipo_sol = '$datosProducto' AND linea_s = 'DAÑOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2'";
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

    // GRAFICA PARA EL TOTAL DE TRAMITES POR MES
    Highcharts.chart('graficaAnualS', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'line'
        },
        title: {
            text: 'TOTAL DE TRAMITES POR MES EN <?php echo "$año"  ?> '
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
            name: 'VIDA ',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'VIDA' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }, {
            color: '#7DCEA0',
            name: 'GMM',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'GMM' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }, {
            color: '#F8C471',
            name: 'AUTOS',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'AUTOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                }
                ?>
            ]
        }, {
            color: '#C39BD3',
            name: 'DAÑOS',
            data: [
                <?php
                if ($periodoGeneral == "7") {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$anioSemanal'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>
                <?php
                } else {
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '01' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '02' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '03' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '04' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '05' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '06' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '07' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '08' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '09' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '10' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                    <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '11' AND YEAR(fecha)='$year'";
                    $resultProduct = mysqli_query($conexion, $consultaProduct);
                    while ($product = mysqli_fetch_array($resultProduct)) {
                        $datosProduct = $product[0];
                        echo "$datosProduct";
                    }
                    ?>,
                <?php
                    $consultaProduct = "SELECT COUNT(*) FROM folios_s WHERE linea_s = 'DAÑOS' AND MONTH(fecha) = '12' AND YEAR(fecha)='$year'";
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

    function VIDA() {
        document.getElementById("containerVIDA").style.display = "block";
        document.getElementById("containerGS2").style.display = "none";
        document.getElementById("containerAUTOS").style.display = "none";
        document.getElementById("containerDAÑOS").style.display = "none";
    }

    function GMM() {
        document.getElementById("containerVIDA").style.display = "none";
        document.getElementById("containerGS2").style.display = "block";
        document.getElementById("containerAUTOS").style.display = "none";
        document.getElementById("containerDAÑOS").style.display = "none";
    }

    function AUTOS() {
        document.getElementById("containerVIDA").style.display = "none";
        document.getElementById("containerGS2").style.display = "none";
        document.getElementById("containerAUTOS").style.display = "block";
        document.getElementById("containerDAÑOS").style.display = "none";
    }

    function DAÑOS() {
        document.getElementById("containerVIDA").style.display = "none";
        document.getElementById("containerGS2").style.display = "none";
        document.getElementById("containerAUTOS").style.display = "none";
        document.getElementById("containerDAÑOS").style.display = "block";
    }
</script>