<?php

error_reporting(E_ALL);
session_start();
// se inicia la sesion y se incluye la conexión a la base//
include_once "../app/conexion.php";
$conexion = conexion();
$nomusuario = $_SESSION['nomusuario'];
    /*actualizar archicvo */

        var_dump($_FILES);die();
    if($_FILES){
       $data = array(
            'mensaje' => "Archivos Guardados : ",
            'status' => "1000" );

        foreach($_FILES as $key => $tmp_name) {            
            $archivo=$tmp_name['name'];
            $archivo = $_POST['nombre'];
            $ruta=$tmp_name['tmp_name'];
            $destino="../archivos/".$archivo;
            if(copy($ruta,$destino)) {                
                $data['mensaje'] .= $archivo;
            }
            else  
                echo ("Ha ocurrido un error con el archivo :".$archivo.", por favor inténtelo de nuevo.<br>");     
        }
        echo json_encode($data);die(); 
    }
    mysqli_close($conexion);
      
    

    