<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();
$id = $_SESSION['id_usuario'];

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fechaActual=strftime("%Y-%m-%d");
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!-- JS -->
    <script src="js/datos_adicionales_gdd.js"></script>
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_datos_adicionales.css">
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>

<?php
include('plantillas/cabecera_datosAdicionales_gdd.php');
?>

<body>

    <!-- SELECCION POR RAMO -->
    <div class="container">
        <div class="form-group form-control-sm">
            <label for="exampleFormControlSelect1">Ramo:</label>
            <select class="form-control" id="ramo" name="ramo" onchange="show()">
                <option selected disabled hidden>Seleccione: </option>
                <option value="autos">AUTOS</option>
                <option value="gmm">GMM</option>
                <option value="siniestros">SINIESTROS</option>
                <option value="vida">VIDA</option>
            </select>
        </div>
    </div>

    <!-- DATOS / SINIESTROS, GMM, AUTOS -->
    <div id="datosRamos" style="display: none;">
        <form method="POST" onsubmit="return enviarDato();">

            <!-- SELECCION DE CONSULTA GENERAL / INDIVIDUAL -->
            <div class="container">
                <div class="form-group form-control-sm">
                    <label for="exampleFormControlSelect1">Consulta:</label>
                    <select class="form-control" id="selectGoV" name="selectGoV" onchange="showDatos()">
                        <option selected disabled hidden>Seleccione: </option>
                        <option value="general">GENERAL</option>
                        <option value="individual">INDIVIDUAL</option>
                    </select>
                </div>
            </div>

            <!-- DATOS GENERALES -->
            <div id="datosGenerales" style="display: none;">

                <!-- PERIODOS -->
                <div class="container">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoGeneral" name="periodoGeneral" onchange="showGeneral()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="semanal">PERSONALIZADO</option>
                                        <option value="mensual">MENSUAL</option>
                                        <option value="cuatrimestral">CUATRIMESTRAL</option>
                                        <option value="semestral">SEMESTRAL</option>
                                        <option value="anual">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONSULTA PERSONALIZADA -->
                <div class="container" id="semanalG" style="display: none;">
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
                <div class="container" id="mensualG" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensualG" name="periodoMensualG" onchange="showYearG()">
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
                <div class="container" id="cuatrimestralG" style="display: none;">
                    <label>Cuatrimestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoCuatrimestralG" name="periodoCuatrimestralG" onchange="showYearG()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerCg">1ero</option>
                                        <option value="segundoCg">2do</option>
                                        <option value="terceroCg">3ro</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRE -->
                <div class="container" id="semestralG" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestralG" name="periodoSemestralG" onchange="showYearG()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerSg">1ero</option>
                                        <option value="segundoSg">2do</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AÑO -->
                <div class="container" id="yearG" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="yearGeneral" name="yearGeneral">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <p id="resp_G"></p>
                </div>

            </div>

        </form>

        <form method="POST" onsubmit="return enviarIndividual();">
            <!-- DATOS INDIVIDUALES -->
            <div id="datosIndividuales" style="display: none;">

                <!-- AGENTE -->
                <div class="container">
                    <label>Agente:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="agente" name="agente" onchange="showIndividual()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <?php
                                        $query = mysqli_query($conexion, "SELECT * FROM datos_agente WHERE gdd = '$id' ORDER BY nombre");

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
                <div class="container" id="periodoIndividual" style="display: none;">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoInd" name="periodoInd" onchange="showIndividual()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="semanalInd">PERSONALIZADO</option>
                                        <option value="mensualInd">MENSUAL</option>
                                        <option value="cuatrimestralInd">CUATRIMESTRAL</option>
                                        <option value="semestralInd">SEMESTRAL</option>
                                        <option value="anualInd">ANUAL</option>
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

                <!-- MES -->
                <div class="container" id="mensualInd" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensualInd" name="periodoMensualInd" onchange="showYearInd()">
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
                                    <select class="form-control" id="periodoCuatrimestralInd" name="periodoCuatrimestralInd" onchange="showYearInd()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerCind">1ero</option>
                                        <option value="segundoCind">2do</option>
                                        <option value="tercerCind">3ro</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRE -->
                <div class="container" id="semestralInd" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestralInd" name="periodoSemestralInd" onchange="showYearInd()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerSind">1ero</option>
                                        <option value="segundoSind">2do</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AÑO -->
                <div class="container" id="yearInd" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="yearIndividual" name="yearIndividual">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <p id="resp_Ind"></p>
                </div>

            </div>
        </form>
    </div>


    <!-- DATOS / VIDA -->
    <div id="datosVida" style="display: none;">

        <form method="POST" onsubmit="return enviarDato_v();">
            <!-- SELECCION DE CONSULTA GENERAL / INDIVIDUAL -->
            <div class="container">
                <div class="form-group form-control-sm">
                    <label for="exampleFormControlSelect1">Consulta:</label>
                    <select class="form-control" id="selectGoInd_v" name="selectGoInd_v" onchange="showDatosVida()">
                        <option selected disabled hidden>Seleccione: </option>
                        <option value="generalVida">GENERAL</option>
                        <option value="individualVida">INDIVIDUAL</option>
                    </select>
                </div>
            </div>

            <!-- DATOS GENERALES -->
            <div id="datosGeneralesV" style="display: none;">

                <!-- PERIODOS -->
                <div class="container">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoGeneral_v" name="periodoGeneral_v" onchange="showGeneral_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="semanalV">PERSONALIZADO</option>
                                        <option value="mensualV">MENSUAL</option>
                                        <option value="trimestralV">TRIMESTRAL</option>
                                        <option value="semestralV">SEMESTRAL</option>
                                        <option value="anualV">ANUAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONSULTA PERSONALIZADA -->
                <div class="container" id="semanalG_v" style="display: none;">
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
                <div class="container" id="mensualG_v" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensualG_v" name="periodoMensualG_v" onchange="showYearG_v()">
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
                <div class="container" id="trimestralG_v" style="display: none;">
                    <label>Trimestral:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoTrimestralG_v" name="periodoTrimestralG_v" onchange="showYearG_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerTg_v">1ero</option>
                                        <option value="segundoTg_v">2do</option>
                                        <option value="terceroTg_v">3ro</option>
                                        <option value="cuartoTg_v">4to</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRE -->
                <div class="container" id="semestralG_v" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestralG_v" name="periodoSemestralG_v" onchange="showYearG_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerSg_v">1ero</option>
                                        <option value="segundoSg_v">2do</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AÑO -->
                <div class="container" id="yearG_v" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="yearGeneral_v" name="yearGeneral_v">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <p id="resp_G_v"></p>
                </div>

            </div>
        </form>


        <!-- DATOS INDIVIDUALES -->
        <form method="POST" onsubmit="return enviarIndividual_v();">
            <!-- DATOS INDIVIDUALES -->
            <div id="datosIndividualesV" style="display: none;">

                <!-- AGENTE -->
                <div class="container">
                    <label>Agente:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="agente_v" name="agente_v" onchange="showIndividual_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <?php
                                        $query = mysqli_query($conexion, "SELECT * FROM datos_agente WHERE gdd = '$id' ORDER BY nombre");

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
                <div class="container" id="periodoIndividual_v" style="display: none;">
                    <label>Periodo:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoInd_v" name="periodoInd_v" onchange="showIndividual_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="semanalIndV">PERSONALIZADO</option>
                                        <option value="mensualIndV">MENSUAL</option>
                                        <option value="trimestralIndV">TRIMESTRAL</option>
                                        <option value="semestralIndV">SEMESTRAL</option>
                                        <option value="anualIndV">ANUAL</option>
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

                <!-- MES -->
                <div class="container" id="mensualInd_v" style="display: none;">
                    <label>Mes:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoMensualInd_v" name="periodoMensualInd_v" onchange="showYearInd_v()">
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
                    <label>Trimestral:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoTrimestralInd_v" name="periodoTrimestralInd_v" onchange="showYearInd_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerTind_v">1ero</option>
                                        <option value="segundoTind_v">2do</option>
                                        <option value="tercerTind_v">3ro</option>
                                        <option value="cuartoTind_v">4to</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTRE -->
                <div class="container" id="semestralInd_v" style="display: none;">
                    <label>Semestre:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="periodoSemestralInd_v" name="periodoSemestralInd_v" onchange="showYearInd_v()">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="primerSind_v">1ero</option>
                                        <option value="segundoSind_v">2do</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AÑO -->
                <div class="container" id="yearInd_v" style="display: none;">
                    <label>Año:</label>
                    <div class="text-center">
                        <div class="row">
                            <div class='col-md-2'>
                                <div class="form-group">
                                    <select class="form-control" id="yearIndividual_v" name="yearIndividual_v">
                                        <option selected disabled hidden>Seleccione: </option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-2'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <p id="resp_Ind_v"></p>
                </div>

            </div>
        </form>

    </div>


</body>

</html>