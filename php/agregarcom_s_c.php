<?php
include '../app/conexion.php';
$conexion = conexion();
// se agrega la conexión con las variables recibidas por post //
$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
$estado = $_POST['estado'];
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s", $time);
$tipo = "COMENTARIO";
$contador = "1";
// consulta que almacena el id //
$id = "select id_agente from folios_s where id='$folio'";
$reid = mysqli_query($conexion, $id);
while ($verid = mysqli_fetch_row($reid)) {
  $did = $verid[0];
}
// se hace la insercion en la tabla de notificaciones1_s //
$cont = "INSERT INTO notificaciones1_s(folio,usuario,estado,fecha,tipo,contador,id_agente)
            VALUES
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador','$did')";
$resultc = mysqli_query($conexion, $cont);

if ($estado == "Seleccione") {
  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";

  $result = mysqli_query($conexion, $sql);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];
// se hace la consulta a la tabla de folios_s //
      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}
// si el estado es igual a proceso: //
if ($estado == "PROCESO") {

  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estado')";

  echo $result1 = mysqli_query($conexion, $sql);

  $update = "UPDATE folios_s SET estado = '$estado', fecha_cam_estado = '$fecha_actual' where id='$folio'";
  echo $result = mysqli_query($conexion, $update);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}

if ($estado == "PROCESO GNP") {

// CONSULTA QUE INSERTA LOS COMENTARIOS //
  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estado')";

  echo $result1 = mysqli_query($conexion, $sql);

  $update = "UPDATE folios_s SET estado = '$estado', fecha_cam_estado = '$fecha_actual'  where id='$folio'";
  echo $result = mysqli_query($conexion, $update);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO GNP!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO GNP!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO GNP!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN PROCESO GNP!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}

if ($estado == "REPROCESO") {

  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estado')";

  echo $result1 = mysqli_query($conexion, $sql);

  $update = "UPDATE folios_s SET estado = '$estado', fecha_cam_estado = '$fecha_actual' where id='$folio'";
  echo $result = mysqli_query($conexion, $update);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}

if ($estado == "TERMINADO") {

  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estado')";

  echo $result1 = mysqli_query($conexion, $sql);

  $update = "UPDATE folios_s SET estado = '$estado' where id='$folio'";
  echo $result = mysqli_query($conexion, $update);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}

if ($estado == "CANCELADO") {

  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estado')";

  echo $result1 = mysqli_query($conexion, $sql);

  $update = "UPDATE folios_s SET estado = '$estado' where id='$folio'";
  echo $result = mysqli_query($conexion, $update);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}

if ($estado == "INCOMPLETO") {

  $sql = "INSERT INTO comentarios_s(fecha_comentario,comentario,folio,usuario,estado)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estado')";

  echo $result1 = mysqli_query($conexion, $sql);

  $update = "UPDATE folios_s SET estado = '$estado' where id='$folio'";
  echo $result = mysqli_query($conexion, $update);

  $cont0 = "UPDATE notificaciones_s set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);

  $sqlid = "select id_agente from folios_s where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correos from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT * FROM folios_s WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6] . "||" .
          $df[7] . "||" .
          $df[8] . "||" .
          $df[9] . "||" .
          $df[10] . "||" .
          $df[11] . "||" .
          $df[12] . "||" .
          $df[13] . "||" .
          $df[14] . "||" .
          $df[15] . "||" .
          $df[16];

        if ($df[2] == "GMM") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡ESTA INCOMPLETO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSG' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Afectado:</td>
                    <td>' . $df[16] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Reclamacion:</td>
                    <td>' . $df[11] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Folio:</td>
                    <td>' . $df[12] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "VIDA") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡ESTA INCOMPLETO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSV' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else if ($df[2] == "AUTOS") {

          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡ESTA INCOMPLETO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSA' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        } else {
// CONTENIDO DEL MENSAJE //
          $contenido = '
                                          
                <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                  <img src="https://asesoresgam.com.mx/sistemas1/img/lol.png" width="600" height="130">
                </a>
                                        
                <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡ESTA INCOMPLETO!</strong></p>
                
                <table width="400" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140">
                      <img src="https://asesoresgam.com.mx/sistemas1/img/logo_intra.png" width="70" height="70">
                    </td>
                    <td align="right">
                      <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">FSD' . $df[0] . '</strong>
                    </td>
                  </tr>
                </table>
                <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Linea de Siniestro:</td>
                    <td>' . $df[2] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Tipo de Solicitud:</td>
                    <td>' . $df[3] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Contratante:</td>
                    <td>' . $df[7] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Poliza:</td>
                    <td>' . $df[8] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de Siniestro:</td>
                    <td>' . $df[9] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">N° de QR:</td>
                    <td>' . $df[10] . '</td>
                  </tr>
                  <tr>
                    <td width="140"><strong style="color:darkblue;">Comentario:</td>
                    <td>' . $observaciones . '</td>
                  </tr>
                </table>
                                            
              ';

          $cuerpo = $contenido;
          $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
          $headers .= 'Bcc: calidad@asesoresgam.com.mx' . "\r\n";

          mail($correo, $mensaje, $cuerpo, $headers);
        }
      }
    }
  }
}


//CAMBIO DE ESTADO PARA DETENER LOS DIAS DE TRAMITE
if ($estado == "TERMINADO" || $estado == "CANCELADO") {
  $sqlf = "SELECT folio_s FROM cam_estado_s WHERE folio_s='$folio'";
  $resultf = mysqli_query($conexion, $sqlf);

  while ($verf = mysqli_fetch_row($resultf)) {
    $datosf = $verf[0];
  }

  if ($datosf == 0) {
    $sql = "INSERT INTO cam_estado_s(folio_s,cd_estado_s,estado_s) values('$folio','$fecha_actual','$estado')";
    echo $result = mysqli_query($conexion, $sql);
  } else {

    $update = "UPDATE cam_estado_s SET estado_s = '$estado', cd_estado_s = '$fecha_actual' WHERE folio_s='$folio'";
    echo $result = mysqli_query($conexion, $update);
  }
}
