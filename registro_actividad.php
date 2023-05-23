<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}

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
    <script src="js/registro_actividad.js"></script>
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_registro.css">

</head>

<?php
// Redirecciona al index si es agente
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
    // Muestra la cabecera para visualizar la actividad del portal
} else {
    include('plantillas/cabecera_regActividad.php');
}
?>

<body>

    <!-- Primer select muestra los nombres del colaborador que se desea consultar -->
    <div class="container">
        <label>Seleccione un Consultor: </label>
        <select type="text" class="form-control input-sm" id="select" name="select" onchange="mostrarSeleccion()">
            <option value="Seleccione" selected disabled hidden>Seleccionar:</option>
            <option value="Carolina">CAROLINA HERNANDEZ MORA</option>
            <option value="Dante">DANTE VILLEGAS FONSECA</option>
            <option value="Diana">DIANA CASTRO GARCIA</option>
            <option value="Giovanni">GIOVANNI JOSUE MEJIA COLMENARES</option>
            <option value="Karla">KARLA BAHENA</option>
            <option value="Veronica">VERONICA SANCHEZ MONTESINOS</option>
            <option value="Todos">TODOS</option>
        </select>
    </div>

    <!-- SELECCION CAROLINA -->
    <div id="Carolina" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviar();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1" name="date1" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2" name="date2" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respC"></p>
        </div>
    </div>

    <!-- SELECCION DANTE -->
    <div id="Dante" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarDa();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1Da" name="date1Da" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2Da" name="date2Da" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respDa"></p>
        </div>

    </div>

    <!-- SELECCION DIANA -->
    <div id="Diana" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarDi();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1Di" name="date1Di" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2Di" name="date2Di" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respDi"></p>
        </div>

    </div>


    <!-- SELECCION GIOVANNI -->
    <div id="Giovanni" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarGi();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1Gi" name="date1Gi" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2Gi" name="date2Gi" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respGi"></p>
        </div>

    </div>

    <!-- SELECCION KARLA -->
    <div id="Karla" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarK();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1K" name="date1K" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2K" name="date2K" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respK"></p>
        </div>

    </div>

    <!-- SELECCION VERONICA -->
    <div id="Veronica" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarV();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1V" name="date1V" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2V" name="date2V" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respV"></p>
        </div>
    </div>

    <!-- SELECCION TODOS -->
    <div id="Todos" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarTotal();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" id="date1T" name="date1T" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" id="date2T" name="date2T" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="respT"></p>
        </div>

    </div>

</body>

</html>