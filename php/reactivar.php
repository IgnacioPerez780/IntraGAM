<?php 
	session_start();
	$nomusuario = $_SESSION['nomusuario'];
    if ($nomusuario == null || $nomusuario =$nomusuario){

    }
    include '../app/conexion.php';
    $conexion = conexion();

    //SE RECUPERAN LAS VARIABLES DE LA HOJA ACTIVAR.PHP
    $folio = $_POST['folio'];
    $nomusu = $_POST['nomusu'];
    $tipo = $_POST['tipo'];
    $motivo = $_POST['motivo'];

    //SE INICIA UNA VARIABLE DEFINIDA CON UN COMENTARIO, SE AGREGA EL MOTIVO RECUPERADO
    $comen = "*** ESTE FOLIO FUE REACTIVADO, JUSTIFICANDO LO SIGUIENTE: ".$motivo;

    //SE RECUPERA LA FECHA Y HORA EN LA QUE SE ESTA HACIENDO LA PETICIÓN
    date_default_timezone_set("America/Mexico_City");
    $time = time();
    $fec1 = date("Y-m-d H:i:s",$time); //SE ANEXA PARA LA CAPTURA DE LA HORA            

    //SE HACE UN INSERT EN LA TABLA ACTIVADOS PARA TENER REGISTRO DE LAS PETICIONES REALIZADAS
    $sql = "INSERT INTO activados(folio,usuario,tipo,detalles,fecha) VALUES ('$folio','$nomusu','$tipo','$motivo','$fec1')";
    $result = mysqli_query($conexion,$sql);
    
    //SE HACE EL UPDATE EN LA TABLA DE FOLIOS DONDE EL ESTADO CAMBIA DE CANCELADO A ENVIADO POR DEFAULT
    $sql1 = "UPDATE folios set estado='ENVIADO' WHERE id='$folio'";
    $resul1 = mysqli_query($conexion,$sql1);

    //SE HACE UN INSERT EN LA TABLA COMENTARIOS, ESTO SERVIRA PARA QUE TANTO EL AGENTE COMO EL CONSULTOR SEPAN EL MOTIVO POR EL CUAL SE ESTA CAMBIANDO EL ESTADO DEL FOLIO
    $sql2 = "INSERT INTO comentarios(fecha_comentario,comentario,folio,usuario,estado1) VALUES ('$fec1','$comen','$folio','$nomusu','ENVIADO')";
    $result2 = mysqli_query($conexion,$sql2);

    //SE HACE UN INSERT EN LA TABLA DE NOTIFICACIONES PARA EL AGENTE, EL CUAL LE AVISARA QUE TIENE UN CAMBIO DE ESTADO EN SU TRAMITE
    $sql3 = "INSERT INTO notificaciones(folio,usuario,estado,fecha,tipo,contador) VALUES ('$folio','$nomusu','ENVIADO','$fec1','REACTIVACION','1')";
    echo $result3 = mysqli_query($conexion,$sql3);

?>