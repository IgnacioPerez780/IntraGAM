<?php
include 'app/conexion.php';
$conexion = conexion();
session_start();
$nomusuario = $_SESSION['nomusuario'];
/*$nomusuario = $_POST['nomusuario'];*/
/*echo "$nomusuario";*/

$x = 1;

if ($_SESSION['nomusuario'] <> TRUE) {
  header('location: index.php');
  exit;
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Editar Perfil</title>
  <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
  <!-- Compiled and minified Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="css/estilos_generales_editar.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- LIBRERIAS DE ALERTAS  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <!-- HOJAS DE ESTILO -->
  <link rel="stylesheet" type="text/css" href="css/hoja_editarDatosA.css">


</head>


<?php
/*SE INCLUYE DESPUES LA CABECERA PARA QUE ACTUALICE LA IMAGEN DE LA CABECERA*/
include('plantillas/cabecera_general_menuA.php');
?>


<body>

  <form id="datos" method="post" action="actualizarDatosAgente.php" enctype="multipart/form-data">
    <?php
    $mod = "SELECT * FROM datos_agente WHERE nomusuario = '$nomusuario' ";
    $resultTE = mysqli_query($conexion, $mod);
    while ($modificacion = mysqli_fetch_array($resultTE)) {
    ?>

      <div class="container">
        <div class="row">
          <table>
            <tr>
              <td>
                <img class="fotoPerfilA_nueva" src="<?php echo $modificacion['fotoPerfil'];  ?>">
                <input type="file" accept="image/*" name="archivo" class="cambiarFoto">
              </td>
            </tr>
          </table>
          <input style="display: none; " type="radio" name="enviar" value="<?php echo "1" ?>" checked>
          <button type="button" onclick="validar();" class="btn btn-primary">ACTUALIZAR</button>
        </div>


        <div class="edicionDatos_Agente">
          <table>
            <tr>
              <td>
                <label class="datosEditar_nombre">Nombre: </label>
                <input style="display: none;" type="radio" name="nombreAnterior" value="<?php echo $modificacion['nombre'];  ?>" checked>
                <input type="text" class="form-control" name="nombre" placeholder="Sin Datos" onkeyup="mayusculas(this);" value="<?php echo $modificacion['nombre'];  ?>" readonly="">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_direccion">Dirección:</label>
                <label data-toggle="tooltip" data-placement="right" title="Los datos de contacto nos ayudan a mantenernos comunicados y a brindarte un mejor servicio." class="tooltipDireccion">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none; " type="radio" name="direccionAnterior" value="<?php echo $modificacion['direccion'];  ?>" checked>
                <input type="text" class="form-control" name="direccion" placeholder="AV. PASEO DE LA REFORMA 144 COL. JUAREZ, C.P. 06600 CUAUHTEMOC, CDMX." onkeyup="mayusculas(this);" value="<?php echo $modificacion['direccion'];  ?>">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_rfc">RFC:</label>
                <label data-toggle="tooltip" data-placement="right" title="ABCD 90101 XYZ" class="tooltipRfc">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none;" type="radio" name="rfcAnterior" value="<?php echo $modificacion['rfc'];  ?>" checked>
                <input type="text" class="form-control" maxlength="13" name="rfc" rows="1" placeholder="RFC" onkeyup="mayusculas(this);" value="<?php echo $modificacion['rfc'];  ?>">
              </td>
            </tr>

            <input style="display: none;" type="radio" name="nomusuario" value="<?php echo $nomusuario;  ?>" checked>
            <input style="display: none;" type="radio" name="imagen" value="<?php echo $modificacion['fotoPerfil'];  ?>" checked>

            <tr>
              <td>
                <label class="datosEditar_correo">Correo Vida:</label>
                <label data-toggle="tooltip" data-html="true" data-placement="right" title="Para agregar más de un correo, estos deberán estar divididos por una coma (,) y no deberá existir ningún espacio entre ellos, la estructura es la siguiente: <br>v1@gmail.com,v2@gmail.com" class="tooltipCorreo">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none;" type="radio" name="correoAnterior" value="<?php echo $modificacion['correo'];  ?>" checked>
                <input type="text" class="form-control" id="correo" name="correo" rows="1" placeholder="ramo-vida@agente.com.mx" onkeyup="mayusculas(this);" value="<?php echo $modificacion['correo'];  ?>">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_correo">Correo Siniestros:</label>
                <label data-toggle="tooltip" data-html="true" data-placement="right" title="Para agregar más de un correo, estos deberán estar divididos por una coma (,) y no deberá existir ningún espacio entre ellos, la estructura es la siguiente: <br>s1@gmail.com,s2@gmail.com" class="tooltipCorreo">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none;" type="radio" name="correosAnterior" value="<?php echo $modificacion['correos'];  ?>" checked>
                <input type="text" class="form-control" style="" id="correos" name="correos" style="" rows="1" placeholder="ramo-siniestros@agente.com.mx" onkeyup="mayusculas(this);" value="<?php echo $modificacion['correos'];  ?>">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_correo">Correo GMM:</label>
                <label data-toggle="tooltip" data-html="true" data-placement="right" title="Para agregar más de un correo, estos deberán estar divididos por una coma (,) y no deberá existir ningún espacio entre ellos, la estructura es la siguiente: <br>g1@gmail.com,g2@gmail.com" class="tooltipCorreo">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none;" type="radio" name="correogAnterior" value="<?php echo $modificacion['correog'];  ?>" checked>
                <input type="text" class="form-control" style="" id="correog" name="correog" style="" rows="1" placeholder="ramo-gmm@agente.com.mx" onkeyup="mayusculas(this);" value="<?php echo $modificacion['correog'];  ?>">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_correo">Correo Autos:</label>
                <label data-toggle="tooltip" data-html="true" data-placement="right" title="Para agregar más de un correo, estos deberán estar divididos por una coma (,) y no deberá existir ningún espacio entre ellos, la estructura es la siguiente: <br>a1@gmail.com,a2@gmail.com" class="tooltipCorreo">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none;" type="radio" name="correoaAnterior" value="<?php echo $modificacion['correoa'];  ?>" checked>
                <input type="text" class="form-control" style="" id="correoa" name="correoa" style="" rows="1" placeholder="ramo-autos@agente.com.mx" onkeyup="mayusculas(this);" value="<?php echo $modificacion['correoa'];  ?>">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_celular">Celular:</label>
                <label data-toggle="tooltip" data-html="true" data-placement="right" title="Los datos de contacto nos ayudan a mantenernos comunicados y a brindarte un mejor servicio. <br>La marcación es a 10 dígitos." class="tooltipCelular">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="22" height="22" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                      <g xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84     c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869     c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389     c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291     c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" fill="#0d6aba" data-original="#000000" class="" />
                            <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256     C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216     C472,375.377,375.393,472,256,472z" fill="#0d6aba" data-original="#000000" class="" />
                          </g>
                        </g>
                      </g>
                  </svg>
                </label>
                <input style="display: none;" type="radio" name="celularAnterior" value="<?php echo $modificacion['celular'];  ?>" checked>
                <input type="text" class="form-control" maxlength="10" style="" name="celular" placeholder="(55) 555 000 55" onkeyup="mayusculas(this);" value="<?php echo $modificacion['celular'];  ?>">
              </td>
            </tr>

            <tr>
              <td>
                <label class="datosEditar_cua">CUA:</label>
                <input style="display: none;" type="radio" name="cuaAnterior" value="<?php echo $modificacion['cua'];  ?>" checked>
                <input type="text" class="form-control" name="cua" rows="1" placeholder="Sin Datos" onkeyup="mayusculas(this);" value="<?php echo $modificacion['cua'];  ?>" disabled>
              </td>
            </tr>

          </table>


        </div>
      </div>

  </form>
<?php

    }

?>

</body>

</html>

<script>

 function validar() {

var correo = document.getElementById("correo").value;
var correoa = document.getElementById("correoa").value;
var correos = document.getElementById("correos").value;
var correog = document.getElementById("correog").value;
var expresion = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;
 
    if (!correo.includes('@') || !correo.includes('.')) {
        swal({
            title: "Oops...",
            text: "¡E-mail vida inválido!",
            type: "error",
            allowOutsideClick: false
        });
      }



      else if (!correos.includes('@') || !correos.includes('.')) {
        swal({
            title: "Oops...",
            text: "¡E-mail siniestros inválido!",
            type: "error",
            allowOutsideClick: false
        });
      }


      else if (!correoa.includes('@') || !correoa.includes('.')) {
        swal({
            title: "Oops...",
            text: "¡E-mail autos inválido!",
            type: "error",
            allowOutsideClick: false
        });
      }

            else if (!correog.includes('@') || !correog.includes('.')) {
        swal({
            title: "Oops...",
            text: "¡E-mail gastos medicos inválido!",
            type: "error",
            allowOutsideClick: false
        });
      }




else {
    swal({
        title: "¿Actualizar Datos?",
        text: "Puedes cambiar tus datos las veces que quieras",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#F8C471",
        confirmButtonText: "Actualizar",
        closeOnConfirm: false,
        customClass: "Custom_Cancel"

      },
      function() {
        document.getElementById('datos').submit();
        return false;
      });
    }

  }
  

  

  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>