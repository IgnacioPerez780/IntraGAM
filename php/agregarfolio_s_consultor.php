<?php
    error_reporting(E_ALL);
    session_start();
    $id = $_SESSION['id_usuario'];
    $carpeta = $_SESSION['nomusuario'];
    include '../app/conexion.php';
    $conexion = conexion();
    $sql="SELECT MAX(id) FROM folios_s";
    $result = $conexion->query($sql);
    if ($row = mysqli_fetch_row($result)) {
        $id_folio = trim($row[0]);
    }
    $id_folio = isset( $id_folio)? $id_folio  : 18999 ;
    $carpeta = "../archivos/";
    $id_folio ++;


    $nom = "SELECT nomusuario FROM datos_agente WHERE id = '$id'";
    $nomr = $conexion->query($nom);
    if($row = mysqli_fetch_row($nomr)){
      $nomusu = $row[0];
    }
    if ($_POST['datos']) {
        $post =explode("&", $_POST['datos']);

        $array_data = array( );
        foreach ($post as $key => $value) {
          $value = explode("=", $value);
          $array_data[$key]=$value[1];
        }

        if (isset($post[32])) {
            $fec = $array_data[0];
            $neg = $array_data[1];
            $t_s = $array_data[2];
            $t_v = $array_data[3];
            $t_a = $array_data[4];
            $t_d = $array_data[5];
            $tot = $array_data[6];
            $gas = $array_data[7];
            $mon = $array_data[8];
            $con = $array_data[9];
            $cov = $array_data[10];
            $coa = $array_data[11];
            $cod = $array_data[12];
            $nmp = $array_data[13];
            $nmv = $array_data[14];
            $nma = $array_data[15];
            $nmd = $array_data[16];
            $nms = $array_data[17];
            $nmsa = $array_data[18];
            $nmsd = $array_data[19];
            $nmq = $array_data[20];
            $nmqa = $array_data[21];
            $nmqd = $array_data[22];
            $nmr = $array_data[23];
            $nmf = $array_data[24];
            $des = $array_data[25];
            $desv = $array_data[26];
            $desa = $array_data[27];
            $desd = $array_data[28];
            $est = $array_data[29];
            $afe = $array_data[30];
            $age = $array_data[31];


            date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec1 = date("Y-m-d H:i:s",$time);
            
            
            $time1 = time();
            $fecha_actual = date("Y-m-d H:i:s",$time1);
            $tipoa = "TRAMITE";
            $contador = "1";
            $estado = "ENVIADO";
            
            $cont = "INSERT INTO notificaciones1_s(folio,usuario,estado,fecha,tipo,contador)
                                    VALUES
                                    ('$id_folio','$nomusu','$estado','$fecha_actual','$tipoa','$contador')";
            $resultc = mysqli_query($conexion,$cont);
            if($neg == "GMM"){
                $sql = "INSERT INTO
                    folios_s(fecha,linea_s,tipo_sol,total,gastos_no,monto_pro,contratante,n_poliza,n_siniestro,n_qr,n_reclamacion,n_folio,descripcion,estado,id_agente,afectado)
                values  ('$fec1','$neg','$t_s','$tot','$gas','$mon','$con','$nmp','$nms','$nmq','$nmr','$nmf','$des','$est',(select id from datos_agente where nombre = '$age'),'$afe')";

                $insert = $conexion->query($sql);
                if(!empty($_FILES) && $insert ){
                    $data = array(
                        'mensaje' => "Archivos Guardados",
                        'status' => "200" );
                    echo json_encode($data);die();
                }
                mysqli_close($conexion);
            }else if($neg == "VIDA"){
                $sql = "INSERT INTO
                    folios_s(fecha,linea_s,tipo_sol,total,gastos_no,monto_pro,contratante,n_poliza,n_siniestro,n_qr,n_reclamacion,n_folio,descripcion,estado,id_agente,afectado)
                values  ('$fec1','$neg','$t_v','$tot','$gas','$mon','$cov','$nmv','$nms','$nmq','$nmr','$nmf','$desv','$est',(select id from datos_agente where nombre = '$age'),'N/A')";

                $insert = $conexion->query($sql);
                if(!empty($_FILES) && $insert ){
                    $data = array(
                        'mensaje' => "Archivos Guardados",
                        'status' => "200" );
                    echo json_encode($data);die();
                }
                mysqli_close($conexion);
            }else if($neg == "AUTOS"){
                $sql = "INSERT INTO
                    folios_s(fecha,linea_s,tipo_sol,total,gastos_no,monto_pro,contratante,n_poliza,n_siniestro,n_qr,n_reclamacion,n_folio,descripcion,estado,id_agente,afectado)
                values  ('$fec1','$neg','$t_a','$tot','$gas','$mon','$coa','$nma','$nmsa','$nmqa','$nmr','$nmf','$desa','$est',(select id from datos_agente where nombre = '$age'),'N/A')";

                $insert = $conexion->query($sql);
                if(!empty($_FILES) &&
                 $insert ){
                    $data = array(
                        'mensaje' => "Archivos Guardados",
                        'status' => "200" );
                    echo json_encode($data);die();
                }
                mysqli_close($conexion);
            }else if($neg == "DAÑOS"){
                $sql = "INSERT INTO
                    folios_s(fecha,linea_s,tipo_sol,total,gastos_no,monto_pro,contratante,n_poliza,n_siniestro,n_qr,n_reclamacion,n_folio,descripcion,estado,id_agente,afectado)
                values  ('$fec1','$neg','$t_d','$tot','$gas','$mon','$cod','$nmd','$nmsd','$nmqd','$nmr','$nmf','$desd','$est',(select id from datos_agente where nombre = '$age'),'N/A')";

                $insert = $conexion->query($sql);
                if(!empty($_FILES) && $insert ){
                    $data = array(
                        'mensaje' => "Archivos Guardados",
                        'status' => "200" );
                    echo json_encode($data);die();
                }
                mysqli_close($conexion);
            }
            
        }

    }
?>

