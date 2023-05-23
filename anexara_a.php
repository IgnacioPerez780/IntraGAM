<?php 
	
	//ESTAS LINEAS SON PARA EL AGENTE
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

    $carpeta = "/archivos_a/";
    
    $est = "select estado from folios_a where id='$idf'";
	$re = mysqli_query($conexion,$est);
		while($vere = mysqli_fetch_row($re)){
	        $ess = $vere[0];

	        $cont = "INSERT INTO notificaciones_a(folio,usuario,estado,fecha,tipo,contador)
	                                    VALUES
	                                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador')";
	        $resultc = mysqli_query($conexion,$cont);

	    }

    if($tipo == 'acta_constitutiva'){
    	$files = array();
	   	$files_count = count($files_post['name']);
       	$file_keys = array_keys($files_post);

       	for($i=0; $i < $files_count; $i++){
		    foreach($file_keys as $key){
		        $files[$i][$key] = $files_post[$key][$i];
		    }
		}

		$arch = "../archivos_a/".'acta_constitutiva_'.$idf.'.pdf';
		$arch1 = "../archivos_a/".'acta_constitutivav1_'.$idf.'.pdf';
		$arch2 = "../archivos_a/".'acta_constitutivav2_'.$idf.'.pdf';
		$arch3 = "../archivos_a/".'acta_constitutivav3_'.$idf.'.pdf';
		$arch4 = "../archivos_a/".'acta_constitutivav4_'.$idf.'.pdf';
		$arch5 = "../archivos_a/".'acta_constitutivav5_'.$idf.'.pdf';
		$arch6 = "../archivos_a/".'acta_constitutivav6_'.$idf.'.pdf';
		$arch7 = "../archivos_a/".'acta_constitutivav7_'.$idf.'.pdf';
		$arch8 = "../archivos_a/".'acta_constitutivav8_'.$idf.'.pdf';
		$arch9 = "../archivos_a/".'acta_constitutivav9_'.$idf.'.pdf';

		$sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'acta_constitutiva_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'acta_constitutiva_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'acta_constitutivav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'acta_constitutivav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'acta_constitutivav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'acta_constitutivav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'acta_constitutivav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'acta_constitutivav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'acta_constitutivav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'acta_constitutivav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'acta_constitutivav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'acta_constitutivav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'acta_constitutivav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'acta_constitutivav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'acta_constitutivav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'acta_constitutivav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'acta_constitutivav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'acta_constitutivav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'acta_constitutivav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'acta_constitutivav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'acta_constitutivav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'acta_constitutivav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
    //***************************CIERRE DE ACTA CONSTITUTIVA****************************
    }else if($tipo == 'carta_cancelacion'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'carta_cancelacion_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'carta_cancelacionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'carta_cancelacionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'carta_cancelacionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'carta_cancelacionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'carta_cancelacionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'carta_cancelacionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'carta_cancelacionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'carta_cancelacionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'carta_cancelacionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'carta_cancelacion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'carta_cancelacion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'carta_cancelacionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'carta_cancelacionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'carta_cancelacionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'carta_cancelacionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'carta_cancelacionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'carta_cancelacionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'carta_cancelacionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'carta_cancelacionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'carta_cancelacionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'carta_cancelacionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'carta_cancelacionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'carta_cancelacionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'carta_cancelacionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'carta_cancelacionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'carta_cancelacionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'carta_cancelacionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'carta_cancelacionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'carta_cancelacionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'carta_cancelacionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'carta_cancelacionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
    //***************************CIERRE DE CARTA CANCELACION****************************	
    }else if($tipo == 'carta_peticion'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'carta_peticion_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'carta_peticionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'carta_peticionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'carta_peticionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'carta_peticionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'carta_peticionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'carta_peticionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'carta_peticionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'carta_peticionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'carta_peticionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'carta_peticion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'carta_peticion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'carta_peticionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'carta_peticionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'carta_peticionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'carta_peticionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'carta_peticionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'carta_peticionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'carta_peticionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'carta_peticionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'carta_peticionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'carta_peticionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'carta_peticionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'carta_peticionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'carta_peticionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'carta_peticionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'carta_peticionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'carta_peticionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'carta_peticionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'carta_peticionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'carta_peticionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'carta_peticionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
    //***************************CIERRE DE CARTA PETICION****************************
    }else if($tipo == 'cianne_de_cotizacion'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'cianne_de_cotizacion_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'cianne_de_cotizacionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'cianne_de_cotizacionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'cianne_de_cotizacionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'cianne_de_cotizacionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'cianne_de_cotizacionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'cianne_de_cotizacionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'cianne_de_cotizacionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'cianne_de_cotizacionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'cianne_de_cotizacionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'cianne_de_cotizacion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'cianne_de_cotizacion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'cianne_de_cotizacionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'cianne_de_cotizacionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'cianne_de_cotizacionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'cianne_de_cotizacionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'cianne_de_cotizacionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'cianne_de_cotizacionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'cianne_de_cotizacionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'cianne_de_cotizacionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'cianne_de_cotizacionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'cianne_de_cotizacionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'cianne_de_cotizacionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'cianne_de_cotizacionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'cianne_de_cotizacionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'cianne_de_cotizacionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'cianne_de_cotizacionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'cianne_de_cotizacionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'cianne_de_cotizacionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'cianne_de_cotizacionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'cianne_de_cotizacionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'cianne_de_cotizacionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE CIANNE DE COTIZACION*********************************  
    }else if($tipo == 'comprobante_de_domicilio'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'comprobante_de_domicilio_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'comprobante_de_domiciliov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'comprobante_de_domiciliov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'comprobante_de_domiciliov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'comprobante_de_domiciliov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'comprobante_de_domiciliov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'comprobante_de_domiciliov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'comprobante_de_domiciliov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'comprobante_de_domiciliov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'comprobante_de_domiciliov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'comprobante_de_domicilio_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'comprobante_de_domicilio_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'comprobante_de_domiciliov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'comprobante_de_domiciliov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'comprobante_de_domiciliov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'comprobante_de_domiciliov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'comprobante_de_domiciliov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'comprobante_de_domiciliov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'comprobante_de_domiciliov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'comprobante_de_domiciliov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'comprobante_de_domiciliov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'comprobante_de_domiciliov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'comprobante_de_domiciliov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'comprobante_de_domiciliov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'comprobante_de_domiciliov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'comprobante_de_domiciliov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'comprobante_de_domiciliov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'comprobante_de_domiciliov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'comprobante_de_domiciliov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'comprobante_de_domiciliov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'comprobante_de_domiciliov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'comprobante_de_domiciliov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE COMPROBANTE DE DOMICILIO*********************************  
    }else if($tipo == 'emision_de_poliza'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'emision_de_poliza_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'emision_de_polizav1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'emision_de_polizav2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'emision_de_polizav3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'emision_de_polizav4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'emision_de_polizav5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'emision_de_polizav6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'emision_de_polizav7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'emision_de_polizav8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'emision_de_polizav9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'emision_de_poliza_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'emision_de_poliza_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'emision_de_polizav1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'emision_de_polizav1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'emision_de_polizav2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'emision_de_polizav2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'emision_de_polizav3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'emision_de_polizav3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'emision_de_polizav4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'emision_de_polizav4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'emision_de_polizav5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'emision_de_polizav5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'emision_de_polizav6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'emision_de_polizav6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'emision_de_polizav7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'emision_de_polizav7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'emision_de_polizav8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'emision_de_polizav8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'emision_de_polizav9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'emision_de_polizav9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'emision_de_polizav10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'emision_de_polizav10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE EMISION DE POLIZA*********************************  
    }else if($tipo == 'factura_de_adaptaciones'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'factura_de_adaptaciones_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'factura_de_adaptacionesv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'factura_de_adaptacionesv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'factura_de_adaptacionesv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'factura_de_adaptacionesv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'factura_de_adaptacionesv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'factura_de_adaptacionesv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'factura_de_adaptacionesv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'factura_de_adaptacionesv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'factura_de_adaptacionesv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'factura_de_adaptaciones_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'factura_de_adaptaciones_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'factura_de_adaptacionesv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'factura_de_adaptacionesv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'factura_de_adaptacionesv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'factura_de_adaptacionesv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'factura_de_adaptacionesv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'factura_de_adaptacionesv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'factura_de_adaptacionesv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'factura_de_adaptacionesv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'factura_de_adaptacionesv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'factura_de_adaptacionesv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'factura_de_adaptacionesv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'factura_de_adaptacionesv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'factura_de_adaptacionesv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'factura_de_adaptacionesv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'factura_de_adaptacionesv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'factura_de_adaptacionesv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'factura_de_adaptacionesv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'factura_de_adaptacionesv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'factura_de_adaptacionesv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'factura_de_adaptacionesv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE FACTURA DE ADAPTACIONES*********************************  
    }else if($tipo == 'factura_del_vehiculo'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'factura_del_vehiculo_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'factura_del_vehiculov1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'factura_del_vehiculov2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'factura_del_vehiculov3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'factura_del_vehiculov4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'factura_del_vehiculov5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'factura_del_vehiculov6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'factura_del_vehiculov7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'factura_del_vehiculov8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'factura_del_vehiculov9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'factura_del_vehiculo_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'factura_del_vehiculo_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'factura_del_vehiculov1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'factura_del_vehiculov1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'factura_del_vehiculov2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'factura_del_vehiculov2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'factura_del_vehiculov3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'factura_del_vehiculov3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'factura_del_vehiculov4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'factura_del_vehiculov4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'factura_del_vehiculov5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'factura_del_vehiculov5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'factura_del_vehiculov6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'factura_del_vehiculov6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'factura_del_vehiculov7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'factura_del_vehiculov7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'factura_del_vehiculov8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'factura_del_vehiculov8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'factura_del_vehiculov9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'factura_del_vehiculov9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'factura_del_vehiculov10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'factura_del_vehiculov10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE FACTURA DEL VEHICULO*********************************  
    }else if($tipo == 'identificacion_oficial'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'identificacion_oficial_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'identificacion_oficialv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'identificacion_oficialv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'identificacion_oficialv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'identificacion_oficialv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'identificacion_oficialv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'identificacion_oficialv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'identificacion_oficialv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'identificacion_oficialv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'identificacion_oficialv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'identificacion_oficial_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'identificacion_oficial_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'identificacion_oficialv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'identificacion_oficialv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'identificacion_oficialv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'identificacion_oficialv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'identificacion_oficialv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'identificacion_oficialv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'identificacion_oficialv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'identificacion_oficialv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'identificacion_oficialv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'identificacion_oficialv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'identificacion_oficialv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'identificacion_oficialv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'identificacion_oficialv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'identificacion_oficialv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'identificacion_oficialv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'identificacion_oficialv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'identificacion_oficialv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'identificacion_oficialv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'identificacion_oficialv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'identificacion_oficialv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE IDENTIFICACION OFICIAL*********************************  
    }else if($tipo == 'pantallas_de_resolucion'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'pantallas_de_resolucion_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'pantallas_de_resolucionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'pantallas_de_resolucionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'pantallas_de_resolucionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'pantallas_de_resolucionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'pantallas_de_resolucionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'pantallas_de_resolucionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'pantallas_de_resolucionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'pantallas_de_resolucionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'pantallas_de_resolucionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'pantallas_de_resolucion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'pantallas_de_resolucion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'pantallas_de_resolucionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'pantallas_de_resolucionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'pantallas_de_resolucionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'pantallas_de_resolucionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'pantallas_de_resolucionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'pantallas_de_resolucionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'pantallas_de_resolucionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'pantallas_de_resolucionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'pantallas_de_resolucionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'pantallas_de_resolucionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'pantallas_de_resolucionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'pantallas_de_resolucionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'pantallas_de_resolucionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'pantallas_de_resolucionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'pantallas_de_resolucionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'pantallas_de_resolucionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'pantallas_de_resolucionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'pantallas_de_resolucionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'pantallas_de_resolucionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'pantallas_de_resolucionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE PANTALLAS DE RESOLUCION*********************************  
    }else if($tipo == 'poder_notarial'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'poder_notarial_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'poder_notarialv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'poder_notarialv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'poder_notarialv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'poder_notarialv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'poder_notarialv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'poder_notarialv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'poder_notarialv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'poder_notarialv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'poder_notarialv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'poder_notarial_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'poder_notarial_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'poder_notarialv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'poder_notarialv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'poder_notarialv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'poder_notarialv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'poder_notarialv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'poder_notarialv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'poder_notarialv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'poder_notarialv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'poder_notarialv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'poder_notarialv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'poder_notarialv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'poder_notarialv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'poder_notarialv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'poder_notarialv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'poder_notarialv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'poder_notarialv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'poder_notarialv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'poder_notarialv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'poder_notarialv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'poder_notarialv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE PODER NOTARIAL*********************************  
    }else if($tipo == 'rfc'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'rfc_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'rfcv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'rfcv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'rfcv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'rfcv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'rfcv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'rfcv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'rfcv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'rfcv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'rfcv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'rfc_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'rfc_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'rfcv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'rfcv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'rfcv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'rfcv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'rfcv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'rfcv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'rfcv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'rfcv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'rfcv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'rfcv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'rfcv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'rfcv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'rfcv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'rfcv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'rfcv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'rfcv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'rfcv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'rfcv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'rfcv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'rfcv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE RFC*********************************  
    }else if($tipo == 'tarjeta_de_circulacion'){
    	$files = array();
	    		$files_count = count($files_post['name']);
        		$file_keys = array_keys($files_post);

        		for($i=0; $i < $files_count; $i++){
		            foreach($file_keys as $key){
		                $files[$i][$key] = $files_post[$key][$i];
		            }
		        }

		        $arch = "../archivos_a/".'tarjeta_de_resolucion_'.$idf.'.pdf';
		        $arch1 = "../archivos_a/".'tarjeta_de_resolucionv1_'.$idf.'.pdf';
		        $arch2 = "../archivos_a/".'tarjeta_de_resolucionv2_'.$idf.'.pdf';
		        $arch3 = "../archivos_a/".'tarjeta_de_resolucionv3_'.$idf.'.pdf';
		        $arch4 = "../archivos_a/".'tarjeta_de_resolucionv4_'.$idf.'.pdf';
		        $arch5 = "../archivos_a/".'tarjeta_de_resolucionv5_'.$idf.'.pdf';
		        $arch6 = "../archivos_a/".'tarjeta_de_resolucionv6_'.$idf.'.pdf';
		        $arch7 = "../archivos_a/".'tarjeta_de_resolucionv7_'.$idf.'.pdf';
		        $arch8 = "../archivos_a/".'tarjeta_de_resolucionv8_'.$idf.'.pdf';
		        $arch9 = "../archivos_a/".'tarjeta_de_resolucionv9_'.$idf.'.pdf';

		        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch'";
        		$resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        		if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos_a/".'tarjeta_de_resolucion_'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos_a/".'tarjeta_de_resolucion_'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
	            }else{
	                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch1'";
	                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                    if(mysqli_num_rows($resi)==0){
	                        foreach($files as $fileID => $file){
	                            $fileContent = file_get_contents($file['tmp_name']);
	                            file_put_contents("archivos_a/".'tarjeta_de_resolucionv1_'.$idf.'.pdf',$fileContent);

	                            $nombref = "../archivos_a/".'tarjeta_de_resolucionv1_'.$idf.'.pdf';
	                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                            $result = $conexion->query($sql);
	                                if($result){
	                                    $data = array(
	                                        'mensaje' => "Archivo Guardado",
	                                        'status' => "200");
	                                         echo json_encode($data);die();
	                                }
	                        }
	                    }else{
	                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch2'";
	                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                            if(mysqli_num_rows($resi)==0){
	                                foreach($files as $fileID => $file){
	                                    $fileContent = file_get_contents($file['tmp_name']);
	                                    file_put_contents("archivos_a/".'tarjeta_de_resolucionv2_'.$idf.'.pdf',$fileContent);

	                                    $nombref = "../archivos_a/".'tarjeta_de_resolucionv2_'.$idf.'.pdf';
	                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                    $result = $conexion->query($sql);
	                                        if($result){
	                                            $data = array(
	                                                'mensaje' => "Archivo Guardado",
	                                                'status' => "200");
	                                                 echo json_encode($data);die();
	                                        }
	                                }
	                            }else{
	                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch3'";
	                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                    if(mysqli_num_rows($resi)==0){
	                                        foreach($files as $fileID => $file){
	                                            $fileContent = file_get_contents($file['tmp_name']);
	                                            file_put_contents("archivos_a/".'tarjeta_de_resolucionv3_'.$idf.'.pdf',$fileContent);

	                                            $nombref = "../archivos_a/".'tarjeta_de_resolucionv3_'.$idf.'.pdf';
	                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                            $result = $conexion->query($sql);
	                                                if($result){
	                                                    $data = array(
	                                                        'mensaje' => "Archivo Guardado",
	                                                        'status' => "200");
	                                                         echo json_encode($data);die();
	                                                }
	                                        }
	                                    }else{
	                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch4'";
	                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                            if(mysqli_num_rows($resi)==0){
	                                                foreach($files as $fileID => $file){
	                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                    file_put_contents("archivos_a/".'tarjeta_de_resolucionv4_'.$idf.'.pdf',$fileContent);

	                                                    $nombref = "../archivos_a/".'tarjeta_de_resolucionv4_'.$idf.'.pdf';
	                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                    $result = $conexion->query($sql);
	                                                        if($result){
	                                                            $data = array(
	                                                                'mensaje' => "Archivo Guardado",
	                                                                'status' => "200");
	                                                                 echo json_encode($data);die();
	                                                        }
	                                                }
	                                            }else{
	                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch5'";
	                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                    if(mysqli_num_rows($resi)==0){
	                                                        foreach($files as $fileID => $file){
	                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                            file_put_contents("archivos_a/".'tarjeta_de_resolucionv5_'.$idf.'.pdf',$fileContent);

	                                                            $nombref = "../archivos_a/".'tarjeta_de_resolucionv5_'.$idf.'.pdf';
	                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                            $result = $conexion->query($sql);
	                                                                if($result){
	                                                                    $data = array(
	                                                                        'mensaje' => "Archivo Guardado",
	                                                                        'status' => "200");
	                                                                         echo json_encode($data);die();
	                                                                }
	                                                        }
	                                                    }else{
	                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch6'";
	                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                            if(mysqli_num_rows($resi)==0){
	                                                                foreach($files as $fileID => $file){
	                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                    file_put_contents("archivos_a/".'tarjeta_de_resolucionv6_'.$idf.'.pdf',$fileContent);

	                                                                    $nombref = "../archivos_a/".'tarjeta_de_resolucionv6_'.$idf.'.pdf';
	                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                    $result = $conexion->query($sql);
	                                                                        if($result){
	                                                                            $data = array(
	                                                                                'mensaje' => "Archivo Guardado",
	                                                                                'status' => "200");
	                                                                                 echo json_encode($data);die();
	                                                                        }
	                                                                }
	                                                            }else{
	                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch7'";
	                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                    if(mysqli_num_rows($resi)==0){
	                                                                        foreach($files as $fileID => $file){
	                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                            file_put_contents("archivos_a/".'tarjeta_de_resolucionv7_'.$idf.'.pdf',$fileContent);

	                                                                            $nombref = "../archivos_a/".'tarjeta_de_resolucionv7_'.$idf.'.pdf';
	                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                            $result = $conexion->query($sql);
	                                                                                if($result){
	                                                                                    $data = array(
	                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                        'status' => "200");
	                                                                                         echo json_encode($data);die();
	                                                                                }
	                                                                        }
	                                                                    }else{
	                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch8'";
	                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                foreach($files as $fileID => $file){
	                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                    file_put_contents("archivos_a/".'tarjeta_de_resolucionv8_'.$idf.'.pdf',$fileContent);

	                                                                                    $nombref = "../archivos_a/".'tarjeta_de_resolucionv8_'.$idf.'.pdf';
	                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                    $result = $conexion->query($sql);
	                                                                                        if($result){
	                                                                                            $data = array(
	                                                                                                'mensaje' => "Archivo Guardado",
	                                                                                                'status' => "200");
	                                                                                                 echo json_encode($data);die();
	                                                                                        }
	                                                                                }
	                                                                            }else{
	                                                                                $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch9'";
	                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                    if(mysqli_num_rows($resi)==0){
	                                                                                        foreach($files as $fileID => $file){
	                                                                                            $fileContent = file_get_contents($file['tmp_name']);
	                                                                                            file_put_contents("archivos_a/".'tarjeta_de_resolucionv9_'.$idf.'.pdf',$fileContent);

	                                                                                            $nombref = "../archivos_a/".'tarjeta_de_resolucionv9_'.$idf.'.pdf';
	                                                                                            $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
	                                                                                            $result = $conexion->query($sql);
	                                                                                                if($result){
	                                                                                                    $data = array(
	                                                                                                        'mensaje' => "Archivo Guardado",
	                                                                                                        'status' => "200");
	                                                                                                         echo json_encode($data);die();
	                                                                                                }
	                                                                                        }
	                                                                                    }else{
	                                                                                        $sqli = "SELECT nombre FROM archivos_a WHERE fk_folio='$idf' and nombre='$arch10'";
	                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
	                                                                                            if(mysqli_num_rows($resi)==0){
	                                                                                                foreach($files as $fileID => $file){
	                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
	                                                                                                    file_put_contents("archivos_a/".'tarjeta_de_resolucionv10_'.$idf.'.pdf',$fileContent);

	                                                                                                    $nombref = "../archivos_a/".'tarjeta_de_resolucionv10_'.$idf.'.pdf';
	                                                                                                    $sql = "INSERT INTO archivos_a (nombre,fecha_creacion,fk_folio, nomusuario) VALUES ('$nombref','$fecha_actual', '$idf', '$nomusuario')";
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
	//******************CIERRE DE TARJETA DE CIRCULACION*********************************  
    }
?>