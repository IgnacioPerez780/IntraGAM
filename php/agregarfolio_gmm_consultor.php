<?php 

	error_reporting(E_ALL);
	session_start();
	$id = $_SESSION['id_usuario'];
    $carpeta = $_SESSION['nomusuario'];
    include '../app/conexion.php';
    $conexion = conexion();
    $sql="SELECT MAX(id) FROM folios_g";
    $result = $conexion->query($sql);
    if ($row = mysqli_fetch_row($result)) {
        $id_folio = trim($row[0]);
    }
    $id_folio = isset( $id_folio)? $id_folio  : 18999 ;
    $carpeta = "../archivos/";
    $id_folio ++;

    $nom = "SELECT nomusuario FROM datos_operativos WHERE id = '$id'";
    $nomr = $conexion->query($nom);
    if($row = mysqli_fetch_row($nomr)){
      $nomusu = $row[0];
    }

    if($_POST['datos']){
    	$post = explode("&", $_POST['datos']);

    	$array_data = array( );
    	foreach ($post as $key => $value) {
    		$value = explode("=", $value);
    		$array_data[$key] = $value[1];
    	}

    	if(isset($post[17])){
    		$fec = $array_data[0];
    		$age = $array_data[1];
    		$neg = $array_data[2];
    		$tso = $array_data[3];
    		$tsn = $array_data[4];
    		$tsi = $array_data[5];
    		$mov = $array_data[6];
			$mapn = $array_data[7];
			$mapi = $array_data[8];
    		$prima = $array_data[9];
    		$prima1 = $array_data[10];
    		$pol = $array_data[11];
    		$con = $array_data[12];
    		$pri = $array_data[13];
    		$mot = $array_data[14];
    		$com = $array_data[15];
    		$est = $array_data[16];

    		date_default_timezone_set("America/Mexico_City");
    		$time = time();
    		$fec1 = date("Y-m-d H:i:s",$time);

    		$time1 = time();
            $fecha_actual = date("Y-m-d H:i:s",$time1);
            $tipoa = "TRAMITE";
            $contador = "1";
            $estado = "ENVIADO";
            
            $cont = "INSERT INTO notificaciones1_g(folio,usuario,estado,fecha,tipo,contador,id_agente)
                                    VALUES
                                    ('$id_folio','$nomusu','$estado','$fecha_actual','$tipoa','$contador',(select id from datos_agente where nombre = '$age'))";
                $resultc = mysqli_query($conexion,$cont);

            if($tso == "ALTA POLIZA NACIONAL"){
            	if($pri == "ALTA") {
            		$sql = "INSERT INTO folios_g(fecha,negocio,t_solicitud,producto,poliza,fgnp,moneda_apn,moneda_api,prima,contratante,prioridad,motivo,comentario,estado,agente,usuario)
            		values ('$fec1','$neg','$tso','$tsn','---','---','$mapn','$mapi','$prima','$con','$pri','$mot','$com','$est',(select id from datos_agente where nombre = '$age'),'$id')";

            		$insert = $conexion->query($sql);
            		if(!empty($_FILES) && $insert){
            			$data = array(
            				'mensaje' => "Archivos Guardados : ",
            				'status' => "200");
            			echo json_encode($data);die();
            		}
            		mysqli_close($conexion);	
            	} else {
            		$sql1 = "INSERT INTO folios_g(fecha,negocio,t_solicitud,producto,poliza,fgnp,moneda_apn,moneda_api,prima,contratante,prioridad,motivo,comentario,estado,agente,usuario)
            		values ('$fec1','$neg','$tso','$tsn','---','---','$mapn','$mapi','$prima','$con','$pri','---','$com','$est',(select id from datos_agente where nombre = '$age'),'$id')";

            		$insert = $conexion->query($sql1);
            		if(!empty($_FILES) && $insert){
            			$data = array(
            				'mensaje' => "Archivos Guardados : ",
            				'status' => "200");
            			echo json_encode($data);die();
            		}
            		mysqli_close($conexion);
            	}
            }else if($tso == "ALTA POLIZA INTERNACIONAL"){
            	if($pri == "ALTA"){
            		$sql = "INSERT INTO folios_g(fecha,negocio,t_solicitud,producto,poliza,fgnp,moneda_apn,moneda_api,prima,contratante,prioridad,motivo,comentario,estado,agente,usuario)
            		values ('$fec1','$neg','$tso','$tsi','---','---','$mapn','$mapi','$prima1','$con','$pri','$mot','$com','$est',(select id from datos_agente where nombre = '$age'),'$id')";

            		$insert = $conexion->query($sql);
            		if(!empty($_FILES) && $insert){
            			$data = array(
            				'mensaje' => "Archivos Guardados : ",
            				'status' => "200");
            			echo json_encode($data);die();
            		}
            		mysqli_close($conexion);	
            	} else {
            		$sql1 = "INSERT INTO folios_g(fecha,negocio,t_solicitud,producto,poliza,fgnp,moneda_apn,moneda_api,prima,contratante,prioridad,motivo,comentario,estado,agente,usuario)
            		values ('$fec1','$neg','$tso','$tsi','---','---','$mapn','$mapi','$prima1','$con','$pri','---','$com','$est',(select id from datos_agente where nombre = '$age'),'$id')";

            		$insert = $conexion->query($sql1);
            		if(!empty($_FILES) && $insert){
            			$data = array(
            				'mensaje' => "Archivos Guardados : ",
            				'status' => "200");
            			echo json_encode($data);die();
            		}
            		mysqli_close($conexion);
            	} 
            }else if($tso == "MOVIMIENTOS"){
            	if($pri == "ALTA"){
            		$sql = "INSERT INTO folios_g(fecha,negocio,t_solicitud,producto,poliza,fgnp,prima,contratante,prioridad,motivo,comentario,estado,agente,usuario)
            		values ('$fec1','$neg','$tso','$mov','$pol','---','---','$con','$pri','$mot','$com','$est',(select id from datos_agente where nombre = '$age'),'$id')";

            		$insert = $conexion->query($sql);
            		if(!empty($_FILES) && $insert){
            			$data = array(
            				'mensaje' => "Archivos Guardados : ",
            				'status' => "200");
            			echo json_encode($data);die();
            		}
            		mysqli_close($conexion);
            	} else {
            		$sql1 = "INSERT INTO folios_g(fecha,negocio,t_solicitud,producto,poliza,fgnp,prima,contratante,prioridad,motivo,comentario,estado,agente,usuario)
            		values ('$fec1','$neg','$tso','$mov','$pol','---','---','$con','$pri','---','$com','$est',(select id from datos_agente where nombre = '$age'),'$id')";

            		$insert = $conexion->query($sql1);
            		if(!empty($_FILES) && $insert){
            			$data = array(
            				'mensaje' => "Archivos Guardados : ",
            				'status' => "200");
            			echo json_encode($data);die();
            		}
            		mysqli_close($conexion);
            	}

            }

    	}
    }
