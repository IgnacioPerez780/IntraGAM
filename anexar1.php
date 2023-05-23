<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'app/conexion.php';
    $conexion = conexion();

    $time = time();
    $fecha_actual = date("Y-m-d H:i:s",$time);
    $tipoa = "ARCHIVO";
    $contador = "1";
    //$estado = "";

    $files_post = $_FILES['file'];
    $idf = $_POST['idf'];
    $tipo = $_POST['tipo'];
    $nomusuario = $_POST['nomusuario'];



    $carpeta = "/archivos/";


    //****************************************************************IDENTIFICACION**********************************************************************
    if($tipo=='identificacion'){//If IDENTIFICACION

        $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

        $files = array();
        $files_count = count($files_post['name']);
        $file_keys = array_keys($files_post);

        for($i=0; $i < $files_count; $i++){
            foreach($file_keys as $key){
                $files[$i][$key] = $files_post[$key][$i];
            }
        }

        $arch = "../archivos/".'identificacion'.$idf.'.pdf';
        $arch1 = "../archivos/".'identificacionv1_'.$idf.'.pdf';
        $arch2 = "../archivos/".'identificacionv2_'.$idf.'.pdf';
        $arch3 = "../archivos/".'identificacionv3_'.$idf.'.pdf';
        $arch4 = "../archivos/".'identificacionv4_'.$idf.'.pdf';
        $arch5 = "../archivos/".'identificacionv5_'.$idf.'.pdf';
        $arch6 = "../archivos/".'identificacionv6_'.$idf.'.pdf';
        $arch7 = "../archivos/".'identificacionv7_'.$idf.'.pdf';
        $arch8 = "../archivos/".'identificacionv8_'.$idf.'.pdf';
        $arch9 = "../archivos/".'identificacionv9_'.$idf.'.pdf';

        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'identificacion'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'identificacion'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'identificacionv1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'identificacionv1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'identificacionv2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'identificacionv2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'identificacionv3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'identificacionv3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'identificacionv4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'identificacionv4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'identificacionv5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'identificacionv5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'identificacionv6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'identificacionv6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'identificacionv7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'identificacionv7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'identificacionv8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'identificacionv8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'identificacionv9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'identificacionv9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'identificacionv10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'identificacionv10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio, nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************SOLICITUD*****************************************************
    }elseif($tipo=='solicitud'){

        $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

        $files = array();
        $files_count = count($files_post['name']);
        $file_keys = array_keys($files_post);

        for($i=0; $i < $files_count; $i++){
            foreach($file_keys as $key){
                $files[$i][$key] = $files_post[$key][$i];
            }
        }

        $arch = "../archivos/".'solicitud'.$idf.'.pdf';
        $arch1 = "../archivos/".'solicitudv1_'.$idf.'.pdf';
        $arch2 = "../archivos/".'solicitudv2_'.$idf.'.pdf';
        $arch3 = "../archivos/".'solicitudv3_'.$idf.'.pdf';
        $arch4 = "../archivos/".'solicitudv4_'.$idf.'.pdf';
        $arch5 = "../archivos/".'solicitudv5_'.$idf.'.pdf';
        $arch6 = "../archivos/".'solicitudv6_'.$idf.'.pdf';
        $arch7 = "../archivos/".'solicitudv7_'.$idf.'.pdf';
        $arch8 = "../archivos/".'solicitudv8_'.$idf.'.pdf';
        $arch9 = "../archivos/".'solicitudv9_'.$idf.'.pdf';

        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'solicitud'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'solicitud'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'solicitudv1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'solicitudv1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'solicitudv2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'solicitudv2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'solicitudv3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'solicitudv3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'solicitudv4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'solicitudv4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'solicitudv5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'solicitudv5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'solicitudv6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'solicitudv6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'solicitudv7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'solicitudv7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'solicitudv8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'solicitudv8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'solicitudv9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'solicitudv9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'solicitudv10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'solicitudv10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************comprobante_domicilio*****************************************************
        }elseif($tipo=='comprobante_domicilio'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'comprobante_domicilio'.$idf.'.pdf';
            $arch1 = "../archivos/".'comprobante_domiciliov1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'comprobante_domiciliov2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'comprobante_domiciliov3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'comprobante_domiciliov4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'comprobante_domiciliov5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'comprobante_domiciliov6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'comprobante_domiciliov7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'comprobante_domiciliov8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'comprobante_domiciliov9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'comprobante_domicilio'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'comprobante_domicilio'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'comprobante_domiciliov1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'comprobante_domiciliov1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'comprobante_domiciliov2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'comprobante_domiciliov2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'comprobante_domiciliov3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'comprobante_domiciliov3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'comprobante_domiciliov4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'comprobante_domiciliov4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'comprobante_domiciliov5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'comprobante_domiciliov5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'comprobante_domiciliov6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'comprobante_domiciliov6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'comprobante_domiciliov7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'comprobante_domiciliov7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'comprobante_domiciliov8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'comprobante_domiciliov8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'comprobante_domiciliov9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'comprobante_domiciliov9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'comprobante_domiciliov10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'comprobante_domiciliov10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************carta_extraprima*****************************************************
        }elseif($tipo=='carta_extraprima'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'carta_extraprima'.$idf.'.pdf';
            $arch1 = "../archivos/".'carta_extraprimav1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'carta_extraprimav2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'carta_extraprimav3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'carta_extraprimav4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'carta_extraprimav5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'carta_extraprimav6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'carta_extraprimav7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'carta_extraprimav8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'carta_extraprimav9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'carta_extraprima'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'carta_extraprima'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'carta_extraprimav1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'carta_extraprimav1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'carta_extraprimav2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'carta_extraprimav2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'carta_extraprimav3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'carta_extraprimav3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'carta_extraprimav4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'carta_extraprimav4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'carta_extraprimav5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'carta_extraprimav5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'carta_extraprimav6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'carta_extraprimav6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'carta_extraprimav7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'carta_extraprimav7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'carta_extraprimav8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'carta_extraprimav8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'carta_extraprimav9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'carta_extraprimav9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'carta_extraprimav10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'carta_extraprimav10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************carta_rechazo*****************************************************
        }elseif($tipo=='carta_rechazo'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'carta_rechazo'.$idf.'.pdf';
            $arch1 = "../archivos/".'carta_rechazov1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'carta_rechazov2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'carta_rechazov3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'carta_rechazov4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'carta_rechazov5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'carta_rechazov6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'carta_rechazov7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'carta_rechazov8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'carta_rechazov9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'carta_rechazo'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'carta_rechazo'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'carta_rechazov1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'carta_rechazov1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'carta_rechazov2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'carta_rechazov2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'carta_rechazov3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'carta_rechazov3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'carta_rechazov4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'carta_rechazov4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'carta_rechazov5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'carta_rechazov5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'carta_rechazov6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'carta_rechazov6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'carta_rechazov7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'carta_rechazov7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'carta_rechazov8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'carta_rechazov8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'carta_rechazov9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'carta_rechazov9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'carta_rechazov10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'carta_rechazov10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************cartas_adicionales*****************************************************
        }elseif($tipo=='cartas_adicionales'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'cartas_adicionales'.$idf.'.pdf';
            $arch1 = "../archivos/".'cartas_adicionalesv1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'cartas_adicionalesv2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'cartas_adicionalesv3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'cartas_adicionalesv4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'cartas_adicionalesv5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'cartas_adicionalesv6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'cartas_adicionalesv7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'cartas_adicionalesv8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'cartas_adicionalesv9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'cartas_adicionales'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'cartas_adicionales'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'cartas_adicionalesv1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'cartas_adicionalesv1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio) VALUES ('$nombref', '$idf')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'cartas_adicionalesv2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'cartas_adicionalesv2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'cartas_adicionalesv3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'cartas_adicionalesv3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'cartas_adicionalesv4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'cartas_adicionalesv4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'cartas_adicionalesv5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'cartas_adicionalesv5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'cartas_adicionalesv6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'cartas_adicionalesv6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'cartas_adicionalesv7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'cartas_adicionalesv7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'cartas_adicionalesv8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'cartas_adicionalesv8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'cartas_adicionalesv9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'cartas_adicionalesv9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'cartas_adicionalesv10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'cartas_adicionalesv10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************cuestionario_adicional_suscripcion*****************************************************
        }elseif($tipo=='cuestionario_adicional_suscripcion'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'cuestionario_adicional_cobranza'.$idf.'.pdf';
            $arch1 = "../archivos/".'cuestionario_adicional_cobranzav1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'cuestionario_adicional_cobranzav2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'cuestionario_adicional_cobranzav3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'cuestionario_adicional_cobranzav4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'cuestionario_adicional_cobranzav5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'cuestionario_adicional_cobranzav6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'cuestionario_adicional_cobranzav7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'cuestionario_adicional_cobranzav8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'cuestionario_adicional_cobranzav9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'cuestionario_adicional_cobranza'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'cuestionario_adicional_cobranza'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'cuestionario_adicional_cobranzav1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'cuestionario_adicional_cobranzav1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'cuestionario_adicional_cobranzav2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'cuestionario_adicional_cobranzav2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'cuestionario_adicional_cobranzav3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'cuestionario_adicional_cobranzav3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'cuestionario_adicional_cobranzav4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'cuestionario_adicional_cobranzav4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'cuestionario_adicional_cobranzav5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'cuestionario_adicional_cobranzav5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'cuestionario_adicional_cobranzav6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'cuestionario_adicional_cobranzav6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'cuestionario_adicional_cobranzav7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'cuestionario_adicional_cobranzav7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'cuestionario_adicional_cobranzav8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'cuestionario_adicional_cobranzav8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'cuestionario_adicional_cobranzav9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'cuestionario_adicional_cobranzav9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'cuestionario_adicional_cobranzav10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'cuestionario_adicional_cobranzav10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************formato_cobranza_electronica*****************************************************
        }elseif($tipo=='formato_cobranza_electronica'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'formato_cobranza_electronica'.$idf.'.pdf';
            $arch1 = "../archivos/".'formato_cobranza_electronicav1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'formato_cobranza_electronicav2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'formato_cobranza_electronicav3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'formato_cobranza_electronicav4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'formato_cobranza_electronicav5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'formato_cobranza_electronicav6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'formato_cobranza_electronicav7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'formato_cobranza_electronicav8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'formato_cobranza_electronicav9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'formato_cobranza_electronica'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'formato_cobranza_electronica'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'formato_cobranza_electronicav1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'formato_cobranza_electronicav1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'formato_cobranza_electronicav2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'formato_cobranza_electronicav2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'formato_cobranza_electronicav3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'formato_cobranza_electronicav3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'formato_cobranza_electronicav4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'formato_cobranza_electronicav4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'formato_cobranza_electronicav5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'formato_cobranza_electronicav5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'formato_cobranza_electronicav6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'formato_cobranza_electronicav6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'formato_cobranza_electronicav7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'formato_cobranza_electronicav7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'formato_cobranza_electronicav8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'formato_cobranza_electronicav8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'formato_cobranza_electronicav9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'formato_cobranza_electronicav9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'formato_cobranza_electronicav10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'formato_cobranza_electronicav10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************hoja_h107*****************************************************
        }elseif($tipo=='hoja_h107'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'hoja_h107'.$idf.'.pdf';
            $arch1 = "../archivos/".'hoja_h107v1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'hoja_h107v2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'hoja_h107v3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'hoja_h107v4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'hoja_h107v5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'hoja_h107v6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'hoja_h107v7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'hoja_h107v8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'hoja_h107v9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'hoja_h107'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'hoja_h107'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'hoja_h107v1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'hoja_h107v1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'hoja_h107v2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'hoja_h107v2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'hoja_h107v3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'hoja_h107v3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'hoja_h107v4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'hoja_h107v4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'hoja_h107v5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'hoja_h107v5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'hoja_h107v6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'hoja_h107v6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'hoja_h107v7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'hoja_h107v7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'hoja_h107v8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'hoja_h107v8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'hoja_h107v9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'hoja_h107v9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'hoja_h107v10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'hoja_h107v10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************solicitudes_adicionales*****************************************************
        }elseif($tipo=='solicitudes_adicionales'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'solicitudes_adicionales'.$idf.'.pdf';
            $arch1 = "../archivos/".'solicitudes_adicionalesv1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'solicitudes_adicionalesv2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'solicitudes_adicionalesv3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'solicitudes_adicionalesv4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'solicitudes_adicionalesv5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'solicitudes_adicionalesv6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'solicitudes_adicionalesv7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'solicitudes_adicionalesv8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'solicitudes_adicionalesv9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'solicitudes_adicionales'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'solicitudes_adicionales'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'solicitudes_adicionalesv1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'solicitudes_adicionalesv1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'solicitudes_adicionalesv2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'solicitudes_adicionalesv2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'solicitudes_adicionalesv3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'solicitudes_adicionalesv3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'solicitudes_adicionalesv4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'solicitudes_adicionalesv4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'solicitudes_adicionalesv5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'solicitudes_adicionalesv5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'solicitudes_adicionalesv6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'solicitudes_adicionalesv6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'solicitudes_adicionalesv7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'solicitudes_adicionalesv7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'solicitudes_adicionalesv8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'solicitudes_adicionalesv8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'solicitudes_adicionalesv9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'solicitudes_adicionalesv9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'solicitudes_adicionalesv10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'solicitudes_adicionalesv10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }


        //**************************************************************************caratula_poliza*****************************************************
        }elseif($tipo=='caratula_poliza'){

            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'caratula_poliza'.$idf.'.pdf';
            $arch1 = "../archivos/".'caratula_polizav1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'caratula_polizav2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'caratula_polizav3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'caratula_polizav4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'caratula_polizav5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'caratula_polizav6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'caratula_polizav7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'caratula_polizav8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'caratula_polizav9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'caratula_poliza'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'caratula_poliza'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'caratula_polizav1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'caratula_polizav1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'caratula_polizav2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'caratula_polizav2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'caratula_polizav3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'caratula_polizav3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'caratula_polizav4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'caratula_polizav4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'caratula_polizav5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'caratula_polizav5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'caratula_polizav6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'caratula_polizav6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'caratula_polizav7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'caratula_polizav7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'caratula_polizav8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'caratula_polizav8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'caratula_polizav9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'caratula_polizav9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'caratula_polizav10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'caratula_polizav10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }


        //**************************************************************************condiciones_generales*****************************************************
        }elseif($tipo=='condiciones_generales'){
            $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

            $files = array();
            $files_count = count($files_post['name']);
            $file_keys = array_keys($files_post);

            for($i=0; $i < $files_count; $i++){
                foreach($file_keys as $key){
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }

            $arch = "../archivos/".'condiciones_generales'.$idf.'.pdf';
            $arch1 = "../archivos/".'condiciones_generalesv1_'.$idf.'.pdf';
            $arch2 = "../archivos/".'condiciones_generalesv2_'.$idf.'.pdf';
            $arch3 = "../archivos/".'condiciones_generalesv3_'.$idf.'.pdf';
            $arch4 = "../archivos/".'condiciones_generalesv4_'.$idf.'.pdf';
            $arch5 = "../archivos/".'condiciones_generalesv5_'.$idf.'.pdf';
            $arch6 = "../archivos/".'condiciones_generalesv6_'.$idf.'.pdf';
            $arch7 = "../archivos/".'condiciones_generalesv7_'.$idf.'.pdf';
            $arch8 = "../archivos/".'condiciones_generalesv8_'.$idf.'.pdf';
            $arch9 = "../archivos/".'condiciones_generalesv9_'.$idf.'.pdf';

            $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
            $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

            if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'condiciones_generales'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'condiciones_generales'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'condiciones_generalesv1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'condiciones_generalesv1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'condiciones_generalesv2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'condiciones_generalesv2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'condiciones_generalesv3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'condiciones_generalesv3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'condiciones_generalesv4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'condiciones_generalesv4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'condiciones_generalesv5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'condiciones_generalesv5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'condiciones_generalesv6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'condiciones_generalesv6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'condiciones_generalesv7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'condiciones_generalesv7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'condiciones_generalesv8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'condiciones_generalesv8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'condiciones_generalesv9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'condiciones_generalesv9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'condiciones_generalesv10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'condiciones_generalesv10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }


        //**************************************************************************RECIBO_PAGO*****************************************************
    }elseif($tipo=='recibo_pago'){

        $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

        $files = array();
        $files_count = count($files_post['name']);
        $file_keys = array_keys($files_post);

        for($i=0; $i < $files_count; $i++){
            foreach($file_keys as $key){
                $files[$i][$key] = $files_post[$key][$i];
            }
        }

        $arch = "../archivos/".'recibo_pago'.$idf.'.pdf';
        $arch1 = "../archivos/".'recibo_pagov1_'.$idf.'.pdf';
        $arch2 = "../archivos/".'recibo_pagov2_'.$idf.'.pdf';
        $arch3 = "../archivos/".'recibo_pagov3_'.$idf.'.pdf';
        $arch4 = "../archivos/".'recibo_pagov4_'.$idf.'.pdf';
        $arch5 = "../archivos/".'recibo_pagov5_'.$idf.'.pdf';
        $arch6 = "../archivos/".'recibo_pagov6_'.$idf.'.pdf';
        $arch7 = "../archivos/".'recibo_pagov7_'.$idf.'.pdf';
        $arch8 = "../archivos/".'recibo_pagov8_'.$idf.'.pdf';
        $arch9 = "../archivos/".'recibo_pagov9_'.$idf.'.pdf';

        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'recibo_pago'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'recibo_pago'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'recibo_pagov1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'recibo_pagov1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'recibo_pagov2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'recibo_pagov2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'recibo_pagov3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'recibo_pagov3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'recibo_pagov4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'recibo_pagov4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'recibo_pagov5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'recibo_pagov5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'recibo_pagov6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'recibo_pagov6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'recibo_pagov7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'recibo_pagov7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'recibo_pagov8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'recibo_pagov8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'recibo_pagov9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'recibo_pagov9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'recibo_pagov10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'recibo_pagov10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************comprobante_termino*****************************************************
    }elseif($tipo=='comprobante_termino'){

        $id = "select id_agente from folios where id='$idf'";
        $reid = mysqli_query($conexion,$id);
        while($verid = mysqli_fetch_row($reid)){
            $did = $verid[0];
            
            $est = "select estado from folios where id='$idf'";
            $re = mysqli_query($conexion,$est);
            while($vere = mysqli_fetch_row($re)){
                $ess = $vere[0];

                $cont = "insert into notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                    values
                    ('$idf','$nomusuario','$ess','$fecha_actual','$tipoa','$contador','$did')";
            $resultc = mysqli_query($conexion,$cont);

            }
            
            
        }

        $files = array();
        $files_count = count($files_post['name']);
        $file_keys = array_keys($files_post);

        for($i=0; $i < $files_count; $i++){
            foreach($file_keys as $key){
                $files[$i][$key] = $files_post[$key][$i];
            }
        }

        $arch = "../archivos/".'comprobante_termino'.$idf.'.pdf';
        $arch1 = "../archivos/".'comprobante_terminov1_'.$idf.'.pdf';
        $arch2 = "../archivos/".'comprobante_terminov2_'.$idf.'.pdf';
        $arch3 = "../archivos/".'comprobante_terminov3_'.$idf.'.pdf';
        $arch4 = "../archivos/".'comprobante_terminov4_'.$idf.'.pdf';
        $arch5 = "../archivos/".'comprobante_terminov5_'.$idf.'.pdf';
        $arch6 = "../archivos/".'comprobante_terminov6_'.$idf.'.pdf';
        $arch7 = "../archivos/".'comprobante_terminov7_'.$idf.'.pdf';
        $arch8 = "../archivos/".'comprobante_terminov8_'.$idf.'.pdf';
        $arch9 = "../archivos/".'comprobante_terminov9_'.$idf.'.pdf';

        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch'";
        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);

        if(mysqli_num_rows($resi)==0){
                    foreach($files as $fileID => $file){
                        $fileContent = file_get_contents($file['tmp_name']);
                        file_put_contents("archivos/".'comprobante_termino'.$idf.'.pdf',$fileContent);

                        $nombref = "../archivos/".'comprobante_termino'.$idf.'.pdf';
                        $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                        $result = $conexion->query($sql);
                            if($result){
                                $data = array(
                                    'mensaje' => "Archivo Guardado",
                                    'status' => "200");
                                     echo json_encode($data);die();
                            }
                    }
            }else{
                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch1'";
                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                    if(mysqli_num_rows($resi)==0){
                        foreach($files as $fileID => $file){
                            $fileContent = file_get_contents($file['tmp_name']);
                            file_put_contents("archivos/".'comprobante_terminov1_'.$idf.'.pdf',$fileContent);

                            $nombref = "../archivos/".'comprobante_terminov1_'.$idf.'.pdf';
                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                            $result = $conexion->query($sql);
                                if($result){
                                    $data = array(
                                        'mensaje' => "Archivo Guardado",
                                        'status' => "200");
                                         echo json_encode($data);die();
                                }
                        }
                    }else{
                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch2'";
                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                            if(mysqli_num_rows($resi)==0){
                                foreach($files as $fileID => $file){
                                    $fileContent = file_get_contents($file['tmp_name']);
                                    file_put_contents("archivos/".'comprobante_terminov2_'.$idf.'.pdf',$fileContent);

                                    $nombref = "../archivos/".'comprobante_terminov2_'.$idf.'.pdf';
                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                    $result = $conexion->query($sql);
                                        if($result){
                                            $data = array(
                                                'mensaje' => "Archivo Guardado",
                                                'status' => "200");
                                                 echo json_encode($data);die();
                                        }
                                }
                            }else{
                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch3'";
                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                    if(mysqli_num_rows($resi)==0){
                                        foreach($files as $fileID => $file){
                                            $fileContent = file_get_contents($file['tmp_name']);
                                            file_put_contents("archivos/".'comprobante_terminov3_'.$idf.'.pdf',$fileContent);

                                            $nombref = "../archivos/".'comprobante_terminov3_'.$idf.'.pdf';
                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                            $result = $conexion->query($sql);
                                                if($result){
                                                    $data = array(
                                                        'mensaje' => "Archivo Guardado",
                                                        'status' => "200");
                                                         echo json_encode($data);die();
                                                }
                                        }
                                    }else{
                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch4'";
                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                            if(mysqli_num_rows($resi)==0){
                                                foreach($files as $fileID => $file){
                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                    file_put_contents("archivos/".'comprobante_terminov4_'.$idf.'.pdf',$fileContent);

                                                    $nombref = "../archivos/".'comprobante_terminov4_'.$idf.'.pdf';
                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                    $result = $conexion->query($sql);
                                                        if($result){
                                                            $data = array(
                                                                'mensaje' => "Archivo Guardado",
                                                                'status' => "200");
                                                                 echo json_encode($data);die();
                                                        }
                                                }
                                            }else{
                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch5'";
                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                    if(mysqli_num_rows($resi)==0){
                                                        foreach($files as $fileID => $file){
                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                            file_put_contents("archivos/".'comprobante_terminov5_'.$idf.'.pdf',$fileContent);

                                                            $nombref = "../archivos/".'comprobante_terminov5_'.$idf.'.pdf';
                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                            $result = $conexion->query($sql);
                                                                if($result){
                                                                    $data = array(
                                                                        'mensaje' => "Archivo Guardado",
                                                                        'status' => "200");
                                                                         echo json_encode($data);die();
                                                                }
                                                        }
                                                    }else{
                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch6'";
                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                            if(mysqli_num_rows($resi)==0){
                                                                foreach($files as $fileID => $file){
                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                    file_put_contents("archivos/".'comprobante_terminov6_'.$idf.'.pdf',$fileContent);

                                                                    $nombref = "../archivos/".'comprobante_terminov6_'.$idf.'.pdf';
                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                    $result = $conexion->query($sql);
                                                                        if($result){
                                                                            $data = array(
                                                                                'mensaje' => "Archivo Guardado",
                                                                                'status' => "200");
                                                                                 echo json_encode($data);die();
                                                                        }
                                                                }
                                                            }else{
                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch7'";
                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                    if(mysqli_num_rows($resi)==0){
                                                                        foreach($files as $fileID => $file){
                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                            file_put_contents("archivos/".'comprobante_terminov7_'.$idf.'.pdf',$fileContent);

                                                                            $nombref = "../archivos/".'comprobante_terminov7_'.$idf.'.pdf';
                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                            $result = $conexion->query($sql);
                                                                                if($result){
                                                                                    $data = array(
                                                                                        'mensaje' => "Archivo Guardado",
                                                                                        'status' => "200");
                                                                                         echo json_encode($data);die();
                                                                                }
                                                                        }
                                                                    }else{
                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch8'";
                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                            if(mysqli_num_rows($resi)==0){
                                                                                foreach($files as $fileID => $file){
                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                    file_put_contents("archivos/".'comprobante_terminov8_'.$idf.'.pdf',$fileContent);

                                                                                    $nombref = "../archivos/".'comprobante_terminov8_'.$idf.'.pdf';
                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                    $result = $conexion->query($sql);
                                                                                        if($result){
                                                                                            $data = array(
                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                'status' => "200");
                                                                                                 echo json_encode($data);die();
                                                                                        }
                                                                                }
                                                                            }else{
                                                                                $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch9'";
                                                                                $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                    if(mysqli_num_rows($resi)==0){
                                                                                        foreach($files as $fileID => $file){
                                                                                            $fileContent = file_get_contents($file['tmp_name']);
                                                                                            file_put_contents("archivos/".'comprobante_terminov9_'.$idf.'.pdf',$fileContent);

                                                                                            $nombref = "../archivos/".'comprobante_terminov9_'.$idf.'.pdf';
                                                                                            $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                            $result = $conexion->query($sql);
                                                                                                if($result){
                                                                                                    $data = array(
                                                                                                        'mensaje' => "Archivo Guardado",
                                                                                                        'status' => "200");
                                                                                                         echo json_encode($data);die();
                                                                                                }
                                                                                        }
                                                                                    }else{
                                                                                        $sqli = "SELECT nombre FROM archivos WHERE fk_folio='$idf' and nombre='$arch10'";
                                                                                        $resi = mysqli_query($conexion,$sqli) or die(mysql_error);
                                                                                            if(mysqli_num_rows($resi)==0){
                                                                                                foreach($files as $fileID => $file){
                                                                                                    $fileContent = file_get_contents($file['tmp_name']);
                                                                                                    file_put_contents("archivos/".'comprobante_terminov10_'.$idf.'.pdf',$fileContent);

                                                                                                    $nombref = "../archivos/".'comprobante_terminov10_'.$idf.'.pdf';
                                                                                                    $sql = "INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$nombref', '$idf', '$nomusuario')";
                                                                                                    $result = $conexion->query($sql);
                                                                                                        if($result){
                                                                                                            $data = array(
                                                                                                                'mensaje' => "Archivo Guardado",
                                                                                                                'status' => "200");
                                                                                                                 echo json_encode($data);die();
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                    }
                                                                            }
                                                                    }
                                                            }
                                                    }
                                            }
                                    }
                            }
                    }
            }

        //**************************************************************************comprobante_termino*****************************************************
        }




?>





?>
