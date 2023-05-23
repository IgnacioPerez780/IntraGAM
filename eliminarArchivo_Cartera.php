<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
include('plantillas/digitalizacion.php');

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}




$id = $_POST['id'];
$nombreContratante = $_POST['nombreContratante'];
$numeroP = $_POST['numeroP'];

$url = $_POST['url'];
/*BORRAR ARCHIVO DE LA CARPETA*/
/*unlink($url);*/
echo "Borrado completado";








/*CONSULTA PARA ELIMINAR ARCHIVO
*/
$sql2 = "DELETE FROM archivos_digitalizacion WHERE nombreContratante = '$nombreContratante' AND numeroP = '$numeroP' AND urlArchivo = '$url'";
$updateSql2 = mysqli_query( $conexion, $sql2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");




mysqli_close( $conexion );


?>


<form name="miformulario" action="detalles.php" method="POST">
    <input style="display: none;" type="radio" name="id" value="<?php echo $id;  ?>" checked>

    <input style="display: none;" type="radio" name="nombreContratante" value="<?php echo $nombreContratante;  ?>" checked>
    <input style="display: none;" type="radio" name="numeroP" value="<?php echo $numeroP;  ?>" checked>
</form>
<?php
 echo "<script> document.forms['miformulario'].submit(); </script>";




?>
