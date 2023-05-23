<?php
error_reporting(E_ALL);
session_start();
include 'app/conexion.php';
$conexion = conexion();

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fechaActual=strftime("%Y-%m-%d");

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!-- JS -->
    <script src="js/colaborador.js"></script>
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_general_estadisticas.css">
    <link rel="stylesheet" type="text/css" href="css/graficos.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="librerias/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/themes/grid-light.js"></script>
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>

<?php
include('plantillas/cabecera_general_estadisticas.php');
?>

<body>

    <!-- SELECCION POR RAMO / ESTADISTICAS GAM -->
    <div class="container">
        <div class="form-group form-control-sm">
            <label for="exampleFormControlSelect1">Ramo:</label>
            <select class="form-control" id="ramo" name="ramo" onchange="show()">
                <option selected disabled hidden>Seleccione: </option>
                <option value="4">AUTOS</option>
                <option value="2">GMM</option>
                <option value="3">SINIESTROS</option>
                <option value="1">VIDA</option>
            </select>
        </div>
    </div>

    <!-- DATOS A MOSTRAR PARA / SINIESTROS, GMM, AUTOS -->
    <div id="ramosEstGam" style="display: none;">
        <form method="POST" onsubmit="return enviarGeneral();">
            <!-- SELECCION GENERAL O INDIVIDUAL -->
            <div class="container">
                <div class="form-group form-control-sm">
                    <label for="exampleFormControlSelect1">Consulta:</label>
                    <select class="form-control" id="selec" name="selec" onchange="showDatos()">
                        <option selected disabled hidden>Seleccione: </option>
                        <option value="1">GENERAL</option>
                        <option value="2">INDIVIDUAL</option>
                    </select>
                </div>
            </div>

            <!-- PRIMERA GRAFICA / LADO DERECHO -->
            <div style="float: right; position: absolute; right: 100px; top: 5px; width: 50%;" class="div">
                <p id="respG"></p>
                <p id="respInd"></p>
            </div>

            <!-- DATOS GENERALES -->
            <div id="dtGenerales" style="display: none;">

                <!-- PERIODO -->
                <div class="container">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoGeneral" name="periodoGeneral" onchange="showInp2()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="7">PERSONALIZADO</option>
                                        <option value="1">MENSUAL</option>
                                        <option value="4">CUATRIMESTRAL</option>
                                        <option value="5">SEMESTRAL</option>
                                        <option value="6">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONSULTA PERSONALIZADA -->
                <div class="container" id="semanal" style="display: none;">
                    <label>Consulta personalizada:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Desde </label><input type="date" id="date1Sg" name="date1Sg" class="form-control form-control-sm input-sm">
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Hasta </label><input type="date" id="date2Sg" name="date2Sg" class="form-control form-control-sm input-sm" value = "<?php echo $fechaActual?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <!-- MENSUAL -->
                <div class="container" id="mensual" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensual" name="periodoMensual" onchange="year()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="01">ENERO</option>
                                        <option value="02">FEBRERO</option>
                                        <option value="03">MARZO</option>
                                        <option value="04">ABRIL</option>
                                        <option value="05">MAYO</option>
                                        <option value="06">JUNIO</option>
                                        <option value="07">JULIO</option>
                                        <option value="08">AGOSTO</option>
                                        <option value="09">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CUATRIMESTRAL -->
                <div class="container" id="cuatrimestral" style="display: none;">
                    <label>Cuatrimestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoCuatrimestral" name="periodoCuatrimestral" onchange="year()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                        <option value="3">3ro</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRAL -->
                <div class="container" id="semestre" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestral" name="periodoSemestral" onchange="year()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ANUAL -->
                <div class="container" id="year" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="año" name="año">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" onclick="muestraGrafico();">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="text-center">
                        <p id="respG2"></p>
                    </div>
                </div>

            </div>
        </form>


        <!-- DATOS INDIVIDUALES -->
        <form method="POST" onsubmit="return enviarIndividual();">
            <div id="dtIndividual" style="display: none;">

                <!-- AGENTE -->
                <div class="container">
                    <label>Agente:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="agente" name="agente" onchange="showInp3()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <?php
                                        $query = mysqli_query($conexion, "SELECT * FROM datos_agente ORDER BY nombre");

                                        while ($datos = mysqli_fetch_array($query)) {
                                        ?>
                                            <option value="<?php echo $datos['nombre'] ?>"> <?php echo $datos['nombre'] ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- PERIODO -->
                <div class="container" id="individual" style="display: none;">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoInd" name="periodoInd" onchange="showInp3()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="7">PERSONALIZADO</option>
                                        <option value="1">MENSUAL</option>
                                        <option value="4">CUATRIMESTRAL</option>
                                        <option value="5">SEMESTRAL</option>
                                        <option value="6">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONSULTA PERSONALIZADA -->
                <div class="container" id="semanalInd" style="display: none;">
                    <label>Consulta personalizada:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Desde </label><input type="date" id="date1Sind" name="date1Sind" class="form-control form-control-sm input-sm">
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Hasta </label><input type="date" id="date2Sind" name="date2Sind" class="form-control form-control-sm input-sm" value = "<?php echo $fechaActual?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <!-- MENSUAL -->
                <div class="container" id="mensualInd" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensualInd" name="periodoMensualInd" onchange="yearInd()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="01">ENERO</option>
                                        <option value="02">FEBRERO</option>
                                        <option value="03">MARZO</option>
                                        <option value="04">ABRIL</option>
                                        <option value="05">MAYO</option>
                                        <option value="06">JUNIO</option>
                                        <option value="07">JULIO</option>
                                        <option value="08">AGOSTO</option>
                                        <option value="09">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CUATRIMESTRE -->
                <div class="container" id="cuatrimestralInd" style="display: none;">
                    <label>Cuatrimestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoCuatrimestralInd" name="periodoCuatrimestralInd" onchange="yearInd()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                        <option value="3">3ro</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRE -->
                <div class="container" id="semestreInd" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestralInd" name="periodoSemestralInd" onchange="yearInd()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ANUAL -->
                <div class="container" id="yearInd" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="añoInd" name="añoInd">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" onclick="muestraGrafico2();">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="text-center">
                        <p id="respInd2"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- DATOS A MOSTRAR PARA / VIDA -->
    <div id="ramosEstGam_v" style="display: none;">
        <form method="POST" onsubmit="return enviarGeneral_v();">
            <!-- SELECCION GENERAL O INDIVIDUAL -->
            <div class="container">
                <div class="form-group form-control-sm">
                    <label for="exampleFormControlSelect1">Consulta:</label>
                    <select class="form-control" id="selec_v" name="selec" onchange="showDatos_v()">
                        <option selected disabled hidden>Seleccione: </option>
                        <option value="1_v">GENERAL</option>
                        <option value="2_v">INDIVIDUAL</option>
                    </select>
                </div>
            </div>

            <!-- PRIMERA GRAFICA / LADO DERECHO -->
            <div style="float: right; position: absolute; right: 100px; top: 5px; width: 50%;" class="div">
                <p id="respG_v"></p>
                <p id="respInd_v"></p>
            </div>

            <!-- DATOS GENERALES -->
            <div id="dtGenerales_v" style="display: none;">

                <!-- PERIODO -->
                <div class="container">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoGeneral_v" name="periodoGeneral_v" onchange="showInp2_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="7_v">PERSONALIZADO</option>
                                        <option value="1_v">MENSUAL</option>
                                        <option value="3_v">TRIMESTRAL</option>
                                        <option value="5_v">SEMESTRAL</option>
                                        <option value="6_v">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONSULTA PERSONALIZADA -->
                <div class="container" id="semanal_v" style="display: none;">
                    <label>Consulta personalizada:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Desde </label><input type="date" id="date1Sg_v" name="date1Sg_v" class="form-control form-control-sm input-sm">
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Hasta </label><input type="date" id="date2Sg_v" name="date2Sg_v" class="form-control form-control-sm input-sm" value = "<?php echo $fechaActual?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <!-- MENSUAL -->
                <div class="container" id="mensual_v" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensual_v" name="periodoMensual_v" onchange="yearG_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="01">ENERO</option>
                                        <option value="02">FEBRERO</option>
                                        <option value="03">MARZO</option>
                                        <option value="04">ABRIL</option>
                                        <option value="05">MAYO</option>
                                        <option value="06">JUNIO</option>
                                        <option value="07">JULIO</option>
                                        <option value="08">AGOSTO</option>
                                        <option value="09">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TRIMESTRAL -->
                <div class="container" id="trimestral_v" style="display: none;">
                    <label>Trimestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoTrimestral_v" name="periodoTrimestral_v" onchange="yearG_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                        <option value="3">3ro</option>
                                        <option value="4">4to</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRAL -->
                <div class="container" id="semestre_v" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestral_v" name="periodoSemestral_v" onchange="yearG_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ANUAL -->
                <div class="container" id="year_v" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="año_v" name="año_v">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" onclick="muestraGraficoG_v();">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="text-center">
                        <p id="respG2_v"></p>
                    </div>
                </div>

            </div>
        </form>


        <!-- DATOS INDIVIDUALES -->
        <form method="POST" onsubmit="return enviarIndividual_v();">
            <div id="dtIndividual_v" style="display: none;">

                <!-- AGENTE -->
                <div class="container">
                    <label>Agente:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="agente_v" name="agente_v" onchange="showInp3_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <?php
                                        $query = mysqli_query($conexion, "SELECT * FROM datos_agente ORDER BY nombre");

                                        while ($datos = mysqli_fetch_array($query)) {
                                        ?>
                                            <option value="<?php echo $datos['nombre'] ?>"> <?php echo $datos['nombre'] ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PERIODO -->
                <div class="container" id="individual_v" style="display: none;">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoInd_v" name="periodoInd_v" onchange="showInp3_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="7ind_v">PERSONALIZADO</option>
                                        <option value="1ind_v">MENSUAL</option>
                                        <option value="3ind_v">TRIMESTRAL</option>
                                        <option value="5ind_v">SEMESTRAL</option>
                                        <option value="6ind_v">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONSULTA PERSONALIZADA -->
                <div class="container" id="semanalInd_v" style="display: none;">
                    <label>Consulta personalizada:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Desde </label><input type="date" id="date1Sind_v" name="date1Sind_v" class="form-control form-control-sm input-sm">
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <label>Hasta </label><input type="date" id="date2Sind_v" name="date2Sind_v" class="form-control form-control-sm input-sm" value = "<?php echo $fechaActual?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <!-- MENSUAL -->
                <div class="container" id="mensualInd_v" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensualInd_v" name="periodoMensualInd_v" onchange="yearInd_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="01">ENERO</option>
                                        <option value="02">FEBRERO</option>
                                        <option value="03">MARZO</option>
                                        <option value="04">ABRIL</option>
                                        <option value="05">MAYO</option>
                                        <option value="06">JUNIO</option>
                                        <option value="07">JULIO</option>
                                        <option value="08">AGOSTO</option>
                                        <option value="09">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TRIMESTRAL -->
                <div class="container" id="trimestralInd_v" style="display: none;">
                    <label>Trimestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoTrimestralInd_v" name="periodoTrimestralInd_v" onchange="yearInd_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                        <option value="3">3ro</option>
                                        <option value="4">4to</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRE -->
                <div class="container" id="semestreInd_v" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestralInd_v" name="periodoSemestralInd_v" onchange="yearInd_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="1">1ero</option>
                                        <option value="2">2do</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ANUAL -->
                <div class="container" id="yearInd_v" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="añoInd_v" name="añoInd_v">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" onclick="muestraGrafico2_v();">Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="text-center">
                        <p id="respInd2_v"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>




</body>

</html>