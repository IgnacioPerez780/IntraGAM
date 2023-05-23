<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
include('plantillas/digitalizacion_py.php');

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}




$id = $_POST['id'];
$nombreContratante = $_POST['nombreContratante'];
$numeroP = $_POST['numeroP'];
$vigencia = $_POST['vigencia'];
$primaNeta = $_POST['primaNeta'];
$url = $_POST['url'];
$fecha = $_POST['fecha'];
$agente = $_POST['agente'];
$formaPago = $_POST['formaPago'];
$moneda = $_POST['moneda'];
$comentario = $_POST['comentario'];
unlink($url);
echo "Borrado completado";








/*CONSULTA PARA ELIMINAR ARCHIVO
*/
$sql2 = "DELETE FROM archivos_digitalizacion_pymes WHERE nombreContratante = '$nombreContratante' AND numeroP = '$numeroP' AND urlArchivo = '$url'";
$updateSql2 = mysqli_query( $conexion, $sql2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");




mysqli_close( $conexion );


?>


<form name="miformulario" action="detalles_py.php" method="POST">
    <input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>

    <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nombreContratante;  ?>" checked>
    <input style="display: none;" type="radio" name="numeroP" value="<?php echo $numeroP;  ?>" checked>
    <input style="display: none;" type="radio" name="vigencia" value="<?php echo $vigencia;  ?>" checked>
    <input style="display: none;" type="radio" name="primaNeta" value="<?php echo $primaNeta;  ?>" checked>
    <input style="display: none;" type="radio" name="agente" value="<?php echo $agente;  ?>" checked>
    <input style="display: none;" type="radio" name="formaPago" value="<?php echo $formaPago;  ?>" checked>
    <input style="display: none;" type="radio" name="moneda" value="<?php echo $moneda;  ?>" checked>
    <input style="display: none;" type="radio" name="comentario" value="<?php echo $comentario;  ?>" checked>
</form>
<?php
 echo "<script> document.forms['miformulario'].submit(); </script>";




?>
