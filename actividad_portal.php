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
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_registro_completo.css">
    <!-- JS -->
    <script src="js/registros_completos.js"></script>

</head>

<?php
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '4') {
    include('plantillas/cabecera_regActividad.php');
} else {
    include('plantillas/cabecera_regPortal.php');
}
?>

<body>

    <!-- SELECT OPTION QUE DESEA CONSULTAR -->

    <div class="container">
        <div class="form-group form-control-sm">
            <label for="exampleFormControlSelect1">Seleccione su consulta:</label>
            <select class="form-control" id="seleccion" name="seleccion" onchange="showInp()">
                <option selected disabled hidden>Seleccione: </option>
                <option value="1">GENERAL</option>
                <option value="2">INDIVIDUAL</option>
            </select>
        </div>
    </div>

    <!-- CALENDARIO GENERAL -->

    <div id="mostrarGeneral" style="display: none;">

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

    <div id="mostrarIndividual" style="display: none;">

        <!-- SELECT OPTION CONSULTA INDIVIDUAL -->

        <div class="container">
            <div class="form-group form-control-sm">
                <label for="exampleFormControlSelect1">Seleccione a quien que desee consultar:</label>
                <form method="POST" onsubmit="return enviarIndividual();">
                    <select class="form-control" id="seleccion2" name="seleccion2">
                        <option selected disabled hidden value="">Seleccione: </option>
                        <?php
                        $sql = "SELECT nombre FROM datos_operativos WHERE nomusuario = 'Carolina H' OR nomusuario = 'Dante V' OR nomusuario = 'Diana C' OR nomusuario = 'Giovanni M' OR nomusuario = 'Karla B' OR nomusuario = 'Veronica S' OR nomusuario = 'Manuel R' OR nomusuario = 'Martin G' OR nomusuario = 'Nancy O' OR nomusuario = 'Omar S' OR nomusuario = 'Roberto R'  OR nomusuario = 'Daniela V' ORDER BY nombre";
                        $result = mysqli_query($conexion, $sql);
                        while ($registros = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $registros['nombre'] ?>"> <?php echo $registros['nombre'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
            </div>
        </div>

        <!-- CALENDARIO INDIVIDUAL -->

        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <div class='col-md-2'>
                        <div class="form-group">
                            <label>Desde </label><input type="date" name="date1" id="date1" class="form-control form-control-sm input-sm">
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            <label>Hasta </label><input type="date" name="date2" id="date2" class="form-control form-control-sm input-sm">
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
            <p id="respInd"></p>
        </div>
    </div>

</body>

</html>