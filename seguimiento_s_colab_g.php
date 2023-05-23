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
                    FROM archivos_s
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

$sql1 = "select * from estado_s order by nombre";
$result1 = $conexion->query($sql1);
if ($result1->num_rows > 0) {
    $combobit1 = "";
    while ($row = $result1->fetch_array(MYSQLI_ASSOC)) {
        $combobit1 .= " <option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
    }
}

$consulta2 = "select * from validar_archivos_s";
$resultados = mysqli_query($conexion, $consulta2);
$categorias = array();
while ($c = mysqli_fetch_assoc($resultados)) {
    $categorias[] = $c['idarchivo'];
}

$consulta3 = "select * from terminos_s";
$resultados2 = mysqli_query($conexion, $consulta3);
$categorias2 = array();
while ($c = mysqli_fetch_assoc($resultados2)) {
    $categorias2[] = $c['conformidad_s'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones2.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="librerias/datatable/buttons/jszip.min.js"></script>
    <script src="librerias/datatable/buttons/pdfmake.min.js"></script>
    <script src="librerias/datatable/buttons/vfs_fonts.js"></script>
    <link href="styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
    <!--LIBRERIAS DE SWEETALERT-->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
<!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!--HOJAS DE ESTILO-->
    

<?php
if ($_SESSION['rol'] == '1') {
    header('location: index.php');
    exit;
} else if ($_SESSION['rol'] == '6') {
    include('plantillas/cabecera_s_colab_g.php');
} else if ($_SESSION['rol'] == '8') {
    include('plantillas/cabecera_cartera_s.php');
}
?>

             <!--DESPUES DE LAS CABECERAS ^^^^^^^^^^^^^^^^^^^^^^-->
    <link rel="stylesheet" href="css/hoja_seguimientos.css">

</head>



<body <?php if (in_array($ids, $categorias2)) {
            echo 'onload="conformidad_s()"';
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
                    $sql = "SELECT * FROM folios_s where id='$ids'";
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
                            $ver[16];
                    ?>
                        <tr>
                            <td colspan="8" align="center" bgcolor="#eeefef"></td>
                        </tr>

                        <?php if ($ver[14] == "CANCELADO") { ?>

                            <?php if ($ver[2] == "GMM") { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center"><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Contratante:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                                    <td colspan="1" align="center"><b>Poliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center"></td>
                                    <td colspan="1" align="center"><b>Total:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Afectado:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[16]; ?></td>
                                    <td colspan="1" align="center"><b>Gastos no cubiertos:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[5]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Tipo de Solicitud:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center"><b>Monto Procedente:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de QR:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de Reclamación:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de Folio:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[12]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                            <?php } else if ($ver[2] == 'VIDA') { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center"><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Tipo de Solicitud:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center"><b>Poliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><b>Contratante:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[7]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                            <?php } else if ($ver[2] == 'AUTOS') { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center"><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Contratante:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                                    <td colspan="1" align="center"><b>Poliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Tipo de Solicitud:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de Siniestro:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[9]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de QR:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                                    <td align="center"><b>Línea de Negocio:</b></td>
                                    <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                                    <td align="center"><b>Fecha Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center"><b><?php echo $ver[14] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center"><b>Contratante:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                                    <td colspan="1" align="center"><b>Poliza:</b></td>
                                    <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Tipo de Solicitud:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de Siniestro:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[9]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" align="center" bgcolor="#eeefef"></td>
                                    <td colspan="2" align="center"><b>Número de QR:</b></td>
                                    <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                                    <td colspan="1" bgcolor="#eeefef"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                                    <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>

                            <?php } ?>

                            <!-- Documentos -->
                            <tr>
                                <td colspan="8" align="center" class="documentos"> <b>
                                        <p style="color:#FFFFFF">DOCUMENTOS
                                    </b></td>
                            </tr>
                            <tr align="center" class="datosDocument">
                                <td colspan="1"><b>Usuario</td>
                                <td colspan="3"><b>Nombre de Archivo</td>
                                <td colspan="1"><b>Ver</td>
                                <td colspan="1"><b>Descargar</td>
                                <td colspan="1"><b>¿Aprobado?</td>
                                <td colspan="1"><b>Fecha de carga</td>
                            </tr>
                            <form class="" action="validar_s.php" method="post">
                                <?php
                                $query = "SELECT id,nombre, fk_folio, fecha_creacion, nomusuario FROM archivos_s WHERE fk_folio = '$ids' order by id desc";
                                $resultado = $conexion->query($query);
                                while ($row = mysqli_fetch_row($resultado)) {
                                ?>
                                    <tr>
                                        <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                        <td colspan="3" align="center"><?php echo $row[1]; ?></td>
                                        <td colspan="1" align="center"> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank">
                                                <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                        </td>
                                        <td colspan="1" align="center">
                                            <a href="../sistemas/archivos_s/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                                <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                                        </td>

                                        <td colspan="1" align="center">
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

                            <!--****************************************AARCHIVOS***************************************-->
                <tbody>
                    <form action="anexar_s.php" method="POST" enctype="multipart/form-data">
                        <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                        <tr>
                            <td colspan="8" align="center" class="agregar"><b>
                                    <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                </b></td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <input id="agregar2" type="file" name="file" accept=".pdf" disabled> <!-- AGREGAR ARCHIVO -->
                            </td>
                        </tr>

                        <tr>
                            <td colspan="9" align="center">
                                <button type="submit" onclick="return subir2();" class="btn btn-primary" disabled>Subir Archivo</button> <!-- BOTON PARA SUBIR ARCHIVO -->
                            </td>
                        </tr>
                    </form>
                </tbody>
                <!--****************************************COMENTARIOS***************************************-->
                <tbody>
                    <tr class="comentarios">
                        <!-- Tabla de comentarios -->
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
                            $sql = "SELECT * FROM comentarios_s where folio='$ids' ORDER BY fecha_comentario DESC";
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

                <?php } ?>

                <tr>
                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                </tr>

                <tr class="observaciones">
                    <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                    <td colspan="6" align="center">
                        <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled></textarea>
                        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">

                        <?php
                            $est = "SELECT estado from folios_s where id='$ids'";
                            $est1 = mysqli_query($conexion, $est);
                            while ($ver3 = mysqli_fetch_row($est1)) {
                                $datos2 = $ver3[0];
                        ?>
                            <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2"; ?>">

                        <?php } ?>

                    </td>
                </tr>
                <tr class="observaciones">
                    <td colspan="2" align="center"></td>
                    <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                    <td colspan="2" align="center">
                        <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                            <option value="Seleccione">Seleccione:</option>
                            <?php
                            if ($datos2 == "ENVIADO") {
                            ?>
                                <option value="INCOMPLETO">INCOMPLETO</option>
                                <option value="PROCESO">PROCESO</option>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "INCOMPLETO") {
                            ?>
                                <option value="PROCESO">PROCESO</option>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "PROCESO") {
                            ?>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="REPROCESO">REPROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "PROCESO GNP") {
                            ?>
                                <option value="REPROCESO">REPROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "REPROCESO") {
                            ?>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "TERMINADO") {
                            ?>
                                <option value="REPROCESO">REPROCESO</option>
                            <?php
                            } else {
                            }
                            ?>
                        </select>
                    </td>
                    <td colspan="2" align="center"></td>
                </tr>
                <tr class="observaciones">
                    <td colspan="8" align="center">
                        <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar2" disabled></button>
                    </td>
                </tr>
                </tbody>

            <?php } ?>


            <!-- Entran todos los estados -->
            <?php if ($ver[14] == "ENVIADO" || $ver[14] == "INCOMPLETO" || $ver[14] == "PROCESO" || $ver[14] == "PROCESO GNP" || $ver[14] == "REPROCESO") { ?>

                <?php if ($ver[2] == 'GMM') { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Contratante:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center"></td>
                        <td colspan="1" align="center"><b>Total:</b></td>
                        <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Afectado:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[16]; ?></td>
                        <td colspan="1" align="center"><b>Gastos no cubiertos:</b></td>
                        <td colspan="2" align="center"><?php echo $ver[5]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center"><b>Monto Procedente:</b></td>
                        <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de QR:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Reclamación:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Folio:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[12]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } else if ($ver[2] == 'VIDA') { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Contratante:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[7]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } else if ($ver[2] == 'AUTOS') { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Contratante:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Siniestro:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[9]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de QR:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Contratante:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Siniestro:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[9]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de QR:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } ?>

                <!-- Documentos -->
                <tr>
                    <td colspan="8" align="center" class="documentos"> <b>
                            <p style="color:#FFFFFF">DOCUMENTOS
                        </b></td>
                </tr>
                <tr align="center" class="datosDocument">
                    <td colspan="1"><b>Usuario</td>
                    <td colspan="3"><b>Nombre de Archivo</td>
                    <td colspan="1"><b>Ver</td>
                    <td colspan="1"><b>Descargar</td>
                    <td colspan="1"><b>¿Aprobado?</td>
                    <td colspan="1"><b>Fecha de carga</td>
                </tr>
                <form class="" action="validar_s.php" method="post">
                    <?php
                            $query = "SELECT id,nombre, fk_folio, fecha_creacion, nomusuario FROM archivos_s WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {
                    ?>
                        <tr>
                            <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                            <td colspan="3" align="center"><?php echo $row[1]; ?></td>
                            <td colspan="1" align="center"> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank">
                                    <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                            </td>
                            <td colspan="1" align="center">
                                <a href="../sistemas/archivos_s/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                            </td>
                            <td colspan="1" align="center">
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

                <!-- Archivos -->
                <tbody>
                    <form action="anexar_s.php" method="POST" enctype="multipart/form-data">
                        <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                        <tr>
                            <td colspan="8" align="center" class="agregar"><b>
                                    <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                </b></td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <input id="agregar2" type="file" name="file" accept=".pdf" disabled> <!-- AGREGAR ARCHIVO -->
                            </td>
                        </tr>

                        <tr>
                            <td colspan="9" align="center">
                                <button type="submit" onclick="return subir2();" class="btn btn-primary" disabled>Subir Archivo</button> <!-- BOTON PARA SUBIR ARCHIVO -->
                            </td>
                        </tr>
                    </form>
                </tbody>

                <!-- Comentarios -->
                <tbody>
                    <tr class="comentarios">
                        <!-- Tabla de comentarios -->
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
                            $sql = "SELECT * FROM comentarios_s where folio='$ids' ORDER BY fecha_comentario DESC";
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

                <?php } ?>

                <tr>
                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                </tr>

                <tr class="observaciones">
                    <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                    <td colspan="6" align="center">
                        <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">

                        <?php
                            $est = "SELECT estado from folios_s where id='$ids'";
                            $est1 = mysqli_query($conexion, $est);
                            while ($ver3 = mysqli_fetch_row($est1)) {
                                $datos2 = $ver3[0];
                        ?>
                            <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2"; ?>">

                        <?php } ?>

                    </td>
                </tr>
                <tr class="observaciones">
                    <td colspan="2" align="center"></td>
                    <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                    <td colspan="2" align="center">
                        <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                            <option value="Seleccione">Seleccione:</option>
                            <?php
                            if ($datos2 == "ENVIADO") {
                            ?>
                                <option value="INCOMPLETO">INCOMPLETO</option>
                                <option value="PROCESO">PROCESO</option>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "INCOMPLETO") {
                            ?>
                                <option value="PROCESO">PROCESO</option>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "PROCESO") {
                            ?>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="REPROCESO">REPROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "PROCESO GNP") {
                            ?>
                                <option value="REPROCESO">REPROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "REPROCESO") {
                            ?>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "TERMINADO") {
                            ?>
                                <option value="REPROCESO">REPROCESO</option>
                            <?php
                            } else {
                            }
                            ?>
                        </select>
                    </td>
                    <td colspan="2" align="center"></td>
                </tr>
                <tr class="observaciones">
                    <td colspan="8" align="center">
                        <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar2"></button>
                    </td>
                </tr>
                </tbody>

            <?php } ?>

            <!-- SECCION DE TERMINADOS  -->

            <?php if ($ver[14] == 'TERMINADO') { ?>
                <?php if ($ver[2] == 'GMM') { ?>

                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Contratante:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center"></td>
                        <td colspan="1" align="center"><b>Total:</b></td>
                        <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Afectado:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[16]; ?></td>
                        <td colspan="1" align="center"><b>Gastos no cubiertos:</b></td>
                        <td colspan="2" align="center"><?php echo $ver[5]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center"><b>Monto Procedente:</b></td>
                        <td colspan="2" align="center"><?php echo $ver[6]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de QR:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Reclamación:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[11]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Folio:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[12]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } else if ($ver[2] == 'VIDA') { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Contratante:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[7]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } else if ($ver[2] == 'AUTOS') { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Contratante:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Siniestro:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[9]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de QR:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td align="center"><b>Folio:</b></td>
                        <td align="center"><input type="text" hidden="" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled>FS<?php echo "$ids"; ?></td>
                        <td align="center"><b>Línea de Negocio:</b></td>
                        <td align="center">SINIESTROS <?php echo $ver[2]; ?></td>
                        <td align="center"><b>Fecha Solicitud:</b></td>
                        <td align="center"><?php echo $ver[1]; ?></td>
                        <td align="center"><b>Estado:</b></td>
                        <td align="center"><b><?php echo $ver[14] ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center"><b>Contratante:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[7]; ?></td>
                        <td colspan="1" align="center"><b>Poliza:</b></td>
                        <td colspan="3" align="center"><?php echo $ver[8]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Tipo de Solicitud:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[3]; ?></td>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de Siniestro:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[9]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="1" align="center" bgcolor="#eeefef"></td>
                        <td colspan="2" align="center"><b>Número de QR:</b></td>
                        <td colspan="4" align="center"><?php echo $ver[10]; ?></td>
                        <td colspan="1" bgcolor="#eeefef"></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><b>Descripcion Detallada:</b></td>
                        <td colspan="6" align="center"><?php echo $ver[13]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                    </tr>

                <?php } ?>

                <!-- DOCUMENTOS -->
                <tr>
                    <td colspan="8" align="center" class="documentos"> <b>
                            <p style="color:#FFFFFF">DOCUMENTOS
                        </b></td>
                </tr>
                <tr align="center" class="datosDocument">
                    <td colspan="1"><b>Usuario</td>
                    <td colspan="3"><b>Nombre de Archivo</td>
                    <td colspan="1"><b>Ver</td>
                    <td colspan="1"><b>Descargar</td>
                    <td colspan="1"><b>¿Aprobado?</td>
                    <td colspan="1"><b>Fecha de carga</td>
                </tr>
                <form class="" action="validar_s.php" method="post">
                    <?php
                            $query = "SELECT id,nombre, fk_folio, fecha_creacion, nomusuario FROM archivos_s WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {
                    ?>
                        <tr>
                            <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                            <td colspan="3" align="center"><?php echo $row[1]; ?></td>
                            <td colspan="1" align="center"> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank">
                                    <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                            </td>
                            <td colspan="1" align="center">
                                <a href="../sistemas/archivos_s/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1]; ?>">
                                    <span class="btn btn-primary glyphicon glyphicon-download-alt"></span></a>
                            </td>

                            <td colspan="1" align="center">
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

                <!-- ARCHIVOS -->

                <tbody>
                    <form action="anexar_s.php" method="POST" enctype="multipart/form-data">
                        <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                        <tr>
                            <td colspan="8" align="center" class="agregar"><b>
                                    <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                </b></td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <input id="agregar2" type="file" name="file" accept=".pdf" disabled> <!-- AGREGAR ARCHIVO -->
                            </td>
                        </tr>

                        <tr>
                            <td colspan="9" align="center">
                                <button type="submit" onclick="return subir2();" class="btn btn-primary" disabled>Subir Archivo</button> <!-- BOTON PARA SUBIR ARCHIVO -->
                            </td>
                        </tr>
                    </form>
                </tbody>

                <!-- COMENTARIOS -->

                <tbody>
                    <tr class="comentarios">
                        <!-- Tabla de comentarios -->
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
                            $sql = "SELECT * FROM comentarios_s where folio='$ids' ORDER BY fecha_comentario DESC";
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

                <?php } ?>

                <tr>
                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                </tr>

                <tr class="observaciones">

                    <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                    <td colspan="6" align="center">
                        <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">

                        <?php
                            $est = "SELECT estado from folios_s where id='$ids'";
                            $est1 = mysqli_query($conexion, $est);
                            while ($ver3 = mysqli_fetch_row($est1)) {
                                $datos2 = $ver3[0];
                        ?>
                            <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2"; ?>">

                        <?php } ?>

                    </td>
                </tr>
                <tr class="observaciones">
                    <td colspan="2" align="center"></td>
                    <td colspan="2" align="center"><b>Cambiar estado:</b></td>
                    <td colspan="2" align="center">
                        <select type="text" name="estado" value="" id="estado" class="form-control input-sm" disabled>
                            <option value="Seleccione">Seleccione:</option>
                            <?php
                            if ($datos2 == "ENVIADO") {
                            ?>
                                <option value="INCOMPLETO">INCOMPLETO</option>
                                <option value="PROCESO">PROCESO</option>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "INCOMPLETO") {
                            ?>
                                <option value="PROCESO">PROCESO</option>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "PROCESO") {
                            ?>
                                <option value="PROCESO GNP">PROCESO GNP</option>
                                <option value="REPROCESO">REPROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "PROCESO GNP") {
                            ?>
                                <option value="REPROCESO">REPROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "REPROCESO") {
                            ?>
                                <option value="TERMINADO">TERMINADO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            <?php
                            } else if ($datos2 == "TERMINADO") {
                            ?>
                                <option value="REPROCESO">REPROCESO</option>
                            <?php
                            } else {
                            }
                            ?>
                        </select>
                    </td>
                    <td colspan="2" align="center"></td>
                </tr>
                <tr class="observaciones">
                    <td colspan="8" align="center">
                        <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar2"></button>
                    </td>
                </tr>
                </tbody>

                <!-- CIERRE DE TERMINADO  -->
            <?php } ?>


        <?php } ?>

        </tbody>
            </table>
        </div>
    </div>
</body>

<script type="text/javascript">
$(document).ready(function() {
     $('[rel="tooltip"]').tooltip();
  });
    $(document).ready(function() {
        $('#guardar2').click(function() {

            var comentario = document.getElementById('observaciones').value;
            var estado = document.getElementById('estado').value;

            if (estado == 'Seleccione') {
                if (comentario.length == 0) {
                    swal({
                        title: "¡Error!",
                        text: "Ingresa un comentario para continuar",
                        type: "error",
                        customClass: 'swal-wide',
                        allowOutsideClick: false
                    });
                    hasError = true;
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'INCOMPLETO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'PROCESO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'PROCESO GNP') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'REPROCESO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            if (estado == 'TERMINADO') {
                if (comentario.length == 0) {
                    alertify.alert("Ingresa un comentario justificando el cambio de estado.");
                } else {
                    guardar3();
                    location.reload();
                    location.reload();
                }
            }

            //PARA VERIFICAR EL ESTADO DE CANCELADO
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

                            guardar3();
                            location.reload();
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
    function subir2() {

        var agregar1 = document.getElementById("agregar2").value;
        if (agregar1 == null || agregar1 == 0) {
            alertify.alert('ERROR: Seleccione algun archivo.');
            return false;
        }

        $.ajax({
            success: function() {
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
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
</footer>


<!--VALIDACION DE CONFORMIDAD-->

<script type="text/javascript">
    function conformidad_s() {

        var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".checkbox");

        for (var i = 0; i < tabla.length; i++) {
            tabla[i].disabled = true;

        }
        var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".btn");

        for (var i = 0; i < tabla.length; i++) {
            tabla[i].disabled = true;
            tabla[i].checked = true;
        }
        document.getElementById("agregar2").disabled = true;
        document.getElementById("observaciones").disabled = true;
        document.getElementById("estado").disabled = true;
        document.getElementById("notificar").disabled = true;
        document.getElementById("estado").disabled = true;

    }

    //FUNCION PARA LA CARGA DE ARCHIVOS (ALERTA)
    function subir() {
        var agregar2 = document.getElementById("agregar2").value;
        if (agregar2 == null || agregar2 == 0) {
            alertify.alert('ERROR: Seleccione algun archivo por favor.');
            return false;
        }
    }
</script>

</html>