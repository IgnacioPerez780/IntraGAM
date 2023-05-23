<?php
// se incluye la conexión //
include '../app/conexion.php';

// variables con los datos recibidos por POST //
$conexion = conexion();
$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
$estado = $_POST['estado'];
$estado1 = $_POST['estado1'];
$fgnp = $_POST['fgnp'];
$polizap = $_POST['polizap'];
$tipo = "COMENTARIO";
$contador = "1";

$prima2 = $_POST['prima2'];
$moneda2 = $_POST['moneda2'];
$periodo = $_POST['periodo'];
$primaAnual = $_POST['primaAnual'];

date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s", $time);

$id = "select id_agente from folios where id='$folio'";
$reid = mysqli_query($conexion, $id);
while ($verid = mysqli_fetch_row($reid)) {
  $did = $verid[0];

  $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
            values
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador','$did')";
  $resultc = mysqli_query($conexion, $cont);

  $cont0 = "UPDATE notificaciones set contador='0' where folio='$folio'";
  $result = mysqli_query($conexion, $cont0);
}

if ($estado == "PROCESO" or $estado == "REPROCESO" or $estado == "ACTIVADO MED" or $estado == "ACTIVADO FLT" or $estado == "ACTIVADO GNP" or $estado == "CANCELADO") {

  $sqlf = "select folio from promesa where folio='$folio'";
  $resultf = mysqli_query($conexion, $sqlf);

  while ($verf = mysqli_fetch_row($resultf)) {
    $datosf = $verf[0];
  }

  if ($datosf == 0) {

    $sqlf2 = "insert into promesa(folio,fechaest,estado) values('$folio','$fecha_actual','$estado')";
    echo $resultf2 = mysqli_query($conexion, $sqlf2);

    if ($estado == "Seleccione") {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
      echo $result = mysqli_query($conexion, $sql);
    } else {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
      echo $result = mysqli_query($conexion, $sql);

      //ANEXE LINEAS DE CODIGO PARA LA CAPTURA DEL FOLIO
      if ($estado == "PROCESO") {

        if (empty($fgnp)) {
          $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        } else {
          $sql1 = "UPDATE folios set estado='$estado',fgnp='$fgnp'
                                where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        }

        //********************************************************************AQUI VAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO A PROCESO***************************************************

        $sqlid = "select id_agente from folios where id='$folio'";
        $sqlid1 = mysqli_query($conexion, $sqlid);
        while ($id1 = mysqli_fetch_row($sqlid1)) {
          $id2 = $id1[0];

          $sqlem = "select correo from datos_agente where id='$id2'";
          $sqlem1 = mysqli_query($conexion, $sqlem);
          while ($co = mysqli_fetch_row($sqlem1)) {
            $correo = $co[0];

            //CONSULTA PARA OBTENER DATOS DEL FOLIO
            $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
                $df[9];

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:darkblue;">¡ESTA EN PROCESO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:darkblue;">¡ESTA EN PROCESO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[8] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:darkblue;">¡ESTA EN PROCESO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[9] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            }
          }
        }

        //********************************************************************AQUI TERMINAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO A PROCESO***************************************************

      } else if ($estado == "ACTIVADO FLT") {

        //********************************************************************AQUI VAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO A PROCESO***************************************************

        $sqlid = "select id_agente from folios where id='$folio'";
        $sqlid1 = mysqli_query($conexion, $sqlid);
        while ($id1 = mysqli_fetch_row($sqlid1)) {
          $id2 = $id1[0];

          $sqlem = "select correo from datos_agente where id='$id2'";
          $sqlem1 = mysqli_query($conexion, $sqlem);
          while ($co = mysqli_fetch_row($sqlem1)) {
            $correo = $co[0];

            //CONSULTA PARA OBTENER DATOS DEL FOLIO
            $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
                $df[9];

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR FILTRO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR FILTRO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[8] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR FILTRO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[9] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            }
          }
        }

        //********************************************************************AQUI TERMINAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO A PROCESO*************************************************** 

      } else if ($estado == "TERMINADO CON POLIZA") {

        $consulta = "SELECT folio FROM polizasemitidas where folio='$folio'";
        $resc = mysqli_query($conexion, $consulta);
        while ($row1 = mysqli_fetch_array($resc)) {
          $row2 = $row1['folio'];
        }

        if ($row2 == $folio) {
          $update = "UPDATE polizasemitidas SET folio = '$folio', prima = '$prima2', moneda = '$moneda2', periodo = '$periodo', primaAnual = '$primaAnual' WHERE folio = '$folio'";
          $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
          echo $update22 = mysqli_query($conexion, $update2);
          /*SE HACE LA INSERCION DE LOS DATOS
                            */
          $conexion->query($update);
        } else {
          $insertar = "insert into polizasemitidas(folio,prima,moneda,periodo,primaAnual)values('$folio','$prima2','$moneda2','$periodo','$primaAnual')";
          echo $insertarr = mysqli_query($conexion, $insertar);

          $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
          echo $update22 = mysqli_query($conexion, $update2);
        }
        //********************************************************************AQUI VAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO A PROCESO***************************************************

        $sqlid = "select id_agente from folios where id='$folio'";
        $sqlid1 = mysqli_query($conexion, $sqlid);
        while ($id1 = mysqli_fetch_row($sqlid1)) {
          $id2 = $id1[0];

          $sqlem = "select correo from datos_agente where id='$id2'";
          $sqlem1 = mysqli_query($conexion, $sqlem);
          while ($co = mysqli_fetch_row($sqlem1)) {
            $correo = $co[0];

            //CONSULTA PARA OBTENER DATOS DEL FOLIO
            $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
                $df[9];

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE,a  GAMltecomplace  informrtea que tu folio está  <strong style="colorgreene;">TERMINADO CON POLIZA!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE,a  GAMltecomplace  informrtea que tu folio está  <strong style="colorgreene;">TERMINADO CON POLIZA!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[8] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio está <strong style="color:green;">¡TERMINADO CON POLIZA</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[9] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            }
          }
        }

        //********************************************************************AQUI TERMINAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO A PROCESO***************************************************
      }
    }
  } else {

    $sqlf1 = "UPDATE promesa set fechaest='$fecha_actual', estado='$estado'  where folio='$folio'";
    echo $resultf1 = mysqli_query($conexion, $sqlf1);

    if ($estado == "Seleccione") {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
      echo $result = mysqli_query($conexion, $sql);
    } else {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
      echo $result = mysqli_query($conexion, $sql);

      //ANEXE LINEAS DE CODIGO PARA LA CAPTURA DEL FOLIO
      if ($estado == "PROCESO") {

        if (empty($fgnp)) {
          $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        } else {
          $sql1 = "UPDATE folios set estado='$estado',fgnp='$fgnp'
                                where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        }
      }

      //********************************************************************AQUI VAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO SIN TERMINADO Y PROCESO***************************************************

      $sqlid = "select id_agente from folios where id='$folio'";
      $sqlid1 = mysqli_query($conexion, $sqlid);
      while ($id1 = mysqli_fetch_row($sqlid1)) {
        $id2 = $id1[0];

        $sqlem = "select correo from datos_agente where id='$id2'";
        $sqlem1 = mysqli_query($conexion, $sqlem);
        while ($co = mysqli_fetch_row($sqlem1)) {
          $correo = $co[0];

          //CONSULTA PARA OBTENER DATOS DEL FOLIO
          $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
              $df[9];

            if ($df[2] == "ALTA DE POLIZA") {

              if ($estado == "TERMINADO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡HA SIDO TERMINADO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "TERMINADO CON POLIZA") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡HA SIDO TERMINADO CON POLIZA!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "CANCELADO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "PROCESO") {
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:darkblue;">¡ESTA EN PROCESO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "REPROCESO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO GNP") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR GNP!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO MED") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                          <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR CUESTIONES MEDICAS!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO FLT") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR FILTRO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'CC: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            } else if ($df[2] == "MOVIMIENTOS") {

              if ($estado == "TERMINADO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡HA SIDO TERMINADO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "TERMINADO CON POLIZA") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡HA SIDO TERMINADO CON POLIZA!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "CANCELADO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "PROCESO") {
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:darkblue;">¡ESTA EN PROCESO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[8] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "REPROCESO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO GNP") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR GNP!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO MED") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                          <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR CUESTIONES MEDICAS!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO FLT") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR FILTRO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            } else if ($df[2] == "PAGOS") {

              if ($estado == "TERMINADO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡HA SIDO TERMINADO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "TERMINADO CON POLIZA") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡HA SIDO TERMINADO CON POLIZA!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "CANCELADO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:red;">¡HA SIDO CANCELADO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "PROCESO") {
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:darkblue;">¡ESTA EN PROCESO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[9] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "REPROCESO") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:blue;">¡ESTA EN REPROCESO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO GNP") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR GNP!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO MED") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                          <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR CUESTIONES MEDICAS!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } elseif ($estado == "ACTIVADO FLT") {
                $contenido = '
                                        
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:darkorange;">¡HA SIDO ACTIVADO POR FILTRO!</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            }
          }
        }
      }


      //********************************************************************AQUI TERMINAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS CAMBIOS DE ESTADO SIN TERMINADO Y PROCESO**********************************************************************************************************************************************

    }
  }
} else {

  if ($estado == "Seleccione") {

    $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
    echo $result = mysqli_query($conexion, $sql);

    //********************************************************************AQUI VAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS COMENTARIOS DE CUALQUIER ESTADO***************************************************


    $sqlid = "select id_agente from folios where id='$folio'";
    $sqlid1 = mysqli_query($conexion, $sqlid);
    while ($id1 = mysqli_fetch_row($sqlid1)) {
      $id2 = $id1[0];

      $sqlem = "select correo from datos_agente where id='$id2'";
      $sqlem1 = mysqli_query($conexion, $sqlem);
      while ($co = mysqli_fetch_row($sqlem1)) {
        $correo = $co[0];

        //CONSULTA PARA OBTENER LOS DATOS DEL FOLIO
        $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
            $df[9];

          if ($df[2] == "ALTA DE POLIZA") {

            $contenido = '
            
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p><strong style="color:black;">Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[3] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
            $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

            mail($correo, $mensaje, $cuerpo, $headers);
          } else if ($df[2] == "MOVIMIENTOS") {

            $contenido = '
            
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p><strong style="color:black;">Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[8] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
            $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

            mail($correo, $mensaje, $cuerpo, $headers);
          } else if ($df[2] == "PAGOS") {

            $contenido = '
            
                                        <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                          <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                        </a>
                                      
                                        <p><strong style="color:black;">Estimado AGENTE, GAM te informa que se agrego un comentario a tu folio</strong></p>
                                         <table width="400" CELLPADDING=10 CELLSPACING=0>
                                          <tr>
                                              <td width="140">
                                                  <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                              </td>
                                              <td align="right">
                                                  <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                              </td>
                                          </tr>
                                         </table>
                                         <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                             <td>' . $df[1] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                             <td>' . $df[2] . '</td>
                                           </tr>
                                           <tr>
                                             <td>' . $df[9] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                             <td>' . $df[4] . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                             <td>' . $polizap . '</td>
                                           </tr>
                                           <tr>
                                             <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                             <td>' . $df[7] . '</td>
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
            $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

            mail($correo, $mensaje, $cuerpo, $headers);
          }
        }
      }


      //********************************************************************AQUI TERMINAN LAS CONFIGURACIONES PARA LOS CORREOS DE LOS COMENTARIOS DE CUALQUIER ESTADO**********************************************************************************************************************************************
    }
  } else {

    $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
    echo $result = mysqli_query($conexion, $sql);

    //ANEXE LINEAS DE CODIGO PARA LA CAPTURA DEL FOLIO
    if ($estado == "PROCESO") {

      if (empty($fgnp)) {
        $sql1 = "UPDATE folios set estado='$estado'
                                where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      } else {
        $sql1 = "UPDATE folios set estado='$estado',fgnp='$fgnp'
                            where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      }
    }
  }
}

if ($estado == "TERMINADO" or $estado == "TERMINADO CON POLIZA") {




  $sqlf = "select folio from cam_estado where folio='$folio'";
  $resultf = mysqli_query($conexion, $sqlf);

  while ($verf = mysqli_fetch_row($resultf)) {
    $datosf = $verf[0];
  }

  if ($datosf == 0) {

    $sqlf2 = "insert into cam_estado(folio,cd_estado,estado) values('$folio','$fecha_actual','$estado')";
    echo $resultf2 = mysqli_query($conexion, $sqlf2);

    if ($estado == "Seleccione") {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
      //echo $result = mysqli_query($conexion,$sql);

    } else {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
      //echo $result = mysqli_query($conexion,$sql);

      //ANEXE LINEAS DE CODIGO PARA LA CAPTURA DE LA POLIZA

      if ($estado == "TERMINADO CON POLIZA") {

        $consulta = "SELECT folio FROM polizasemitidas where folio='$folio'";
        $resc = mysqli_query($conexion, $consulta);
        while ($row1 = mysqli_fetch_array($resc)) {
          $row2 = $row1['folio'];
        }

        if ($row2 == $folio) {
          $update = "UPDATE polizasemitidas SET folio = '$folio', prima = '$prima2', moneda = '$moneda2', periodo = '$periodo', primaAnual = '$primaAnual' WHERE folio = '$folio'";
          $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
          echo $update22 = mysqli_query($conexion, $update2);
          /*SE HACE LA INSERCION DE LOS DATOS
                            */
          $conexion->query($update);
        } else {
          $insertar = "insert into polizasemitidas(folio,prima,moneda,periodo,primaAnual)values('$folio','$prima2','$moneda2','$periodo','$primaAnual')";
          echo $insertarr = mysqli_query($conexion, $insertar);

          $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
          echo $update22 = mysqli_query($conexion, $update2);
        }

        if (empty($polizap)) {
          $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        } else {
          $sql1 = "UPDATE folios set estado='$estado',polizap='$polizap'
                                where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        }
      }

      if ($estado == "TERMINADO" || $estado == "PROCESO" || $estado == "REPROCESO" || $estado == "ACTIVADO MED" || $estado == "ACTIVADO GNP" || $estado == "ACTIVADO FLT" || $estado == "CANCELADO") {

        $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      }
      //************************************************AQUI VAN LAS CONFIGURACIONES PARA EL ENVIO DE CORREOS CON CAMBIO DE ESTADO DE TERMINADOS Y TERMINADOS CON POLIZA*************************************

      $sqlid = "select id_agente from folios where id='$folio'";
      $sqlid1 = mysqli_query($conexion, $sqlid);
      while ($id1 = mysqli_fetch_row($sqlid1)) {
        $id2 = $id1[0];

        $sqlem = "select correo from datos_agente where id='$id2'";
        $sqlem1 = mysqli_query($conexion, $sqlem);
        while ($co = mysqli_fetch_row($sqlem1)) {
          $correo = $co[0];

          //CONSULTA PARA OBTENER DATOS DEL FOLIO
          $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
              $df[9];

            if ($estado == "TERMINADO") {

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[8] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[9] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            } else if ($estado == "TERMINADO CON POLIZA") {

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO CON POLIZA!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO CON POLIZA!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[8] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO CON POLIZA!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[9] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            }
          }
        }
      }

      //***********************************************AQUI TERMINAN LAS CONFIGURACIONES PARA EL ENVIO DE CORREOS CON CAMBIO DE ESTADO DE TERMINADOS Y TERMINADOS CON POLIZA**********************************************************************************************************************************************
    }
  } else {

    $sqlf1 = "UPDATE cam_estado set cd_estado='$fecha_actual', estado='$estado'  where folio='$folio'";
    echo $resultf1 = mysqli_query($conexion, $sqlf1);

    if ($estado == "Seleccione") {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
      //echo $result = mysqli_query($conexion,$sql);


    } else {

      $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
      //echo $result = mysqli_query($conexion,$sql);

      //ANEXE LINEAS DE CODIGO PARA LA CAPTURA DE LA POLIZA

      if ($estado == "TERMINADO CON POLIZA") {
        $consulta = "SELECT folio FROM polizasemitidas where folio='$folio'";
        $resc = mysqli_query($conexion, $consulta);
        while ($row1 = mysqli_fetch_array($resc)) {
          $row2 = $row1['folio'];
        }

        if ($row2 == $folio) {
          $update = "UPDATE polizasemitidas SET folio = '$folio', prima = '$prima2', moneda = '$moneda2', periodo = '$periodo', primaAnual = '$primaAnual' WHERE folio = '$folio'";
          $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
          echo $update22 = mysqli_query($conexion, $update2);
          /*SE HACE LA INSERCION DE LOS DATOS
                            */
          $conexion->query($update);
        } else {
          $insertar = "insert into polizasemitidas(folio,prima,moneda,periodo,primaAnual)values('$folio','$prima2','$moneda2','$periodo','$primaAnual')";
          echo $insertarr = mysqli_query($conexion, $insertar);

          $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
          echo $update22 = mysqli_query($conexion, $update2);
        }





        if (empty($polizap)) {
          $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        } else {
          $sql1 = "UPDATE folios set estado='$estado',polizap='$polizap'
                                where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        }
      }

      if ($estado == "TERMINADO" || $estado == "PROCESO" || $estado == "REPROCESO" || $estado == "ACTIVADO MED" || $estado == "ACTIVADO GNP" || $estado == "ACTIVADO FLT" || $estado == "CANCELADO") {

        $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      }

      $sqlid = "select id_agente from folios where id='$folio'";
      $sqlid1 = mysqli_query($conexion, $sqlid);
      while ($id1 = mysqli_fetch_row($sqlid1)) {
        $id2 = $id1[0];

        $sqlem = "select correo from datos_agente where id='$id2'";
        $sqlem1 = mysqli_query($conexion, $sqlem);
        while ($co = mysqli_fetch_row($sqlem1)) {
          $correo = $co[0];

          //CONSULTA PARA OBTENER DATOS DEL FOLIO
          $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, polizap, fgnp, movimiento, monto FROM folios WHERE id='$folio'";
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
              $df[9];

            if ($estado == "TERMINADO") {

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[8] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[9] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            } else if ($estado == "TERMINADO CON POLIZA") {

              if ($df[2] == "ALTA DE POLIZA") {

                //FORMATO DEL CORREO
                $contenido = '
                                          
                                          <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                            <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                          </a>
                                        
                                          <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO CON POLIZA!</strong></p>
                                           <table width="400" CELLPADDING=10 CELLSPACING=0>
                                            <tr>
                                                <td width="140">
                                                    <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                </td>
                                                <td align="right">
                                                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                </td>
                                            </tr>
                                           </table>
                                           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                               <td>' . $df[1] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                               <td>' . $df[2] . '</td>
                                             </tr>
                                             <tr>
                                               <td>' . $df[3] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                               <td>' . $df[4] . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                               <td>' . $polizap . '</td>
                                             </tr>
                                             <tr>
                                               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                               <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "MOVIMIENTOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO CON POLIZA!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[8] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              } else if ($df[2] == "PAGOS") {

                //FORMATO DEL CORREO
                $contenido = '
                                              
                                              <a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                                                <img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                                              </a>
                                            
                                              <p>Estimado AGENTE, a GAM le complace informarte que tu folio <strong style="color:green;">¡ESTA TERMINADO CON POLIZA!</strong></p>
                                               <table width="400" CELLPADDING=10 CELLSPACING=0>
                                                <tr>
                                                    <td width="140">
                                                        <img src="https://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                                                    </td>
                                                    <td align="right">
                                                        <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                                                    </td>
                                                </tr>
                                               </table>
                                               <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Linea de Negocio:</td>
                                                   <td>' . $df[1] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140" ROWSPAN=2 COLSPAN=1><strong style="color:darkblue;">Tipo de Solicitud:</td>
                                                   <td>' . $df[2] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td>' . $df[9] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Contratante:</td>
                                                   <td>' . $df[4] . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">N° Póliza:</td>
                                                   <td>' . $polizap . '</td>
                                                 </tr>
                                                 <tr>
                                                   <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
                                                   <td>' . $df[7] . '</td>
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
                $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

                mail($correo, $mensaje, $cuerpo, $headers);
              }
            }
          }
        }
      }
    }
  }
} else {

  if ($estado == "Seleccione") {

    $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
    //echo $result = mysqli_query($conexion,$sql);

    //??????



  } else {

    $sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
    //echo $result = mysqli_query($conexion,$sql);

    //ANEXE LINEAS DE CODIGO PARA LA CAPTURA DE LA POLIZA

    if ($estado == "TERMINADO CON POLIZA") {

      $consulta = "SELECT folio FROM polizasemitidas where folio='$folio'";
      $resc = mysqli_query($conexion, $consulta);
      while ($row1 = mysqli_fetch_array($resc)) {
        $row2 = $row1['folio'];
      }

      if ($row2 == $folio) {
        $update = "UPDATE polizasemitidas SET folio = '$folio', prima = '$prima2', moneda = '$moneda2', periodo = '$periodo', primaAnual = '$primaAnual' WHERE folio = '$folio'";
        $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
        echo $update22 = mysqli_query($conexion, $update2);
        /*SE HACE LA INSERCION DE LOS DATOS
                            */
        $conexion->query($update);
      } else {
        $insertar = "insert into polizasemitidas(folio,prima,moneda,periodo,primaAnual)values('$folio','$prima2','$moneda2','$periodo','$primaAnual')";
        echo $insertarr = mysqli_query($conexion, $insertar);

        $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
        echo $update22 = mysqli_query($conexion, $update2);
      }


      if (empty($polizap)) {
        $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      } else {
        $sql1 = "UPDATE folios set estado='$estado',polizap='$polizap'
                                where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      }
    }

    if ($estado == "TERMINADO" || $estado == "PROCESO" || $estado == "REPROCESO" || $estado == "ACTIVADO MED" || $estado == "ACTIVADO GNP" || $estado == "ACTIVADO FLT" || $estado == "CANCELADO") {

      $sql1 = "UPDATE folios set estado='$estado'
                                    where id='$folio'";
      echo $result = mysqli_query($conexion, $sql1);
    }
  }
}
