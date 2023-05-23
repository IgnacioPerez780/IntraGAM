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

$sql1 = "select * from tipo_solicitud_autos order by id";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
    $combobit1 = "";
    while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
        $combobit1 .= " <option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>";
    }
}

$sql2 = "select * from producto_autos where tipo_solicitud='1' order by producto";
$result2 = $conexion->query($sql2);
if ($result2->num_rows > 0) {
    $combobit2 = "";
    while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
        $combobit2 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql3 = "select * from producto_autos where tipo_solicitud='2' order by producto";
$result3 = $conexion->query($sql3);
if ($result3->num_rows > 0) {
    $combobit3 = "";
    while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
        $combobit3 .= " <option value='" . $row['producto'] . "'>" . $row['producto'] . "</option>";
    }
}

$sql5 = "select * from motivo_a order by tipo";
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
    <link rel="stylesheet" href="css/hoja_general_autos.css">
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    
    <!-- Chatra {literal}
<script>
    (function(d, w, c) {
        w.ChatraID = 'nhpkGLxTvJKpwhFt8';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = 'https://call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
</script>
/Chatra {/literal} -->
</head>

<?php
include('plantillas/cabecera_agente_a.php');
?>

<body>

    <div class="container">
        <?php include('componentes/tabla_a_a.php'); ?>
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

                    <label>Línea de negocio:</label>
                    <input type="text" name="negocio" value="AUTOS" id="negocio" class="form-control input-sm" disabled>

                    <label>Tipo de Solicitud:</label>
                    <select type="text" name="t_solicitud" value="" id="t_solicitud" onChange="mostrar()" class="form-control input-sm">
                        <option value="" selected disabled hidden>Seleccione:</option>
                        <?php echo $combobit1; ?>
                    </select>

                    <script>
                        function mostrar() {
                            var opcion = document.getElementById("t_solicitud").value;

                            if (opcion == "NUEVO NEGOCIO") {
                                document.getElementById('t_nuevo').style.display = 'block';
                                document.getElementById('t_movimiento').style.display = 'none';
                            } else if (opcion == "MOVIMIENTOS") {
                                document.getElementById('t_nuevo').style.display = 'none';
                                document.getElementById('t_movimiento').style.display = 'block';
                            } else {
                                document.getElementById('t_nuevo').style.display = 'none';
                                document.getElementById('t_movimiento').style.display = 'none';
                            }
                        }
                    </script>

                    <div id="t_nuevo" name="t_nuevo" style="display: none;" class="col-md-14">
                        <label>Número de Resolución:</label>
                        <input type="text" name="num_resolucion" value="" id="num_resolucion" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
                        <label>Producto:</label>
                        <select type="text" name="t_solicitud_nuevo" value="" id="t_solicitud_nuevo" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit2; ?>
                        </select>
                    </div>
                    <div id="t_movimiento" name="t_movimiento" style="display: none;" class="col-md-14">
                        <label>Número de Póliza:</label>
                        <input type="text" name="num_poliza" value="" id="num_poliza" class="form-control input-sm" placeholder="#####" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
                        <label>Movimiento:</label>
                        <select type="text" name="movimiento" value="" id="movimiento" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit3; ?>
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
                        <select type="text" name="motivo" value="" id="motivo" onChange="motivo()" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit5; ?>
                        </select>
                        <script>
                            function motivo() {
                                var opcion2 = document.getElementById("motivo").value;

                                if (opcion2 == "OTROS") {
                                    document.getElementById('otros').style.display = 'block';
                                } else {
                                    document.getElementById('otros').style.display = 'none';
                                }
                            }
                        </script>


                        <div id="otros" name="otros" style="display: none;">
                            <label>Descripción:</label>
                            <input type="text" name="descripcion" value="" id="descripcion" class="form-control input-sm" placeholder="Ingrese una Descripción Breve" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                    <label>Contacto:</label>
                    <input maxlength="12" onkeypress="return valideKey(event);" type="text" name="telefono" value="" id="telefono" class="form-control input-sm" placeholder="Ingrese un número telefónico" required>

                    <label>Comentarios:</label>
                    <input type="text" name="comentarios" value="" id="comentarios" class="form-control input-sm" placeholder="Ingrese una Descripción" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>

                    <label>Estado:</label>
                    <input type="text" name="estado" value="ENVIADO" id="estado" class="form-control input-sm" disabled>
                </div>
                <div class="modal-footer">
                    <button href="#" class="btn btn-primary" type="button" id="guardar-form" onclick="return validar1()" id="btnreload"> Crear</button>
                </div>

                <script type="text/javascript">
                    function valideKey(evt) {
                        // code is the decimal ASCII representation of the pressed key.
                        var code = (evt.which) ? evt.which : evt.keyCode;

                        if (code == 8) { // backspace.
                            return true;
                        } else if (code >= 48 && code <= 57) { // is a number.
                            return true;
                        } else { // other keys.
                            return false;
                        }
                    }

                    // VALIDACION DE CAMPOS EN EL MODAL 
                    function validar1() {
                        var t_solicitud = document.getElementById("t_solicitud").value;
                        var num_resolucion = document.getElementById('num_resolucion').value;
                        var t_solicitud_nuevo = document.getElementById('t_solicitud_nuevo').value;
                        var num_poliza = document.getElementById("num_poliza").value;
                        var movimiento = document.getElementById('movimiento').value;
                        var contratante = document.getElementById("contratante").value;
                        var prioridad = document.getElementById("prioridad").value;
                        var motivo = document.getElementById('motivo').value;
                        var descripcion = document.getElementById('descripcion').value;
                        var telefono = document.getElementById("telefono").value;
                        var comentarios = document.getElementById('comentarios').value;
                        // Primeros campos de validacion
                        if (t_solicitud.length == 0) {
                            swal({
                                title: "¡Error!",
                                text: "Seleccione alguna opción del combo Tipo de Solicitud",
                                type: "error",
                                customClass: 'swal-wide',
                                allowOutsideClick: false
                            });
                            hasError = true;
                            // Nuevo Negocio 
                        } else if (t_solicitud == 'NUEVO NEGOCIO') {
                            if (num_resolucion.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Ingrese el Número de Resolución correspondiente",
                                    type: "error",
                                    customClass: 'swal-wide',
                                    allowOutsideClick: false
                                });
                                hasError = true;
                            } else if (t_solicitud_nuevo.length == 0) {
                                swal({
                                    title: "¡Error!",
                                    text: "Seleccione alguna opción del combo Producto",
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
                                } else if (motivo == 'OTROS') {
                                    if (descripcion.length == 0) {
                                        swal({
                                            title: "¡Error!",
                                            text: "Ingrese una Descripción del Motivo",
                                            type: "error",
                                            customClass: 'swal-wide',
                                            allowOutsideClick: false
                                        });
                                        hasError = true;
                                    } else if (telefono.length == 0) {
                                        swal({
                                            title: "¡Error!",
                                            text: "Ingrese un número telefónico para contactarlo",
                                            type: "error",
                                            customClass: 'swal-wide',
                                            allowOutsideClick: false
                                        });
                                        hasError = true;
                                    } else if (comentarios.length == 0) {
                                        swal({
                                            title: "¡Error!",
                                            text: "Ingrese un Comentario para continuar",
                                            type: "error",
                                            customClass: 'swal-wide',
                                            allowOutsideClick: false
                                        });
                                        hasError = true;
                                    } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                        swal({
                                                title: "¡Recuerda!",
                                                text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                                                type: "info",
                                                showCancelButton: true,
                                                cancelButtonText: "Corregir",
                                                confirmButtonColor: "#449d44",
                                                confirmButtonText: "Ok",
                                                closeOnConfirm: false,
                                                customClass: "Custom_Cancel"
                                            },
                                            function() {
                                                $guarda = (guardarfolioautos1() + actualizar());
                                            });
                                    }
                                } else if (telefono.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un número telefónico para contactarlo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario para continuar",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfolioautos1() + actualizar());
                                        });
                                }
                            } else if (prioridad == 'NORMAL') {
                                if (telefono.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un número telefónico para contactarlo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario para continuar",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfolioautos1() + actualizar());
                                        });
                                }
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
                                } else if (motivo == 'OTROS') {
                                    if (descripcion.length == 0) {
                                        swal({
                                            title: "¡Error!",
                                            text: "Ingrese un Descripción del Motivo",
                                            type: "error",
                                            customClass: 'swal-wide',
                                            allowOutsideClick: false
                                        });
                                        hasError = true;
                                    } else if (telefono.length == 0) {
                                        swal({
                                            title: "¡Error!",
                                            text: "Ingrese un número telefónico para contactarlo",
                                            type: "error",
                                            customClass: 'swal-wide',
                                            allowOutsideClick: false
                                        });
                                        hasError = true;
                                    } else if (comentarios.length == 0) {
                                        swal({
                                            title: "¡Error!",
                                            text: "Ingrese un Comentario para continuar",
                                            type: "error",
                                            customClass: 'swal-wide',
                                            allowOutsideClick: false
                                        });
                                        hasError = true;
                                    } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                        swal({
                                                title: "¡Recuerda!",
                                                text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                                                type: "info",
                                                showCancelButton: true,
                                                cancelButtonText: "Corregir",
                                                confirmButtonColor: "#449d44",
                                                confirmButtonText: "Ok",
                                                closeOnConfirm: false,
                                                customClass: "Custom_Cancel"
                                            },
                                            function() {
                                                $guarda = (guardarfolioautos1() + actualizar());
                                            });
                                    }
                                } else if (telefono.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un número telefónico para contactarlo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario para continuar",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfolioautos1() + actualizar());
                                        });
                                }
                            } else if (prioridad == 'NORMAL') {
                                if (telefono.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un número telefónico para contactarlo",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length == 0) {
                                    swal({
                                        title: "¡Error!",
                                        text: "Ingrese un Comentario para continuar",
                                        type: "error",
                                        customClass: 'swal-wide',
                                        allowOutsideClick: false
                                    });
                                    hasError = true;
                                } else if (comentarios.length >= 1 || /^\s+$/.test(comentarios)) {
                                    swal({
                                            title: "¡Recuerda!",
                                            text: "El correcto llenado de los datos nos permite dar un seguimiento oportuno a tu solicitud",
                                            type: "info",
                                            showCancelButton: true,
                                            cancelButtonText: "Corregir",
                                            confirmButtonColor: "#449d44",
                                            confirmButtonText: "Ok",
                                            closeOnConfirm: false,
                                            customClass: "Custom_Cancel"
                                        },
                                        function() {
                                            $guarda = (guardarfolioautos1() + actualizar());
                                        });
                                }
                            }
                        }
                    }
                </script>

                <script>
                    function guardarfolioautos1() {
                        var archivos_pdf = [];
                        fecha = $('#fecha').val();
                        negocio = $('#negocio').val();
                        t_solicitud = $('#t_solicitud').val();
                        num_resolucion = $('#num_resolucion').val();
                        t_solicitud_nuevo = $('#t_solicitud_nuevo').val();
                        num_poliza = $('#num_poliza').val();
                        movimiento = $('#movimiento').val();
                        contratante = $('#contratante').val();
                        prioridad = $('#prioridad').val();
                        motivo = $('#motivo').val();
                        descripcion = $('#descripcion').val();
                        telefono = $('#telefono').val();
                        comentarios = $('#comentarios').val();
                        estado = $('#estado').val();

                        guardarfolio = "true";

                        var cadena = "fecha=" + fecha +
                            "&negocio=" + negocio +
                            "&t_solicitud=" + t_solicitud +
                            "&num_resolucion=" + num_resolucion +
                            "&t_solicitud_nuevo=" + t_solicitud_nuevo +
                            "&num_poliza=" + num_poliza +
                            "&movimiento=" + movimiento +
                            "&contratante=" + contratante +
                            "&prioridad=" + prioridad +
                            "&motivo=" + motivo +
                            "&descripcion=" + descripcion +
                            "&telefono=" + telefono +
                            "&comentarios=" + comentarios +
                            "&estado=" + estado +
                            '&guardar=' + 'v';

                        if (window.FormData) {
                            formdata = new FormData();
                        }

                        formdata.append("datos", cadena);
                        $.ajax({
                            url: 'php/agregarfolio_autos_agente.php',
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