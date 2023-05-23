<?php
// se incluye la conexión con la base //
include '../app/conexion.php';
$conexion = conexion();

// variables que reciben los nuevos datos //

$folio = $_POST['folio'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$estadoss = $_POST['estadoss'];
date_default_timezone_set("America/Mazatlan");
$time = time();
$fecha_actual = date("Y-m-d H:i:s", $time);
$tipo = "COMENTARIO";
$contador = "1";

// $prima2 = $_POST['prima2'];
// $moneda2 = $_POST['moneda2'];
// $periodo = $_POST['periodo'];
// $primaAnual = $_POST['primaAnual'];

// $consulta = "SELECT folio FROM polizasemitidas where folio='$folio'";
// $resc = mysqli_query($conexion, $consulta);
// while ($row1 = mysqli_fetch_array($resc)) {
//     $row2 = $row1['folio'];
// }
// if ($row2 == $folio) {
//     $update = "UPDATE polizasemitidas SET folio = '$folio', prima = '$prima2', moneda = '$moneda2', periodo = '$periodo', primaAnual = '$primaAnual' WHERE folio = '$folio'";
//     $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
//     echo $update22 = mysqli_query($conexion, $update2);
//     /*SE HACE LA INSERCION DE LOS DATOS*/
//     $conexion->query($update);
// } else {
//     $insertar = "insert into polizasemitidas(folio,prima,moneda,periodo,primaAnual)values('$folio','$prima2','$moneda2','$periodo','$primaAnual')";
//     echo $insertarr = mysqli_query($conexion, $insertar);
//     $update2 = "UPDATE folios set prima = '$prima2', monedap = '$moneda2' where id = '$folio'";
//     echo $update22 = mysqli_query($conexion, $update2);
// }


// se hace la insercion en la tabla de notificaciones con los nuevos valores //

$cont = "insert into notificaciones(folio,usuario,estado,fecha,tipo,contador)
            values
            ('$folio','$usuario','$estadoss','$fecha_actual','$tipo','$contador')";
$resultc = mysqli_query($conexion, $cont);

$sql = "insert into comentarios(fecha_comentario,comentario,folio,usuario,estado1)
                  values
      ('$fecha_actual','$observaciones','$folio','$usuario','$estadoss')";

$result = mysqli_query($conexion, $sql);

if (!$result) {
    echo '<script> alert("Error 1"); window.history.go(-1); </sript>';
} else {
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

        //FORMATO DEL CORREO
        $correo = "vida@asesoresgam.com.mx";
        $contenido = '
          
          <a href="http://www.asesoresgam.com.mx/sistemas/index.php">    
            <img src="http://asesoresgam.com.mx/sistemas/img/lol.png" width="600" height="130">
          </a>
        
          <p><strong style="color:black;">Estimado CONSULTOR, GAM te informa que se agrego un comentario al folio: </strong></p>
           <table width="400" CELLPADDING=10 CELLSPACING=0>
            <tr>
                <td width="140">
                    <img src="http://asesoresgam.com.mx/sistemas/img/logo_intra.png" width="70" height="70">
                </td>
                <td align="right">
                    <strong style="color:darkblue;">Folio GAM: </strong> <strong style="color:black;">' . $df[0] . '</strong>
                </td>
            </tr>
           </table>
           <table width="400" BORDER BORDERCOLOR="#FF6100" CELLPADDING=10 CELLSPACING=0>
             <tr>
               <td width="140"><strong style="color:darkblue;">L&iacute;nea de Negocio:</td>
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
               <td width="140"><strong style="color:darkblue;">N&#176; P&oacute;liza:</td>
               <td>' . $df[5] . '</td>
             </tr>
             <tr>
               <td width="140"><strong style="color:darkblue;">Orden de Trabajo:</td>
               <td>' . $df[7] . '</td>
             </tr>
           </table>
            
        ';
        $cuerpo = $contenido;
        $mensaje = "MENSAJE AUTOMATICO DE INTRAGAM";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: ventanagam@gmail.com" . "\r\n";
        $headers .= "CC: calidad@asesoresgam.com.mx" . "\r\n";
        mail($correo, $mensaje, $cuerpo, $headers);

        echo '<script> alert("Se envio correctamente tu MSN"); location.href="seguimiento.php=' . $folio . '" </script>';
    }
}
?>