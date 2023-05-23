<?php
 // se incluye la conexión y se declaran las variables que contienen los datos recibidos por post //
include '../app/conexion.php';
$conexion = conexion();
$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
$estado = $_POST['estado'];
$estado1 = $_POST['estado1'];
$fgnp = $_POST['fgnp'];
$poliza = $_POST['poliza'];
$tipo = "COMENTARIO";
$contador = "1";

// se declara la zona horaria //
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s", $time);
// se seleccionaN LOS DATOS DEL FOLIO //
$id = "select agente from folios_a where id='$folio'";
$reid = mysqli_query($conexion, $id);
while ($verid = mysqli_fetch_row($reid)) {
  $did = $verid[0];
}
// se hace el update a la tabla de notificaciones //
$cont0 = "UPDATE notificaciones_a set contador='0' where folio='$folio'";
$result = mysqli_query($conexion, $cont0);

$cont = "INSERT INTO notificaciones1_a(folio,usuario,estado,fecha,tipo,contador,id_agente)
            VALUES
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador','$did')";
$resultc = mysqli_query($conexion, $cont);

if ($estado == "PROCESO") {
  $sqlid = "select agente from folios_a where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correoa from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];
// se seleccionan los datos y el contenido del mensaje //
      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_a WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];

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
                         <td>' . $poliza . '</td>
                       </tr>
                       <tr>
                         <td width="140"><strong style="color:darkblue;">Folio GNP:</td>
                         <td>' . $df[6] . '</td>
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
} else if ($estado == "INCOMPLETO") {

  $sqlid = "select agente from folios_a where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correoa from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_a WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];

        $contenido = '

	            	<a href="https://www.asesoresgam.com.mx/sistemas/index.php">    
                    	<img src="https://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
                    </a>
                                      
                    <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:grey;">¡ESTA INCOMPLETO!</strong></p>
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
                         <td>' . $poliza . '</td>
                       </tr>
                       <tr>
                         <td width="140"><strong style="color:darkblue;">Folio GNP:</td>
                         <td>' . $df[6] . '</td>
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
} else if ($estado == "CANCELADO") {

  $sqlid = "select agente from folios_a where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correoa from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_a WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];

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
                         <td>' . $poliza . '</td>
                       </tr>
                       <tr>
                         <td width="140"><strong style="color:darkblue;">Folio GNP:</td>
                         <td>' . $df[6] . '</td>
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
} else if ($estado == "TERMINADO") {

  $sqlid = "select agente from folios_a where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correoa from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_a WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];

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
                         <td>' . $poliza . '</td>
                       </tr>
                       <tr>
                         <td width="140"><strong style="color:darkblue;">Folio GNP:</td>
                         <td>' . $df[6] . '</td>
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

if ($estado == "Seleccione") {
  $sql = "insert into comentarios_a(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
  echo $result = mysqli_query($conexion, $sql);

  $sql1 = "UPDATE folios_a set fgnp='$fgnp', poliza='$poliza' where id='$folio'";
  echo $result = mysqli_query($conexion, $sql1);

  $sqlid = "select agente from folios_a where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correoa from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_a WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];

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
                         <td>' . $poliza . '</td>
                       </tr>
                       <tr>
                         <td width="140"><strong style="color:darkblue;">Folio GNP:</td>
                         <td>' . $df[6] . '</td>
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
} else {

  $sqlf = "select folio from promesa_a where folio='$folio'";
  $resultf = mysqli_query($conexion, $sqlf);

  while ($verf = mysqli_fetch_row($resultf)) {
    $datosf = $verf[0];
  }
  if ($datosf == 0) {
    $sqlf2 = "insert into promesa_a(folio,fechaest,estado) values('$folio','$fecha_actual','$estado')";
    echo $resultf2 = mysqli_query($conexion, $sqlf2);

    if ($estado == "Seleccione") {
      $sql = "insert into comentarios_a(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
      echo $result = mysqli_query($conexion, $sql);
    } else {
      $sql = "insert into comentarios_a(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
      echo $result = mysqli_query($conexion, $sql);

      if (empty($fgnp)) {
        $sql1 = "UPDATE folios_a set estado='$estado',fgnp='$fgnp', poliza='$poliza' where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      } else {
        $sql1 = "UPDATE folios_a set estado='$estado',fgnp='$fgnp', poliza='$poliza' where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      }
    }
  } else {
    if ($estado == "PROCESO" or $estado == "INCOMPLETO" or $estado == "CANCELADO" or $estado == "TERMINADO") {
      $sqlf1 = "UPDATE promesa_a set fechaest='$fecha_actual', estado='$estado'  where folio='$folio'";
      echo $resultf1 = mysqli_query($conexion, $sqlf1);

      if ($estado == "Seleccione") {
        $sql = "insert into comentarios_a(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
        echo $result = mysqli_query($conexion, $sql);
      } else {
        $sql = "insert into comentarios_a(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
        echo $result = mysqli_query($conexion, $sql);

        if (empty($fgnp)) {
          $sql1 = "UPDATE folios_a set estado='$estado',fgnp='$fgnp', poliza='$poliza' where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        } else {
          $sql1 = "UPDATE folios_a set estado='$estado',fgnp='$fgnp', poliza='$poliza' where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        }
      }
    }
  }
}


//CAMBIO DE ESTADO PARA DETENER LOS DIAS DE TRAMITE
if ($estado == "TERMINADO" || $estado == "CANCELADO") {
  $sqlg = "SELECT folio_a FROM cam_estado_a WHERE folio_a = '$folio'";
  $resultA = mysqli_query($conexion, $sqlg);
  while ($verA = mysqli_fetch_row($resultA)) {
    $datosA = $verA[0];
  }
  if ($datosA == 0) {
    $sqlA = "INSERT INTO cam_estado_a(folio_a, cd_estado_a, estado_a) VALUES ('$folio','$fecha_actual', '$estado')";
    echo $resultgmm = mysqli_query($conexion, $sqlA);
  } else {
    $updateA = "UPDATE cam_estado_a SET estado_a = '$estado', cd_estado_a = '$fecha_actual' WHERE folio_a='$folio'";
    echo $resultupd = mysqli_query($conexion, $updateA);
  }
}
