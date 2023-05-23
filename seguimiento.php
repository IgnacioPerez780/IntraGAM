<?php
error_reporting(E_ALL);
include 'app/conexion.php';
$conexion = conexion();
session_start();


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
} else header('location: index.php');
$nomusuario = $_SESSION['nomusuario'];
$ids = isset($_GET['id']) ? $_GET['id'] : 1;
//var_dump($ids);
$cont = "UPDATE notificaciones1 set contador='0' where folio='$ids'";
$result = mysqli_query($conexion, $cont);
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$id_archivo = isset($_GET['id_archivo']) ? $_GET['id_archivo'] : 0;
//var_dump($_GET['id_archivo']);
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

<!--     alertas
 -->    
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- termina codigo alertas
 -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/alertify.min.js"></script>
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
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
    <link rel="stylesheet" type="text/css" href="css/estilo_check.css">
    <!--HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_seguimientos.css">
    <link rel="stylesheet" href="css/main_vida.css">
    <!-- JS - BARRA DE PROGRESO-->
    <script src="js/main_vida_agente.js"></script>
    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />

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
include('plantillas/cabecera_agente.php');
?>

<body <?php if (in_array($ids, $categorias2)) {
            echo 'onload="conformidad()"';
        } ?>>
    
    
    
    


<!-- FUNCION PARA LA ENCUESTA -*********************************************************************************
 -->
<!-- Modal que se muestra si el folio esta terminado
 -->
 <div class="modal fade" id="dialogo1">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- cabecera del diálogo -->
          <div class="modal-header">
            <h3 class="text-center">SOLICITUD CONCLUIDA</h3>
            <button type="button" class="close" data-dismiss="modal">X</button>
          </div>
    
          <!-- cuerpo del diálogo -->
          <div class="modal-body">
            <h4> <p class="text-justify">     
                    Tu solicitud ha sido concluida con éxito, por favor revisa la documentación anexa y ayúdanos a corroborar que cumpla los criterios necesarios de acuerdo con lo solicitado, en tal caso, acepta los términos en los que fue resulta tu solicitud para poder descargar la caratula de tu poliza.   </p>
                    <br>
                    <br>

                <p class="text-justify"> Si existe alguna inconsistencia favor de notificar de manera inmediata al consultor a través de este medio.
                Gracias. </p>
            </h4>
          </div>
    
          <!-- pie del diálogo -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
    
        </div>
      </div>
    </div> 




<?php 


    
   $buscarencuesta = "SELECT * FROM encuesta where folio ='$ids' ";
                    $result2 = mysqli_query($conexion, $buscarencuesta);
                    while ($encuesta = mysqli_fetch_row($result2)) {
                        $datosE = $encuesta[0] . "||" .
                            $encuesta[1]; 
                            $respondido = $encuesta[1];
                        }
    
/*     $buscarconsultor = "SELECT * FROM comentarios where folio ='$ids' AND usuario = 'Veronica S' || usuario = 'Carolina H' || usuario = 'Dante V' || usuario = 'Diana C' || usuario = 'Karla B' || usuario = 'sistemas'";
                    $result3 = mysqli_query($conexion, $buscarconsultor);
                    while ($consultorCom = mysqli_fetch_row($result3)) {
                        $datosE = $consultorCom[0];
                            $respondido2 = $consultorCom[4];
                        }

                       echo $respondido2;
*/

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
                            $ver[19];


                            if ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA') {

                                $terminado = 1 ;
                                if ($respondido != $ids ) {
                                    
                              

                                ?>
                                <script type="text/javascript">
                                         $(document).ready(function() {
     

                                  $('#dialogo1').modal('show');  

                                    });
                                </script>
                                <?php
                              }
                                $lnegocio = $ver[2];
                            }

                        } 
                      
                    ?>


<!-- Modal que se muestra la encuesta
 -->

 <form id="fencuesta" method="POST" action="guardarEncuesta.php">
    <div class="modal fade modal-dialog-centered" id="encuesta" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- cabecera del diálogo -->
          <div class="modal-header">
            <h3 style="text-align:center;" class="modal-title">Encuesta Calidad<button type="button" class="close" data-dismiss="modal">X</button>
            </h3>
          </div>
    
          <!-- cuerpo del diálogo -->
          <div class="modal-body">
            

                    <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>

                    <input style="display: none;" type="radio" name="ramo" value="<?php echo $lnegocio;  ?>" checked>

                    <input style="display: none;" type="radio" name="folio" value="<?php echo $ids;  ?>" checked>

                <div class="feedback" id="pregunta1">
                    <h4 style="text-align:center;"> <p tex> 1.- ¿Qué tan satisfecho estas con el tiempo de respuesta? </p> </h4>   

                    <div class="rating" style="left:0">
                        <input type="radio" name="rating" value="10" id="rating-10">
                        <label for="rating-10"></label>
                        <input type="radio" name="rating" value="9" id="rating-9">
                        <label for="rating-9"></label>
                        <input type="radio" name="rating" value="8" id="rating-8">
                        <label for="rating-8"></label>
                        <input type="radio" name="rating" value="7" id="rating-7">
                        <label for="rating-7"></label>
                        <input type="radio" name="rating" value="6" id="rating-6">
                        <label for="rating-6"></label>
                        <input type="radio" name="rating" value="5" id="rating-5">
                        <label for="rating-5"></label>
                        <input type="radio" name="rating" value="4" id="rating-4">
                        <label for="rating-4"></label>
                        <input type="radio" name="rating" value="3" id="rating-3">
                        <label for="rating-3"></label>
                        <input type="radio" name="rating" value="2" id="rating-2">
                        <label for="rating-2"></label>
                        <input type="radio" name="rating" value="1" id="rating-1">
                        <label for="rating-1"></label>
                        <input type="radio" name="rating" value="0" id="rating-0">
                        <label for="rating-0"></label>
                        <div class="emoji-wrapper">
                            <div class="emoji">
                                <!--CODIGO PARA EL ICONO NUMERO 00-ESTE ICONO ES PARA CUANDO NO SE HA SELECCIONADO NADA AUN-->
                                <svg class="rating-00" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534" />
                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347" />
                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63" />
                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347" />
                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347" />
                                </svg>
                                <!--CODIGO PARA EL VALOR 0 EN EL RATING-->
                                <svg class="rating-0 shake-opacity" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px" class="hovered-paths">
                                    <g>
                                        <circle style="fill:#CACAC7" cx="256" cy="256" r="256" data-original="#FFD93B" class="" data-old_color="#FFD93B" />
                                        <path style="fill:#D2D2D2" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28  c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72  C474.8,103.68,512,175.52,512,256z" data-original="#F4C534" class="hovered-path active-path" data-old_color="#F4C534" />
                                        <g>
                                            <path style="fill:#F02A2A" d="M303.104,396.704c0,26.08-21.12,47.04-47.04,47.04c-26.08,0-47.04-20.96-47.04-47.04   c0-25.92,20.96-47.04,47.04-47.04C281.984,349.664,303.104,370.784,303.104,396.704z" data-original="#3E4347" class="" data-old_color="#3E4347" />
                                            <path style="fill:#F02A2A" d="M203.744,218.56l-21.6,21.6l21.6,21.6c6.88,6.88,6.88,18.4,0,25.28l-0.16,0.16   c-6.88,6.88-18.4,6.88-25.28,0l-21.6-21.6l-21.6,21.6c-6.88,6.88-18.4,6.88-25.28,0l-0.16-0.16c-6.88-6.88-6.88-18.4,0-25.28   l21.6-21.6l-21.6-21.6c-6.88-6.88-6.88-18.4,0-25.44c7.008-6.992,19.072-6.656,25.44,0l21.6,21.6l21.6-21.6   c6.88-6.88,18.4-6.88,25.28,0h0.16C210.624,200.16,210.624,211.68,203.744,218.56z" data-original="#3E4347" class="" data-old_color="#3E4347" />
                                            <path style="fill:#F02A2A" d="M402.336,287.04v0.16c-7.04,6.88-18.56,6.88-25.44,0l-21.6-21.6l-21.44,21.6   c-7.04,6.88-18.56,6.88-25.44,0v-0.16c-7.04-6.88-7.04-18.4,0-25.28l21.44-21.6l-21.44-21.6c-7.04-6.88-7.04-18.4,0-25.44   c7.072-7.072,18.816-6.608,25.44,0l21.44,21.6l21.6-21.6c6.88-6.88,18.4-6.88,25.44,0c6.864,7.2,6.8,18.64,0,25.44l-21.6,21.6   l21.6,21.6C409.216,268.64,409.216,280.16,402.336,287.04z" data-original="#3E4347" class="" data-old_color="#3E4347" />
                                        </g>
                                    </g>
                                </svg>
                                <!--EMOJI 1-->
                                <svg class="rating-1 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <circle style="fill:#3E4347;" cx="256" cy="382.144" r="63.856" />
                                    <path style="fill:#E24B4B;" d="M256,446c16.848,0,32.128-6.576,43.536-17.232c-0.256-6.912-2.08-13.424-5.168-19.104
                                    c-6.016-10.96-19.232-15.808-30.848-11.392c-6.768,2.48-14.4,3.984-23.008,3.984c-0.112,0-0.112,0-0.224,0
                                    c-12.896-0.112-25.04,7.952-27.296,20.64c-0.336,1.904-0.496,3.872-0.576,5.856C223.856,439.424,239.136,446,256,446z" />
                                    <path style="fill:#FFFFFF;" d="M309.056,346.64C297.6,329.552,278.112,318.288,256,318.288s-41.6,11.248-53.056,28.336
                                    C213.2,356,233.104,357.12,256,357.12S298.8,356,309.056,346.64z" />
                                    <g style="opacity:0.2;">
                                        <ellipse transform="matrix(-0.9317 -0.3632 0.3632 -0.9317 387.3987 892.644)" style="fill:#FFFFFF;" cx="277.618" cy="409.902" rx="8.816" ry="5.04" />
                                    </g>
                                    <g>
                                        <path style="fill:#E9B02C;" d="M280.064,159.152c-2.256-5.44,0.352-11.68,5.792-13.92l78.016-32.16
                                        c5.44-2.272,11.68,0.352,13.92,5.792c2.256,5.44-0.352,11.68-5.792,13.92l-78.016,32.16
                                        C288.528,167.2,282.288,164.576,280.064,159.152z" />
                                        <path style="fill:#E9B02C;" d="M218.016,164.944L140,132.784c-5.44-2.24-8.048-8.48-5.792-13.92c2.24-5.44,8.48-8.064,13.92-5.792
                                        l78.016,32.16c5.44,2.24,8.048,8.48,5.792,13.92C229.712,164.576,223.472,167.2,218.016,164.944z" />
                                    </g>
                                    <ellipse style="fill:#FFFFFF;" cx="177.6" cy="232.608" rx="58" ry="58.048" />
                                    <circle style="fill:#3E4347;" cx="177.6" cy="232.608" r="32" />
                                    <ellipse transform="matrix(-0.6912 -0.7227 0.7227 -0.6912 163.8109 510.0115)" style="fill:#5A5F63;" cx="190.875" cy="220.006" rx="7.392" ry="5.456" />
                                    <ellipse style="fill:#FFFFFF;" cx="334.432" cy="232.608" rx="58" ry="58.048" />
                                    <circle style="fill:#3E4347;" cx="334.416" cy="232.608" r="32" />
                                    <ellipse transform="matrix(-0.6912 -0.7227 0.7227 -0.6912 428.994 623.274)" style="fill:#5A5F63;" cx="347.667" cy="219.978" rx="7.392" ry="5.456" />
                                    <g></g>
                                </svg>
                                <!--EMOJI 2-->
                                <svg class="rating-2 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M328.416,428.016c-17.12-21.28-43.2-34.88-72.48-34.88s-55.36,13.6-72.48,34.72
                                    c-4.64,5.76-13.44,1.6-12-5.76c7.52-36.8,40.64-68.96,84.48-68.96c44.16,0,77.44,32.64,84.64,69.76
                                    C341.856,429.792,332.896,433.472,328.416,428.016z" />
                                    <path style="fill:#F4C534;" d="M269.216,222.32c5.28,62.784,52.048,113.84,104.752,113.84c52.368,0,90.864-51.056,85.584-113.84
                                    c-1.984-24.944-10.736-47.904-23.632-66.752c-4.128-6.112-12.224-7.936-18.512-4.128c-16.192,10.08-36.176,16.192-60.128,16.192
                                    c-22.8,0-42.128-5.616-57.824-14.864c-6.768-3.968-15.36-1.488-18.832,5.456C271.68,176.384,267.392,198.528,269.216,222.32z" />
                                    <path style="fill:#FFFFFF;" d="M356.96,189.456c25.792,0,46.976-7.088,63.76-18.608c10,14.592,17.072,32.048,18.672,51.504
                                    c4.096,49.6-26.096,89.728-67.488,89.728c-41.568,0-78.368-40.128-82.464-89.728c-1.488-18.032,2-34.368,8.512-48.336
                                    C313.952,183.68,333.6,189.456,356.96,189.456z" />
                                    <path style="fill:#3E4347;" d="M396.208,246.144c0,21.392-17.184,38.576-38.752,38.576c-21.392,0-38.576-17.184-38.576-38.592
                                    c0-21.568,17.184-38.752,38.576-38.752C379.008,207.392,396.208,224.576,396.208,246.144z" />
                                    <path style="fill:#FFFFFF;" d="M380.416,241.104c-3.2,3.2-9.92,1.744-14.88-3.216c-4.816-4.816-6.272-11.52-3.056-14.736
                                    c3.36-3.36,10.064-1.904,14.88,2.912C382.304,231.04,383.76,237.76,380.416,241.104z" />
                                    <path style="fill:#F4C534;" d="M242.784,222.32c-5.28,62.784-52.048,113.84-104.752,113.84c-52.368,0-90.864-51.056-85.584-113.84
                                    c1.984-24.944,10.736-47.904,23.632-66.752c4.144-6.112,12.24-7.92,18.512-4.128c16.192,10.08,36.176,16.192,60.128,16.192
                                    c22.8,0,42.128-5.616,57.824-14.864c6.768-3.968,15.36-1.488,18.832,5.456C240.32,176.384,244.608,198.528,242.784,222.32z" />
                                    <path style="fill:#FFFFFF;" d="M155.04,189.456c-25.792,0-46.976-7.088-63.76-18.608c-10,14.592-17.072,32.048-18.672,51.504
                                    c-4.096,49.6,26.096,89.728,67.488,89.728c41.568,0,78.368-40.128,82.464-89.728c1.488-18.032-2-34.368-8.512-48.336
                                    C198.048,183.68,178.4,189.456,155.04,189.456z" />
                                    <path style="fill:#3E4347;" d="M115.792,246.144c0,21.392,17.184,38.576,38.752,38.576c21.392,0,38.576-17.184,38.576-38.592
                                    c0-21.568-17.184-38.752-38.576-38.752C132.992,207.392,115.792,224.576,115.792,246.144z" />
                                    <path style="fill:#FFFFFF;" d="M131.584,241.104c3.2,3.2,9.92,1.744,14.88-3.216c4.816-4.816,6.272-11.52,3.056-14.736
                                    c-3.36-3.36-10.064-1.904-14.88,2.912C129.696,231.04,128.24,237.76,131.584,241.104z" />
                                    <g>
                                    </g>
                                </svg>
                                <!--EMOJI 3-->
                                <svg class="rating-3 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M343.408,430.672c-14.608,6.256-46.016-20.592-92.32-40.656c-52.32-22.192-92.4-5.792-101.472-16.096
                                    c-11.408-7.088,28.304-41.072,115.84-39.28C367.056,339.648,360.832,426.384,343.408,430.672z" />
                                    <path style="fill:#FFFFFF;" d="M241.856,222.624c0,39.584-35.552,75.952-79.392,81.232c-43.856,5.28-79.392-22.528-79.392-62.112
                                    s35.552-75.952,79.392-81.232S241.856,183.04,241.856,222.624z" />
                                    <ellipse style="fill:#3E4347;" cx="175.729" cy="222.766" rx="37.36" ry="37.36" />
                                    <path style="fill:#5A5F63;" d="M198.64,214.624c-2.832,2.832-8.48,1.696-12.56-2.384c-3.952-3.968-5.088-9.616-2.256-12.448
                                    c2.72-2.72,8.368-1.584,12.336,2.384C200.224,206.256,201.36,211.92,198.64,214.624z" />
                                    <path style="fill:#FFFFFF;" d="M270.144,222.624c0,39.584,35.552,75.952,79.392,81.232c43.856,5.28,79.392-22.528,79.392-62.112
                                    s-35.552-75.952-79.392-81.232S270.144,183.04,270.144,222.624z" />
                                    <ellipse style="fill:#3E4347;" cx="336.307" cy="222.747" rx="37.36" ry="37.36" />
                                    <path style="fill:#5A5F63;" d="M313.36,214.624c2.832,2.832,8.48,1.696,12.56-2.384c3.968-3.968,5.088-9.616,2.272-12.448
                                    c-2.72-2.72-8.368-1.584-12.336,2.384C311.776,206.256,310.64,211.92,313.36,214.624z" />
                                    <g>
                                        <path style="fill:#F4C534;" d="M98.656,155.376c16-7.984,44.704-21.808,63.472-35.92c26.336-18.032,38.608-34.8,54.608-48.208
                                    c-1.76,25.664-19.584,53.872-40.752,67.808C151.52,157.008,116.72,162.08,98.656,155.376z" />
                                        <path style="fill:#F4C534;" d="M401.216,120.24c-12.432,14.992-45.2,27.824-75.136,24.496
                                    c-29.12-1.696-55.568-18.128-69.184-38.352c16,2.816,40.512,12.08,71.392,14.464C352.24,123.76,385.216,121.216,401.216,120.24z" />
                                    </g>
                                </svg>
                                <!--EMOJI 4-->
                                <svg class="rating-4 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#FFD93B;" d="M380.128,402.976c-14.08,23.184-29.84,25.216-50.24,12c-7.76-4.704-23.376-12.48-41.168-17.584
                                    c-26.96-8.416-59.44-6.336-88.096,8.96c-18.512,9.952-35.168,17.264-44.656,18.224c-25.008,1.712-47.456-20.544-51.84-43.36
                                    c-4.752-22.256,10.128-60.288,43.648-71.488c12.048-3.84,35.36-3.68,57.632,4.224c34.384,11.584,67.92,19.984,100.528,26.576
                                    c21.088,4.336,40.736,10.192,51.2,13.328C385.952,361.872,394.208,380.32,380.128,402.976z" />
                                    <path style="fill:#3E4347;" d="M380.128,402.976c-14.08,23.184-29.84,25.216-50.24,12c-7.76-4.704-23.376-12.48-41.168-17.584
                                    c-26.96-8.416-59.44-6.336-88.096,8.96c-18.512,9.952-35.168,17.264-44.656,18.224c-25.008,1.712-47.456-20.544-51.84-43.36
                                    c-4.752-22.256,10.128-60.288,43.648-71.488c12.048-3.84,35.36-3.68,57.632,4.224c34.384,11.584,67.92,19.984,100.528,26.576
                                    c21.088,4.336,40.736,10.192,51.2,13.328C385.952,361.872,394.208,380.32,380.128,402.976z" />
                                    <path style="fill:#FFFFFF;" d="M317.6,378c18.688,1.632,36.464,5.12,55.904,6.368c0.784-9.376-4.736-17.792-20.112-22.912
                                    c-8.064-2.64-25.616-7.84-47.184-11.552c-17.12-2.832-34.544-5.936-52.24-9.44c-17.68-3.504-35.52-7.728-53.456-12.944
                                    c-22.56-6.784-43.632-5.808-52.608-3.056c-18.096,5.184-27.072,20.912-29.888,34.096c20.176,0.368,40.272,5.152,59.584,9.504
                                    c-19.328,4.4-38.88,9.104-59.024,14.352c4.208,14.704,16.256,30.352,35.456,27.888c7.68-1.008,23.52-7.184,43.616-16.96
                                    c15.792-7.488,32.72-11.44,49.232-11.76c16.512-0.336,32.544,2.48,46.96,7.824c18.64,6.64,32.816,14.208,39.168,17.728
                                    c15.824,9.072,26.368,4.56,34.08-6.144C351.2,391.952,334.608,384.368,317.6,378z" />
                                    <circle style="fill:#F4C534;" cx="158.512" cy="183.008" r="86.048" />
                                    <path style="fill:#FFFFFF;" d="M234.688,183.008c-2.288,41.344-38.256,74.848-80.32,74.848s-74.304-33.504-72.016-74.848
                                    c2.288-41.328,38.256-74.848,80.32-74.848S236.976,141.68,234.688,183.008z" />
                                    <ellipse style="fill:#3E4347;" cx="180.148" cy="183.469" rx="42.784" ry="42.784" />
                                    <path style="fill:#5A5F63;" d="M205.712,174.08c-3.28,3.28-9.664,2.416-14.16-2.08c-4.32-4.48-5.344-10.704-2.064-14.144
                                    c3.456-3.28,9.664-2.24,14.16,2.064C208.128,164.416,208.992,170.8,205.712,174.08z" />
                                    <circle style="fill:#F4C534;" cx="352.8" cy="183.008" r="86.048" />
                                    <path style="fill:#FFFFFF;" d="M276.56,183.008c2.288,41.344,38.256,74.848,80.32,74.848s74.304-33.504,72.016-74.848
                                    s-38.256-74.848-80.32-74.848C306.496,108.16,274.256,141.68,276.56,183.008z" />
                                    <ellipse style="fill:#3E4347;" cx="331.084" cy="183.461" rx="42.784" ry="42.784" />
                                    <path style="fill:#5A5F63;" d="M356.672,174.08c-3.28,3.28-9.664,2.416-14.144-2.08c-4.32-4.48-5.344-10.704-2.064-14.144
                                    c3.456-3.28,9.664-2.24,14.144,2.064C359.088,164.416,359.952,170.8,356.672,174.08z" />
                                    <path style="fill:#FFD93B;" d="M60.48,264.352c60.928,26.064,120.096,27.84,177.168,0c-65.936-35.968-143.056-14.704-177.168-1.856
                                    C60.48,262.496,60.48,264.352,60.48,264.352z" />
                                    <path style="fill:#F4C534;" d="M233.808,262.128c-16-2.864-37.888-10.256-79.76-9.76c-29.04-0.08-58.096,3.888-81.04,5.744
                                    c16.032-10.768,48.544-21.664,80.992-21.728C183.408,236.96,210.96,243.472,233.808,262.128z" />
                                    <g></g>
                                </svg>
                                <!--EMOJI 5-->
                                <svg class="rating-5 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <g fill="#ffd93b">
                                        <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                        <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                        c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                        C474.8,103.68,512,175.52,512,256z" />
                                        <path style="fill:#3E4347;" d="M445.504,196.112c-2.416,12.624-4.816,25.248-7.232,37.872c-21.6-31.568-65.216-53.328-112.832-50.72
                                        c-9.872,0.64-19.168,2.4-28.032,4.912c-3.936-19.2-8.144-38.368-12.592-57.52c5.488,11.824,10.8,23.712,15.936,35.616
                                        c-1.568-12.768-3.216-25.52-4.944-38.272c5.824-1.168,12.08-1.872,18.304-2.224c30.144-1.936,59.456,5.168,82.672,18.336
                                        c-0.24,11.28-0.496,22.56-0.816,33.824c1.968-10.272,3.952-20.544,5.952-30.816c6.096,3.824,11.664,7.856,16.672,12.432
                                        c-0.912,10-1.84,20.016-2.784,30.032c2.32-8.704,4.672-17.392,7.024-26.08C432.768,173.088,440.464,184.24,445.504,196.112z" />
                                        <path style="fill:#F4C534;" d="M403.184,266.736c-5.04,28.896-35.44,47.664-68.096,44.368
                                        c-32.656-3.424-58.464-28.064-57.504-57.344c0.944-29.184,31.632-51.904,68.384-48.096
                                        C382.72,209.424,408.224,237.936,403.184,266.736z" />
                                        <path style="fill:#FFFFFF;" d="M397.44,265.808c-1.632,24.736-27.264,40.544-57.2,37.376c-29.936-3.264-55.344-24.416-56.848-49.136
                                        c-1.52-24.608,23.968-43.744,57.056-40.464C373.536,216.784,399.072,241.152,397.44,265.808z" />
                                        <path style="fill:#3E4347;" d="M358.416,262.72c-1.76,13.968-16.384,23.712-32.704,22.224c-16.16-1.552-28.752-13.728-27.952-27.776
                                        c0.816-14.16,15.504-24.816,32.608-23.248C347.664,235.504,360.176,248.64,358.416,262.72z" />
                                        <path style="fill:#5A5F63;" d="M316.816,253.888c-1.76,3.616-5.712,5.424-8.88,4.224c-3.056-1.152-4.032-5.008-2.08-8.528
                                        c1.728-3.664,5.856-5.44,8.944-4.24C317.888,246.56,318.816,250.4,316.816,253.888z" />
                                        <path style="fill:#3E4347;" d="M66.496,196.112c2.416,12.624,4.816,25.248,7.232,37.872c21.6-31.568,65.216-53.328,112.848-50.72
                                        c9.856,0.64,19.168,2.4,28.032,4.912c3.936-19.2,8.144-38.368,12.592-57.52c-5.488,11.824-10.8,23.712-15.936,35.616
                                        c1.552-12.768,3.2-25.52,4.912-38.272c-5.824-1.168-12.08-1.872-18.304-2.224c-30.144-1.952-59.456,5.152-82.672,18.336
                                        c0.224,11.28,0.496,22.56,0.8,33.824c-1.968-10.272-3.952-20.544-5.952-30.816c-6.08,3.808-11.648,7.84-16.672,12.416
                                        c0.912,10,1.84,20.016,2.784,30.032c-2.32-8.704-4.672-17.392-7.024-26.08C79.232,173.088,71.536,184.24,66.496,196.112z" />
                                        <path style="fill:#F4C534;" d="M108.8,266.736c5.04,28.896,35.44,47.664,68.096,44.368c32.656-3.424,58.464-28.064,57.504-57.344
                                        c-0.944-29.184-31.632-51.904-68.384-48.096C129.28,209.424,103.76,237.936,108.8,266.736z" />
                                        <path style="fill:#FFFFFF;" d="M114.56,265.808c1.632,24.736,27.264,40.544,57.2,37.376c29.936-3.264,55.328-24.416,56.848-49.136
                                        c1.52-24.64-23.984-43.728-57.056-40.464C138.464,216.784,112.928,241.152,114.56,265.808z" />
                                        <path style="fill:#3E4347;" d="M153.584,262.72c1.76,13.968,16.384,23.712,32.704,22.224c16.16-1.552,28.752-13.728,27.936-27.776
                                        c-0.816-14.16-15.504-24.816-32.608-23.248C164.352,235.504,151.808,248.64,153.584,262.72z" />
                                        <path style="fill:#5A5F63;" d="M195.184,253.888c1.76,3.616,5.712,5.424,8.88,4.224c3.056-1.152,4.032-5.008,2.08-8.528
                                        c-1.728-3.664-5.856-5.44-8.944-4.24C194.112,246.56,193.184,250.4,195.184,253.888z" />
                                        <g>
                                        <path style="fill:#3E4347;" d="M233.168,405.152c0.48-0.064,16.432,2.368,25.44,2.336c13.36,0.08,19.456-2.304,25.44-2.336
                                        c-3.968,8-14.496,14.288-25.44,14.32C247.392,419.408,236.816,412.752,233.168,405.152z" />
                                        <path style="fill:#3E4347;" d="M348.992,381.392c1.264,3.408-187.2,4.16-185.968,0.512
                                        C163.44,371.84,347.28,371.632,348.992,381.392z" />
                                        </g>
                                </svg>
                                <!--EMOJI 6-->
                                <svg class="rating-6 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#3E4347;" d="M416.992,337.968c-26.432,62.896-88.544,107.088-161.008,107.088
                                    c-72.48,0-134.432-44.192-160.864-107.088c-5.408-12.672,4.176-26.576,18.08-25.808c95.024,6.032,190.224,6.032,285.552,0
                                    C412.656,311.392,422.24,325.296,416.992,337.968z" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <ellipse style="fill:#FFFFFF;" cx="150.464" cy="185.52" rx="92.96" ry="93.04" />
                                    <path style="fill:#3E4347;" d="M217.024,179.632c0,26.08-21.12,47.2-47.2,47.04c-25.92,0-47.04-20.96-47.04-47.04
                                    c0-25.92,21.12-47.04,47.2-47.04C195.904,132.608,217.024,153.712,217.024,179.632z" />
                                    <g>
                                    <path style="fill:#FFFFFF;" d="M197.024,170.672c-3.2,3.36-9.92,1.76-14.88-3.36c-4.96-4.96-6.56-11.52-3.36-14.88
                                    c3.36-3.2,9.92-1.6,14.88,3.36C198.784,160.752,200.384,167.472,197.024,170.672z" />
                                    <ellipse style="fill:#FFFFFF;" cx="361.536" cy="185.52" rx="92.96" ry="93.04" />
                                    </g>
                                    <path style="fill:#3E4347;" d="M290.368,179.632c0,26.08,21.12,47.2,47.2,47.04c25.92,0,47.04-20.96,47.04-47.04
                                    c0-25.92-21.12-47.04-47.2-47.04C311.488,132.608,290.368,153.712,290.368,179.632z" />
                                    <g>
                                    <path style="fill:#FFFFFF;" d="M310.368,170.672c3.2,3.36,9.92,1.76,14.88-3.36c4.96-4.96,6.56-11.52,3.36-14.88
                                    c-3.36-3.2-9.92-1.6-14.88,3.36C308.608,160.752,307.008,167.472,310.368,170.672z" />
                                    <path style="fill:#FFFFFF;" d="M113.184,312.16c-1.12-0.064-2.16,0.112-3.216,0.24c29.712,40.224,83.904,42.448,146.032,42.448
                                    s116.32-2.224,146.032-42.448c-1.088-0.128-2.144-0.304-3.28-0.24C303.408,318.192,208.224,318.192,113.184,312.16z" />
                                    </g>
                                    <path style="fill:#E24B4B;" d="M255.968,445.056c26.608,0,51.808-6,74.368-16.656c-1.104-18.576-8.624-35.424-21.008-47.968
                                    c-9.904-9.872-24.992-13.568-38.128-8.736c-11.952,4.288-24.976,6.496-39.072,6.64c-23.968,0-44.912,17.568-49.248,41.072
                                    c-0.544,2.976-0.672,6.08-0.832,9.184C204.48,439.104,229.504,445.056,255.968,445.056z" />
                                    <g></g>
                                </svg>
                                <!--EMOJI 7-->
                                <svg class="rating-7 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M431.312,234.736c11.456,24.656-121.44,50.176-133.6,21.744c-3.28-9.12,7.584-24.144,46.24-40.688
                                    c27.344-12.352,48.512-21.264,53.408-14.72c3.984,5.328-6.112,21.056-27.68,34.4C401.824,230.928,427.968,227.232,431.312,234.736z" />
                                    <path style="fill:#F4C534;" d="M240.224,238.736c0,44.352-35.776,80.112-80.112,80.112c-44.16,0-80.112-35.76-80.112-80.112
                                    c0-44.16,35.952-80.112,80.112-80.112C204.448,158.624,240.224,194.576,240.224,238.736z" />
                                    <path style="fill:#FFFFFF;" d="M229.2,238.736c-2.224,35.536-34.912,64.256-73.12,64.256s-67.28-28.72-65.056-64.256
                                    s34.912-64.256,73.12-64.256C202.352,174.48,231.424,203.2,229.2,238.736z" />
                                    <path style="fill:#3E4347;" d="M206.656,236.544c0,21.344-17.328,38.864-38.864,39.056c-21.36,0-38.88-17.52-38.88-38.864
                                    c0-21.728,17.52-39.056,39.056-39.056C189.328,197.68,206.656,215.2,206.656,236.544z" />
                                    <path style="fill:#5A5F63;" d="M190.24,229.056c-3.28,3.296-9.312,2.736-13.504-1.456c-4.016-4.192-4.752-10.224-1.456-13.504
                                    c3.472-3.28,9.488-2.736,13.696,1.456C192.976,219.76,193.696,225.776,190.24,229.056z" />
                                    <g>
                                    <path style="fill:#3E4347;" d="M376.448,313.696c-8.416-6.56-40.56,66.608-105.312,85.024c-32.72,11.552-64.416,5.664-88.16-1.376
                                    c-17.568-6.768-20.864,8.624-2.928,23.904c25.648,16.736,61.472,37.68,102.32,24.448
                                    C363.648,420.208,386.64,317.008,376.448,313.696z" />
                                    <path style="fill:#3E4347;" d="M283.28,147.056c21.04-11.92,64.928-31.552,111.072-20.656c4.88,1.152,8.592-5.376,4.48-8.24
                                    c-48.784-33.904-90.016-29.168-122.176,22.416C274.16,144.592,279.168,149.376,283.28,147.056z" />
                                    <path style="fill:#3E4347;" d="M228.72,147.056c-21.04-11.92-64.928-31.552-111.072-20.656c-4.88,1.152-8.592-5.376-4.48-8.24
                                    c48.784-33.904,90.016-29.168,122.176,22.416C237.84,144.592,232.832,149.376,228.72,147.056z" />
                                    </g>
                                </svg>
                                <!--EMOJI 8-->
                                <svg class="rating-8 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M431.312,323.28c-18.88,79.36-90.08,138.56-175.36,138.56s-156.48-59.2-175.36-138.72
                                    c-1.44-6.08,4.16-11.36,10.08-9.6c111.04,33.12,221.28,33.76,330.56,0.16C427.312,311.76,432.752,317.2,431.312,323.28z" />
                                    <path style="fill:#E24B4B;" d="M245.648,394.72c-65.536,0-112.224-19.28-103.136,26.288c0.048,0.24,0.144,0.464,0.192,0.704
                                    c30.928,25.072,70.288,40.112,113.248,40.112s82.32-15.056,113.248-40.096c0.048-0.256,0.144-0.48,0.192-0.72
                                    C378.48,375.44,311.2,394.72,245.648,394.72z" />
                                    <path style="fill:#FFFFFF;" d="M93.232,314.192c9.68,34.72,78.64,61.504,162.4,61.504c83.456,0,152.192-26.592,162.272-61.136
                                    C310.56,346.88,202.288,346.224,93.232,314.192z" />
                                    <circle style="fill:#F4C534;" cx="362.8" cy="214.608" r="98.448" />
                                    <path style="fill:#FFFFFF;" d="M447.072,214.64c-2.592,46.832-42.4,84.768-88.944,84.768c-46.528,0-82.288-37.952-79.696-84.768
                                    c2.592-46.832,42.56-84.912,89.088-84.912S449.664,167.824,447.072,214.64z" />
                                    <path style="fill:#3E4347;" d="M402.688,214.576c0.096,22.064-17.872,40.032-39.936,39.936
                                    c-22.064,0.096-40.048-17.888-39.936-39.952c-0.096-22.064,17.872-40.032,39.936-39.936
                                    C384.816,174.528,402.784,192.512,402.688,214.576z" />
                                    <ellipse transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 502.9126 608.1483)" style="fill:#FFFFFF;" cx="377.408" cy="199.918" rx="11.92" ry="7.648" />
                                    <circle style="fill:#F4C534;" cx="149.216" cy="214.608" r="98.448" />
                                    <path style="fill:#FFFFFF;" d="M64.944,214.64c2.592,46.832,42.4,84.768,88.944,84.768c46.528,0,82.288-37.952,79.696-84.768
                                    c-2.592-46.832-42.56-84.912-89.088-84.912C97.952,129.728,62.352,167.824,64.944,214.64z" />
                                    <path style="fill:#3E4347;" d="M109.312,214.576c-0.096,22.064,17.872,40.032,39.936,39.936
                                    c22.064,0.096,40.032-17.888,39.936-39.952c0.096-22.064-17.872-40.032-39.936-39.936
                                    C127.2,174.528,109.216,192.512,109.312,214.576z" />
                                    <ellipse transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 88.3791 436.5053)" style="fill:#FFFFFF;" cx="134.593" cy="199.949" rx="7.648" ry="11.92" />
                                    <g>
                                    <path style="fill:#3E4347;" d="M155.152,72.928c0,0-52.016-7.312-106.624,55.904C48.528,128.832,83.84,15.584,155.152,72.928z" />
                                    <path style="fill:#3E4347;" d="M356.848,72.928c0,0,52.016-7.312,106.624,55.904C463.472,128.832,428.16,15.584,356.848,72.928z" />
                                    </g>
                                </svg>
                                <!--EMOJI 9-->
                                <svg class="rating-9 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M393.952,348.752c14.256,29.712-18.176,80.56-137.968,84.176
                                    c-119.776-3.664-152.192-54.496-137.968-84.176c13.936-31.536,53.136-30.448,137.968-28.576
                                    C340.832,318.32,379.984,317.184,393.952,348.752z" />
                                    <path style="fill:#FFFFFF;" d="M331.856,374.704c20.576-2.864,37.312-17.504,44.48-25.6
                                    c-15.456-15.328-56.112-11.776-120.416-11.408c-41.792-0.096-72.96-2.016-94.896,1.392c-13.92,2.048-21.168,5.92-25.2,9.776
                                    c7.008,7.984,23.936,23.056,44.896,25.936c0.064,0.032-26.144-2-50.896-13.584C127.44,382.672,170.08,414.688,256,415.632
                                    c0.064,0,0.128,0,0.192,0c85.744-0.912,128.32-32.88,126-54.336C357.616,372.688,331.792,374.72,331.856,374.704z" />
                                    <g>
                                    <path style="fill:#3E4347;" d="M433.056,236.512c-14.048-20.032-38.544-33.264-66.512-33.264c-36.32,0-66.8,22.272-76.128,52.752
                                    c-2.368-5.984-3.472-12.256-3.472-18.928c0-34.928,32.704-63.184,73.056-63.184C400.08,173.888,432.64,201.856,433.056,236.512z" />
                                    <path style="fill:#3E4347;" d="M78.944,236.512c14.048-20.032,38.544-33.264,66.512-33.264c36.32,0,66.8,22.272,76.128,52.752
                                    c2.368-5.984,3.472-12.256,3.472-18.928c0-34.928-32.704-63.184-73.056-63.184C111.92,173.888,79.36,201.856,78.944,236.512z" />
                                    </g>
                                </svg>
                                <!--EMOJI 10-->
                                <svg class="rating-10 shake" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M388.368,309.264C410.864,315.424,374.816,435.04,256,435.92
                                    c-118.816-0.88-154.864-120.496-132.368-126.656C141.616,300.4,189.856,349.52,256,349.52
                                    C323.056,349.504,370.384,300.4,388.368,309.264z" />
                                    <path style="fill:#E24B4B;" d="M173.344,256.784c-1.392,1.712-3.728,2.128-5.648,1.072c-14.4-7.568-72.32-40-77.872-70.192
                                    c-3.52-19.088,9.072-37.44,28.16-40.96c13.76-2.56,27.088,3.312,34.88,14.08c3.312-12.8,13.76-23.04,27.52-25.488
                                    c19.088-3.52,37.328,9.072,40.848,28.16C226.784,193.632,184.112,244.512,173.344,256.784z" />
                                    <path style="fill:#D03F3F;" d="M179.424,249.632c-2.448,2.992-4.592,5.44-6.08,7.152c-1.392,1.712-3.728,2.128-5.648,1.072
                                    c-14.4-7.568-72.32-40-77.872-70.192c-3.2-17.168,6.608-33.712,22.512-39.36c-8.112,7.888-12.272,19.632-10.032,31.568
                                    C107.744,209.632,163.952,241.52,179.424,249.632z" />
                                    <g style="opacity:0.2;">
                                        <ellipse transform="matrix(-0.3654 -0.9308 0.9308 -0.3654 116.941 405.326)" style="fill:#FFFFFF;" cx="196.632" cy="162.802" rx="13.871" ry="9.344" />
                                    </g>
                                    <path style="fill:#E24B4B;" d="M332.752,256.784c1.392,1.712,3.728,2.128,5.648,1.072c14.4-7.568,72.32-40,77.872-70.192
                                    c3.52-19.088-9.072-37.44-28.16-40.96c-13.76-2.56-27.088,3.312-34.88,14.08c-3.312-12.8-13.76-23.04-27.52-25.488
                                    c-19.088-3.52-37.328,9.072-40.848,28.16C279.312,193.632,321.968,244.512,332.752,256.784z" />
                                    <path style="fill:#D03F3F;" d="M326.672,249.632c2.448,2.992,4.592,5.44,6.08,7.152c1.392,1.712,3.728,2.128,5.648,1.072
                                    c14.4-7.568,72.32-40,77.872-70.192c3.2-17.168-6.608-33.712-22.512-39.36c8.112,7.888,12.272,19.632,10.032,31.568
                                    C398.352,209.632,342.128,241.52,326.672,249.632z" />
                                    <g style="opacity:0.2;">
                                        <ellipse transform="matrix(-0.9308 -0.3654 0.3654 -0.9308 537.9436 427.4479)" style="fill:#FFFFFF;" cx="309.42" cy="162.82" rx="9.344" ry="13.871" />
                                    </g>
                                    <path style="fill:#E24B4B;" d="M256,435.92c22.944-0.176,42.768-4.8,59.712-12.144c-3.84-11.28-10.736-21.12-19.808-28.496
                                    c-7.28-6-17.28-7.088-26.272-4.176c-5.184,1.632-11.008,2.64-17.456,2.64c-5.008,0-9.632-0.64-13.904-1.632
                                    c-9.728-2.448-19.904,0.448-26.992,7.552c-6.704,6.704-11.84,14.96-14.96,24.144C213.264,431.136,233.072,435.76,256,435.92z" />
                                    <g></g>
                                </svg>
                            </div>
                        </div>
                    </div>
                
                </div>
                




                   <div class="feedback" id="pregunta2" style="display: none;">
                   <h4 style="text-align:center;"> <p> 2.- ¿Qué tan conforme estas con la resolución de tu solicitud? </p></h4>
                    <div class="rating" style="left:0">
                        <input type="radio" name="rating2" value="10" id="rating-102">
                        <label for="rating-102"></label>
                        <input type="radio" name="rating2" value="9" id="rating-92">
                        <label for="rating-92"></label>
                        <input type="radio" name="rating2" value="8" id="rating-82">
                        <label for="rating-82"></label>
                        <input type="radio" name="rating2" value="7" id="rating-72">
                        <label for="rating-72"></label>
                        <input type="radio" name="rating2" value="6" id="rating-62">
                        <label for="rating-62"></label>
                        <input type="radio" name="rating2" value="5" id="rating-52">
                        <label for="rating-52"></label>
                        <input type="radio" name="rating2" value="4" id="rating-42">
                        <label for="rating-42"></label>
                        <input type="radio" name="rating2" value="3" id="rating-32">
                        <label for="rating-32"></label>
                        <input type="radio" name="rating2" value="2" id="rating-22">
                        <label for="rating-22"></label>
                        <input type="radio" name="rating2" value="1" id="rating-12">
                        <label for="rating-12"></label>
                        <input type="radio" name="rating2" value="0" id="rating-02">
                        <label for="rating-02"></label>
                        <div class="emoji-wrapper">
                            <div class="emoji">
                                <!--CODIGO PARA EL ICONO NUMERO 00-ESTE ICONO ES PARA CUANDO NO SE HA SELECCIONADO NADA AUN-->
                                <svg class="rating-00" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534" />
                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347" />
                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63" />
                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347" />
                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347" />
                                </svg>
                                <!--CODIGO PARA EL VALOR 0 EN EL RATING-->
                                <svg class="rating-0 shake-opacity" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px" class="hovered-paths">
                                    <g>
                                        <circle style="fill:#CACAC7" cx="256" cy="256" r="256" data-original="#FFD93B" class="" data-old_color="#FFD93B" />
                                        <path style="fill:#D2D2D2" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28  c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72  C474.8,103.68,512,175.52,512,256z" data-original="#F4C534" class="hovered-path active-path" data-old_color="#F4C534" />
                                        <g>
                                            <path style="fill:#F02A2A" d="M303.104,396.704c0,26.08-21.12,47.04-47.04,47.04c-26.08,0-47.04-20.96-47.04-47.04   c0-25.92,20.96-47.04,47.04-47.04C281.984,349.664,303.104,370.784,303.104,396.704z" data-original="#3E4347" class="" data-old_color="#3E4347" />
                                            <path style="fill:#F02A2A" d="M203.744,218.56l-21.6,21.6l21.6,21.6c6.88,6.88,6.88,18.4,0,25.28l-0.16,0.16   c-6.88,6.88-18.4,6.88-25.28,0l-21.6-21.6l-21.6,21.6c-6.88,6.88-18.4,6.88-25.28,0l-0.16-0.16c-6.88-6.88-6.88-18.4,0-25.28   l21.6-21.6l-21.6-21.6c-6.88-6.88-6.88-18.4,0-25.44c7.008-6.992,19.072-6.656,25.44,0l21.6,21.6l21.6-21.6   c6.88-6.88,18.4-6.88,25.28,0h0.16C210.624,200.16,210.624,211.68,203.744,218.56z" data-original="#3E4347" class="" data-old_color="#3E4347" />
                                            <path style="fill:#F02A2A" d="M402.336,287.04v0.16c-7.04,6.88-18.56,6.88-25.44,0l-21.6-21.6l-21.44,21.6   c-7.04,6.88-18.56,6.88-25.44,0v-0.16c-7.04-6.88-7.04-18.4,0-25.28l21.44-21.6l-21.44-21.6c-7.04-6.88-7.04-18.4,0-25.44   c7.072-7.072,18.816-6.608,25.44,0l21.44,21.6l21.6-21.6c6.88-6.88,18.4-6.88,25.44,0c6.864,7.2,6.8,18.64,0,25.44l-21.6,21.6   l21.6,21.6C409.216,268.64,409.216,280.16,402.336,287.04z" data-original="#3E4347" class="" data-old_color="#3E4347" />
                                        </g>
                                    </g>
                                </svg>
                                <!--EMOJI 1-->
                                <svg class="rating-1 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <circle style="fill:#3E4347;" cx="256" cy="382.144" r="63.856" />
                                    <path style="fill:#E24B4B;" d="M256,446c16.848,0,32.128-6.576,43.536-17.232c-0.256-6.912-2.08-13.424-5.168-19.104
                                    c-6.016-10.96-19.232-15.808-30.848-11.392c-6.768,2.48-14.4,3.984-23.008,3.984c-0.112,0-0.112,0-0.224,0
                                    c-12.896-0.112-25.04,7.952-27.296,20.64c-0.336,1.904-0.496,3.872-0.576,5.856C223.856,439.424,239.136,446,256,446z" />
                                    <path style="fill:#FFFFFF;" d="M309.056,346.64C297.6,329.552,278.112,318.288,256,318.288s-41.6,11.248-53.056,28.336
                                    C213.2,356,233.104,357.12,256,357.12S298.8,356,309.056,346.64z" />
                                    <g style="opacity:0.2;">
                                        <ellipse transform="matrix(-0.9317 -0.3632 0.3632 -0.9317 387.3987 892.644)" style="fill:#FFFFFF;" cx="277.618" cy="409.902" rx="8.816" ry="5.04" />
                                    </g>
                                    <g>
                                        <path style="fill:#E9B02C;" d="M280.064,159.152c-2.256-5.44,0.352-11.68,5.792-13.92l78.016-32.16
                                        c5.44-2.272,11.68,0.352,13.92,5.792c2.256,5.44-0.352,11.68-5.792,13.92l-78.016,32.16
                                        C288.528,167.2,282.288,164.576,280.064,159.152z" />
                                        <path style="fill:#E9B02C;" d="M218.016,164.944L140,132.784c-5.44-2.24-8.048-8.48-5.792-13.92c2.24-5.44,8.48-8.064,13.92-5.792
                                        l78.016,32.16c5.44,2.24,8.048,8.48,5.792,13.92C229.712,164.576,223.472,167.2,218.016,164.944z" />
                                    </g>
                                    <ellipse style="fill:#FFFFFF;" cx="177.6" cy="232.608" rx="58" ry="58.048" />
                                    <circle style="fill:#3E4347;" cx="177.6" cy="232.608" r="32" />
                                    <ellipse transform="matrix(-0.6912 -0.7227 0.7227 -0.6912 163.8109 510.0115)" style="fill:#5A5F63;" cx="190.875" cy="220.006" rx="7.392" ry="5.456" />
                                    <ellipse style="fill:#FFFFFF;" cx="334.432" cy="232.608" rx="58" ry="58.048" />
                                    <circle style="fill:#3E4347;" cx="334.416" cy="232.608" r="32" />
                                    <ellipse transform="matrix(-0.6912 -0.7227 0.7227 -0.6912 428.994 623.274)" style="fill:#5A5F63;" cx="347.667" cy="219.978" rx="7.392" ry="5.456" />
                                    <g></g>
                                </svg>
                                <!--EMOJI 2-->
                                <svg class="rating-2 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M328.416,428.016c-17.12-21.28-43.2-34.88-72.48-34.88s-55.36,13.6-72.48,34.72
                                    c-4.64,5.76-13.44,1.6-12-5.76c7.52-36.8,40.64-68.96,84.48-68.96c44.16,0,77.44,32.64,84.64,69.76
                                    C341.856,429.792,332.896,433.472,328.416,428.016z" />
                                    <path style="fill:#F4C534;" d="M269.216,222.32c5.28,62.784,52.048,113.84,104.752,113.84c52.368,0,90.864-51.056,85.584-113.84
                                    c-1.984-24.944-10.736-47.904-23.632-66.752c-4.128-6.112-12.224-7.936-18.512-4.128c-16.192,10.08-36.176,16.192-60.128,16.192
                                    c-22.8,0-42.128-5.616-57.824-14.864c-6.768-3.968-15.36-1.488-18.832,5.456C271.68,176.384,267.392,198.528,269.216,222.32z" />
                                    <path style="fill:#FFFFFF;" d="M356.96,189.456c25.792,0,46.976-7.088,63.76-18.608c10,14.592,17.072,32.048,18.672,51.504
                                    c4.096,49.6-26.096,89.728-67.488,89.728c-41.568,0-78.368-40.128-82.464-89.728c-1.488-18.032,2-34.368,8.512-48.336
                                    C313.952,183.68,333.6,189.456,356.96,189.456z" />
                                    <path style="fill:#3E4347;" d="M396.208,246.144c0,21.392-17.184,38.576-38.752,38.576c-21.392,0-38.576-17.184-38.576-38.592
                                    c0-21.568,17.184-38.752,38.576-38.752C379.008,207.392,396.208,224.576,396.208,246.144z" />
                                    <path style="fill:#FFFFFF;" d="M380.416,241.104c-3.2,3.2-9.92,1.744-14.88-3.216c-4.816-4.816-6.272-11.52-3.056-14.736
                                    c3.36-3.36,10.064-1.904,14.88,2.912C382.304,231.04,383.76,237.76,380.416,241.104z" />
                                    <path style="fill:#F4C534;" d="M242.784,222.32c-5.28,62.784-52.048,113.84-104.752,113.84c-52.368,0-90.864-51.056-85.584-113.84
                                    c1.984-24.944,10.736-47.904,23.632-66.752c4.144-6.112,12.24-7.92,18.512-4.128c16.192,10.08,36.176,16.192,60.128,16.192
                                    c22.8,0,42.128-5.616,57.824-14.864c6.768-3.968,15.36-1.488,18.832,5.456C240.32,176.384,244.608,198.528,242.784,222.32z" />
                                    <path style="fill:#FFFFFF;" d="M155.04,189.456c-25.792,0-46.976-7.088-63.76-18.608c-10,14.592-17.072,32.048-18.672,51.504
                                    c-4.096,49.6,26.096,89.728,67.488,89.728c41.568,0,78.368-40.128,82.464-89.728c1.488-18.032-2-34.368-8.512-48.336
                                    C198.048,183.68,178.4,189.456,155.04,189.456z" />
                                    <path style="fill:#3E4347;" d="M115.792,246.144c0,21.392,17.184,38.576,38.752,38.576c21.392,0,38.576-17.184,38.576-38.592
                                    c0-21.568-17.184-38.752-38.576-38.752C132.992,207.392,115.792,224.576,115.792,246.144z" />
                                    <path style="fill:#FFFFFF;" d="M131.584,241.104c3.2,3.2,9.92,1.744,14.88-3.216c4.816-4.816,6.272-11.52,3.056-14.736
                                    c-3.36-3.36-10.064-1.904-14.88,2.912C129.696,231.04,128.24,237.76,131.584,241.104z" />
                                    <g>
                                    </g>
                                </svg>
                                <!--EMOJI 3-->
                                <svg class="rating-3 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M343.408,430.672c-14.608,6.256-46.016-20.592-92.32-40.656c-52.32-22.192-92.4-5.792-101.472-16.096
                                    c-11.408-7.088,28.304-41.072,115.84-39.28C367.056,339.648,360.832,426.384,343.408,430.672z" />
                                    <path style="fill:#FFFFFF;" d="M241.856,222.624c0,39.584-35.552,75.952-79.392,81.232c-43.856,5.28-79.392-22.528-79.392-62.112
                                    s35.552-75.952,79.392-81.232S241.856,183.04,241.856,222.624z" />
                                    <ellipse style="fill:#3E4347;" cx="175.729" cy="222.766" rx="37.36" ry="37.36" />
                                    <path style="fill:#5A5F63;" d="M198.64,214.624c-2.832,2.832-8.48,1.696-12.56-2.384c-3.952-3.968-5.088-9.616-2.256-12.448
                                    c2.72-2.72,8.368-1.584,12.336,2.384C200.224,206.256,201.36,211.92,198.64,214.624z" />
                                    <path style="fill:#FFFFFF;" d="M270.144,222.624c0,39.584,35.552,75.952,79.392,81.232c43.856,5.28,79.392-22.528,79.392-62.112
                                    s-35.552-75.952-79.392-81.232S270.144,183.04,270.144,222.624z" />
                                    <ellipse style="fill:#3E4347;" cx="336.307" cy="222.747" rx="37.36" ry="37.36" />
                                    <path style="fill:#5A5F63;" d="M313.36,214.624c2.832,2.832,8.48,1.696,12.56-2.384c3.968-3.968,5.088-9.616,2.272-12.448
                                    c-2.72-2.72-8.368-1.584-12.336,2.384C311.776,206.256,310.64,211.92,313.36,214.624z" />
                                    <g>
                                        <path style="fill:#F4C534;" d="M98.656,155.376c16-7.984,44.704-21.808,63.472-35.92c26.336-18.032,38.608-34.8,54.608-48.208
                                    c-1.76,25.664-19.584,53.872-40.752,67.808C151.52,157.008,116.72,162.08,98.656,155.376z" />
                                        <path style="fill:#F4C534;" d="M401.216,120.24c-12.432,14.992-45.2,27.824-75.136,24.496
                                    c-29.12-1.696-55.568-18.128-69.184-38.352c16,2.816,40.512,12.08,71.392,14.464C352.24,123.76,385.216,121.216,401.216,120.24z" />
                                    </g>
                                </svg>
                                <!--EMOJI 4-->
                                <svg class="rating-4 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#FFD93B;" d="M380.128,402.976c-14.08,23.184-29.84,25.216-50.24,12c-7.76-4.704-23.376-12.48-41.168-17.584
                                    c-26.96-8.416-59.44-6.336-88.096,8.96c-18.512,9.952-35.168,17.264-44.656,18.224c-25.008,1.712-47.456-20.544-51.84-43.36
                                    c-4.752-22.256,10.128-60.288,43.648-71.488c12.048-3.84,35.36-3.68,57.632,4.224c34.384,11.584,67.92,19.984,100.528,26.576
                                    c21.088,4.336,40.736,10.192,51.2,13.328C385.952,361.872,394.208,380.32,380.128,402.976z" />
                                    <path style="fill:#3E4347;" d="M380.128,402.976c-14.08,23.184-29.84,25.216-50.24,12c-7.76-4.704-23.376-12.48-41.168-17.584
                                    c-26.96-8.416-59.44-6.336-88.096,8.96c-18.512,9.952-35.168,17.264-44.656,18.224c-25.008,1.712-47.456-20.544-51.84-43.36
                                    c-4.752-22.256,10.128-60.288,43.648-71.488c12.048-3.84,35.36-3.68,57.632,4.224c34.384,11.584,67.92,19.984,100.528,26.576
                                    c21.088,4.336,40.736,10.192,51.2,13.328C385.952,361.872,394.208,380.32,380.128,402.976z" />
                                    <path style="fill:#FFFFFF;" d="M317.6,378c18.688,1.632,36.464,5.12,55.904,6.368c0.784-9.376-4.736-17.792-20.112-22.912
                                    c-8.064-2.64-25.616-7.84-47.184-11.552c-17.12-2.832-34.544-5.936-52.24-9.44c-17.68-3.504-35.52-7.728-53.456-12.944
                                    c-22.56-6.784-43.632-5.808-52.608-3.056c-18.096,5.184-27.072,20.912-29.888,34.096c20.176,0.368,40.272,5.152,59.584,9.504
                                    c-19.328,4.4-38.88,9.104-59.024,14.352c4.208,14.704,16.256,30.352,35.456,27.888c7.68-1.008,23.52-7.184,43.616-16.96
                                    c15.792-7.488,32.72-11.44,49.232-11.76c16.512-0.336,32.544,2.48,46.96,7.824c18.64,6.64,32.816,14.208,39.168,17.728
                                    c15.824,9.072,26.368,4.56,34.08-6.144C351.2,391.952,334.608,384.368,317.6,378z" />
                                    <circle style="fill:#F4C534;" cx="158.512" cy="183.008" r="86.048" />
                                    <path style="fill:#FFFFFF;" d="M234.688,183.008c-2.288,41.344-38.256,74.848-80.32,74.848s-74.304-33.504-72.016-74.848
                                    c2.288-41.328,38.256-74.848,80.32-74.848S236.976,141.68,234.688,183.008z" />
                                    <ellipse style="fill:#3E4347;" cx="180.148" cy="183.469" rx="42.784" ry="42.784" />
                                    <path style="fill:#5A5F63;" d="M205.712,174.08c-3.28,3.28-9.664,2.416-14.16-2.08c-4.32-4.48-5.344-10.704-2.064-14.144
                                    c3.456-3.28,9.664-2.24,14.16,2.064C208.128,164.416,208.992,170.8,205.712,174.08z" />
                                    <circle style="fill:#F4C534;" cx="352.8" cy="183.008" r="86.048" />
                                    <path style="fill:#FFFFFF;" d="M276.56,183.008c2.288,41.344,38.256,74.848,80.32,74.848s74.304-33.504,72.016-74.848
                                    s-38.256-74.848-80.32-74.848C306.496,108.16,274.256,141.68,276.56,183.008z" />
                                    <ellipse style="fill:#3E4347;" cx="331.084" cy="183.461" rx="42.784" ry="42.784" />
                                    <path style="fill:#5A5F63;" d="M356.672,174.08c-3.28,3.28-9.664,2.416-14.144-2.08c-4.32-4.48-5.344-10.704-2.064-14.144
                                    c3.456-3.28,9.664-2.24,14.144,2.064C359.088,164.416,359.952,170.8,356.672,174.08z" />
                                    <path style="fill:#FFD93B;" d="M60.48,264.352c60.928,26.064,120.096,27.84,177.168,0c-65.936-35.968-143.056-14.704-177.168-1.856
                                    C60.48,262.496,60.48,264.352,60.48,264.352z" />
                                    <path style="fill:#F4C534;" d="M233.808,262.128c-16-2.864-37.888-10.256-79.76-9.76c-29.04-0.08-58.096,3.888-81.04,5.744
                                    c16.032-10.768,48.544-21.664,80.992-21.728C183.408,236.96,210.96,243.472,233.808,262.128z" />
                                    <g></g>
                                </svg>
                                <!--EMOJI 5-->
                                <svg class="rating-5 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <g fill="#ffd93b">
                                        <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                        <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                        c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                        C474.8,103.68,512,175.52,512,256z" />
                                        <path style="fill:#3E4347;" d="M445.504,196.112c-2.416,12.624-4.816,25.248-7.232,37.872c-21.6-31.568-65.216-53.328-112.832-50.72
                                        c-9.872,0.64-19.168,2.4-28.032,4.912c-3.936-19.2-8.144-38.368-12.592-57.52c5.488,11.824,10.8,23.712,15.936,35.616
                                        c-1.568-12.768-3.216-25.52-4.944-38.272c5.824-1.168,12.08-1.872,18.304-2.224c30.144-1.936,59.456,5.168,82.672,18.336
                                        c-0.24,11.28-0.496,22.56-0.816,33.824c1.968-10.272,3.952-20.544,5.952-30.816c6.096,3.824,11.664,7.856,16.672,12.432
                                        c-0.912,10-1.84,20.016-2.784,30.032c2.32-8.704,4.672-17.392,7.024-26.08C432.768,173.088,440.464,184.24,445.504,196.112z" />
                                        <path style="fill:#F4C534;" d="M403.184,266.736c-5.04,28.896-35.44,47.664-68.096,44.368
                                        c-32.656-3.424-58.464-28.064-57.504-57.344c0.944-29.184,31.632-51.904,68.384-48.096
                                        C382.72,209.424,408.224,237.936,403.184,266.736z" />
                                        <path style="fill:#FFFFFF;" d="M397.44,265.808c-1.632,24.736-27.264,40.544-57.2,37.376c-29.936-3.264-55.344-24.416-56.848-49.136
                                        c-1.52-24.608,23.968-43.744,57.056-40.464C373.536,216.784,399.072,241.152,397.44,265.808z" />
                                        <path style="fill:#3E4347;" d="M358.416,262.72c-1.76,13.968-16.384,23.712-32.704,22.224c-16.16-1.552-28.752-13.728-27.952-27.776
                                        c0.816-14.16,15.504-24.816,32.608-23.248C347.664,235.504,360.176,248.64,358.416,262.72z" />
                                        <path style="fill:#5A5F63;" d="M316.816,253.888c-1.76,3.616-5.712,5.424-8.88,4.224c-3.056-1.152-4.032-5.008-2.08-8.528
                                        c1.728-3.664,5.856-5.44,8.944-4.24C317.888,246.56,318.816,250.4,316.816,253.888z" />
                                        <path style="fill:#3E4347;" d="M66.496,196.112c2.416,12.624,4.816,25.248,7.232,37.872c21.6-31.568,65.216-53.328,112.848-50.72
                                        c9.856,0.64,19.168,2.4,28.032,4.912c3.936-19.2,8.144-38.368,12.592-57.52c-5.488,11.824-10.8,23.712-15.936,35.616
                                        c1.552-12.768,3.2-25.52,4.912-38.272c-5.824-1.168-12.08-1.872-18.304-2.224c-30.144-1.952-59.456,5.152-82.672,18.336
                                        c0.224,11.28,0.496,22.56,0.8,33.824c-1.968-10.272-3.952-20.544-5.952-30.816c-6.08,3.808-11.648,7.84-16.672,12.416
                                        c0.912,10,1.84,20.016,2.784,30.032c-2.32-8.704-4.672-17.392-7.024-26.08C79.232,173.088,71.536,184.24,66.496,196.112z" />
                                        <path style="fill:#F4C534;" d="M108.8,266.736c5.04,28.896,35.44,47.664,68.096,44.368c32.656-3.424,58.464-28.064,57.504-57.344
                                        c-0.944-29.184-31.632-51.904-68.384-48.096C129.28,209.424,103.76,237.936,108.8,266.736z" />
                                        <path style="fill:#FFFFFF;" d="M114.56,265.808c1.632,24.736,27.264,40.544,57.2,37.376c29.936-3.264,55.328-24.416,56.848-49.136
                                        c1.52-24.64-23.984-43.728-57.056-40.464C138.464,216.784,112.928,241.152,114.56,265.808z" />
                                        <path style="fill:#3E4347;" d="M153.584,262.72c1.76,13.968,16.384,23.712,32.704,22.224c16.16-1.552,28.752-13.728,27.936-27.776
                                        c-0.816-14.16-15.504-24.816-32.608-23.248C164.352,235.504,151.808,248.64,153.584,262.72z" />
                                        <path style="fill:#5A5F63;" d="M195.184,253.888c1.76,3.616,5.712,5.424,8.88,4.224c3.056-1.152,4.032-5.008,2.08-8.528
                                        c-1.728-3.664-5.856-5.44-8.944-4.24C194.112,246.56,193.184,250.4,195.184,253.888z" />
                                        <g>
                                        <path style="fill:#3E4347;" d="M233.168,405.152c0.48-0.064,16.432,2.368,25.44,2.336c13.36,0.08,19.456-2.304,25.44-2.336
                                        c-3.968,8-14.496,14.288-25.44,14.32C247.392,419.408,236.816,412.752,233.168,405.152z" />
                                        <path style="fill:#3E4347;" d="M348.992,381.392c1.264,3.408-187.2,4.16-185.968,0.512
                                        C163.44,371.84,347.28,371.632,348.992,381.392z" />
                                        </g>
                                </svg>
                                <!--EMOJI 6-->
                                <svg class="rating-6 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#3E4347;" d="M416.992,337.968c-26.432,62.896-88.544,107.088-161.008,107.088
                                    c-72.48,0-134.432-44.192-160.864-107.088c-5.408-12.672,4.176-26.576,18.08-25.808c95.024,6.032,190.224,6.032,285.552,0
                                    C412.656,311.392,422.24,325.296,416.992,337.968z" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <ellipse style="fill:#FFFFFF;" cx="150.464" cy="185.52" rx="92.96" ry="93.04" />
                                    <path style="fill:#3E4347;" d="M217.024,179.632c0,26.08-21.12,47.2-47.2,47.04c-25.92,0-47.04-20.96-47.04-47.04
                                    c0-25.92,21.12-47.04,47.2-47.04C195.904,132.608,217.024,153.712,217.024,179.632z" />
                                    <g>
                                    <path style="fill:#FFFFFF;" d="M197.024,170.672c-3.2,3.36-9.92,1.76-14.88-3.36c-4.96-4.96-6.56-11.52-3.36-14.88
                                    c3.36-3.2,9.92-1.6,14.88,3.36C198.784,160.752,200.384,167.472,197.024,170.672z" />
                                    <ellipse style="fill:#FFFFFF;" cx="361.536" cy="185.52" rx="92.96" ry="93.04" />
                                    </g>
                                    <path style="fill:#3E4347;" d="M290.368,179.632c0,26.08,21.12,47.2,47.2,47.04c25.92,0,47.04-20.96,47.04-47.04
                                    c0-25.92-21.12-47.04-47.2-47.04C311.488,132.608,290.368,153.712,290.368,179.632z" />
                                    <g>
                                    <path style="fill:#FFFFFF;" d="M310.368,170.672c3.2,3.36,9.92,1.76,14.88-3.36c4.96-4.96,6.56-11.52,3.36-14.88
                                    c-3.36-3.2-9.92-1.6-14.88,3.36C308.608,160.752,307.008,167.472,310.368,170.672z" />
                                    <path style="fill:#FFFFFF;" d="M113.184,312.16c-1.12-0.064-2.16,0.112-3.216,0.24c29.712,40.224,83.904,42.448,146.032,42.448
                                    s116.32-2.224,146.032-42.448c-1.088-0.128-2.144-0.304-3.28-0.24C303.408,318.192,208.224,318.192,113.184,312.16z" />
                                    </g>
                                    <path style="fill:#E24B4B;" d="M255.968,445.056c26.608,0,51.808-6,74.368-16.656c-1.104-18.576-8.624-35.424-21.008-47.968
                                    c-9.904-9.872-24.992-13.568-38.128-8.736c-11.952,4.288-24.976,6.496-39.072,6.64c-23.968,0-44.912,17.568-49.248,41.072
                                    c-0.544,2.976-0.672,6.08-0.832,9.184C204.48,439.104,229.504,445.056,255.968,445.056z" />
                                    <g></g>
                                </svg>
                                <!--EMOJI 7-->
                                <svg class="rating-7 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M431.312,234.736c11.456,24.656-121.44,50.176-133.6,21.744c-3.28-9.12,7.584-24.144,46.24-40.688
                                    c27.344-12.352,48.512-21.264,53.408-14.72c3.984,5.328-6.112,21.056-27.68,34.4C401.824,230.928,427.968,227.232,431.312,234.736z" />
                                    <path style="fill:#F4C534;" d="M240.224,238.736c0,44.352-35.776,80.112-80.112,80.112c-44.16,0-80.112-35.76-80.112-80.112
                                    c0-44.16,35.952-80.112,80.112-80.112C204.448,158.624,240.224,194.576,240.224,238.736z" />
                                    <path style="fill:#FFFFFF;" d="M229.2,238.736c-2.224,35.536-34.912,64.256-73.12,64.256s-67.28-28.72-65.056-64.256
                                    s34.912-64.256,73.12-64.256C202.352,174.48,231.424,203.2,229.2,238.736z" />
                                    <path style="fill:#3E4347;" d="M206.656,236.544c0,21.344-17.328,38.864-38.864,39.056c-21.36,0-38.88-17.52-38.88-38.864
                                    c0-21.728,17.52-39.056,39.056-39.056C189.328,197.68,206.656,215.2,206.656,236.544z" />
                                    <path style="fill:#5A5F63;" d="M190.24,229.056c-3.28,3.296-9.312,2.736-13.504-1.456c-4.016-4.192-4.752-10.224-1.456-13.504
                                    c3.472-3.28,9.488-2.736,13.696,1.456C192.976,219.76,193.696,225.776,190.24,229.056z" />
                                    <g>
                                    <path style="fill:#3E4347;" d="M376.448,313.696c-8.416-6.56-40.56,66.608-105.312,85.024c-32.72,11.552-64.416,5.664-88.16-1.376
                                    c-17.568-6.768-20.864,8.624-2.928,23.904c25.648,16.736,61.472,37.68,102.32,24.448
                                    C363.648,420.208,386.64,317.008,376.448,313.696z" />
                                    <path style="fill:#3E4347;" d="M283.28,147.056c21.04-11.92,64.928-31.552,111.072-20.656c4.88,1.152,8.592-5.376,4.48-8.24
                                    c-48.784-33.904-90.016-29.168-122.176,22.416C274.16,144.592,279.168,149.376,283.28,147.056z" />
                                    <path style="fill:#3E4347;" d="M228.72,147.056c-21.04-11.92-64.928-31.552-111.072-20.656c-4.88,1.152-8.592-5.376-4.48-8.24
                                    c48.784-33.904,90.016-29.168,122.176,22.416C237.84,144.592,232.832,149.376,228.72,147.056z" />
                                    </g>
                                </svg>
                                <!--EMOJI 8-->
                                <svg class="rating-8 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M431.312,323.28c-18.88,79.36-90.08,138.56-175.36,138.56s-156.48-59.2-175.36-138.72
                                    c-1.44-6.08,4.16-11.36,10.08-9.6c111.04,33.12,221.28,33.76,330.56,0.16C427.312,311.76,432.752,317.2,431.312,323.28z" />
                                    <path style="fill:#E24B4B;" d="M245.648,394.72c-65.536,0-112.224-19.28-103.136,26.288c0.048,0.24,0.144,0.464,0.192,0.704
                                    c30.928,25.072,70.288,40.112,113.248,40.112s82.32-15.056,113.248-40.096c0.048-0.256,0.144-0.48,0.192-0.72
                                    C378.48,375.44,311.2,394.72,245.648,394.72z" />
                                    <path style="fill:#FFFFFF;" d="M93.232,314.192c9.68,34.72,78.64,61.504,162.4,61.504c83.456,0,152.192-26.592,162.272-61.136
                                    C310.56,346.88,202.288,346.224,93.232,314.192z" />
                                    <circle style="fill:#F4C534;" cx="362.8" cy="214.608" r="98.448" />
                                    <path style="fill:#FFFFFF;" d="M447.072,214.64c-2.592,46.832-42.4,84.768-88.944,84.768c-46.528,0-82.288-37.952-79.696-84.768
                                    c2.592-46.832,42.56-84.912,89.088-84.912S449.664,167.824,447.072,214.64z" />
                                    <path style="fill:#3E4347;" d="M402.688,214.576c0.096,22.064-17.872,40.032-39.936,39.936
                                    c-22.064,0.096-40.048-17.888-39.936-39.952c-0.096-22.064,17.872-40.032,39.936-39.936
                                    C384.816,174.528,402.784,192.512,402.688,214.576z" />
                                    <ellipse transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 502.9126 608.1483)" style="fill:#FFFFFF;" cx="377.408" cy="199.918" rx="11.92" ry="7.648" />
                                    <circle style="fill:#F4C534;" cx="149.216" cy="214.608" r="98.448" />
                                    <path style="fill:#FFFFFF;" d="M64.944,214.64c2.592,46.832,42.4,84.768,88.944,84.768c46.528,0,82.288-37.952,79.696-84.768
                                    c-2.592-46.832-42.56-84.912-89.088-84.912C97.952,129.728,62.352,167.824,64.944,214.64z" />
                                    <path style="fill:#3E4347;" d="M109.312,214.576c-0.096,22.064,17.872,40.032,39.936,39.936
                                    c22.064,0.096,40.032-17.888,39.936-39.952c0.096-22.064-17.872-40.032-39.936-39.936
                                    C127.2,174.528,109.216,192.512,109.312,214.576z" />
                                    <ellipse transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 88.3791 436.5053)" style="fill:#FFFFFF;" cx="134.593" cy="199.949" rx="7.648" ry="11.92" />
                                    <g>
                                    <path style="fill:#3E4347;" d="M155.152,72.928c0,0-52.016-7.312-106.624,55.904C48.528,128.832,83.84,15.584,155.152,72.928z" />
                                    <path style="fill:#3E4347;" d="M356.848,72.928c0,0,52.016-7.312,106.624,55.904C463.472,128.832,428.16,15.584,356.848,72.928z" />
                                    </g>
                                </svg>
                                <!--EMOJI 9-->
                                <svg class="rating-9 shake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M393.952,348.752c14.256,29.712-18.176,80.56-137.968,84.176
                                    c-119.776-3.664-152.192-54.496-137.968-84.176c13.936-31.536,53.136-30.448,137.968-28.576
                                    C340.832,318.32,379.984,317.184,393.952,348.752z" />
                                    <path style="fill:#FFFFFF;" d="M331.856,374.704c20.576-2.864,37.312-17.504,44.48-25.6
                                    c-15.456-15.328-56.112-11.776-120.416-11.408c-41.792-0.096-72.96-2.016-94.896,1.392c-13.92,2.048-21.168,5.92-25.2,9.776
                                    c7.008,7.984,23.936,23.056,44.896,25.936c0.064,0.032-26.144-2-50.896-13.584C127.44,382.672,170.08,414.688,256,415.632
                                    c0.064,0,0.128,0,0.192,0c85.744-0.912,128.32-32.88,126-54.336C357.616,372.688,331.792,374.72,331.856,374.704z" />
                                    <g>
                                    <path style="fill:#3E4347;" d="M433.056,236.512c-14.048-20.032-38.544-33.264-66.512-33.264c-36.32,0-66.8,22.272-76.128,52.752
                                    c-2.368-5.984-3.472-12.256-3.472-18.928c0-34.928,32.704-63.184,73.056-63.184C400.08,173.888,432.64,201.856,433.056,236.512z" />
                                    <path style="fill:#3E4347;" d="M78.944,236.512c14.048-20.032,38.544-33.264,66.512-33.264c36.32,0,66.8,22.272,76.128,52.752
                                    c2.368-5.984,3.472-12.256,3.472-18.928c0-34.928-32.704-63.184-73.056-63.184C111.92,173.888,79.36,201.856,78.944,236.512z" />
                                    </g>
                                </svg>
                                <!--EMOJI 10-->
                                <svg class="rating-10 shake" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <circle style="fill:#FFD93B;" cx="256" cy="256" r="256" />
                                    <path style="fill:#F4C534;" d="M512,256c0,141.44-114.64,256-256,256c-80.48,0-152.32-37.12-199.28-95.28
                                    c43.92,35.52,99.84,56.72,160.72,56.72c141.36,0,256-114.56,256-256c0-60.88-21.2-116.8-56.72-160.72
                                    C474.8,103.68,512,175.52,512,256z" />
                                    <path style="fill:#3E4347;" d="M388.368,309.264C410.864,315.424,374.816,435.04,256,435.92
                                    c-118.816-0.88-154.864-120.496-132.368-126.656C141.616,300.4,189.856,349.52,256,349.52
                                    C323.056,349.504,370.384,300.4,388.368,309.264z" />
                                    <path style="fill:#E24B4B;" d="M173.344,256.784c-1.392,1.712-3.728,2.128-5.648,1.072c-14.4-7.568-72.32-40-77.872-70.192
                                    c-3.52-19.088,9.072-37.44,28.16-40.96c13.76-2.56,27.088,3.312,34.88,14.08c3.312-12.8,13.76-23.04,27.52-25.488
                                    c19.088-3.52,37.328,9.072,40.848,28.16C226.784,193.632,184.112,244.512,173.344,256.784z" />
                                    <path style="fill:#D03F3F;" d="M179.424,249.632c-2.448,2.992-4.592,5.44-6.08,7.152c-1.392,1.712-3.728,2.128-5.648,1.072
                                    c-14.4-7.568-72.32-40-77.872-70.192c-3.2-17.168,6.608-33.712,22.512-39.36c-8.112,7.888-12.272,19.632-10.032,31.568
                                    C107.744,209.632,163.952,241.52,179.424,249.632z" />
                                    <g style="opacity:0.2;">
                                        <ellipse transform="matrix(-0.3654 -0.9308 0.9308 -0.3654 116.941 405.326)" style="fill:#FFFFFF;" cx="196.632" cy="162.802" rx="13.871" ry="9.344" />
                                    </g>
                                    <path style="fill:#E24B4B;" d="M332.752,256.784c1.392,1.712,3.728,2.128,5.648,1.072c14.4-7.568,72.32-40,77.872-70.192
                                    c3.52-19.088-9.072-37.44-28.16-40.96c-13.76-2.56-27.088,3.312-34.88,14.08c-3.312-12.8-13.76-23.04-27.52-25.488
                                    c-19.088-3.52-37.328,9.072-40.848,28.16C279.312,193.632,321.968,244.512,332.752,256.784z" />
                                    <path style="fill:#D03F3F;" d="M326.672,249.632c2.448,2.992,4.592,5.44,6.08,7.152c1.392,1.712,3.728,2.128,5.648,1.072
                                    c14.4-7.568,72.32-40,77.872-70.192c3.2-17.168-6.608-33.712-22.512-39.36c8.112,7.888,12.272,19.632,10.032,31.568
                                    C398.352,209.632,342.128,241.52,326.672,249.632z" />
                                    <g style="opacity:0.2;">
                                        <ellipse transform="matrix(-0.9308 -0.3654 0.3654 -0.9308 537.9436 427.4479)" style="fill:#FFFFFF;" cx="309.42" cy="162.82" rx="9.344" ry="13.871" />
                                    </g>
                                    <path style="fill:#E24B4B;" d="M256,435.92c22.944-0.176,42.768-4.8,59.712-12.144c-3.84-11.28-10.736-21.12-19.808-28.496
                                    c-7.28-6-17.28-7.088-26.272-4.176c-5.184,1.632-11.008,2.64-17.456,2.64c-5.008,0-9.632-0.64-13.904-1.632
                                    c-9.728-2.448-19.904,0.448-26.992,7.552c-6.704,6.704-11.84,14.96-14.96,24.144C213.264,431.136,233.072,435.76,256,435.92z" />
                                    <g></g>
                                </svg>
                            </div>
                        </div>
                    </div>
     </div>
          

<div id="pregunta3" style="display:none;" class="form-check-input" align="center" style="text-align: center;">
    <h4> <p> 3.- ¿El consultor solicitó toda la documentación necesaria para la gestión de tu solicitud desde el inicio?  </p> </h4>  
                      <br>
    <label class="btn ">
        <input type="radio" name="p3" value="SI" autocomplete="off"> SI
    </label>
    <label class="btn ">
        <input type="radio" name="p3" value="NO" autocomplete="off"> NO
    </label>
</div>


        <div id="pregunta4" style="display:none;" class="form-check-input" align="center" style="text-align: center;">
                      <h4> <p> 4.- ¿Algún comentario adicional?  </p> </h4>  
                      <br>
                    <textarea class="form-control" placeholder="(Opcional)" id="p4" name="p4" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
         </div> 


                      <!-- pie del diálogo -->
                <div class="modal-footer" id="pie1" onclick="pregunta2();">

                                <button type="button" class="btn btn-secondary">Siguiente</button>
                    </div>



                    <div class="modal-footer" id="pie2" style="display: none;" >

                                <button type="button" class="btn btn-secondary" onclick="pregunta3();">Siguiente</button>
                    </div>



                      <div class="modal-footer" id="pie3" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="pregunta4();">Siguiente</button>
                      </div>




                
                                <div class="modal-footer" id="pie4" style="display: none;">
                        <input onclick="enviar();" type="button" class="btn btn-secondary" value="Enviar">
                      </div>

     
            </div>
          </div>
        </div> 

     </div>

 </form>




<!-- TERMINA EL CODIGO AGREGADO PARA LA ENCUESTA ************************************
 -->
 
 
    <div class="container">
        <div class="col-sm-12">
            <table class="table table-condensed table-bordered" id="tablaDinamicaLoad">
                <tbody>
                    <tr>
                        <td colspan="8" align="center" class="seguimiento"><b>
                                <h2>
                                    <p style="color:#FFFFFF">Seguimiento de <?php echo $nomusuario; ?>
                                </h2>
                            </b>
                        </td>
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

                        <!--ENTRAN TODOS LOS PROCESOS-->

                        <?php if ($ver[14] == 'TERMINADO' || $ver[14] == 'TERMINADO CON POLIZA') { ?>

                            <?php if ($ver[3] == "ALTA DE POLIZA") { ?>
                                <tr>
                                    <td align="center"><b>Folio: </b></td>
                                    <td align="center" style="width: 148px;"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                    <td align="center" style="width: 148px;"><b>Línea de Negocio:</b></td>
                                    <td align="center" style="width: 148px;"><?php echo $ver[2]; ?></td>
                                    <td align="center" style="width: 148px;"><b>Fecha Solicitud:</b></td>
                                    <td align="center" style="width: 148px;"><?php echo $ver[1]; ?></td>
                                    <td align="center"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                        if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                        elseif ($ver[14] == 'ACTIVADO') : ?> bgcolor="#F1C40F" <?php
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
                                    <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
                                    <td align="center"><?php echo $ver[3]; ?></td>
                                    <td align="center"><b>Producto:</b></td>
                                    <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                                    <td align="center"><b>Rango:</b></td>
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
                                    <!--hay cambio aquí monto_pagos-->
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

                                <tr>

                                <?php } elseif ($ver[3] == "MOVIMIENTOS") { ?>

                                <tr>
                                    <td align="center"><b>Folio:</b></td>
                                    <td align="center" style="width: 148px;"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                    <td align="center" style="width: 148px;"><b>Línea de Negocio:</b></td>
                                    <td align="center" style="width: 148px;"><?php echo $ver[2]; ?></td>
                                    <td align="center" style="width: 148px;"><b>Fecha Solicitud:</b></td>
                                    <td align="center" style="width: 148px;"><?php echo $ver[1]; ?></td>
                                    <td align="center" style="width: 148px;"><b>Estado:</b></td>
                                    <td align="center" <?php
                                                        if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                        elseif ($ver[14] == 'ACTIVADO') : ?> bgcolor="#F1C40F" <?php
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
                                    <td colspan="2" align="center"><?php echo $ver[8]; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                                </tr>


                                <tr>
                                    <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
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
                                                        elseif ($ver[14] == 'ACTIVADO') : ?> bgcolor="#F1C40F" <?php
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
                                    <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
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
                            <!--CIERRE DEL IF PAGOS-->
                            <tr>
                                <!-- Tabla de documentos -->
                                <td colspan="8" align="center" class="documentos">
                                    <b>
                                        <p style="color:#FFFFFF">DOCUMENTOS
                                    </b>
                                </td>
                            </tr>

                            <tr align="center" class="datosDocument">
                                <td colspan="1"><b>Usuario</td>
                                <td colspan="2"><b>Nombre de Archivo</td>
                                <td colspan="1"><b>Ver</td>
                                <td colspan="1"><b>Descargar</td>
                                <td colspan="2"><b>¿Aprobado?</td>
                                <td colspan="1" style="width:180px;"><b>Fecha de carga</td>
                            </tr>

                            <?php
                            $query = "SELECT id,
                                          nombre, fk_folio, fecha_creacion, nomusuario
                                          FROM archivos
                                          WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {

                            ?>

                                <tr>
                                    <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                    <td colspan="2" align="center"><?php echo $row[1]; ?></td>
                                   <td colspan="1" align="center" <?php  if ($respondido != $ids && $terminado == '1' ) { ?> onclick="return abrirmodal();" <?php } ?>> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank">
                                            <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                            
                                    </td>

                                 <td colspan="1" align="center" >

<!--                                     CODIGO PARA EL BOTON DE DESCARGA     
 -->                                      <?php 

                                        $cadena_buscada = "caratula_poliza"; 
                                        $posicion_coincidencia = strpos($row[1], $cadena_buscada);

                                        if ($respondido != $ids && $posicion_coincidencia != false ) { ?>


                                        <a> <!-- Cierre de etiqueta a  -->
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt" disabled  > </span> 

                                     </a> <!-- termina etiqueta a -->


                                       <?php } else { ?> 

                                        <a  href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1];  ?>"  > <!-- Cierre de etiqueta a  -->
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt"> </span> 

                                     </a> <!-- termina etiqueta a -->

                                   <?php } ?>

<!--                          TERMINA CODIGO PARA EL BOTON           
 -->                                    </td>

                                    <td colspan="2" align="center">
                                        <?php
                                        if (in_array($row[0], $categorias)) {
                                        ?>
                                            <img class="arch_validado" src="img/Validacion.png">

                                        <?php
                                        } else {
                                        ?>
                                            <img class="arch_snValidar" src="img/Sn_validacion.png">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td colspan="1" align="center">
                                        <?php echo $row[3]; ?>
                                    </td>
                                </tr>

                            <?php } ?>


                            <!-- AGREGAR ARCHIVOS (BARRA DE PROGRESO EN LOS ESTADOS DE TERMINADO)-->
                            <form action="" enctype="multipart/form-data" id='filesform'>
                                <tr>
                                    <td colspan="8" align="center" class="agregar">
                                        <b>
                                            <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <div class="form-1-2">
                                            <input id="agregar1" type="file" name="file[]" accept=".pdf">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <select type="text" name="tipo" value="" id="tipo">
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
                                        </select>
                                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                                        <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                                    </td>
                                </tr>
                                <tr class="barraProgresoT">
                                    <td colspan="10">
                                        <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                                        <div class="barra">
                                            <div class="barra_azul" id="barra_estado">
                                                <span></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <button type="submit" onclick="return subir()" class="btn btn-primary" id="subirV">Subir Archivo</button>
                                        <input type="button" class="btn btn-danger" id="cancelar" value="Cancelar" disabled>
                                    </td>
                                </tr>
                            </form>

                            <!-- Tabla de comentarios -->
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
                                <td class="estadoTp">
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
                                $CONSULTA =  "SELECT * FROM fotosPerfil WHERE nomusuario = '$ver1[4]'";
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
                            <td colspan="5" align="center">
                                <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">

                                <?php
                                $est = "SELECT estado from folios where id='$ids'";
                                $est1 = mysqli_query($conexion, $est);
                                while ($ver3 = mysqli_fetch_row($est1)) {
                                    $datos2 = $ver3[0];
                                ?>

                                    <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2"; ?>">
                                <?php } ?>

                            </td>

                            <td align="center" class="observaciones">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar"></button>
                            </td>
                        </tr>

                        <!--CONFORMIDAD-->
                        <tr>
                            <td colspan="8" align="center" class="observaciones"><b>Términos y Condiciones</b></td>
                        </tr>

                        <tr>
                            <td colspan="2" align="justify" class="observaciones" style="width:30px;"><small><b>De acuerdo a la Circular 16 de GNP donde se solicita la documentación física en original sin tachaduras ni enmendaduras,
                                        en una sola tinta tal y como se emitió la póliza te solicitamos nos hagas llegar dicha documentación en un plazo máximo de 15 días.</b></small></td>
                            <td colspan="5" align="center" class="observaciones">

                                <form action="validar-checkbox.php" method="post">
                                    <div class="checkbox" id="checkbox" align="center">
                                        <input type="checkbox" style="display: none" id="checkbox1" name="condiciones[<?php echo $ids; ?>]" value="<?php echo "$ids"; ?>" onclick="validarcheck()">
                                        <label style="font-weight:bold;color:#FFFFFF;" for="checkbox1" class="observaciones">Acepto términos y condiciones bajo los que fue resuelta mi solicitud.</label>
                                        <br><button type="submit" class="btn btn-warning glyphicon glyphicon-ok" id="aceptar" style="display: none" /></br>
                                    </div>
                                </form>

                            <td colspan="5" align="center" class="observaciones"></td>
                            </td>
                        </tr>

                        <!--CIERRE DEL TERMINADO Y TERMINADO CON POLIZA-->
                    <?php } ?>


                    <?php if ($ver[14] == 'CANCELADO') { ?>

                        <?php if ($ver[3] == "ALTA DE POLIZA") { ?>

                            <tr>
                                <td align="center"><b>Folio: </b></td>
                                <td align="center" style="width: 148px;"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                <td align="center" style="width: 148px;"><b>Línea de Negocio:</b></td>
                                <td align="center" style="width: 108px;"><?php echo $ver[2]; ?></td>
                                <td align="center" style="width: 148px;"><b>Fecha Solicitud:</b></td>
                                <td align="center" style="width: 148px;"><?php echo $ver[1]; ?></td>
                                <td align="center"><b>Estado:</b></td>
                                <td align="center" <?php
                                                    if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                    elseif ($ver[14] == 'ACTIVADO') : ?> bgcolor="#F1C40F" <?php
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
                                <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
                                <td align="center"><?php echo $ver[3]; ?></td>
                                <td align="center"><b>Producto:</b></td>
                                <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                                <td align="center"><b>Rango:</b></td>
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
                                <td align="center" style="width: 148px;"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                <td align="center" style="width: 148px;"><b>Línea de Negocio:</b></td>
                                <td align="center" style="width: 108px;"><?php echo $ver[2]; ?></td>
                                <td align="center" style="width: 148px;"><b>Fecha Solicitud:</b></td>
                                <td align="center" style="width: 148px;"><?php echo $ver[1]; ?></td>
                                <td align="center"><b>Estado:</b></td>
                                <td align="center" <?php
                                                    if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                    elseif ($ver[14] == 'ACTIVADO') : ?> bgcolor="#F1C40F" <?php
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
                                <td colspan="2" align="center"><?php echo $ver[8]; ?></td>
                            </tr>

                            <tr>
                                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                            </tr>

                            <tr>
                                <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
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


                        <?php } elseif ($ver[3] == "PAGOS") { ?>

                            <tr>
                                <td align="center"><b>Folio:</b></td>
                                <td align="center" style="width: 148px;"><input type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                                <td align="center" style="width: 108px;"><b>Línea de Negocio:</b></td>
                                <td align="center" style="width: 148px;"><?php echo $ver[2]; ?></td>
                                <td align="center" style="width: 148px;"><b>Fecha Solicitud:</b></td>
                                <td align="center" style="width: 148px;"><?php echo $ver[1]; ?></td>
                                <td align="center"><b>Estado:</b></td>
                                <td align="center" <?php
                                                    if ($ver[14] == 'PROCESO') : ?> bgcolor="#2980B9" <?php
                                                    elseif ($ver[14] == 'ACTIVADO') : ?> bgcolor="#F1C40F" <?php
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
                                <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
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
                        <!--CIERRE DE PAGOS-->

                        <tr>
                            <!-- Tabla de documentos -->
                            <td colspan="8" align="center" class="documentos">
                                <b>
                                    <p style="color:#FFFFFF">DOCUMENTOS
                                </b>
                            </td>
                        </tr>

                        <tr align="center" class="datosDocument">
                            <td colspan="1"><b>Usuario</td>
                            <td colspan="2"><b>Nombre de Archivo</td>
                            <td colspan="1"><b>Ver</td>
                            <td colspan="1"><b>Descargar</td>
                            <td colspan="2"><b>¿Aprobado?</td>
                            <td colspan="1" style="width: 180px;"><b>Fecha de carga</td>
                        </tr>

                        <?php
                            $query = "SELECT id,
                                          nombre, fk_folio, fecha_creacion, nomusuario
                                          FROM archivos
                                          WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {

                        ?>

                            <tr>
                                <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                                <td colspan="2" align="center"><?php echo $row[1]; ?></td>
                               <td colspan="1" align="center" <?php  if ($respondido != $ids && $terminado == '1' ) { ?> onclick="return abrirmodal();" <?php } ?>> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank">
                                            <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                            
                                    </td>

                                 <td colspan="1" align="center" >

<!--                                     CODIGO PARA EL BOTON DE DESCARGA     
 -->                                      <?php 

                                        $cadena_buscada = "caratula_poliza"; 
                                        $posicion_coincidencia = strpos($row[1], $cadena_buscada);

                                        if ($respondido != $ids && $posicion_coincidencia != false ) { ?>


                                        <a> <!-- Cierre de etiqueta a  -->
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt" disabled  > </span> 

                                     </a> <!-- termina etiqueta a -->


                                       <?php } else { ?> 

                                        <a  href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1];  ?>"  > <!-- Cierre de etiqueta a  -->
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt"> </span> 

                                     </a> <!-- termina etiqueta a -->

                                   <?php } ?>

<!--                          TERMINA CODIGO PARA EL BOTON           
 -->                                    </td>


                                <td colspan="2" align="center">
                                    <?php
                                    if (in_array($row[0], $categorias)) {
                                    ?>
                                        <img class="arch_validado" src="img/Validacion.png" />

                                    <?php
                                    } else {
                                    ?>
                                        <img class="arch_snValidar" src="img/Sn_validacion.png" />
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td colspan="1" align="center">
                                    <?php echo $row[3]; ?>
                                </td>
                            </tr>

                        <?php } ?>


                        <!-- AGREGAR ARCHIVOS -->
                <tbody>
                    <form action="anexar.php" method="post" enctype="multipart/form-data" id='filesform'>

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

                <!-- Tabla de comentarios -->
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
                    <td style="width: 120px;">
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

            <?php } ?>

            <tr>
                <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
            </tr>

            <tr class="observaciones">
                <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
                <td colspan="5" align="center">
                    <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled></textarea>
                    <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">
                    <?php
                            $est = "SELECT estado from folios where id='$ids'";
                            $est1 = mysqli_query($conexion, $est);
                            while ($ver3 = mysqli_fetch_row($est1)) {
                                $datos2 = $ver3[0];
                    ?>
                        <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2"; ?>">

                    <?php } ?>
                </td>

                <td align="center" class="observaciones">
                    <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar" disabled></button>
                </td>
            </tr>

            <!--CIERRE DE CANCELADO-->
        <?php } ?>


        <!--LOS PROCESOS RESTANTES PARA QUE NO SE BLOQUEE NADA-->
        <?php if ($ver[14] == 'PROCESO' || $ver[14] == 'ACTIVADO FLT' || $ver[14] == 'REPROCESO' || $ver[14] == 'ENVIADO' || $ver[14] == 'ACTIVADO GNP' || $ver[14] == 'ACTIVADO MED') { ?>

            <?php if ($ver[3] == "ALTA DE POLIZA") { ?>
                <tr>
                    <td align="center"><b>Folio: </b></td>
                    <td align="center"><input style="width: 150px;" type="text" value="<?php echo "$ids"; ?>" id="folio" name="folio" disabled></td>
                    <td align="center" style="width: 148px;"><b>Línea de Negocio:</b></td>
                    <td align="center" style="width: 100px;"><?php echo $ver[2]; ?></td>
                    <td align="center" style="width: 148px;"><b>Fecha Solicitud:</b></td>
                    <td align="center" style="width: 148px;"><?php echo $ver[1]; ?></td>
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
                    <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
                    <td align="center"><?php echo $ver[3]; ?></td>
                    <td align="center"><b>Producto:</b></td>
                    <td colspan="2" align="center"><?php echo $ver[4]; ?></td>
                    <td align="center"><b>Rango:</b></td>
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
                    <!--hay cambio aquí monto_pagos-->
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
                    <td colspan="2" align="center"><?php echo $ver[8]; ?></td>
                </tr>

                <tr>
                    <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
                </tr>

                <tr>
                    <td align="center" style="width: 148px;"><b>Tipo Solicitud:</b></td>
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
                    <!--hay cambio aquí monto_pagos-->
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
            <!--CIERRE DE PAGOS-DEMAS PROCESOS-->

            <tr>
                <!-- Tabla de documentos -->
                <td colspan="8" align="center" class="documentos">
                    <b>
                        <p style="color:#FFFFFF">DOCUMENTOS
                    </b>
                </td>
            </tr>

            <tr align="center" class="datosDocument">
                <td colspan="1"><b>Usuario</td>
                <td colspan="2"><b>Nombre de Archivo</td>
                <td colspan="1"><b>Ver</td>
                <td colspan="1"><b>Descargar</td>
                <td colspan="2"><b>¿Aprobado?</td>
                <td colspan="1"><b>Fecha de carga</td>
            </tr>

            <?php
                            $query = "SELECT id,
                                          nombre, fk_folio, fecha_creacion, nomusuario
                                          FROM archivos
                                          WHERE fk_folio = '$ids' order by id desc";
                            $resultado = $conexion->query($query);
                            while ($row = mysqli_fetch_row($resultado)) {

            ?>
                <tr>
                    <td colspan="1" align="center"><?php echo $row[4]; ?></td>
                    <td colspan="2" align="center"><?php echo $row[1]; ?></td>
                    <td colspan="1" align="center" <?php  if ($respondido != $ids && $terminado == '1' ) { ?> onclick="return abrirmodal();" <?php } ?>> <a href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank">
                                            <span class="btn btn-primary glyphicon glyphicon-file"></span></a>
                                            
                                    </td>

                                 <td colspan="1" align="center" >

<!--                                     CODIGO PARA EL BOTON DE DESCARGA     
 -->                                      <?php 

                                        $cadena_buscada = "caratula_poliza"; 
                                        $posicion_coincidencia = strpos($row[1], $cadena_buscada);

                                        if ($respondido != $ids && $posicion_coincidencia != false ) { ?>


                                        <a> <!-- Cierre de etiqueta a  -->
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt" disabled  > </span> 

                                     </a> <!-- termina etiqueta a -->


                                       <?php } else { ?> 

                                        <a  href="../sistemas/archivos/<?php echo $row[1]; ?>" target=" _blank" download="<?php echo $row[1];  ?>"  > <!-- Cierre de etiqueta a  -->
                                        <span class="btn btn-primary glyphicon glyphicon-download-alt"> </span> 

                                     </a> <!-- termina etiqueta a -->

                                   <?php } ?>

<!--                          TERMINA CODIGO PARA EL BOTON           
 -->                                    </td>


                    <td colspan="2" align="center">
                        <?php
                                if (in_array($row[0], $categorias)) {
                        ?>
                            <img class="arch_validado" src="img/Validacion.png" />

                        <?php
                                } else {
                        ?>
                            <img class="arch_snValidar" src="img/Sn_validacion.png" />
                        <?php
                                }
                        ?>
                    </td>
                    <td colspan="1" align="center">
                        <?php echo $row[3]; ?>
                    </td>
                </tr>

            <?php } ?>


            <!-- AGREGAR ARCHIVOS (BARRA DE PROGRESO PARA TODOS LOS ESTADOS - MENOS CANCELADO Y TERMINADOS)-->
            <form action="" enctype="multipart/form-data" id='filesform'>

                <tr>
                    <td colspan="8" align="center" class="agregar"><b>
                            <p style="color:#FFFFFF">AGREGAR MAS ARCHIVOS</p>
                        </b></td>
                </tr>
                <tr>
                    <td colspan="9" align="center">
                        <div class="form-1-2">
                            <input id="agregar1" type="file" name="file[]" accept=".pdf">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="9" align="center">
                        <select type="text" name="tipo" value="" id="tipo">
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
                        </select>
                        <input type="text" hidden="" id="nomusuario" name="nomusuario" value="<?php echo "$nomusuario"; ?>">
                        <input type="text" hidden="" id="idf" name="idf" value="<?php echo "$ids"; ?>">
                    </td>
                </tr>
                <tr class="barraProgresoT">
                    <td colspan="10">
                        <p class="txtBt">Permita que su Barra de Progreso este de color verde para subir nuevos archivos</p>
                        <div class="barra">
                            <div class="barra_azul" id="barra_estado">
                                <span></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="9" align="center">
                        <div class="acciones">
                            <button type="submit" onclick="return subir()" class="btn btn-primary" id="subirV">Subir Archivo</button>
                            <input type="button" class="btn btn-danger" id="cancelar" value="Cancelar" disabled>
                        </div>
                    </td>
                </tr>
            </form>


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
                <td class="estadoTp">
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

        <?php } ?>

        <tr>
            <td colspan="8" align="center" bgcolor="#eeefef"><b></b></td>
        </tr>

        <tr class="observaciones">
            <td colspan="2" align="center"><b>Agregar Observaciones:</b></td>
            <td colspan="5" align="center">
                <textarea id="observaciones" name="observaciones" class="campo-form" type="text" style="text-transform:uppercase;" value="" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$nomusuario"; ?>">

                <?php
                            $est = "SELECT estado from folios where id='$ids'";
                            $est1 = mysqli_query($conexion, $est);
                            while ($ver3 = mysqli_fetch_row($est1)) {
                                $datos2 = $ver3[0];
                ?>
                    <input type="text" hidden="" id="estadoss" name="estadoss" value="<?php echo "$datos2"; ?>">

                <?php } ?>

            </td>

            <td align="center" class="observaciones">
                <button type="button" class="btn btn-warning glyphicon glyphicon-ok" id="guardar"></button>
            </td>
        </tr>


        <!--CIERRE DEL RESTO DE LOS PROCESOS-->
    <?php } ?>

<?php } ?>


</tbody>
            </table>
        </div>
    </div>

</body>
<script type="text/javascript">



function abrirmodal(){
      $("#encuesta").modal("show");

}

function pregunta2 (){

  if (!document.querySelector('input[name="rating"]:checked')) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡Seleccione una respuesta!',
                allowOutsideClick: false
            })
            hasError = true;
        } else {
           document.getElementById("pregunta1").style.display = 'none';
          document.getElementById("pie1").style.display = 'none';
         document.getElementById("pregunta2").style.display = 'block';
        document.getElementById("pie2").style.display = 'block';
          document.getElementById("pie3").style.display = 'none'; 
                 document.getElementById("pregunta3").style.display = 'none';
        }
    }


function pregunta3 (){

  if (!document.querySelector('input[name="rating2"]:checked')) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡Seleccione una respuesta!',
                allowOutsideClick: false
            })
            hasError = true;
        } else {
           document.getElementById("pregunta1").style.display = 'none';
          document.getElementById("pie1").style.display = 'none';
            document.getElementById("pregunta2").style.display = 'none';
          document.getElementById("pie2").style.display = 'none';
         document.getElementById("pregunta3").style.display = 'block';
        document.getElementById("pie3").style.display = 'block';
          document.getElementById("pie4").style.display = 'none'; 
                 document.getElementById("pregunta4").style.display = 'none';
        }
    }



function pregunta4 (){


        if (!document.querySelector('input[name="p3"]:checked')) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡Seleccione una respuesta!',
                allowOutsideClick: false
            })
            hasError = true;
        } else {
              document.getElementById("pregunta1").style.display = 'none';
                     document.getElementById("pie1").style.display = 'none';
                   document.getElementById("pregunta2").style.display = 'none';
                    document.getElementById("pie2").style.display = 'none';
                   document.getElementById("pie3").style.display = 'none'; 
                 document.getElementById("pregunta3").style.display = 'none';
                 document.getElementById("pregunta4").style.display = 'block';
        document.getElementById("pie4").style.display = 'block';
              
        }
                  
        
    }



/*FUNCION PARA LAS ESTRELLAS*/
    function enviar() {
   
            document.getElementById('fencuesta').submit();
            return false;
        
    }
    


    
 $(document).ready(function() {
     $('[rel="tooltip"]').tooltip();
  });
    $(document).ready(function() {
        $('#guardar').click(function() {

            //PARA INGRESAR UN COMENTARIO
            var estado = document.getElementById('estadoss').value;
            var comentario = document.getElementById('observaciones').value;
            if (estado == 'ENVIADO' || estado == 'TERMINADO' || estado == 'TERMINADO CON POLIZA' || estado == 'ACTIVADO MED' || estado == 'ACTIVADO FLT' || estado == 'ACTIVADO GNP' || estado == 'PROCESO' || estado == 'REPROCESO') {
                if (comentario.length == 0) {
                    swal({
                        title: "¡Error!",
                        text: "Ingrese un comentario para continuar",
                        type: "error",
                        customClass: 'swal-wide',
                        allowOutsideClick: false
                    });
                    hasError = true;
                } else {
                    guardar1();
                    reload();
                }
            }

        });
    });
</script>

<script type="text/javascript">
    function subir() {
        var agregar1 = document.getElementById("agregar1").value;
        var tipo = document.getElementById("tipo").value;

        if (agregar1 == null || agregar1 == 0) {
            swal({
                title: "¡Error!",
                text: "Seleccione algun archivo para continuar",
                type: "error",
                customClass: 'swal-wide',
                allowOutsideClick: false
            });
            hasError = true;
            return false;
        } else if (tipo == null || tipo == 0) {
            swal({
                title: "¡Error!",
                text: "Seleccione alguna opción del combo para continuar",
                type: "error",
                customClass: 'swal-wide',
                allowOutsideClick: false
            });
            hasError = true;
            return false;
        } else {
            $("#cancelar").prop("disabled", false);
            $(".barraProgresoT").removeClass("barraProgresoT");

        }

        idf = $('#idf').val();
        tipo = $('#tipo').val();

        var Form = new FormData($('#filesform')[0]);

        cadena = "idf=" + idf +
            "&tipo=" + tipo;

        $.ajax({
            data: Form,
            cadena,
            processData: false,
            contentType: false,
            success: function(data) {}
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

<!--VALIDACION PARA CHECKBOX CONFORMIDAD-->

<script type="text/javascript">
    function conformidad() {

        var tabla = document.getElementById('tablaDinamicaLoad').querySelectorAll(".btn");

        for (var i = 0; i < tabla.length; i++) {
            tabla[i].disabled = true;
            tabla[i].checked = true;
        }

        document.getElementById("observaciones").disabled = true;
        document.getElementById("checkbox1").disabled = true;
        document.getElementById("aceptar").style.display = 'none';
        document.getElementById("checkbox1").checked = true;
        document.getElementById("agregar1").disabled = true;
        document.getElementById("tipo").disabled = true;

    } //CIERRE DE LA FUNCION
    function validarcheck() {
        var opcion = document.getElementById('checkbox1');

        if (opcion.checked == true) { //botón seleccionado
            document.getElementById("aceptar").style.display = 'block';

        } else { //botón no seleccionado

            document.getElementById("aceptar").style.display = 'none';

        }
    }
</script>

</html>