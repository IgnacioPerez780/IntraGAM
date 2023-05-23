<?php
// error_reporting();
session_start();
include 'app/conexion.php';
$conexion = conexion();

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}


//INACTIVIDAD DE SESION
if (isset($_SESSION['logged_in'])) {
    $inactive = 1500;
    if (isset($_SESSION["timeout"])) {
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
} else header('location: index.php');
$nomusuario = $_SESSION['nomusuario'];
$ids = isset($_GET['id']) ? $_GET['id'] : 1;
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$id_archivo = isset($_GET['id_archivo']) ? $_GET['id_archivo'] : 0;
$datos_archivo = array();
if (isset($_GET['id_archivo'])) {
    if (isset($_FILES)) {
        var_dump($_FILES);
    }
    if ($id_archivo != 0) {
        $query = "SELECT
                        id as id_archivo , fk_folio as folio, nombre as nombre
                    FROM archivos
                    WHERE id = '$id_archivo'";

        $resultado = $conexion->query($query);
        while ($ver = mysqli_fetch_object($resultado)) {
            $datos_archivo = [
                'id_archivo' => $ver->id_archivo,
                'folio' => $ver->folio,
                'nombre' =>  $ver->nombre
            ];
        }
    }
    var_dump($datos_archivo['nombre']);
}


$sql1 = "select * from estado order by nombre";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
    $combobit1 = "";
    while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
        $combobit1 .= " <option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
    }
}

$consulta2 = "select * from validar_archivos";
$resultados = mysqli_query($conexion, $consulta2);
$categorias = array();
while ($c = mysqli_fetch_assoc($resultados)) {
    $categorias[] = $c['idarchivo'];
}

$consulta3 = "select * from terminos";
$resultados2 = mysqli_query($conexion, $consulta3);
$categorias2 = array();
while ($c = mysqli_fetch_assoc($resultados2)) {
    $categorias2[] = $c['conformidad'];
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <!--agregado-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
    <!--agregado-->
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="librerias/datatable/buttons/jszip.min.js"></script>
    <script src="librerias/datatable/buttons/pdfmake.min.js"></script>
    <script src="librerias/datatable/buttons/vfs_fonts.js"></script>
    <link href="styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400' rel='stylesheet' type='text/css'>
    <!--LIBRERIAS DE SWEETALERT-->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">




<?php
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '6') {
    include('plantillas/cabecera_colaborador_g.php');
} else if ($_SESSION['rol'] == '8') {
    include('plantillas/cabecera_cartera_v.php');
}
?>




             <!--DESPUES DE LAS CABECERAS ^^^^^^^^^^^^^^^^^^^^^^-->
    <link rel="stylesheet" href="css/hoja_seguimientos.css">
</head>



<body <?php if (in_array($ids, $categorias2)) {
            echo 'onload="conformidad()"';
        } ?>>

    <div class="container">
        <div class="col-sm-12">
            <table class="table table-condensed table-bordered" id="tablaDinamicaLoad">
                <tbody>
                    <tr>
                        <td colspan="8" align="center" class="seguimiento"><b>
                                <h2>
                                    <p style="color:#FFFFFF">Seguimiento de <?php echo $nomusuario; ?>
                                </h2>
                            </b></td>
                    </tr>
                    <?php

                    $sql = "SELECT * FROM folios where id='$ids'";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($result)) {
                        $datos = $ver[0] . "||" .
                            $ver[1] . "||" .
                            $ver[2] . "||" .
                            $ver[3] . "||" .
                            $ver[4] . "||" .
                            $ver[5] . "||" .
                            $ver[6] . "||" .
                            $ver[7] . "||" .
                            $ver[8] . "||" .
                            $ver[9] . "||" .
                            $ver[10] . "||" .
                            $ver[11] . "||" .
                            $ver[12] . "||" .
                            $ver[13] . "||" .
                            $ver[14] . "||" .
                            $ver[15] . "||" .
                            $ver[16] . "||" .
                            $ver[17] . "||" .
                            $ver[18] . "||" .
                            $ver[19]; ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"></td>
                        </tr>
                        <tr>
                            <td colspan="8" align="center" class="nombreAgente"><b>
                                    <h4>Nombre del Agente:
                                        <?php
                                        $agente = "SELECT nombre FROM datos_agente WHERE id='$ver[15]'";
                                        $agenter = mysqli_query($conexion, $agente);
                                        while ($agentenom = mysqli_fetch_row($agenter)) {
                                            $datosa = $agentenom[0];
                                            echo $agentenom[0];
                                        }
                                        ?>
                                    </h4>
                                </b></td>
                        </tr>

                        <?php if ($ver[14] == 'CANCELADO') { ?>

                            <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center"><?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                        if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                                        elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                                        elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                                        endif; ?>><b><?php echo $ver[14] ?> </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Contratante:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
                                    <td align="center"><b>Póliza:</b></td>
                                    <td colspan="2" align="center"><?php echo  $ver[17]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Tipo Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[3]; ?></td>
                                    <td align="center"><b>Producto</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                                    <td align="center"><b>Rango</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[5]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center"><b>Prima:</b></td>
                                    <td colspan="2" align="center">$ <?php echo $ver[7]; ?></td>
                                    <td colspan="2" align="center"><b>Moneda:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[18]; ?></td>
                                </tr>


                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Prioridad:</b></td>
                                    <td align="center"><?php echo $ver[12]; ?></td>
                                    <td align="center"><b>Comentarios:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center"></td>
                                    <td colspan="2" align="center"><b>Folio GNP:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
                                    <td colspan="2" align="center"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>


                            <?php } elseif ($ver[3] == "MOVIMIENTOS") { ?>

                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                    <td align="center"><b>Linea de Negocio:</b></td>
                                    <td align="center"><?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                        if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                                        elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                                        elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                                        endif; ?>><b><?php echo $ver[14] ?> </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Contratante:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
                                    <td align="center"><b>Póliza:</b></td>
                                    <td colspan="2" align="center"><?php echo  $ver[8]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Tipo Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="2" align="center"><b>Tipo de Movimiento:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[9]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Prioridad:</b></td>
                                    <td align="center"><?php echo $ver[12]; ?></td>
                                    <td align="center"><b>Comentarios:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center"></td>
                                    <td colspan="2" align="center"><b>Folio GNP:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
                                    <td colspan="2" align="center"></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                            <?php } elseif ($ver[3] == "PAGOS") { ?>

                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center"><?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                        if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                                        elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                                                elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                                                elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                                                elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                                                elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                                                elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                                        elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                                        endif; ?>><b><?php echo $ver[14] ?> </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Contratante:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
                                    <td align="center"><b>Póliza:</b></td>
                                    <td colspan="2" align="center"><?php echo  $ver[17]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Tipo Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[3]; ?></td>
                                    <td align="center"><b>Monto:</b></td>
                                    <td colspan="2" align="center">$ <?php echo $ver[10]; ?></td>
                                    <td align="center"><b>Moneda:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[19]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td align="center"><b>Prioridad:</b></td>
                                    <td align="center"><?php echo $ver[12]; ?></td>
                                    <td align="center"><b>Comentarios:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center"></td>
                                    <td colspan="2" align="center"><b>Folio GNP:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
                                    <td colspan="2" align="center"></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                            <?php } ?>

                            <tr>
                                <td colspan="8" align="center" class="documentos"> <b>
                                        <p style="color:#FFFFFF">DOCUMENTOS
                                    </b></td>
                            </tr>

                            <tr align="center" class="datosDocument">
                                <td colspan="1"><b>Usuario</td>
                                <td colspan="2"><b>Nombre de Archivo</td>
                                <td colspan="1"><b>Ver</td>
                                <td colspan="1"><b>Descargar</td>
                                <td colspan="2"><b>¿Aprobado?</td>
                                <td colspan="1"><b>Fecha de carga</td>
                            </tr>

                            <form class="" action="validar.php" method="post">

                                <?php
                                $query = "SELECT id,
                              nombre, fk_folio,fecha_creacion, nomusuario
                              FROM archivos
                              WHERE fk_folio = '$ids' order by id desc";
                                $resultado = $conexion->query($query);
                                while ($row = mysqli_fetch_row($resultado)) {
                                ?>
                                    <tr>
                                        <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                        <td colspan="2" align="center"><?php echo $row[1]; ?></td>
                                        <td colspan="1" align="center"> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                        </td>
                                        <td colspan="1" align="center">
                                            <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                                <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                                        </td>
                                        <td colspan="2" align="center">
                                            <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                            <input type="text" hidden="" id="nmu" name="nmu" value="<?php echo "$nomusuario"; ?>">
                                            <input type="checkbox" id="checkbox" name="valido[<?php echo $row[0]; ?>]" value="<?php echo $row[0]; ?>" <?php if (in_array($row[0], $categorias)) {
                                                                                                                                                            echo 'checked="checked"';
                                                                                                                                                        } ?> disabled>
                                        </td>
                                        <td colspan="1" align="center">
                                            <?php echo $row[3]; ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                                <tr>
                                    <td colspan="8" align="center">
                                        <div>
                                            <input type="submit" value="Notificar Documentos" disabled />
                                        </div>
                                    </td>
                                </tr>

                            </form>
                </tbody>

                <!-- AGREGAR ARCHIVOS -->
                <tbody>
                    <form action="anexar1.php" method="post" enctype="multipart/form-data" id='filesform'>

                        <tr>
                            <td colspan="8" align="center" class="agregar"><b>
                                    <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                </b></td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <input id="agregar1" type="file" name="file[]" accept=".pdf" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <select type="text" name="tipo" value="" id="tipo" disabled>
                                    <option value="">Seleccione:</option>
                                    <option value="solicitud">Solicitud</option>
                                    <option value="identificacion">Identificacion</option>
                                    <option value="comprobante_domicilio">Comprobante Domicilio</option>
                                    <option value="carta_extraprima">Cartas de Extraprima</option>
                                    <option value="carta_rechazo">Cartas de Rechazo</option>
                                    <option value="cartas_adicionales">Cartas Adicionales</option>
                                    <option value="cuestionario_adicional_suscripcion">Cuestionario Adicional de Suscripcion</option>
                                    <option value="formato_cobranza_electronica">Formato de Cobranza Electronica</option>
                                    <option value="hoja_h107">Hoja H107</option>
                                    <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                                    <option value="caratula_poliza">Caratula de Poliza</option>
                                    <option value="condiciones_generales">Condiciones Generales</option>
                                    <option value="recibo_pago">Recibo de Pago</option>
                                </select>
                                <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                                <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <button type="button" onclick="return subir()" class="btn btn-primary" disabled>Subir Archivo</button>
                            </td>
                        </tr>
                    </form>
                </tbody>

                <tbody>

                    <tr class="comentarios">
                        <td>
                            <b>
                                <p>USUARIO</p>
                            </b>
                        </td>
                        <td colspan="5">
                            <b>
                                <p>OBSERVACIONES</p>
                            </b>
                        </td>
                        <td>
                            <b>
                                <p>ESTADO</p>
                            </b>
                        </td>
                        <td>
                            <b>
                                <p>FECHA Y HORA</p>
                            </b>
                        </td>
                    </tr>

                    <tr>
                        <?php
                            $sql = "SELECT * FROM comentarios where folio='$ids' ORDER BY fecha_comentario DESC";
                            $result = mysqli_query($conexion, $sql);
                            while ($ver1 = mysqli_fetch_row($result)) {
                                $datos1 = $ver1[0] . "||" .
                                    $ver1[1] . "||" .
                                    $ver1[2] . "||" .
                                    $ver1[3] . "||" .
                                    $ver1[4] . "||" .
                                    $ver1[5];
                        ?>
                            <td style="width: 15%;">
                                <b>
                                    <!-- AQUI EMPIEZA EL CODIGO PARA MOSTRAR LA IMAGEN CON EL NOMBRE DEL USUARIO -->
                            <?php
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'   ";
                                $result2 = mysqli_query($conexion, $CONSULTA);
                                while ($prueba = mysqli_fetch_row($result2)) {
                                    $datos221 = $prueba[2];
                                     $data = $prueba[1];
                            ?>
                                    




           <a  style="color: black"
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="bottom" 
               data-html="true" 
              data-title="  <?php  $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE = mysqli_query($conexion, $mod);
                                                $modificacion = mysqli_fetch_array($resultTE);

                                          


                                                $mod2 = "SELECT * FROM datos_agente WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE2 = mysqli_query($conexion, $mod2);
                                                $modificacion2 = mysqli_fetch_array($resultTE2);

                                             ?>
                  <div style='width:350px; overflow:350px;' >

                  <div style='width:240px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>
                    <strong>
                        <?php  

                        if(empty($modificacion['nombre']))
                            {
                                echo $modificacion2['nombre'];
                            }else{ 
                        echo $modificacion['nombre']; 
                         }?>
                        <br>
                        <?php    if(empty($modificacion['puesto']))
                            {
                                $porciones = explode(",", $modificacion2['correo']);
                               echo $porciones[0];


                            }else{ 
                        echo $modificacion['puesto']; 
                         ?>
                        <br>
                        <?php 
                        echo $modificacion['correo']; 
                         } ?>
                         <br>
                        <?php    if(empty($modificacion['telefono']))
                            {
                                echo $modificacion2['celular'];
                            }else{ 
                        echo $modificacion['telefono']; 
                       echo $extension = " Ext ";
                        echo $modificacion['extension'];
                         }     ?>
                         
                    </strong>
 
                </div>


                <div style='background:#F2F2F2;line-height:30px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>

                          <?php     if(isset($modificacion['extension']))
                            { ?>
                    <br>
                        <?php } ?>
                     <img style='; margin-right: 15px; margin-bottom:10px; width: 100px; height: 100px; border-radius: 120px;' src='<?php echo $datos221;  ?>'> 
                    </div>

                  
                         <div style='width:350px;background:#F2F2F2; background-color:#F5CBA7  ; line-height:30px;'>Tocando vidas</div>

                

                </div>



                                              <?php 
                                               ?>
            
                    "> <!-- SE CIERRA LA ETIQUETA A CON EL TOOLTIP -->


                                              <img class="imgUsuario_seg" src="<?php echo $datos221;  ?>">

                                                 <p id="<?php echo $data; ?>"  style="display: none;"><?php echo $ver1[4]; ?></p>
                            <?php } ?>

                            <p class="nombreUsuario"><?php echo $ver1[4]; ?></p></a>
                           

                            <!-- TERMINA EL CODIGO --> 
                                </b>
                            </td>
                            <td colspan="5" align="center"><?php echo $ver1[2]; ?></td>
                            <td align="center"><b><?php echo $ver1[5]; ?></b></td>
                            <td align="center"><b><?php echo $ver1[1]; ?></b></td>
                    </tr>
                <?php
                            }
                ?>

                <tr>
                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                </tr>

                <tr class="observaciones">
                    <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                    <td colspan="4" align="center">
                        <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled></textarea>
                        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
                        <?php
                            $este = "SELECT estado from folios where id='$ids'";
                            $est1e = mysqli_query($conexion, $este);
                            while ($ver3e = mysqli_fetch_row($est1e)) {
                                $datos2e = $ver3e[0];
                        ?>
                            <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2e"; ?>">
                        <?php
                            }
                        ?>

                    </td>
                    <td colspan="2" align="center">

                    </td>
                </tr>

                <tr class="observaciones">
                    <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                    <td colspan="2" align="center">
                        <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                            <option value="Seleccione">Seleccione:</option>
                            <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

                                <?php if ($ver[14] == "ENVIADO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "PROCESO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                                <?php } ?>

                                <?php if ($ver[14] == "REPROCESO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                                <?php } ?>

                                <?php if ($ver[14] == "TERMINADO") { ?>

                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "TERMINADO CON POLIZA") { ?>

                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "ACTIVADO MED") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                                <?php } ?>

                                <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                                <?php } ?>

                                <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>
                                    <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                                <?php } ?>

                            <?php } ?>


                            <?php if ($ver[3] == "MOVIMIENTOS") { ?>
                                <?php if ($ver[14] == "ENVIADO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "PROCESO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "REPROCESO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "TERMINADO") { ?>

                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>

                                <?php } ?>
                                <!--CONDICION TERMINADO CIERRE -->


                                <?php if ($ver[14] == "ACTIVADO MED") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>
                                <!--CONDICION ACTIVADO MED CIERRE -->

                                <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="ACTIVADO MED">ACTIVADO MED</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>
                                <!--CONDICION ACTIVADO GNP CIERRE -->


                            <?php } ?>

                            <?php if ($ver[3] == "PAGOS") { ?>
                                <?php if ($ver[14] == "ENVIADO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "PROCESO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "REPROCESO") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "TERMINADO") { ?>

                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="REPROCESO">REPROCESO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                                    <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                                <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                                    <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                                    <option value="CANCELADO">CANCELADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="REPROCESO">REPROCESO</option>
                                    <option value="TERMINADO">TERMINADO</option>

                                <?php } ?>

                            <?php } ?>

                        </select>
                    </td>
                    <td colspan="2" align="center"><b>Asignar folio GNP:</b></td>
                    <td colspan="2" align="center"><input type="text" value="<?php echo $ver[16]; ?>" id="fgnp" name="fgnp" disabled></td>
                </tr>

                <!--anexe lineas de codigo para poliza -->
                <tr class="observaciones">
                    <td colspan="2" align="center"><b></b></td>
                    <td colspan="2" align="center">

                    </td>

                    <td colspan="2" align="center"><b>Asignar póliza GNP:</b></td>
                    <td colspan="2" align="center"><input type="text" value="<?php echo  $ver[8]; ?><?php echo  $ver[17]; ?>" id="polizap" name="polizap" disabled></td>
                </tr>

                <tr class="observaciones">
                    <td colspan="8" align="center">
                        <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar" disabled></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


<?php } ?>
<!--CIERRE DE LA CONDICION CANCELADO-->

<!--ENTRAN TODOS LOS ESTADOS MENOS CANCELADO, TERMINADO Y TERMINADO/P-->

<?php if ($ver[14] == 'ACTIVADO MED' || $ver[14] == 'ACTIVADO FLT' || $ver[14] == 'ACTIVADO GNP' || $ver[14] == 'PROCESO' || $ver[14] == 'REPROCESO' || $ver[14] == 'ENVIADO') { ?>

    <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

        <tr>
            <td align="center"><b>Folio:</b></td>
            <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
            <td align="center"><b>Línea de Negocio:</b></td>
            <td align="center"><?php echo $ver[2]; ?></td>
            <td align="center"><b>Fecha Solicitud:</b></td>
            <td align="center"><?php echo $ver[1]; ?></td>
            <td align="center"><b>Estado:</b></td>
            <td align="center" <?php
                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                        elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                endif; ?>><b><?php echo $ver[14] ?> </b>
            </td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Contratante:</b></td>
            <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
            <td align="center"><b>Póliza:</b></td>
            <td colspan="2" align="center"><?php echo  $ver[17]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Tipo Solicitud:</b></td>
            <td align="center"><?php echo $ver[3]; ?></td>
            <td align="center"><b>Producto</b></td>
            <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
            <td align="center"><b>Rango</b></td>
            <td colspan="2" align="center"><?php echo $ver[5]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"><b>Prima:</b></td>
            <td colspan="2" align="center">$ <?php echo $ver[7]; ?></td>
            <td colspan="2" align="center"><b>Moneda:</b></td>
            <td colspan="2" align="center"><?php echo $ver[18]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Prioridad:</b></td>
            <td align="center"><?php echo $ver[12]; ?></td>
            <td align="center"><b>Comentarios:</b></td>
            <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2" align="center"><b>Folio GNP:</b></td>
            <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
            <td colspan="2" align="center"></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

    <?php } elseif ($ver[3] == "MOVIMIENTOS") { ?>

        <tr>
            <td align="center"><b>Folio:</b></td>
            <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
            <td align="center"><b>Línea de Negocio:</b></td>
            <td align="center"><?php echo $ver[2]; ?></td>
            <td align="center"><b>Fecha Solicitud:</b></td>
            <td align="center"><?php echo $ver[1]; ?></td>
            <td align="center"><b>Estado:</b></td>
            <td align="center" <?php
                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                        elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                endif; ?>><b><?php echo $ver[14] ?> </b>
            </td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Contratante:</b></td>
            <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
            <td align="center"><b>Póliza:</b></td>
            <td colspan="2" align="center"><?php echo  $ver[8]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Tipo Solicitud:</b></td>
            <td align="center"><?php echo $ver[3]; ?></td>
            <td colspan="2" align="center"><b>Tipo de Movimiento:</b></td>
            <td colspan="6" align="center"><?php echo $ver[9]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Prioridad:</b></td>
            <td align="center"><?php echo $ver[12]; ?></td>
            <td align="center"><b>Comentarios:</b></td>
            <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2" align="center"><b>Folio GNP:</b></td>
            <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
            <td colspan="2" align="center"></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

    <?php } elseif ($ver[3] == "PAGOS") { ?>

        <tr>
            <td align="center"><b>Folio:</b></td>
            <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
            <td align="center"><b>Línea de Negocio:</b></td>
            <td align="center"><?php echo $ver[2]; ?></td>
            <td align="center"><b>Fecha Solicitud:</b></td>
            <td align="center"><?php echo $ver[1]; ?></td>
            <td align="center"><b>Estado:</b></td>
            <td align="center" <?php
                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                        elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                endif; ?>><b><?php echo $ver[14] ?> </b>
            </td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Contratante:</b></td>
            <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
            <td align="center"><b>Póliza:</b></td>
            <td colspan="2" align="center"><?php echo  $ver[17]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Tipo Solicitud:</b></td>
            <td align="center"><?php echo $ver[3]; ?></td>
            <td align="center"><b>Monto:</b></td>
            <td colspan="2" align="center">$ <?php echo $ver[10]; ?></td>
            <td align="center"><b>Moneda:</b></td>
            <td colspan="2" align="center"><?php echo $ver[19]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Prioridad:</b></td>
            <td align="center"><?php echo $ver[12]; ?></td>
            <td align="center"><b>Comentarios:</b></td>
            <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2" align="center"><b>Folio GNP:</b></td>
            <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
            <td colspan="2" align="center"></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

    <?php } ?>

    <tr>
        <td colspan="8" align="center" class="documentos"><b>
                <p style="color:#FFFFFF">DOCUMENTOS
            </b></td>
    </tr>

    <tr align="center" class="datosDocument">
        <td colspan="1"><b>Usuario</td>
        <td colspan="2"><b>Nombre de Archivo</td>
        <td colspan="1"><b>Ver</td>
        <td colspan="1"><b>Descargar</td>
        <td colspan="2"><b>¿Aprobado?</td>
        <td colspan="1"><b>Fecha de carga</td>
    </tr>

    <form class="" action="validar.php" method="post">

        <?php
                            $query = "SELECT id,
                                      nombre, fk_folio,fecha_creacion, nomusuario
                                      FROM archivos
                                      WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {
        ?>
            <tr>
                <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                <td colspan="2" align="center"><?php echo $row[1]; ?></td>
                <td colspan="1" align="center"> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                </td>
                <td colspan="1" align="center">
                    <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                </td>
                <td colspan="2" align="center">
                    <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                    <input type="text" hidden="" id="nmu" name="nmu" value="<?php echo "$nomusuario"; ?>">
                    <input type="checkbox" id="checkbox" name="valido[<?php echo $row[0]; ?>]" value="<?php echo $row[0]; ?>" <?php if (in_array($row[0], $categorias)) {
                                                                                                                                    echo 'checked="checked"';
                                                                                                                                } ?> disabled>
                </td>
                <td colspan="1" align="center">
                    <?php echo $row[3]; ?>
                </td>
            </tr>

        <?php } ?>
        <tr>
            <td colspan="8" align="center">
                <div>
                    <input type="submit" id="notificar" value="Notificar Documentos" disabled />
                </div>
            </td>
        </tr>

    </form>
    </tbody>

    <tbody>
        <form action="anexar1.php" method="post" enctype="multipart/form-data" id='filesform'>

            <tr>
                <td colspan="8" align="center" class="agregar"><b>
                        <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                    </b></td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <input id="agregar1" type="file" name="file[]" accept=".pdf" disabled>
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <select type="text" name="tipo" value="" id="tipo" disabled>
                        <option value="">Seleccione:</option>
                        <option value="solicitud">Solicitud</option>
                        <option value="identificacion">Identificacion</option>
                        <option value="comprobante_domicilio">Comprobante Domicilio</option>
                        <option value="carta_extraprima">Cartas de Extraprima</option>
                        <option value="carta_rechazo">Cartas de Rechazo</option>
                        <option value="cartas_adicionales">Cartas Adicionales</option>
                        <option value="cuestionario_adicional_suscripcion">Cuestionario Adicional de Suscripcion</option>
                        <option value="formato_cobranza_electronica">Formato de Cobranza Electronica</option>
                        <option value="hoja_h107">Hoja H107</option>
                        <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                        <option value="caratula_poliza">Caratula de Poliza</option>
                        <option value="condiciones_generales">Condiciones Generales</option>
                        <option value="recibo_pago">Recibo de Pago</option>
                    </select>
                    <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                    <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <button type="button" onclick="return subir()" class="btn btn-primary" disabled>Subir Archivo</button>
                </td>
            </tr>
        </form>
    </tbody>

    <tbody>

        <tr class="comentarios">
            <td>
                <b>
                    <p>USUARIO
                </b>
            </td>
            <td colspan="5">
                <b>
                    <p>OBSERVACIONES
                </b>
            </td>
            <td>
                <b>
                    <p>ESTADO
                </b>
            </td>
            <td>
                <b>
                    <p>FECHA Y HORA
                </b>
            </td>
        </tr>

        <tr>
            <?php
                            $sql = "SELECT * FROM comentarios where folio='$ids' ORDER BY fecha_comentario DESC";
                            $result = mysqli_query($conexion, $sql);
                            while ($ver1 = mysqli_fetch_row($result)) {
                                $datos1 = $ver1[0] . "||" .
                                    $ver1[1] . "||" .
                                    $ver1[2] . "||" .
                                    $ver1[3] . "||" .
                                    $ver1[4] . "||" .
                                    $ver1[5];
            ?>
                <td style="width: 15%;">
                    <b>
                        <!-- AQUI EMPIEZA EL CODIGO PARA MOSTRAR LA IMAGEN CON EL NOMBRE DEL USUARIO -->
                            <?php
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'   ";
                                $result2 = mysqli_query($conexion, $CONSULTA);
                                while ($prueba = mysqli_fetch_row($result2)) {
                                    $datos221 = $prueba[2];
                                     $data = $prueba[1];
                            ?>
                                    




            <a  style="color: black"
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="bottom" 
               data-html="true" 
              data-title="  <?php  $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE = mysqli_query($conexion, $mod);
                                                $modificacion = mysqli_fetch_array($resultTE);

                                          


                                                $mod2 = "SELECT * FROM datos_agente WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE2 = mysqli_query($conexion, $mod2);
                                                $modificacion2 = mysqli_fetch_array($resultTE2);

                                             ?>
                  <div style='width:350px; overflow:350px;' >

                  <div style='width:240px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>
                    <strong>
                        <?php  

                        if(empty($modificacion['nombre']))
                            {
                                echo $modificacion2['nombre'];
                            }else{ 
                        echo $modificacion['nombre']; 
                         }?>
                        <br>
                        <?php    if(empty($modificacion['puesto']))
                            {
                                $porciones = explode(",", $modificacion2['correo']);
                               echo $porciones[0];


                            }else{ 
                        echo $modificacion['puesto']; 
                         ?>
                        <br>
                        <?php 
                        echo $modificacion['correo']; 
                         } ?>
                         <br>
                        <?php    if(empty($modificacion['telefono']))
                            {
                                echo $modificacion2['celular'];
                            }else{ 
                        echo $modificacion['telefono']; 
                       echo $extension = " Ext ";
                        echo $modificacion['extension'];
                         }     ?>
                         
                    </strong>
 
                </div>


                <div style='background:#F2F2F2;line-height:30px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>

                          <?php     if(isset($modificacion['extension']))
                            { ?>
                    <br>
                        <?php } ?>
                     <img style='; margin-right: 15px; margin-bottom:10px; width: 100px; height: 100px; border-radius: 120px;' src='<?php echo $datos221;  ?>'> 
                    </div>

                  
                         <div style='width:350px;background:#F2F2F2; background-color:#F5CBA7  ; line-height:30px;'>Tocando vidas</div>

                

                </div>



                                              <?php 
                                               ?>
            
                    "> <!-- SE CIERRA LA ETIQUETA A CON EL TOOLTIP -->


                                              <img class="imgUsuario_seg" src="<?php echo $datos221;  ?>">

                                                 <p id="<?php echo $data; ?>"  style="display: none;"><?php echo $ver1[4]; ?></p>
                            <?php } ?>

                            <p class="nombreUsuario"><?php echo $ver1[4]; ?></p></a>
                           

                            <!-- TERMINA EL CODIGO --> 
                    </b>
                </td>
                <td colspan="5" align="center"><?php echo $ver1[2]; ?></td>
                <td align="center"><b><?php echo $ver1[5]; ?></b></td>
                <td align="center"><b><?php echo $ver1[1]; ?></b></td>
        </tr>
    <?php
                            }
    ?>

    <tr>
        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
    </tr>

    <tr class="observaciones">
        <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
        <td colspan="4" align="center">
            <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
            <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
            <?php
                            $este = "SELECT estado from folios where id='$ids'";
                            $est1e = mysqli_query($conexion, $este);
                            while ($ver3e = mysqli_fetch_row($est1e)) {
                                $datos2e = $ver3e[0];
            ?>
                <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2e"; ?>">
            <?php
                            }
            ?>

        </td>
        <td colspan="2" align="center" class="observaciones">
        </td>
    </tr>

    <tr class="observaciones">
        <td colspan="2" align="center"><b>Cambiar estado:</b></td>
        <td colspan="2" align="center">
            <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                <option value="Seleccione">Seleccione:</option>
                <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

                    <?php if ($ver[14] == "ENVIADO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>

                    <?php } ?>


                    <?php if ($ver[14] == "PROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                    <?php } ?>

                    <?php if ($ver[14] == "REPROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO CON POLIZA") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO MED") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                <?php } ?>

                <?php if ($ver[3] == "MOVIMIENTOS") { ?>

                    <?php if ($ver[14] == "ENVIADO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "PROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "REPROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO MED") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                <?php } ?>

                <?php if ($ver[3] == "PAGOS") { ?>

                    <?php if ($ver[14] == "ENVIADO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "PROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "REPROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                <?php } ?>

            </select>
        </td>
        <td colspan="2" align="center"><b>Asignar folio GNP:</b></td>
        <td colspan="2" align="center"><input type="text" value="<?php echo $ver[16]; ?>" id="fgnp" name="fgnp" disabled></td>
    </tr>

    <!--anexe lineas de codigo para poliza -->
    <tr class="observaciones">
        <td colspan="2" align="center"><b></b></td>
        <td colspan="2" align="center">

        </td>

        <td colspan="2" align="center"><b>Asignar póliza GNP:</b></td>
        <td colspan="2" align="center"><input type="text" value="<?php echo  $ver[8]; ?><?php echo  $ver[17]; ?>" id="polizap" name="polizap" disabled></td>
    </tr>

    <tr class="observaciones">
        <td colspan="8" align="center">
            <button type="button" id="guardar" class="btn btn-warning glyphicon glyphicon-ok"></button>

            <button style="display: none" type="button" id="guardar2" class="btn btn-warning glyphicon glyphicon-ok" disabled></button>
        </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>

    <!-- COMIENZA EL MODAL -->
    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <!--PARA NO CERRAR EL MODAL-CAMBIO AQUI-->
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">TERMINADO CON POLIZA</h4>
                </div>
                <div class="modal-body">

                    <label>PRIMA:</label><br>
                    <center> <input type="text" name="prima2" id="prima2" class="number form-control input-sm" placeholder="Escribe la prima correspondiente" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /></center><i>(Máximo 30 digitos)</i><br>
                    <label>MONEDA:</label><br>
                    <center> <select type="text" name="moneda2" id="moneda2" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <option value="DLLS">DLLS</option>
                            <option value="PESOS">PESOS</option>
                        </select></center><br>
                    <label>PERIODO:</label><br>
                    <center> <select onchange="calculo();" type="text" name="periodo" id="periodo" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <option value="MENSUAL">MENSUAL</option>
                            <option value="TRIMESTRAL">TRIMESTRAL</option>
                            <option value="SEMESTRAL">SEMESTRAL</option>
                            <option value="ANUAL">ANUAL</option>
                        </select></center><br>
                    <label>PRIMA ANUAL:</label><br>
                    <center> <input type="text" name="primaAnual" readonly="" id="primaAnual" class="form-control input-sm"></center>
                </div>
                <div class="modal-footer">
                    <button type="button" id="guardarM" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!--TERMINADO Y TERMINADO/P-->
<?php if ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA') { ?>

    <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

        <tr>
            <td align="center"><b>Folio:</b></td>
            <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
            <td align="center"><b>Línea de Negocio:</b></td>
            <td align="center"><?php echo $ver[2]; ?></td>
            <td align="center"><b>Fecha Solicitud:</b></td>
            <td align="center"><?php echo $ver[1]; ?></td>
            <td align="center"><b>Estado:</b></td>
            <td align="center" <?php
                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                        elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                endif; ?>><b><?php echo $ver[14] ?> </b>
            </td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Contratante:</b></td>
            <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
            <td align="center"><b>Póliza:</b></td>
            <td colspan="2" align="center"><?php echo  $ver[17]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Tipo Solicitud:</b></td>
            <td align="center"><?php echo $ver[3]; ?></td>
            <td align="center"><b>Producto</b></td>
            <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
            <td align="center"><b>Rango</b></td>
            <td colspan="2" align="center"><?php echo $ver[5]; ?></td>
        </tr>


        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"><b>Prima:</b></td>
            <td colspan="2" align="center">$ <?php echo $ver[7]; ?></td>
            <td colspan="2" align="center"><b>Moneda:</b></td>
            <td colspan="2" align="center"><?php echo $ver[18]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Prioridad:</b></td>
            <td align="center"><?php echo $ver[12]; ?></td>
            <td align="center"><b>Comentarios:</b></td>
            <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2" align="center"><b>Folio GNP:</b></td>
            <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
            <td colspan="2" align="center"></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

    <?php } elseif ($ver[3] == "MOVIMIENTOS") { ?>

        <tr>
            <td align="center"><b>Folio:</b></td>
            <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
            <td align="center"><b>Línea de Negocio:</b></td>
            <td align="center"><?php echo $ver[2]; ?></td>
            <td align="center"><b>Fecha Solicitud:</b></td>
            <td align="center"><?php echo $ver[1]; ?></td>
            <td align="center"><b>Estado:</b></td>
            <td align="center" <?php
                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                        elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                endif; ?>><b><?php echo $ver[14] ?> </b>
            </td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Contratante:</b></td>
            <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
            <td align="center"><b>Póliza:</b></td>
            <td colspan="2" align="center"><?php echo  $ver[8]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Tipo Solicitud:</b></td>
            <td align="center"><?php echo $ver[3]; ?></td>
            <td colspan="2" align="center"><b>Tipo de Movimiento:</b></td>
            <td colspan="6" align="center"><?php echo $ver[9]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Prioridad:</b></td>
            <td align="center"><?php echo $ver[12]; ?></td>
            <td align="center"><b>Comentarios:</b></td>
            <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2" align="center"><b>Folio GNP:</b></td>
            <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
            <td colspan="2" align="center"></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

    <?php } elseif ($ver[3] == "PAGOS") { ?>

        <tr>
            <td align="center"><b>Folio:</b></td>
            <td align="center"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
            <td align="center"><b>Línea de Negocio:</b></td>
            <td align="center"><?php echo $ver[2]; ?></td>
            <td align="center"><b>Fecha Solicitud:</b></td>
            <td align="center"><?php echo $ver[1]; ?></td>
            <td align="center"><b>Estado:</b></td>
            <td align="center" <?php
                                if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                                                elseif ($ver[14] == 'ACTIVADO FLT') : ?> bgcolor="#F1C40F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO GNP') : ?> bgcolor="#F4D03F" <?php
                                                                                        elseif ($ver[14] == 'ACTIVADO MED') : ?> bgcolor="#F7DC6F" <?php
                                                                                        elseif ($ver[14] == 'CANCELADO') : ?> bgcolor="#C0392B" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO') : ?> bgcolor="#2ECC71" <?php
                                                                                        elseif ($ver[14] == 'TERMINADO CON POLIZA') : ?> bgcolor="#27AE60" <?php
                                                                                                elseif ($ver[14] == 'REPROCESO') : ?> bgcolor="#DE7A10" <?php
                                                                                                endif; ?>><b><?php echo $ver[14] ?> </b>
            </td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Contratante:</b></td>
            <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
            <td align="center"><b>Póliza:</b></td>
            <td colspan="2" align="center"><?php echo  $ver[17]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Tipo Solicitud:</b></td>
            <td align="center"><?php echo $ver[3]; ?></td>
            <td align="center"><b>Monto:</b></td>
            <td colspan="2" align="center">$ <?php echo $ver[10]; ?></td>
            <td align="center"><b>Moneda:</b></td>
            <td colspan="2" align="center"><?php echo $ver[19]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td align="center"><b>Prioridad:</b></td>
            <td align="center"><?php echo $ver[12]; ?></td>
            <td align="center"><b>Comentarios:</b></td>
            <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr>
            <td colspan="2" align="center"></td>
            <td colspan="2" align="center"><b>Folio GNP:</b></td>
            <td colspan="2" align="center"><?php echo $ver[16]; ?></td>
            <td colspan="2" align="center"></td>
        </tr>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>
    <?php } ?>

    <tr>
        <td colspan="8" align="center" class="documentos"><b>
                <p style="color:#FFFFFF">DOCUMENTOS
            </b></td>
    </tr>

    <tr align="center" class="datosDocument">
        <td colspan="1"><b>Usuario</td>
        <td colspan="2"><b>Nombre de Archivo</td>
        <td colspan="1"><b>Ver</td>
        <td colspan="1"><b>Descargar</td>
        <td colspan="2"><b>¿Aprobado?</td>
        <td colspan="1"><b>Fecha de carga</td>
    </tr>

    <form class="" action="validar.php" method="post">
        <?php
                            $query = "SELECT id,
                                      nombre, fk_folio,fecha_creacion, nomusuario
                                      FROM archivos
                                      WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {
        ?>
            <tr>
                <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                <td colspan="2" align="center"><?php echo $row[1]; ?></td>
                <td colspan="1" align="center"> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank"> <span class="btn btn-primary glyphicon glyphicon-file"></span< /a>
                </td>
                <td colspan="1" align="center">
                    <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                </td>
                <td colspan="2" align="center">
                    <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                    <input type="text" hidden="" id="nmu" name="nmu" value="<?php echo "$nomusuario"; ?>">
                    <input type="checkbox" class="checkbox" name="valido[<?php echo $row[0]; ?>]" value="<?php echo $row[0]; ?>" <?php if (in_array($row[0], $categorias)) {
                                                                                                                                        echo 'checked="checked"';
                                                                                                                                    } ?> disabled>
                </td>
                <td colspan="1" align="center">
                    <?php echo $row[3]; ?>
                </td>
            </tr>

        <?php } ?>

        <tr>
            <td colspan="8" align="center">
                <div>
                    <input type="submit" id="notificar" value="Notificar Documentos" disabled />
                </div>
            </td>
        </tr>
    </form>
    </tbody>

    <!-- AGREGAR ARCHIVOS -->
    <tbody>
        <form action="anexar.php" method="post" enctype="multipart/form-data" id='filesform'>

            <tr>
                <td colspan="8" align="center" class="agregar"><b>
                        <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS
                    </b></td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <input id="agregar1" type="file" name="file[]" accept=".pdf" disabled>
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <select type="text" name="tipo" value="" id="tipo" disabled>
                        <option value="">Seleccione:</option>
                        <option value="solicitud">Solicitud</option>
                        <option value="identificacion">Identificacion</option>
                        <option value="comprobante_domicilio">Comprobante Domicilio</option>
                        <option value="carta_extraprima">Cartas de Extraprima</option>
                        <option value="carta_rechazo">Cartas de Rechazo</option>
                        <option value="cartas_adicionales">Cartas Adicionales</option>
                        <option value="cuestionario_adicional_suscripcion">Cuestionario Adicional de Suscripcion</option>
                        <option value="formato_cobranza_electronica">Formato de Cobranza Electronica</option>
                        <option value="hoja_h107">Hoja H107</option>
                        <option value="solicitudes_adicionales">Solicitudes Adicionales</option>
                        <option value="caratula_poliza">Caratula de Poliza</option>
                        <option value="condiciones_generales">Condiciones Generales</option>
                        <option value="recibo_pago">Recibo de Pago</option>

                    </select>
                    <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                    <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <button type="button" onclick="return subir()" class="btn btn-primary" disabled>Subir Archivo</button>
                </td>
            </tr>
        </form>
    </tbody>

    <tbody>

        <tr class="comentarios">
            <td>
                <b>
                    <p>USUARIO
                </b>
            </td>
            <td colspan="5">
                <b>
                    <p>OBSERVACIONES
                </b>
            </td>
            <td>
                <b>
                    <p>ESTADO
                </b>
            </td>
            <td style="width: 110px;">
                <b>
                    <p>FECHA Y HORA
                </b>
            </td>
        </tr>

        <tr>
            <?php
                            $sql = "SELECT * FROM comentarios where folio='$ids' ORDER BY fecha_comentario DESC";
                            $result = mysqli_query($conexion, $sql);
                            while ($ver1 = mysqli_fetch_row($result)) {
                                $datos1 = $ver1[0] . "||" .
                                    $ver1[1] . "||" .
                                    $ver1[2] . "||" .
                                    $ver1[3] . "||" .
                                    $ver1[4] . "||" .
                                    $ver1[5];
            ?>
                <td style="width: 15%;">
                    <b>
                     <!-- AQUI EMPIEZA EL CODIGO PARA MOSTRAR LA IMAGEN CON EL NOMBRE DEL USUARIO -->
                            <?php
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'   ";
                                $result2 = mysqli_query($conexion, $CONSULTA);
                                while ($prueba = mysqli_fetch_row($result2)) {
                                    $datos221 = $prueba[2];
                                     $data = $prueba[1];
                            ?>
                                    




        <a  style="color: black"
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="bottom" 
               data-html="true" 
              data-title="  <?php  $mod = "SELECT * FROM datos_operativos WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE = mysqli_query($conexion, $mod);
                                                $modificacion = mysqli_fetch_array($resultTE);

                                          


                                                $mod2 = "SELECT * FROM datos_agente WHERE nomusuario = '$ver1[4]' ";
                                                $resultTE2 = mysqli_query($conexion, $mod2);
                                                $modificacion2 = mysqli_fetch_array($resultTE2);

                                             ?>
                  <div style='width:350px; overflow:350px;' >

                  <div style='width:240px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>
                    <strong>
                        <?php  

                        if(empty($modificacion['nombre']))
                            {
                                echo $modificacion2['nombre'];
                            }else{ 
                        echo $modificacion['nombre']; 
                         }?>
                        <br>
                        <?php    if(empty($modificacion['puesto']))
                            {
                                $porciones = explode(",", $modificacion2['correo']);
                               echo $porciones[0];


                            }else{ 
                        echo $modificacion['puesto']; 
                         ?>
                        <br>
                        <?php 
                        echo $modificacion['correo']; 
                         } ?>
                         <br>
                        <?php    if(empty($modificacion['telefono']))
                            {
                                echo $modificacion2['celular'];
                            }else{ 
                        echo $modificacion['telefono']; 
                       echo $extension = " Ext ";
                        echo $modificacion['extension'];
                         }     ?>
                         
                    </strong>
 
                </div>


                <div style='background:#F2F2F2;line-height:30px;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-align:left;padding-left:15px;'>

                          <?php     if(isset($modificacion['extension']))
                            { ?>
                    <br>
                        <?php } ?>
                     <img style='; margin-right: 15px; margin-bottom:10px; width: 100px; height: 100px; border-radius: 120px;' src='<?php echo $datos221;  ?>'> 
                    </div>

                  
                         <div style='width:350px;background:#F2F2F2; background-color:#F5CBA7  ; line-height:30px;'>Tocando vidas</div>

                

                </div>



                                              <?php 
                                               ?>
            
                    "> <!-- SE CIERRA LA ETIQUETA A CON EL TOOLTIP -->

                                              <img class="imgUsuario_seg" src="<?php echo $datos221;  ?>">

                                                 <p id="<?php echo $data; ?>"  style="display: none;"><?php echo $ver1[4]; ?></p>
                            <?php } ?>

                            <p class="nombreUsuario"><?php echo $ver1[4]; ?></p></a>
                           

                            <!-- TERMINA EL CODIGO --> 
                    </b>
                </td>
                <td colspan="5" align="center"><?php echo $ver1[2]; ?></td>
                <td align="center"><b><?php echo $ver1[5]; ?></b></td>
                <td align="center"><b><?php echo $ver1[1]; ?></b></td>
        </tr>
    <?php
                            }
    ?>

    <tr>
        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
    </tr>

    <tr class="observaciones">
        <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
        <td colspan="4" align="center">
            <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
            <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>" disabled>
            <?php
                            $este = "SELECT estado from folios where id='$ids'";
                            $est1e = mysqli_query($conexion, $este);
                            while ($ver3e = mysqli_fetch_row($est1e)) {
                                $datos2e = $ver3e[0];
            ?>
                <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2e"; ?>" disabled>
            <?php
                            }
            ?>
        </td>
        <td colspan="2" align="center">

        </td>
    </tr>


    <tr class="observaciones">
        <td colspan="2" align="center"><b>Cambiar estado:</b></td>
        <td colspan="2" align="center">
            <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                <option value="Seleccione">Seleccione:</option>

                <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

                    <?php if ($ver[14] == "ENVIADO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "PROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>
                    <?php } ?>

                    <?php if ($ver[14] == "REPROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO CON POLIZA") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO MED") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>
                        <option value="TERMINADO CON POLIZA">TERMINADO CON POLIZA</option>

                    <?php } ?>

                <?php } ?>

                <?php if ($ver[3] == "MOVIMIENTOS") { ?>

                    <?php if ($ver[14] == "ENVIADO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "PROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "REPROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO MED") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>
                    <!- <?php if ($ver[14] == "ACTIVADO GNP") { ?> <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="ACTIVADO MED">ACTIVADO MED</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>


                <?php } ?>

                <?php if ($ver[3] == "PAGOS") { ?>

                    <?php if ($ver[14] == "ENVIADO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "PROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "REPROCESO") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "TERMINADO") { ?>

                        <option value="CANCELADO">CANCELADO</option>
                        <option value="REPROCESO">REPROCESO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO GNP") { ?>

                        <option value="ACTIVADO FLT">ACTIVADO FLT</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>

                    <?php if ($ver[14] == "ACTIVADO FLT") { ?>

                        <option value="ACTIVADO GNP">ACTIVADO GNP</option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="REPROCESO">REPROCESO</option>
                        <option value="TERMINADO">TERMINADO</option>

                    <?php } ?>


                <?php } ?>

            </select>
        </td>
        <td colspan="2" align="center"><b>Asignar folio GNP:</b></td>
        <td colspan="2" align="center"><input type="text" value="<?php echo $ver[16]; ?>" id="fgnp" name="fgnp" disabled></td>
    </tr>

    <!--anexe lineas de codigo para poliza -->
    <tr class="observaciones">
        <td colspan="2" align="center"><b></b></td>
        <td colspan="2" align="center">

        </td>

        <td colspan="2" align="center"><b>Asignar póliza GNP:</b></td>
        <td colspan="2" align="center"><input type="text" value="<?php echo  $ver[8]; ?><?php echo  $ver[17]; ?>" id="polizap" name="polizap" disabled></td>
    </tr>
    <tr class="observaciones">
        <td colspan="8" align="center">
            <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar"></button>
        </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>

<?php } ?>

<?php } ?>

</body>


<script type="text/javascript">
    /*    FORMATO DE MONEDA PARA LOS INPUTS DEL MODAL*/
    $("#prima2").on({
        "focus": function(event) {
            $(event.target).select();
        },
        "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });

    $("#primaAnual").on({
        "focus": function(event) {
            $(event.target).select();
        },
        "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });

    $(document).ready(function() {

        /*CAMBIO DEL BOTON CUANDO EL ESTADO SEA TERMINADO CON POLIZA PARA MOSTRAR EL MODAL*/
        $('#estado').on('change', function() {
            var estado = document.getElementById("estado").value;
            if (estado == 'TERMINADO CON POLIZA') {
                $("#guardar").css("display", "none");
                $("#guardar2").css("display", "block");

            }
            if (estado != 'TERMINADO CON POLIZA') {
                $("#guardar").css("display", "block");
                $("#guardar2").css("display", "none");

            }

        });

        $('#guardar').click(function() {

            //Alertas para el registro del folio GNP y el ingresar comentarios para cada cambio de estado. 

            var comentario = document.getElementById('observaciones').value;
            var estado = document.getElementById('estado').value;
            var folio = document.getElementById('fgnp').value;
            var polizap = document.getElementById('polizap').value;


            if (estado == "Seleccione") {

                if (comentario.length == 0) {
                    swal({
                        title: "¡Error!",
                        text: "Ingresa un comentario para continuar",
                        type: "error",
                        customClass: 'swal-wide',
                        allowOutsideClick: false
                    });
                    hasError = true;
                    // alertify.alert("Ingresa un comentario para continuar.");

                } else {

                    guardar();
                    location.reload();
                }
            }

            if (estado == 'PROCESO') {

                if (comentario.length == 0) {

                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else if (folio.length == 0) {

                    alertify.alert("Asigna el Folio GNP correspondiente.");

                } else {

                    guardar();
                    location.reload();

                }

            }


            if (estado == 'TERMINADO CON POLIZA') {

                if (comentario.length == 0) {

                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else if (polizap.length == 0) {

                    alertify.alert("Asigna la Póliza GNP correspondiente.");

                } else {

                    guardar();
                    location.reload();

                }

            }

            if (estado == 'TERMINADO' || estado == 'ACTIVADO MED' || estado == 'ACTIVADO GNP' || estado == 'ACTIVADO FLT' || estado == 'ACTIVADO FLT' || estado == 'REPROCESO') {

                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else {

                    guardar();
                    location.reload();
                }

            }



            if (estado == 'CANCELADO') {

                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else {

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success', //Estilo del boton de aceptar
                            cancelButton: 'btn btn-danger', //Estilo del boton de cancelar

                        },

                        buttonsStyling: false,
                        allowOutsideClick: false //no permite que cierre la ventana a menos que se acepte una condición 
                    })

                    swalWithBootstrapButtons.fire({
                        title: '¿Estas seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '¡Estoy seguro! ',
                        cancelButtonText: '¡Voy a pensarlo!',
                        reverseButtons: true //posicion de los botones

                    }).then((result) => {

                        if (result.value) {

                            guardar();
                            location.reload();


                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {

                            swalWithBootstrapButtons.fire(



                                'IntraGAM informa',
                                '¡Tú trámite esta a salvo!',
                                'success'
                            )
                            return false;

                        }
                    });

                }
            }



        });
    });
</script>
<script type="text/javascript">
 $(document).ready(function() {
     $('[rel="tooltip"]').tooltip();
  });
    /*FUNCION PARA EL CALCULO AUTOMATICO DEL MODAL*/
    function calculo() {
        var periodo = document.getElementById("periodo").value;

        if (periodo == "MENSUAL") {
            var value = $("#prima2").val();
            var valor = value.replace(/,/g, "");
            $("#primaAnual").val(Intl.NumberFormat("en-US").format(valor * 12));
        }

        if (periodo == "TRIMESTRAL") {
            var value = $("#prima2").val();
            var valor = value.replace(/,/g, "");
            $("#primaAnual").val(Intl.NumberFormat("en-US").format(valor * 4));
        }

        if (periodo == "SEMESTRAL") {
            var value = $("#prima2").val();
            var valor = value.replace(/,/g, "");
            $("#primaAnual").val(Intl.NumberFormat("en-US").format(valor * 2));
        }

        if (periodo == "ANUAL") {
            var value = $("#prima2").val();
            var valor = value.replace(/,/g, "");
            $("#primaAnual").val(Intl.NumberFormat("en-US").format(valor * 1));


        }
    }

    $(document).ready(function() {
        $('#guardarM').click(function() {

            //Alertas para el registro del folio GNP y el ingresar comentarios para cada cambio de estado.

            var comentario = document.getElementById('observaciones').value;
            var estado = document.getElementById('estado').value;
            var folio = document.getElementById('fgnp').value;
            var polizap = document.getElementById('polizap').value;
            var prima2 = document.getElementById('prima2').value;
            var moneda2 = document.getElementById('moneda2').value;
            var periodo = document.getElementById('periodo').value;
            var primaAnual = document.getElementById('primaAnual').value;

            if (estado == "Seleccione") {

                if (comentario.length == 0) {

                } else {

                    guardar();
                    location.reload();
                }
            }

            if (estado == 'PROCESO') {

                if (comentario.length == 0) {

                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else if (folio.length == 0) {

                    alertify.alert("Asigna el Folio GNP correspondiente.");

                } else {

                    guardar();
                    location.reload();

                }

            }


            if (estado == 'TERMINADO CON POLIZA') {

                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else if (polizap.length == 0) {

                    alertify.alert("Asigna la Póliza GNP correspondiente.");
                } else if (prima2.length == 0) {

                    alertify.alert("Asigna la prima correspondiente.");
                } else if (moneda2.length == 0) {

                    alertify.alert("Asigna la moneda2 correspondiente.");
                } else if (periodo.length == 0) {

                    alertify.alert("Asigna el periodo correspondiente.");
                } else {

                    guardar();
                    location.reload();

                }

            }

            if (estado == 'TERMINADO' || estado == 'ACTIVADO MED' || estado == 'ACTIVADO GNP' || estado == 'ACTIVADO FLT' || estado == 'ACTIVADO FLT' || estado == 'REPROCESO') {

                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else {

                    guardar();
                    location.reload();
                }

            }

            if (estado == 'CANCELADO') {

                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");

                } else {

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success', //Estilo del boton de aceptar
                            cancelButton: 'btn btn-danger', //Estilo del boton de cancelar

                        },

                        buttonsStyling: false,
                        allowOutsideClick: false //no permite que cierre la ventana a menos que se acepte una condición
                    })

                    swalWithBootstrapButtons.fire({
                        title: '¿Estas seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '¡Estoy seguro! ',
                        cancelButtonText: '¡Voy a pensarlo!',
                        reverseButtons: true //posicion de los botones

                    }).then((result) => {

                        if (result.value) {

                            guardar();
                            location.reload();


                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {

                            swalWithBootstrapButtons.fire(



                                'IntraGAM informa',
                                '¡Tú trámite esta a salvo!',
                                'success'
                            )
                            return false;

                        }
                    });

                }
            }



        });
    });

    $('#guardar2').click(function() {

        var comentario = document.getElementById('observaciones').value;
        var estado = document.getElementById('estado').value;
        var folio = document.getElementById('fgnp').value;
        var polizap = document.getElementById('polizap').value;


        if (comentario.length == 0) {
            alertify.alert("Ingresa un comentario justificando el Cambio de Estado.");
        } else if (polizap.length == 0) {
            alertify.alert("Ingresa la poliza GNP");
        } else {
            $('#modal11').modal('show');
        }

    });
</script>

<script type="text/javascript">
    function subir() {
        var agregar1 = document.getElementById("agregar1").value;
        if (agregar1 == null || agregar1 == 0) {
            alertify.alert('ERROR: Seleccione algun archivo por favor.');
            return false;
        }

        var tipo = document.getElementById("tipo").value;
        if (tipo == null || tipo == 0) {
            alertify.alert('ERROR: Seleccione alguna opción del combo por favor.');
            return false;
        }

        idf = $('#idf').val();
        tipo = $('#tipo').val();

        var Form = new FormData($('#filesform')[0]);

        cadena = "idf=" + idf +
            "&tipo=" + tipo;


        $.ajax({
            url: "anexar1.php",
            type: "post",
            data: Form,
            cadena,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Archivos Agregados');
                document.location.reload();
            }
        });
    }
</script>


<footer>
    <script src="<?php echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>

    <!--VALIDACION DE CONFORMIDAD-->

    <script type="text/javascript">
        function conformidad() {

            var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".checkbox");

            for (var i = 0; i < tabla.length; i++) {
                tabla[i].disabled = true;

            }

            var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".btn");

            for (var i = 0; i < tabla.length; i++) {
                tabla[i].disabled = true;
                tabla[i].checked = true;
            }

            document.getElementById("agregar1").disabled = true;
            document.getElementById("tipo").disabled = true;
            document.getElementById("observaciones").disabled = true;
            document.getElementById("estado").disabled = true;
            document.getElementById("fgnp").disabled = true;
            document.getElementById("polizap").disabled = true;
            document.getElementById("notificar").disabled = true;
            document.getElementById("guardar").disabled = true;

        }
    </script>

</html>