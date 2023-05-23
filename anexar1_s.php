<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();

//VARIABLES PARA SUBIR ARCHIVOS
date_default_timezone_set("America/Mexico_City");
$fecha_actual = date('Y-m-d H:i:s');
$idf = $_POST['idf'];
$nomusuario = $_POST['nomusuario'];

$v1 = $_FILES['file']['name']; //nombre original del fichero
$ruta = "../archivos_s/" . $idf . '_' . $v1; // ruta asigna/num Folio/nombre original del archivo

$tipoa = "ARCHIVO";
$contador = "1";

$est = "select estado, id_agente from folios_s where id='$idf'";
$re = mysqli_query($conexion,$est);
	while($vere = mysqli_fetch_row($re)){
        $ess = $vere[0];

        $cont = "INSERT INTO notificaciones_s(folio,usuario,estado,fecha,tipo,contador)
                                    VALUES
                                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador')";
        $resultc = mysqli_query($conexion,$cont);

    }

$consulta = "INSERT INTO archivos_s(nombre, fk_folio, nomusuario, fecha_creacion) VALUES ('" . $ruta . "', '" . $idf . "', '" . $nomusuario . "', '" . $fecha_actual . "')";
$resultado = mysqli_query($conexion, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
mysqli_close($conexion);
$ruta_carpeta = "archivos_s/"; //ruta para guardar los archivos en el servidor
$nombre_archivo = basename($_FILES["file"]["name"]); //se coloca el nombre del archivo
$ruta_guardar_archivo = $ruta_carpeta . $idf . '_' . $nombre_archivo; //se guarda el archivo con la ruta asignada

move_uploaded_file($_FILES['file']['tmp_name'], $ruta_guardar_archivo); //mueve el archivo subido a una nueva ubicaciиоn


?>