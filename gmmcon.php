<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();


if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}

//INACTIVIDAD DE SESION
if (isset($_SESSION['logged_in'])) {
    // set time-out period (in seconds)
    $inactive = 1500;

    // check to see if $_SESSION["timeout"] is set
    if (isset($_SESSION["timeout"])) {
        // calculate the session's "time to live"
        $sessionTTL = time() - $_SESSION["timeout"];
        if ($sessionTTL > $inactive) {
            session_destroy();
            date_default_timezone_set('America/Mexico_City');
            $hoy = date("Y-m-d");
            $nomusuario = $_SESSION['nomusuario'];
            $fecha1 = $_COOKIE["tiempo"];
            $fecha2 = date("H:i");
            $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
            $tiempoTotal = ($tiempo / 60 . " Minutos");
            if ($nomusuario == "Karla M" || $nomusuario == "Christian C" || $nomusuario == "Veronica S" || $nomusuario == "Giovanni M" || $nomusuario == "Karla B" || $nomusuario == "Diana C" || $nomusuario == "Carolina H" || $nomusuario == "Dante V" || $nomusuario == "Manuel R" || $nomusuario == "Roberto R" || $nomusuario == "Omar S" || $nomusuario == "Martin G" || $nomusuario == "Nancy O") {
                $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
            values
            ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
                $inserT = mysqli_query($conexion, $ti);
            }

?>
            <script>
                window.location = 'index.php';
            </script>
<?php

        }
    }

    $_SESSION["timeout"] = time();
}


if ($_SESSION['logged_in'] == 1) {
} else {
    header('location: index.php');
}

date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d H:i:s", $time);

$sql1 = "select * from tipo_solicitud_gmm order by tipo";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
    $combobit1 = "";
    while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
        $combobit1 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
    }
}

$sql2 = "select * from producto_gmm where tipo_solicitud='1' order by producto";
$result2 = $conexion->query($sql2);
if ($result2->num_rows > 0) {
    $combobit2 = "";
    while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
        $combobit2 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql3 = "select * from producto_gmm where tipo_solicitud='2' order by producto";
$result3 = $conexion->query($sql3);
if ($result3->num_rows > 0) {
    $combobit3 = "";
    while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
        $combobit3 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql4 = "select * from producto_gmm where tipo_solicitud='3' order by producto";
$result4 = $conexion->query($sql4);
if ($result4->num_rows > 0) {
    $combobit4 = "";
    while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
        $combobit4 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql5 = "select * from motivo order by tipo";
$result5 = $conexion->query($sql5);
if ($result5->num_rows > 0) {
    $combobit5 = "";
    while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
        $combobit5 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
    }
}


$sql6 = "select * from datos_agente order by nombre";
$result6 = $conexion->query($sql6);
if ($result6->num_rows > 0) {
    $combobit6 = "";
    while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
        $combobit6 .= " <option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--ALERTAS PARA MENSAJES DE VALIDACION-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <!--librerias de bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!--hojas de estilo-->
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
    <link rel="stylesheet" href="css/hoja_general_gmm.css">
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>

<?php
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '3' || $_SESSION['rol'] == '2') {
    include('plantillas/cabecera_gmm_c.php');
} else if ($_SESSION['rol'] == '9') {
    include('plantillas/cabecera_promocion_g.php');
}
?>

<body>

    <div class="container">
        <?php include('componentes/tabla_g_con.php'); ?>
        <div id="tabla"></div>
    </div>

    <!-- MODAL PARA REGISTROS NUEVOS -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Alta Folio GAM</h4>
                </div>

                <div class="modal-body">
                    <label>Fecha</label>
                    <input type="text" name="" value="<?php echo $fechaactual = date("Y-m-d", $time); ?>" id="fecha" class="form-control input-sm" disabled>

                    <label>Agente:</label>
                    <select type="text" name="agente" value="" id="agente" class="form-control input-sm">
                        <option value="" selected disabled hidden>Seleccione:</option>
                        <?php echo $combobit6; ?>
                    </select>

                    <label>Línea de negocio:</label>
                    <input type="text" name="negocio" value="GMM" id="negocio" class="form-control input-sm" disabled>

                    <label>Tipo de Solicitud:</label>
                    <select type="text" name="t_solicitud" value="" id="t_solicitud" onChange="mostrar()" class="form-control input-sm">
                        <option value="" selected disabled hidden>Seleccione:</option>
                        <?php echo $combobit1; ?>
                    </select>

                    <script>
                        function mostrar() {
                            var opcion = document.getElementById("t_solicitud").value;

                            if (opcion == "ALTA POLIZA NACIONAL") {
                                document.getElementById('t_nacional').style.display = 'block';
                                document.getElementById('t_internacional').style.display = 'none';
                                document.getElementById('t_movimiento').style.display = 'none';
                            } else if (opcion == "ALTA POLIZA INTERNACIONAL") {
                                document.getElementById('t_nacional').style.display = 'none';
                                document.getElementById('t_internacional').style.display = 'block';
                                document.getElementById('t_movimiento').style.display = 'none';
                            } else if (opcion == "MOVIMIENTOS") {
                                document.getElementById('t_nacional').style.display = 'none';
                                document.getElementById('t_internacional').style.display = 'none';
                                document.getElementById('t_movimiento').style.display = 'block';
                            } else {
                                document.getElementById('t_nacional').style.display = 'none';
                                document.getElementById('t_internacional').style.display = 'none';
                                document.getElementById('t_movimiento').style.display = 'none';
                            }
                        }
                    </script>

                    <div id="t_nacional" name="t_nacional" style="display: none;" class="col-md-14">
                        <label>Producto:</label>
                        <select type="text" name="t_solicitud_nacional" value="" id="t_solicitud_nacional" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit2; ?>
                        </select>

                        <!-- MONEDA PARA ALTA POLIZA NACIONAL -->
                        <label>Moneda:</label>
                        <input type="text" name="moneda_apn" value="PESOS" id="moneda_apn" class="form-control input-sm" disabled>

                        <label>Prima:</label>
                        <input type="text" name="prima" value="" id="prima" class="number form-control input-sm" id="prima" placeholder="#####" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 20 digitos)</i>
                    </div>
                    <div id="t_internacional" name="t_internacional" style="display: none;" class="col-md-14">
                        <label>Producto:</label>
                        <select type="text" name="t_solicitud_internacional" value="" id="t_solicitud_internacional" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit3; ?>
                        </select>

                        <!-- MONEDA PARA ALTA POLIZA INTERNACIONAL -->
                        <label>Moneda:</label>
                        <input type="text" name="moneda_api" value="PESOS" id="moneda_api" class="form-control input-sm" disabled>

                        <label>Prima:</label>
                        <input type="text" name="prima1" value="" id="prima1" class="number form-control input-sm" id="prima1" placeholder="#####" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 20 digitos)</i>
                    </div>
                    <div id="t_movimiento" name="t_movimiento" style="display: none;" class="col-md-14">
                        <label>Número de Póliza:</label>
                        <input type="text" name="num_poliza" value="" id="num_poliza" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
                        <label>Movimiento:</label>
                        <select type="text" name="movimiento" value="" id="movimiento" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit4; ?>
                        </select>
                    </div>
                    <label>Contratante:</label>
                    <input type="text" name="contratante" value="" id="contratante" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
                    <label>Prioridad:</label>
                    <select type="text" name="prioridad" value="" id="prioridad" onChange="mostrar1()" class="form-control input-sm">
                        <option value="" selected disabled hidden>Seleccione:</option>
                        <option value="ALTA">ALTA</option>
                        <option value="NORMAL"> NORMAL </option>
                    </select>
                    <script>
                        function mostrar1() {
                            var opcion1 = document.getElementById("prioridad").value;

                            if (opcion1 == "ALTA") {
                                document.getElementById('alta').style.display = 'block';
                            } else {
                                document.getElementById('alta').style.display = 'none';
                            }
                        }
                    </script>
                    <div id="alta" name="alta" style="display: none;">
                        <label>Motivo:</label>
                        <select type="text" name="motivo" value="" id="motivo" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit5; ?>
                        </select>
                    </div>
                    <label>Comentarios:</label>
                    <input type="text" name="comentarios" value="" id="comentarios" class="form-control input-sm" placeholder="Ingrese una Descripción" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
                    <label>Estado:</label>
                    <input type="text" name="estado" value="ENVIADO" id="estado" class="form-control input-sm" disabled>
                </div>
                <div class="modal-footer">
                    <button href="#" class="btn btn-primary" type="button" id="guardar-form" onclick="return validar()" id="btnreload"> Crear</button>
                </div>

                <!-- VALIDACION DE CAMPOS PARA EL MODAL -->
                <script type="text/javascript">
                    function validar() {
                        var agente = document.getElementById("agente").value;
                        var t_solicitud = document.getElementById("t_solicitud").value;
                        var t_solicitud_nacional = document.getElementById('t_solicitud_nacional').value;
                        var moneda_apn = document.getElementById('moneda_apn').value;
                        var prima = document.getElementById('prima').value;
                        var t_solicitud_internacional = document.getElementById('t_solicitud_internacional').value;
                        var moneda_api = document.getElementById('moneda_api').value;
                        var prima1 = document.getElementById('prima1').value;
                        var num_poliza = document.getElementById("num_poliza").value;
                        var movimiento = document.getElementById('movimiento').value;
                        var contratante = document.getElementById("contratante").value;
                        var prioridad = document.getElementById("prioridad").value;
                        var motivo = document.getElementById('motivo').value;
                        var comentarios = document.getElementById('comentarios').value;

                        // Primeros campos de validacion
                        if (agente.length == 0) {
                            swal({
                                title: "¡Error!",
                                text: "Seleccione alguna opción del combo Agente",
                                type: "error",
                                customClass: 'swal-wide',
                                allowOutsideClick: false
                            });
                            hasError = true;
                        } else if (t_solicitud.length == 0) {
                            swal({
                                title: "¡Error!",
                                text: "Seleccione alguna opción del combo Tipo de Solicitud",
                                type: "error",
                                customClass: 'swal-wide',
                                allowOutsideClick: false
                            });
                            hasError = true;
                            //Alta Poliza Nacional
                        } else if (t_solicitud == 'ALTA POLIZA NACIONAL') {
                            if (t_solicitud_nacional.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Producto",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (moneda_apn.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Moneda APN",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prima.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese la Prima correspondiente",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (contratante.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese el Nombre del Contratante",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prioridad.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Prioridad",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prioridad == 'ALTA') {
                                if (motivo.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Seleccione alguna opción del combo Motivo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario justificando el Motivo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;

                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "Los datos ingresados en la solicitud, debe ser los correctos",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfoliogmm() + actualizar());
                                        });
                                }
                            } else if (prioridad == 'NORMAL') {
                                swal({
                                        title: "¡Recuerda!",
                                        text: "Los datos ingresados en la solicitud, debe ser los correctos",
                                        type: "info",
                                        showCancelButton: true,
                                        cancelButtonText: "Corregir",
                                        confirmButtonColor: "#449d44",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                        customClass: "Custom_Cancel"
                                    },
                                    function() {
                                        $guarda = (guardarfoliogmm() + actualizar());
                                    });
                            }
                            //Alta Poliza Internacional
                        } else if (t_solicitud == 'ALTA POLIZA INTERNACIONAL') {
                            if (t_solicitud_internacional.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Producto",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (moneda_api.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Moneda API",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prima1.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese la Prima correspondiente",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (contratante.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese el Nombre del Contratante",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prioridad.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Prioridad",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prioridad == 'ALTA') {
                                if (motivo.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Seleccione alguna opción del combo Motivo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario justificando el Motivo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;

                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "Los datos ingresados en la solicitud, debe ser los correctos",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfoliogmm() + actualizar());
                                        });
                                }
                            } else if (prioridad == 'NORMAL') {
                                swal({
                                        title: "¡Recuerda!",
                                        text: "Los datos ingresados en la solicitud, debe ser los correctos",
                                        type: "info",
                                        showCancelButton: true,
                                        cancelButtonText: "Corregir",
                                        confirmButtonColor: "#449d44",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                        customClass: "Custom_Cancel"
                                    },
                                    function() {
                                        $guarda = (guardarfoliogmm() + actualizar());
                                    });
                            }
                        } else if (t_solicitud == 'MOVIMIENTOS') {
                            if (num_poliza.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese el Número de Póliza correspondiente",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (movimiento.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione una opción del combo Movimiento",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (contratante.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese el Nombre del Contratante",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prioridad.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Prioridad",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (prioridad == 'ALTA') {
                                if (motivo.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Seleccione alguna opción del combo Motivo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario justificando el Motivo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "Los datos ingresados en la solicitud, debe ser los correctos",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfoliogmm() + actualizar());
                                        });
                                }
                            } else if (prioridad == 'NORMAL') {
                                swal({
                                        title: "¡Recuerda!",
                                        text: "Los datos ingresados en la solicitud, debe ser los correctos",
                                        type: "info",
                                        showCancelButton: true,
                                        cancelButtonText: "Corregir",
                                        confirmButtonColor: "#449d44",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false,
                                        customClass: "Custom_Cancel"
                                    },
                                    function() {
                                        $guarda = (guardarfoliogmm() + actualizar());
                                    });
                            }
                        }
                    }
                </script>

                <script>
                    function guardarfoliogmm() {
                        var archivos_pdf = [];
                        fecha = $('#fecha').val();
                        agente = $('#agente').val()
                        negocio = $('#negocio').val()
                        t_solicitud = $('#t_solicitud').val();
                        t_solicitud_nacional = $('#t_solicitud_nacional').val();
                        t_solicitud_internacional = $('#t_solicitud_internacional').val();
                        movimiento = $('#movimiento').val();
                        moneda_apn = $('#moneda_apn').val();
                        moneda_api = $('#moneda_api').val();
                        prima = $('#prima').val();
                        prima1 = $('#prima1').val();
                        num_poliza = $('#num_poliza').val();
                        contratante = $('#contratante').val();
                        prioridad = $('#prioridad').val();
                        motivo = $('#motivo').val();
                        comentarios = $('#comentarios').val();
                        estado = $('#estado').val();

                        guardarfolio = "true";

                        var cadena = "fecha=" + fecha +
                            "&agente=" + agente +
                            "&negocio=" + negocio +
                            "&t_solicitud=" + t_solicitud +
                            "&t_solicitud_nacional=" + t_solicitud_nacional +
                            "&t_solicitud_internacional=" + t_solicitud_internacional +
                            "&movimiento=" + movimiento +
                            "&moneda_apn=" + moneda_apn +
                            "&moneda_api=" + moneda_api +
                            "&prima=" + prima +
                            "&prima1=" + prima1 +
                            "&num_poliza=" + num_poliza +
                            "&contratante=" + contratante +
                            "&prioridad=" + prioridad +
                            "&motivo=" + motivo +
                            "&comentarios=" + comentarios +
                            "&estado=" + estado +
                            '&guardar=' + 'v';

                        if (window.FormData) {
                            formdata = new FormData();
                        }

                        formdata.append("datos", cadena);
                        $.ajax({
                            url: 'php/agregarfolio_gmm_consultor.php',
                            type: 'POST',
                            contentType: false,
                            data: formdata,
                            processData: false,
                            cache: false,
                            success: function(resultado) {
                                $('#guardar-form').removeAttr("disabled");
                            },
                            error: function() {
                                alert("Algo ha fallado.");
                            }
                        });
                    }
                </script>

                <script>
                    function actualizar(segs) {
                        setTimeout(function() {
                            location.reload();
                        }, parseInt(segs) * 1000);
                    }
                </script>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="js/index.js"></script>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#MyAutomatic').modal('show')
            $('input.number').keyup(function(event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) {
                    event.preventDefault();
                }

                $(this).val(function(index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            });

        });
    </script>
</footer>

</html>