<?php
// SE INCLUYE LA CONEXIÓN Y LAS VARIABLES QUE TRAEN LOS DATOS //
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
// SE ESTABLECE LA ZONA HORARIA //
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s", $time);

$id = "select agente from folios_g where id='$folio'";
$reid = mysqli_query($conexion, $id);
while ($verid = mysqli_fetch_row($reid)) {
  $did = $verid[0];
}
// SE ACTUALIZA LAS NOTIFICACIONES Y SE AGREGA 1 AL CONTADOR //
$cont0 = "UPDATE notificaciones_g set contador='0' where folio='$folio'";
$result = mysqli_query($conexion, $cont0);

$cont = "INSERT INTO notificaciones1_g(folio,usuario,estado,fecha,tipo,contador,id_agente)
            VALUES
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador','$did')";
$resultc = mysqli_query($conexion, $cont);

if ($estado == "PROCESO") {
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
} else if ($estado == "CASO ESPECIAL") {

  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
                                      
                    <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:grey;">¡ESTA EN CASO ESPECIAL!</strong></p>
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

  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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

  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];

          // contenido del correo //
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
  // validaciones en cuanto al estado  //
} else if ($estado == "ACTIVADO MED") {
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
} else if ($estado == "ACTIVADO FLT") {
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
} else if ($estado == "ACTIVADO GNP") {
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
} else if ($estado == "REPROCESO") {
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
} else if ($estado == "RECHAZO DE SUSCRIPCION") {
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];
// consulta para sacar el correo de los datos del agente //
    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
                                      
                    <p>Estimado AGENTE, GAM te informa que tu folio <strong style="color:indianred;">¡HA SIDO RECHAZADO POR SUSCRIPCION!</strong></p>
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
} else if ($estado == "TERMINADO CON POLIZA") {
// consulta para los folios_g //
  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];
// select que consulta el correo del agente en gmm//
    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
      $datosfolior = mysqli_query($conexion, $datosfolio);
      while ($df = mysqli_fetch_row($datosfolior)) {
        $df1 = $df[0] . "||" .
          $df[1] . "||" .
          $df[2] . "||" .
          $df[3] . "||" .
          $df[4] . "||" .
          $df[5] . "||" .
          $df[6];
// texto del contenido del correo que se enviará //
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
  $sql = "insert into comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
  echo $result = mysqli_query($conexion, $sql);

  $sql1 = "UPDATE folios_g set fgnp='$fgnp' where id='$folio'";
  echo $result = mysqli_query($conexion, $sql1);

  $sqlid = "select agente from folios_g where id='$folio'";
  $sqlid1 = mysqli_query($conexion, $sqlid);
  while ($id1 = mysqli_fetch_row($sqlid1)) {
    $id2 = $id1[0];

    $sqlem = "select correog from datos_agente where id='$id2'";
    $sqlem1 = mysqli_query($conexion, $sqlem);
    while ($co = mysqli_fetch_row($sqlem1)) {
      $correo = $co[0];

      $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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

  $sqlf = "select folio from promesa_g where folio='$folio'";
  $resultf = mysqli_query($conexion, $sqlf);

  while ($verf = mysqli_fetch_row($resultf)) {
    $datosf = $verf[0];
  }
  if ($datosf == 0) {
    $sqlf2 = "insert into promesa_g(folio,fechaest,estado) values('$folio','$fecha_actual','$estado')";
    echo $resultf2 = mysqli_query($conexion, $sqlf2);

    if ($estado == "Seleccione") {
      $sql = "insert into comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
      echo $result = mysqli_query($conexion, $sql);

      $sqlid = "select agente from folios_g where id='$folio'";
      $sqlid1 = mysqli_query($conexion, $sqlid);
      while ($id1 = mysqli_fetch_row($sqlid1)) {
        $id2 = $id1[0];

        $sqlem = "select correog from datos_agente where id='$id2'";
        $sqlem1 = mysqli_query($conexion, $sqlem);
        while ($co = mysqli_fetch_row($sqlem1)) {
          $correo = $co[0];

          $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
      $sql = "insert into comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
      echo $result = mysqli_query($conexion, $sql);

      $sqlid = "select agente from folios_g where id='$folio'";
      $sqlid1 = mysqli_query($conexion, $sqlid);
      while ($id1 = mysqli_fetch_row($sqlid1)) {
        $id2 = $id1[0];

        $sqlem = "select correog from datos_agente where id='$id2'";
        $sqlem1 = mysqli_query($conexion, $sqlem);
        while ($co = mysqli_fetch_row($sqlem1)) {
          $correo = $co[0];

          $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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

      if (empty($fgnp)) {
        $sql1 = "UPDATE folios_g set estado='$estado',fgnp='$fgnp' where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      } else {
        $sql1 = "UPDATE folios_g set estado='$estado',fgnp='$fgnp' where id='$folio'";
        echo $result = mysqli_query($conexion, $sql1);
      }
    }
  } else {
    if ($estado == "PROCESO" or $estado == "REPROCESO" or $estado == "ACTIVADO MED" or $estado == "ACTIVADO FLT" or $estado == "ACTIVADO GNP" or $estado == "CANCELADO" or $estado == "CASO ESPECIAL" or $estado == "RECHAZO DE SUSCRIPCION") {
      $sqlf1 = "UPDATE promesa_g set fechaest='$fecha_actual', estado='$estado'  where folio='$folio'";
      echo $resultf1 = mysqli_query($conexion, $sqlf1);

      if ($estado == "Seleccione") {
        $sqlid = "select agente from folios_g where id='$folio'";
        $sqlid1 = mysqli_query($conexion, $sqlid);
        while ($id1 = mysqli_fetch_row($sqlid1)) {
          $id2 = $id1[0];

          $sqlem = "select correog from datos_agente where id='$id2'";
          $sqlem1 = mysqli_query($conexion, $sqlem);
          while ($co = mysqli_fetch_row($sqlem1)) {
            $correo = $co[0];

            $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
              $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM 4";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= 'From: notificador@asesoresgam.com.mx' . "\r\n";
              $headers .= 'Bcc: respaldo@asesoresgam.com.mx' . "\r\n";

              mail($correo, $mensaje, $cuerpo, $headers);
            }
          }
        }
        $sql = "insert into comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
        echo $result = mysqli_query($conexion, $sql);
      } else {
        $sql = "insert into comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
        echo $result = mysqli_query($conexion, $sql);

        if (empty($fgnp)) {
          $sql1 = "UPDATE folios_g set estado='$estado',fgnp='$fgnp'  where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        } else {
          $sql1 = "UPDATE folios_g set estado='$estado',fgnp='$fgnp'  where id='$folio'";
          echo $result = mysqli_query($conexion, $sql1);
        }
      }
    }
  }
}


//COMENTARIOS Y ACTUALIZACIÓN DE ESTADO
if ($estado == "TERMINADO" || $estado == "TERMINADO CON POLIZA") {

  if ($estado == "Seleccione") {
    $sqlid = "select agente from folios_g where id='$folio'";
    $sqlid1 = mysqli_query($conexion, $sqlid);
    while ($id1 = mysqli_fetch_row($sqlid1)) {
      $id2 = $id1[0];

      $sqlem = "select correog from datos_agente where id='$id2'";
      $sqlem1 = mysqli_query($conexion, $sqlem);
      while ($co = mysqli_fetch_row($sqlem1)) {
        $correo = $co[0];

        $datosfolio = "SELECT id, negocio, t_solicitud, producto, contratante, poliza, fgnp  FROM folios_g WHERE id='$folio'";
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
    $sql = "INSERT INTO comentarios_g(fecha_comentario,comentario,folio,usuario,estado1) values ('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";
    echo $result1 = mysqli_query($conexion, $sql);
  } else {
    $sql = "insert into comentarios_g(fecha_comentario,comentarios,folio,usuario,estado1) values('$fecha_actual','$observaciones','$folio','$usuario','$estado')";
    echo $result = mysqli_query($conexion, $sql);
    $update = "UPDATE folios_g SET estado = '$estado',fgnp='$fgnp',poliza='$poliza' where id='$folio'";
    echo $result = mysqli_query($conexion, $update);
  }
}


//CAMBIO DE ESTADO PARA DETENER LOS DIAS DE TRAMITE
if ($estado == "TERMINADO" || $estado == "CANCELADO" || $estado == "TERMINADO CON POLIZA" || $estado == "RECHAZO DE SUSCRIPCION") {

  $sqlg = "SELECT folio_g FROM cam_estado_g WHERE folio_g = '$folio'";
  $resultg = mysqli_query($conexion, $sqlg);

  while ($verg = mysqli_fetch_row($resultg)) {
    $datosg = $verg[0];
  }

  if ($datosg == 0) {
    $sqlgmm = "INSERT INTO cam_estado_g(folio_g, cd_estado_g, estado_g) VALUES ('$folio','$fecha_actual', '$estado')";
    echo $resultgmm = mysqli_query($conexion, $sqlgmm);
  } else {
    $updategmm = "UPDATE cam_estado_g SET estado_g = '$estado', cd_estado_g = '$fecha_actual' WHERE folio_g='$folio'";
    echo $resultupd = mysqli_query($conexion, $updategmm);
  }
}
