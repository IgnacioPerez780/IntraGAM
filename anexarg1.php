<?php 

	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'app/conexion.php';
    $conexion = conexion();

    date_default_timezone_set("America/Mexico_City");
    $time = time();
    $fecha_actual = date("Y-m-d H:i:s",$time);
    $tipoa = "ARCHIVO";
    $contador = "1";
    //$estado = "";

    $files_post = $_FILES['file'];
    $idf = $_POST['idf'];
    $tipo = $_POST['tipo'];
    $nomusuario = $_POST['nomusuario'];

    $carpeta = "/archivos_g/";

    $est = "select estado, agente from folios_g where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0]."||".
                       $vere[1];

                $cont = "insert into notificaciones1_g(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$vere[0];','$fecha_actual','$tipoa','$contador','$vere[1];')";
            $resultc = mysqli_query($conexion,$cont);

            }


    //*************************************************CONDICION DE MOVIMIENTO*******************************************************

	$sql = " select t_solicitud from folios_g where id = '$idf'";
	$result = mysqli_query($conexion,$sql);
	while($ver = mysqli_fetch_row($result)){
		$datos = $ver[0];

		if($datos=='MOVIMIENTOS'){

			if($tipo == 'articulo_492'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'articulo_492_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'articulo_492v1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'articulo_492v2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'articulo_492v3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'articulo_492v4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'articulo_492v5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'articulo_492v6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'articulo_492v7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'articulo_492v8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'articulo_492v9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'articulo_492_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'articulo_492_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'articulo_492v1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'articulo_492v1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'articulo_492v2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'articulo_492v2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'articulo_492v3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'articulo_492v3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'articulo_492v4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'articulo_492v4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'articulo_492v5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'articulo_492v5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'articulo_492v6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'articulo_492v6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'articulo_492v7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'articulo_492v7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'articulo_492v8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'articulo_492v8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'articulo_492v9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'articulo_492v9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'articulo_492v10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'articulo_492v10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1

	        //******************CIERRE DE ARTICULO 492*********************************   
	    	}else if($tipo == 'caratula_de_otra_compañia_aseguradora'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'caratula_de_otra_compañia_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'caratula_de_otra_compañiav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'caratula_de_otra_compañiav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'caratula_de_otra_compañiav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'caratula_de_otra_compañiav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'caratula_de_otra_compañiav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'caratula_de_otra_compañiav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'caratula_de_otra_compañiav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'caratula_de_otra_compañiav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'caratula_de_otra_compañiav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'caratula_de_otra_compañia_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'caratula_de_otra_compañia_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CARATULA DE OTRA COMPAÑIA*********************************   
	    	}else if($tipo == 'carta_aclaratoria'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'carta_aclaratoria_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'carta_aclaratoriav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'carta_aclaratoriav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'carta_aclaratoriav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'carta_aclaratoriav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'carta_aclaratoriav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'carta_aclaratoriav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'carta_aclaratoriav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'carta_aclaratoriav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'carta_aclaratoriav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'carta_aclaratoria_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'carta_aclaratoria_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'carta_aclaratoriav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'carta_aclaratoriav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'carta_aclaratoriav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'carta_aclaratoriav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'carta_aclaratoriav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'carta_aclaratoriav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'carta_aclaratoriav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'carta_aclaratoriav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'carta_aclaratoriav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'carta_aclaratoriav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'carta_aclaratoriav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'carta_aclaratoriav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'carta_aclaratoriav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'carta_aclaratoriav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'carta_aclaratoriav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'carta_aclaratoriav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'carta_aclaratoriav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'carta_aclaratoriav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'carta_aclaratoriav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'carta_aclaratoriav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CARTA ACLARATORIA*********************************   
	    	}else if($tipo == 'cat'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'cat_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'catv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'catv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'catv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'catv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'catv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'catv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'catv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'catv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'catv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'cat_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'cat_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'catv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'catv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'catv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'catv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'catv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'catv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'catv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'catv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'catv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'catv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'catv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'catv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'catv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'catv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'catv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'catv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'catv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'catv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'catv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'catv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE ARTICULO CAT*********************************   
	    	}else if($tipo == 'comprobante_salida_de_empresa'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'comprobante_salida_de_empresa_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'comprobante_salida_de_empresav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'comprobante_salida_de_empresav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'comprobante_salida_de_empresav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'comprobante_salida_de_empresav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'comprobante_salida_de_empresav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'comprobante_salida_de_empresav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'comprobante_salida_de_empresav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'comprobante_salida_de_empresav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'comprobante_salida_de_empresav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'comprobante_salida_de_empresa_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'comprobante_salida_de_empresa_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE SALIDA DE EMPRESA*********************************   
	    	}else if($tipo == 'cuestionario_ocupacion_o_deportivo'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'cuestionario_ocupacion_o_deportivo_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivo_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivo_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CUESTIONARIO DE OCUPACION*********************************   
	    	}else if($tipo == 'documentos_adicionales'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'documentos_adicionales_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'documentos_adicionalesv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'documentos_adicionalesv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'documentos_adicionalesv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'documentos_adicionalesv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'documentos_adicionalesv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'documentos_adicionalesv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'documentos_adicionalesv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'documentos_adicionalesv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'documentos_adicionalesv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'documentos_adicionales_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'documentos_adicionales_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'documentos_adicionalesv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'documentos_adicionalesv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'documentos_adicionalesv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'documentos_adicionalesv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'documentos_adicionalesv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'documentos_adicionalesv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'documentos_adicionalesv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'documentos_adicionalesv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'documentos_adicionalesv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'documentos_adicionalesv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'documentos_adicionalesv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'documentos_adicionalesv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'documentos_adicionalesv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'documentos_adicionalesv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'documentos_adicionalesv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'documentos_adicionalesv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'documentos_adicionalesv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'documentos_adicionalesv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'documentos_adicionalesv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'documentos_adicionalesv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE DOCUMENTOS ADICIONALES*********************************   
	    	}else if($tipo == 'formato_de_traspaso'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'formato_de_traspaso_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'formato_de_traspasov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'formato_de_traspasov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'formato_de_traspasov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'formato_de_traspasov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'formato_de_traspasov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'formato_de_traspasov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'formato_de_traspasov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'formato_de_traspasov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'formato_de_traspasov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'formato_de_traspaso_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'formato_de_traspaso_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'formato_de_traspasov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'formato_de_traspasov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'formato_de_traspasov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'formato_de_traspasov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'formato_de_traspasov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'formato_de_traspasov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'formato_de_traspasov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'formato_de_traspasov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'formato_de_traspasov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'formato_de_traspasov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'formato_de_traspasov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'formato_de_traspasov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'formato_de_traspasov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'formato_de_traspasov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'formato_de_traspasov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'formato_de_traspasov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'formato_de_traspasov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'formato_de_traspasov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'formato_de_traspasov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'formato_de_traspasov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE FORMATO DE TRASPASO*********************************   
	    	}else if($tipo == 'h107'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'h107_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'h107v1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'h107v2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'h107v3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'h107v4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'h107v5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'h107v6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'h107v7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'h107v8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'h107v9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'h107_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'h107_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'h107v1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'h107v1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'h107v2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'h107v2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'h107v3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'h107v3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'h107v4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'h107v4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'h107v5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'h107v5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'h107v6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'h107v6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'h107v7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'h107v7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'h107v8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'h107v8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'h107v9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'h107v9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'h107v10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'h107v10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELh107
	    	//******************CIERRE DE H107*********************************   
	    	}else if($tipo == 'solicitud_de_movimientos_conexion'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'solicitud_de_movimientos_conexion_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'solicitud_de_movimientos_conexionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'solicitud_de_movimientos_conexionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'solicitud_de_movimientos_conexionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'solicitud_de_movimientos_conexionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'solicitud_de_movimientos_conexionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'solicitud_de_movimientos_conexionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'solicitud_de_movimientos_conexionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'solicitud_de_movimientos_conexionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'solicitud_de_movimientos_conexionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'solicitud_de_movimientos_conexion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'solicitud_de_movimientos_conexion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'solicitud_de_movimientos_conexionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'solicitud_de_movimientos_conexionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE SOLICITUD DE MOVIMIENTOS*********************************
	    	}else if($tipo == 'caratula_poliza'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'caratula_poliza_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'caratula_polizav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'caratula_polizav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'caratula_polizav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'caratula_polizav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'caratula_polizav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'caratula_polizav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'caratula_polizav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'caratula_polizav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'caratula_polizav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'caratula_poliza_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'caratula_poliza_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'caratula_polizav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'caratula_polizav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'caratula_polizav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'caratula_polizav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'caratula_polizav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'caratula_polizav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'caratula_polizav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'caratula_polizav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'caratula_polizav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'caratula_polizav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'caratula_polizav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'caratula_polizav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'caratula_polizav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'caratula_polizav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'caratula_polizav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'caratula_polizav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'caratula_polizav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'caratula_polizav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'caratula_polizav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'caratula_polizav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CARATULA DE POLIZA*********************************	
	    	}else if($tipo == 'recibo'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'recibo_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'recibov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'recibov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'recibov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'recibov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'recibov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'recibov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'recibov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'recibov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'recibov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'recibo_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'recibo_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'recibov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'recibov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'recibov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'recibov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'recibov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'recibov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'recibov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'recibov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'recibov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'recibov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'recibov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'recibov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'recibov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'recibov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'recibov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'recibov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'recibov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'recibov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'recibov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'recibov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE RECIBO*********************************
	    	}else if($tipo == 'factura'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'factura_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'facturav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'facturav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'facturav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'facturav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'facturav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'facturav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'facturav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'facturav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'facturav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'factura_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'factura_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'facturav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'facturav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'facturav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'facturav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'facturav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'facturav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'facturav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'facturav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'facturav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'facturav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'facturav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'facturav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'facturav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'facturav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'facturav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'facturav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'facturav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'facturav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'facturav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'facturav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE FACTURA*********************************
	    	}else if($tipo == 'solicitudes_adicionales'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'solicitudes_adicionales_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'solicitudes_adicionalesv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'solicitudes_adicionalesv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'solicitudes_adicionalesv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'solicitudes_adicionalesv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'solicitudes_adicionalesv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'solicitudes_adicionalesv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'solicitudes_adicionalesv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'solicitudes_adicionalesv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'solicitudes_adicionalesv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'solicitudes_adicionales_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'solicitudes_adicionales_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'solicitudes_adicionalesv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'solicitudes_adicionalesv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1    		
	    	}//******************CIERRE DE SOLICITUDES ADICIONALES*********************************

		}else{//CIERRE DEL IF DE LA LINEA 31 Y SE DA PASO A POLIZAS NACIONALES E INTERNACIONALES

			if($tipo == 'articulo_492'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'articulo_492_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'articulo_492v1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'articulo_492v2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'articulo_492v3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'articulo_492v4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'articulo_492v5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'articulo_492v6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'articulo_492v7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'articulo_492v8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'articulo_492v9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'articulo_492_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'articulo_492_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'articulo_492v1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'articulo_492v1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'articulo_492v2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'articulo_492v2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'articulo_492v3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'articulo_492v3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'articulo_492v4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'articulo_492v4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'articulo_492v5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'articulo_492v5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'articulo_492v6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'articulo_492v6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'articulo_492v7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'articulo_492v7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'articulo_492v8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'articulo_492v8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'articulo_492v9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'articulo_492v9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'articulo_492v10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'articulo_492v10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1

	        //******************CIERRE DE ARTICULO 492*********************************   
	    	}else if($tipo == 'caratula_de_otra_compañia_aseguradora'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'caratula_de_otra_compañia_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'caratula_de_otra_compañiav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'caratula_de_otra_compañiav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'caratula_de_otra_compañiav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'caratula_de_otra_compañiav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'caratula_de_otra_compañiav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'caratula_de_otra_compañiav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'caratula_de_otra_compañiav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'caratula_de_otra_compañiav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'caratula_de_otra_compañiav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'caratula_de_otra_compañia_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'caratula_de_otra_compañia_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'caratula_de_otra_compañiav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'caratula_de_otra_compañiav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'caratula_de_otra_compañiav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'caratula_de_otra_compañiav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CARATULA DE OTRA COMPAÑIA*********************************   
	    	}else if($tipo == 'carta_aclaratoria'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'carta_aclaratoria_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'carta_aclaratoriav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'carta_aclaratoriav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'carta_aclaratoriav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'carta_aclaratoriav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'carta_aclaratoriav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'carta_aclaratoriav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'carta_aclaratoriav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'carta_aclaratoriav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'carta_aclaratoriav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'carta_aclaratoria_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'carta_aclaratoria_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'carta_aclaratoriav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'carta_aclaratoriav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'carta_aclaratoriav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'carta_aclaratoriav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'carta_aclaratoriav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'carta_aclaratoriav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'carta_aclaratoriav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'carta_aclaratoriav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'carta_aclaratoriav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'carta_aclaratoriav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'carta_aclaratoriav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'carta_aclaratoriav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'carta_aclaratoriav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'carta_aclaratoriav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'carta_aclaratoriav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'carta_aclaratoriav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'carta_aclaratoriav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'carta_aclaratoriav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'carta_aclaratoriav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'carta_aclaratoriav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CARTA ACLARATORIA*********************************   
	    	}else if($tipo == 'cotizacion'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'cotizacion_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'cotizacionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'cotizacionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'cotizacionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'cotizacionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'cotizacionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'cotizacionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'cotizacionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'cotizacionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'cotizacionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'cotizacion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'cotizacion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'cotizacionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'cotizacionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'cotizacionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'cotizacionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'cotizacionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'cotizacionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'cotizacionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'cotizacionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'cotizacionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'cotizacionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'cotizacionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'cotizacionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'cotizacionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'cotizacionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'cotizacionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'cotizacionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'cotizacionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'cotizacionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'cotizacionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'cotizacionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE ARTICULO COTIZACION*********************************   
	    	}else if($tipo == 'comprobante_salida_de_empresa'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'comprobante_salida_de_empresa_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'comprobante_salida_de_empresav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'comprobante_salida_de_empresav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'comprobante_salida_de_empresav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'comprobante_salida_de_empresav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'comprobante_salida_de_empresav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'comprobante_salida_de_empresav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'comprobante_salida_de_empresav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'comprobante_salida_de_empresav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'comprobante_salida_de_empresav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'comprobante_salida_de_empresa_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'comprobante_salida_de_empresa_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'comprobante_salida_de_empresav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'comprobante_salida_de_empresav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'comprobante_salida_de_empresav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'comprobante_salida_de_empresav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE SALIDA DE EMPRESA*********************************   
	    	}else if($tipo == 'cuestionario_ocupacion_o_deportivo'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'cuestionario_ocupacion_o_deportivo_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'cuestionario_ocupacion_o_deportivov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivo_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivo_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'cuestionario_ocupacion_o_deportivov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'cuestionario_ocupacion_o_deportivov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CUESTIONARIO DE OCUPACION*********************************   
	    	}else if($tipo == 'declaracion_de_salud'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'declaracion_de_salud_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'declaracion_de_saludv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'declaracion_de_saludv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'declaracion_de_saludv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'declaracion_de_saludv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'declaracion_de_saludv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'declaracion_de_saludv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'declaracion_de_saludv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'declaracion_de_saludv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'declaracion_de_saludv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'declaracion_de_salud_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'declaracion_de_salud_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'declaracion_de_saludv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'declaracion_de_saludv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'declaracion_de_saludv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'declaracion_de_saludv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'declaracion_de_saludv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'declaracion_de_saludv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'declaracion_de_saludv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'declaracion_de_saludv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'declaracion_de_saludv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'declaracion_de_saludv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'declaracion_de_saludv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'declaracion_de_saludv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'declaracion_de_saludv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'declaracion_de_saludv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'declaracion_de_saludv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'declaracion_de_saludv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'declaracion_de_saludv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'declaracion_de_saludv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'declaracion_de_saludv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'declaracion_de_saludv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE DECLARACION DE SALUD*********************************   
	    	}else if($tipo == 'formato_alta_grupo'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'formato_alta_grupo_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'formato_alta_grupov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'formato_alta_grupov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'formato_alta_grupov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'formato_alta_grupov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'formato_alta_grupov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'formato_alta_grupov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'formato_alta_grupov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'formato_alta_grupov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'formato_alta_grupov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'formato_alta_grupo_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'formato_alta_grupo_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'formato_alta_grupov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'formato_alta_grupov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'formato_alta_grupov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'formato_alta_grupov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'formato_alta_grupov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'formato_alta_grupov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'formato_alta_grupov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'formato_alta_grupov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'formato_alta_grupov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'formato_alta_grupov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'formato_alta_grupov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'formato_alta_grupov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'formato_alta_grupov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'formato_alta_grupov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'formato_alta_grupov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'formato_alta_grupov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'formato_alta_grupov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'formato_alta_grupov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'formato_alta_grupov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'formato_alta_grupov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE FORMATO ALTA GRUPO*********************************   
	    	}else if($tipo == 'identificacion'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'identificacion_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'identificacionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'identificacionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'identificacionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'identificacionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'identificacionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'identificacionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'identificacionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'identificacionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'identificacionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'identificacion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'identificacion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'identificacionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'identificacionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'identificacionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'identificacionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'identificacionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'identificacionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'identificacionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'identificacionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'identificacionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'identificacionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'identificacionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'identificacionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'identificacionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'identificacionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'identificacionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'identificacionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'identificacionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'identificacionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'identificacionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'identificacionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELh107
	    	//******************CIERRE DE IDENTIFICACION*********************************   
	    	}else if($tipo == 'informacion_medica'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'informacion_medica_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'informacion_medicav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'informacion_medicav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'informacion_medicav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'informacion_medicav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'informacion_medicav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'informacion_medicav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'informacion_medicav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'informacion_medicav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'informacion_medicav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'informacion_medica_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'informacion_medica_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'informacion_medicav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'informacion_medicav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'informacion_medicav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'informacion_medicav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'informacion_medicav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'informacion_medicav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'informacion_medicav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'informacion_medicav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'informacion_medicav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'informacion_medicav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'informacion_medicav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'informacion_medicav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'informacion_medicav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'informacion_medicav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'informacion_medicav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'informacion_medicav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'informacion_medicav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'informacion_medicav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'informacion_medicav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'informacion_medicav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	        //******************CIERRE DE INFORMACION MEDICA*********************************     
	    	}else if($tipo == 'solicitud_gmm'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'solicitud_gmm_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'solicitud_gmmv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'solicitud_gmmv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'solicitud_gmmv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'solicitud_gmmv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'solicitud_gmmv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'solicitud_gmmv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'solicitud_gmmv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'solicitud_gmmv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'solicitud_gmmv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'solicitud_gmm_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'solicitud_gmm_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'solicitud_gmmv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'solicitud_gmmv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'solicitud_gmmv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'solicitud_gmmv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'solicitud_gmmv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'solicitud_gmmv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'solicitud_gmmv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'solicitud_gmmv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'solicitud_gmmv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'solicitud_gmmv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'solicitud_gmmv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'solicitud_gmmv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'solicitud_gmmv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'solicitud_gmmv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'solicitud_gmmv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'solicitud_gmmv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'solicitud_gmmv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'solicitud_gmmv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'solicitud_gmmv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'solicitud_gmmv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE SOLICITUD DE MOVIMIENTOS*********************************
	    	}else if($tipo == 'caratula_poliza'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'caratula_poliza_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'caratula_polizav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'caratula_polizav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'caratula_polizav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'caratula_polizav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'caratula_polizav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'caratula_polizav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'caratula_polizav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'caratula_polizav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'caratula_polizav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'caratula_poliza_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'caratula_poliza_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'caratula_polizav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'caratula_polizav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'caratula_polizav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'caratula_polizav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'caratula_polizav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'caratula_polizav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'caratula_polizav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'caratula_polizav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'caratula_polizav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'caratula_polizav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'caratula_polizav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'caratula_polizav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'caratula_polizav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'caratula_polizav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'caratula_polizav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'caratula_polizav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'caratula_polizav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'caratula_polizav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'caratula_polizav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'caratula_polizav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE CARATULA DE POLIZA*********************************	
	    	}else if($tipo == 'recibo'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'recibo_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'recibov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'recibov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'recibov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'recibov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'recibov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'recibov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'recibov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'recibov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'recibov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'recibo_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'recibo_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'recibov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'recibov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'recibov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'recibov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'recibov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'recibov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'recibov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'recibov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'recibov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'recibov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'recibov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'recibov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'recibov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'recibov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'recibov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'recibov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'recibov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'recibov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'recibov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'recibov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE RECIBO*********************************
	    	}else if($tipo == 'factura'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'factura_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'facturav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'facturav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'facturav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'facturav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'facturav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'facturav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'facturav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'facturav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'facturav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'factura_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'factura_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'facturav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'facturav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'facturav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'facturav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'facturav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'facturav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'facturav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'facturav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'facturav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'facturav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'facturav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'facturav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'facturav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'facturav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'facturav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'facturav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'facturav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'facturav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'facturav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'facturav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1
	    	//******************CIERRE DE FACTURA*********************************
	    	}else if($tipo == 'solicitudes_adicionales'){
	    		$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_g/".'solicitudes_adicionales_'.$idf.'.pdf';
		        $arch1 = "../archivos_g/".'solicitudes_adicionalesv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_g/".'solicitudes_adicionalesv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_g/".'solicitudes_adicionalesv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_g/".'solicitudes_adicionalesv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_g/".'solicitudes_adicionalesv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_g/".'solicitudes_adicionalesv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_g/".'solicitudes_adicionalesv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_g/".'solicitudes_adicionalesv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_g/".'solicitudes_adicionalesv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_g/".'solicitudes_adicionales_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_g/".'solicitudes_adicionales_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_g/".'solicitudes_adicionalesv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_g/".'solicitudes_adicionalesv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_g/".'solicitudes_adicionalesv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_g/".'solicitudes_adicionalesv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_g WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_g/".'solicitudes_adicionalesv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_g/".'solicitudes_adicionalesv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_g (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                                    $result = $conexion->query($sql);
	                                                                                                        if($result){
	                                                                                                            $data = array(
	                                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                                'status' => "200");
	                                                                                                                 echo json_encode($data);die();
	                                                                                                        }
	                                                                                                }
	                                                                                            }
	                                                                                    }//CIERRE DEL ELSE V10
	                                                                            }//CIEREE DEL ELSE VERSION 9
	                                                                    }//CIERRE DEL ELSE VERSION 8
	                                                            }//CIERRE DEL ELSE VERSION 7
	                                                    }//CIERRE DEL ELSE VERSION 6
	                                            }//CIERRE DEL ELSE VERSION 5
	                                    }//CIERRE DEL ELSE VERSION 4
	                            }//CIERRE DEL ELSE VERSION 3
	                    }//CIERRE DEL ELSE VERSION 2
	            }//CIERRE DEL ELSE VERSION 1    		
	    	}//******************CIERRE DE SOLICITUDES ADICIONALES********************************* 

		}//CIERRE DEL ELSE DE LOS ARCHIVOS PARA NACIONALES, INTERNACIONES DE LA LINEA 2371
	}//CIERRE DEL WHILE DE LA LINEA 28


?>