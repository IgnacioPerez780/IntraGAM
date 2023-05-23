<?php
    error_reporting(E_ALL);
    session_start();
    $id = $_SESSION['id_usuario'];
    $carpeta = $_SESSION['nomusuario'];
    include '../app/conexion.php';
    $conexion = conexion();
    $sql="SELECT MAX(id) FROM folios";
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


    if(isset($_FILES['solicitud'])) {
        $archivo_temp = $_FILES['solicitud']['tmp_name'];
        $destino =  $carpeta . 'solicitud'.$id_folio.'.pdf';
        $copy = guardar_pdf($destino, $archivo_temp , $carpeta, $id_folio, $nomusu);
        return "archivo guardado";
    }


    elseif (isset($_FILES['identificacion'])) {
        $archivo_temp = $_FILES['identificacion']['tmp_name'];
        $destino =  $carpeta . 'identificacion'.$id_folio.'.pdf';
        $copy = guardar_pdf($destino, $archivo_temp , $carpeta, $id_folio, $nomusu);
        return "archivo guardado";
    }



    elseif (isset($_FILES['comprobante'])) {
        $archivo_temp = $_FILES['comprobante']['tmp_name'];
        $destino =  $carpeta . 'comprobante'.$id_folio.'.pdf';
        $copy = guardar_pdf($destino, $archivo_temp , $carpeta, $id_folio, $nomusu);
        return "archivo guardado";
    }


    elseif (isset($_FILES['file'])) {
        $archivo_temp = $_FILES['file']['tmp_name'];
        $destino =  $carpeta . 'file'.$id_folio.'.pdf';
        $copy = guardar_pdf($destino, $archivo_temp , $carpeta, $id_folio, $nomusu);
        return "archivo guardado";
    }


    elseif ($_POST['datos']) {
        $post =explode("&", $_POST['datos']);
        
        $array_data = array( );
        foreach ($post as $key => $value) {
          $value = explode("=", $value);
          $array_data[$key]=$value[1];
        }



        if (isset($post[18])) {
            $fec = $array_data[0];
            $neg = $array_data[1];
            $t_s = $array_data[2];
            $pro = $array_data[3];
            $ran = $array_data[4];
            $mon = $array_data[5];
            $pri = $array_data[6];
            $pol = $array_data[7];
            $mov = $array_data[8];
            $mon = $array_data[9];
            $con = $array_data[10];
            $pad = $array_data[11];
            $com = $array_data[12];
            $est = $array_data[13];
            $pop = $array_data[14];
            $mop = $array_data[15];
            $mopa = $array_data[16]; //hay cambio aqui, se agrego
            $agente = $array_data[18];

            date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec1 = date("Y-m-d H:i:s",$time); //SE ANEXA PARA LA CAPTURA DE LA HORA            
            
            $time1 = time();
            $fecha_actual = date("Y-m-d H:i:s",$time1);
            $tipoa = "TRAMITE";
            $contador = "1";
            $estado = "ENVIADO";
                
                $cont = "INSERT INTO notificaciones1(folio,usuario,estado,fecha,tipo,contador,id_agente)
                                    VALUES
                                    ('$id_folio','$nomusu','$estado','$fecha_actual','$tipoa','$contador',(select id from datos_agente where nombre = '$agente'))";
                $resultc = mysqli_query($conexion,$cont);   

            $sql = "INSERT INTO
                    folios(fecha,negocio,t_solicitud,producto,rango,moneda,prima,poliza,movimiento,monto,contratante,prioridad,comentarios,estado,id_agente,polizap,monedap,moneda_pagos,usuario)
                values  ('$fec1','$neg','$t_s','$pro','$ran','$mon','$pri','$pol','$mov','$mon','$con','$pad','$com','$est',(select id from datos_agente where nombre = '$agente'),'$pop','$mop','$mopa','$id')";


                
            $insert = $conexion->query($sql);
            if(!empty($_FILES) && $insert ){
                $data = array(
                    'mensaje' => "Archivos Guardados : ",
                    'status' => "1000" );

                /*foreach($_FILES as $key => $tmp_name) {
                    $archivo=$tmp_name['name'];
                    $archivo = str_replace('.pdf', "", $archivo);
                    $archivo .= $id_folio . '.pdf';
                    $ruta=$tmp_name['tmp_name'];

                    $destino="../archivos/".$archivo;
                    if(copy($ruta,$destino)) {
                        $sql="INSERT INTO archivos (nombre,fk_folio) VALUES ('$destino', '$id_folio')";
                        $result = $conexion->query($sql);
                        $data['mensaje'] .= $archivo;
                    }
                    else
                        die("Ha ocurrido un error con el archivo :".$archivo.", por favor inténtelo de nuevo.<br>");
                }*/
                echo json_encode($data);die();
            }
            mysqli_close($conexion);
        }
    }

    function guardar_pdf($destino, $archivo_temp, $carpeta, $id_folio, $nomusu){
       if(!is_dir($carpeta)){
            mkdir($carpeta,0777); /*Crea un directorio  mkdir("/ruta/a/mi/directorio", 0700);*/
        }
        
        if(copy($archivo_temp, $destino)) {

            $conexion =  conexion();
            $sql_exist="SELECT COUNT(id) as ids FROM archivos WHERE nombre = '$destino' ;";
            $existe = $conexion->query($sql_exist);
            $num_row = mysqli_fetch_object($existe);
            if($num_row->ids != '0'){
                $data = array(
                        'mensaje' => "Archivo Remplazado",
                        'status' => "1000" );
                echo json_encode($data);die();
            }else{
              $nom = "SELECT nomusuario FROM datos_agente WHERE id = '$id'";
              $nomr = $conexion->query($nom);
              if($row = mysqli_fetch_row($nomr)){
                $nomusu = $row[0];
              }

                $sql="INSERT INTO archivos (nombre,fk_folio,nomusuario) VALUES ('$destino', '$id_folio', '$nomusu')";
                $result = $conexion->query($sql);
                if ($result){
                    $data = array(
                        'mensaje' => "Archivo Guardado",
                        'status' => "1000" );
                    echo json_encode($data);die();
                }
                else
                    die("Ha ocurrido un error, por favor inténtelo de nuevo.<br>");
            }
        }
        else
            die("Ha ocurrido un error, por favor inténtelo de nuevo.<br>");
    }if(isset($_POST['eliminar']))
    {
        $id=$_REQUEST['id'];
        $eliminar = "DELETE FROM archivos WHERE id='$id'";
        $resultado = mysqli_query($conexion, $eliminar);
        if(!$resultado)
        {
            echo '<script>
                    alert("Problemas con el servidor intente mas tarde");
                 </script>
                 ';
        }
        else
        {
            echo '<script>
                    alert("Archivo eliminado con exito.");
                    location.href ="registro.php";
                 </script>
                 ';
        }
        mysqli_close($conexion);
    }
?>

