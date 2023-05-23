<?php 

session_start();
include ('app/conexion.php');
$conexion = conexion();
date_default_timezone_set("America/Mexico_City");

/*VARIABLES
*/

$folio = $_POST['folio'];
$nomusuario = $_POST['nomusuario'];
$pregunta2 = $_POST['rating2'];
$pregunta3 = $_POST['p3'];
$ramo = $_POST['ramo'];

 if ($ramo == "SINIESTROS") {
    $pregunta1 = "SIN DATOS";
}else{ 
$pregunta1 = $_POST['rating'];
}

$pregunta4 = $_POST['p4'];

if ($pregunta4 == "") {
    $pregunta4 = "SIN DATOS";
}

/* echo $nomusuario;
 echo $ramo;*/

echo "Enviando datos...";

$fecha = date("Y-m-d H:i:s");


   $sql = "SELECT * FROM datos_agente where nomusuario='$nomusuario'";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($result)) {
                        $datos = $ver[0] . "||" .
                            $ver[1];


                               
                                $nombre = $ver[1];
                            }

                        
                      



$consulta = "INSERT INTO encuesta  (folio, agente, pregunta1, pregunta2, pregunta3, pregunta4, ramo, fecha) VALUES ('$folio', '$nombre','$pregunta1', '$pregunta2', '$pregunta3', '$pregunta4','$ramo', '$fecha')";

$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");



 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

</body>
</html>


 <form name="miformulario" 

<?php if ($ramo == "VIDA") {
   ?> action="seguimiento.php?id=<?php echo $folio; ?>"
 <?php } ?>
 

<?php if ($ramo == "GMM") {
   ?> action="seguimiento_g_a.php?id=<?php echo $folio; ?>"
 <?php } ?>

<?php if ($ramo == "AUTOS") {
   ?> action="seguimiento_a_a.php?id=<?php echo $folio; ?>"
 <?php } ?>

<?php if ($ramo == "SINIESTROS") {
   ?> action="seguimiento_s.php?id=<?php echo $folio; ?>"
 <?php } ?>



  method="post"> 


 </form>

 <?php 

echo "<script> document.forms['miformulario'].submit(); </script>";
 ?>