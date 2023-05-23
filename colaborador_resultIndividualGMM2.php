<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

$agente = $_POST['agente'];
$periodoInd = $_POST['periodoInd'];
$periodoSemInd1 = $_POST['date1Sind'];
$periodoSemInd2 = $_POST['date2Sind'];
$periodoMensualInd = $_POST['periodoMensualInd'];
$periodoCuatrimestralInd = $_POST['periodoCuatrimestralInd'];
$periodoSemestralInd = $_POST['periodoSemestralInd'];
$añoInd = $_POST['añoInd'];

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

$consulta = "SELECT id FROM datos_agente WHERE nombre = '$agente'";
$resultAgente = mysqli_query($conexion, $consulta);
$agente = mysqli_fetch_array($resultAgente);
$id_agente = $agente[0];

/* echo $id_agente . '<br>';*/

if ($_POST['periodoInd'] != "Seleccione:") {
    /* echo "$periodoInd";*/
}
if ($_POST['periodoMensualInd'] != "Seleccione:") {
    /*echo "$periodoMensualInd";*/
}
if ($_POST['periodoCuatrimestralInd'] != "Seleccione:") {
    /*echo "$periodoCuatrimestralInd";*/
}
if ($_POST['añoInd']) {
    /*echo "$añoInd";*/
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

    $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE MONTH(fecha)  = '$month' AND YEAR(fecha) = '$year' AND agente = '$id_agente'";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE CUATRIMESTRE*/
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND agente = '$id_agente' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND agente = '$id_agente' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA MOSTRAR SEMESTRAL*/
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND agente = '$id_agente' ";
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
        $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND agente = '$id_agente'";
        $resultAgente = mysqli_query($conexion, $consultaAgente);
        while ($agente = mysqli_fetch_array($resultAgente)) {
            $datosAgente = $agente[0];

            /*  echo $datosAgente . '<br>';*/
        }
    }
}

/*ESTE CODIGO ES PARA LA PARTE DE ANUAL*/
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
    $consultaAgente = "SELECT COUNT(*) FROM folios_g WHERE fecha BETWEEN '$fecha1' AND '$nuevafecha2'  AND agente = '$id_agente' ";
    $resultAgente = mysqli_query($conexion, $consultaAgente);
    while ($agente = mysqli_fetch_array($resultAgente)) {
        $datosAgente = $agente[0];

        /* echo $datosAgente . '<br>';*/
    }
}


?>
<div class="btn-group">
    <button id="botonVIDA" type="button" class="btn btn-default" onclick="NACIONAL();">NACIONALES</button>
    <button id="botonGMM" type="button" class="btn btn-default" onclick="INTERNACIONAL();">INTERNACIONALES</button>
    <button id="botonAUTOS" type="button" class="btn btn-default" onclick="MOVIMIENTOS();">MOVIMIENTOS</button>
</div>

<div id="container2IndGMM"></div>
<div id="container2IndGMMINTER" style="display: none;"></div>
<div id="container2IndGMMMOV" style="display: none; height: 700px;"></div>

<script type="text/javascript">
    // GRAFICA PARA ALTA DE POLIZA NACIONAL
    Highcharts.chart('container2IndGMM', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE ALTA PÓLIZA NACIONAL <?php if ($periodoInd == "1") {
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
                                                        }   ?>  '
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
            color: '#85C1E9',
            name: 'NEGOCIOS',
            data: [
                <?php
                if ($periodoInd == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente'";
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
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '1'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA NACIONAL' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND agente = '$id_agente'";
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

    // GRAFICA PARA ALTA DE POLIZA INTERNACIONAL
    Highcharts.chart('container2IndGMMINTER', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE ALTA PÓLIZA INTERNACIONAL <?php if ($periodoInd == "1") {
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
                                                            }   ?> '
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
                if ($periodoInd == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '2'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];

                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente'";
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

                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'ALTA POLIZA INTERNACIONAL' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND agente = '$id_agente'";
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
    Highcharts.chart('container2IndGMMMOV', {
        chart: {
            backgroundColor: '#f7f8f8 ',
            type: 'bar'
        },
        title: {
            text: 'PRODUCTOS DE MOVIMIENTOS <?php if ($periodoInd == "1") {
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
                                            }   ?>  '
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [<?php

                            $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '3'";
                            $resultProducto = mysqli_query($conexion, $consultaProducto);
                            while ($producto = mysqli_fetch_array($resultProducto)) {
                                $datosProducto = $producto[0];

                                $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND agente = '$id_agente'";
                                $resultProduct = mysqli_query($conexion, $consultaProduct);
                                while ($product = mysqli_fetch_array($resultProduct)) {
                                    $datosProduct = $product[0];
                            ?>

                        ' <?php echo $datosProducto; ?>', <?php }
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
            color: '#F8C471',
            name: 'NEGOCIOS',
            data: [
                <?php
                if ($periodoInd == "7") {
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '3'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$periodoSemInd1' AND '$periodoSemInd2' AND agente = '$id_agente'";
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
                    $consultaProducto = "SELECT DISTINCT(producto) FROM producto_gmm WHERE tipo_solicitud = '3'";
                    $resultProducto = mysqli_query($conexion, $consultaProducto);
                    while ($producto = mysqli_fetch_array($resultProducto)) {
                        $datosProducto = $producto[0];
                        $consultaProduct = "SELECT COUNT(producto) FROM folios_g WHERE producto = '$datosProducto' AND t_solicitud = 'MOVIMIENTOS' AND fecha BETWEEN '$fecha1' AND '$nuevafecha2' AND agente = '$id_agente'";
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

    function NACIONAL() {
        document.getElementById("container2IndGMM").style.display = "block";
        document.getElementById("container2IndGMMINTER").style.display = "none";
        document.getElementById("container2IndGMMMOV").style.display = "none";
    }

    function INTERNACIONAL() {
        document.getElementById("container2IndGMM").style.display = "none";
        document.getElementById("container2IndGMMINTER").style.display = "block";
        document.getElementById("container2IndGMMMOV").style.display = "none";
    }

    function MOVIMIENTOS() {
        document.getElementById("container2IndGMM").style.display = "none";
        document.getElementById("container2IndGMMINTER").style.display = "none";
        document.getElementById("container2IndGMMMOV").style.display = "block";
    }
</script>