<?php

//ESTAS LINEAS SON PARA EL AGENTE
error_reporting(E_ALL);
session_start();
$id = $_SESSION['id_usuario'];
$carpeta = $_SESSION['nomusuario'];
include '../app/conexion.php';
$conexion = conexion();
$sql = "SELECT MAX(id) FROM folios_a";
$result = $conexion->query($sql);
if ($row = mysqli_fetch_row($result)) {
	$id_folio = trim($row[0]);
}
$id_folio = isset($id_folio) ? $id_folio  : 18999;
$carpeta = "../archivos/";
$id_folio++;

$nom = "SELECT nomusuario FROM datos_agente WHERE id = '$id'";
$nomr = $conexion->query($nom);
if ($row = mysqli_fetch_row($nomr)) {
	$nomusu = $row[0];
}

if ($_POST['datos']) {
	$post = explode("&", $_POST['datos']);

	$array_data = array();
	foreach ($post as $key => $value) {
		$value = explode("=", $value);
		$array_data[$key] = $value[1];
	}

	if (isset($post[14])) {
		$fec = $array_data[0]; //fecha
		$neg = $array_data[1]; //negocio
		$tso = $array_data[2]; //solicitud
		$res = $array_data[3]; //numero de resoluci車n - nuevo negocio
		$tsn = $array_data[4]; //produto
		$pol = $array_data[5]; //poliza
		$mov = $array_data[6]; //movimiento   		
		$con = $array_data[7]; //contrantante
		$pri = $array_data[8]; //prioridad
		$mot = $array_data[9]; //motivo
		$des = $array_data[10]; //descripcion
		$tel = $array_data[11]; //telefono
		$com = $array_data[12]; //comentario
		$est = $array_data[13]; //estado

		date_default_timezone_set("America/Mexico_City");
		$time = time();
		$fec1 = date("Y-m-d H:i:s", $time);

		$time1 = time();
		$fecha_actual = date("Y-m-d H:i:s", $time1);
		$tipoa = "TRAMITE";
		$contador = "1";
		$estado = "ENVIADO";

		$cont = "INSERT INTO notificaciones_a(folio,usuario,estado,fecha,tipo,contador)
								VALUES
								('$id_folio','$nomusu','$estado','$fecha_actual','$tipoa','$contador')";
		$resultc = mysqli_query($conexion, $cont);



		if ($tso == "NUEVO NEGOCIO") {
			$sql = "INSERT INTO folios_a(
            		fecha,negocio,t_solicitud,producto,n_resolucion,contratante,poliza,fgnp,prioridad,motivo,descripcion,comentarios,estado,telefono,agente,usuario)
            		VALUES
            		('$fec1','$neg','$tso','$tsn','$res','$con','---','---','$pri','$mot','$des','$com','$est','$tel','$id','0')";
			$insert = $conexion->query($sql);
			if (!empty($_FILES) && $insert) {
				$data = array(
					'mensaje' => "Archivos Guardados : ",
					'status' => "200"
				);
				echo json_encode($data);
				die();
			}
			mysqli_close($conexion);
		} else if ($tso == "MOVIMIENTOS"){
			$sql = "INSERT INTO folios_a(
            		fecha,negocio,t_solicitud,producto,n_resolucion,contratante,poliza,fgnp,prioridad,motivo,descripcion,comentarios,estado,telefono,agente,usuario)
            		VALUES
            		('$fec1','$neg','$tso','$mov','','$con','$pol','---','$pri','$mot','$des','$com','$est','$tel','$id','0')";
			$insert = $conexion->query($sql);
			if (!empty($_FILES) && $insert) {
				$data = array(
					'mensaje' => "Archivos Guardados : ",
					'status' => "200"
				);
				echo json_encode($data);
				die();
			}
			mysqli_close($conexion);
		}
	}
}
