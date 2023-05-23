  <?php
error_reporting(E_ALL);
    session_start();
    include_once "../app/conexion.php";
    $conexion=conexion();
    $nomusuario = $_SESSION['nomusuario'];
    if ($nomusuario == null || $nomusuario = $nomusuario){

     }
?>
  <!DOCTYPE html>
    <html>
    <head>
        <title>Archivos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="../imagenes/gam.ico">

    </head>
    <body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="agente.php">GAM</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenido  <?php echo $nomusuario ?></a></li>
                
                
            </ul>
             <ul class="nav navbar-nav navbar-right">
                        <li><a href="../agente.php">Regresar</a></li>
                        <li><a href="../salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>

                    </ul>
        </div>
    </div>
</nav>
<?php  
	$id=$_REQUEST['id'];
	$query ="SELECT * from folios where id = '$id'";
    $resultado = $conexion->query($query);
    while ($row=$resultado->fetch_assoc()) 
    {
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
             
        	<object data="<?php echo $row['archivo_pdf']; ?>" type="application/pdf" width="1000" height="1000">
        	    <embed src="<?php echo $row['archivo_pdf']; ?>" type="application/pdf" width="575" height="800">

        	</object>
            
        </div>
    </div>
</div>
<?php
    }
?>
<br><br>
</body>
<footer class="footer">
    <div class="container text-center">
        <span>Software GAM <sup>©</sup> Todos los Derechos Reservados.</span>
        <!--sup define un fragmento de texto que se debe mostrar, por razones tipográficas, más alto, y generalmente más pequeño -->
    </div>
</footer>
<script src="librerias/jquery-3.2.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>

  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>