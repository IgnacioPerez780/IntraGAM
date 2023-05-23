  <?php

   error_reporting(E_ALL);
    
    $nomusuario = $_SESSION['nomusuario'];
    if ($nomusuario == null || $nomusuario = $nomusuario){

     }
     $base_url = "HTTP://".$_SERVER['HTTP_HOST']."/sistemas/";
?>
  <!DOCTYPE html>
    <html>
    <head>
         <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agente GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/gam.ico">
    </head>
    <body>
<!-- <script src="<?php  echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
<script src="<?php  echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php  echo $base_url ?>librerias/alertify/alertify.js"></script>
 --><nav class="navbar navbar-default" role="navigation">
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
            <li><a href="agente.php">Regresar</a></li>
            <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="panel-body">
            <div class="table-responsive" >
                <table class="table table-hover table-condensed table-bordered text-center" id="dataTables-example" >
                    <thead class="bg-dark text-white">
                        <tr>      
                            <th>Archivo</th>
                            <th>Ver</th>   
                            <th>Descargar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="SELECT id FROM datos_agente WHERE nomusuario='$nomusuario'";
                            $resultado = mysqli_query($conexion,$sql);
                            $res = mysqli_fetch_array($resultado);
                            $id = $res['id'];
                            $query ="SELECT * from folios WHERE id_agente= '$id'";
                            $resultado = $conexion->query($query);
                            while ($row=$resultado->fetch_assoc()) 
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><a href="php/ver_pdf.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-file"></span>Ver</a></td>
                            <td><a href="<?php echo $row['archivo_pdf']; ?>" download="<?php echo $row['archivo_pdf']; ?>"> <span class="glyphicon glyphicon-download-alt"></span>Descargar</a></td>
                           <td>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row['id']; ?>">
                                    <button class="btn btn-danger glyphicon glyphicon-remove" type="submit" name="eliminar"> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>

<script>
    $(document).ready(function() {
        var table = $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]],
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
      });
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
<script src="../librerias/datatables/jquery.dataTables.min.js"></script>
<script src="../librerias/datatables/dataTables.bootstrap.min.js"></script>
</br>