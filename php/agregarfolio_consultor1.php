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
    
    if($_POST['datos']){//INICIO IF DATOS
        $post =explode("&", $_POST['datos']);
        
        $array_data = array( );
        foreach ($post as $key => $value) {
          $value = explode("=", $value);
          $array_data[$key]=$value[1];
        }
        
        if(isset($post[18])){//INICIO DEL IF CON EL ARREGLO DE DATOS
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
            $fec1 = date("Y-m-d H:i:s",$time);

            $sql = "INSERT INTO
                    folios(fecha,negocio,t_solicitud,producto,rango,moneda,prima,poliza,movimiento,monto,contratante,prioridad,comentarios,estado,id_agente,polizap,monedap,moneda_pagos)
                values  ('$fec1','$neg','$t_s','$pro','$ran','$mon','$pri','$pol','$mov','$mon','$con','$pad','$com','$est',(select id from datos_agente where nombre = '$agente'),'$pop','$mop','$mopa')";
            
            $insert = $conexion->query($sql);
        }//FIN DE IF DE ARREGLO DE DATOS
    }//FIN DE IF DE DATOS
    
    
?>