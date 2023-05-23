 <?php

   error_reporting(E_ALL);
   session_start();
   include_once "../app/conexion.php";
   $conexion = conexion();
   $nomusuario = $_SESSION['nomusuario'];

   function update() {
    echo 'Actualizar';
    var_dump($_FILES);
    die();

   }
   if ($nomusuario == null || $nomusuario =$nomusuario){
   }
    $base_url = "HTTP://".$_SERVER['HTTP_HOST']."/sistemas/";
    $id = $_GET['id'];
    $nombre = isset($_GET['nombre'])? $_GET['nombre'] : '';
    $id_archivo = isset($_GET['id_archivo']) ? $_GET['id_archivo'] : 0;    
     $datos_archivo = array();     
     if(isset($_GET['id_archivo'])){
        if (isset($_FILES)) {
            var_dump($_FILES);
        }
        if($id_archivo != 0 ){
            $query ="SELECT  
                        id as id_archivo , fk_folio as folio, nombre as nombre
                    FROM archivos 
                    WHERE id = '$id_archivo'";
            
            $resultado = $conexion->query($query); 
             while($ver = mysqli_fetch_object($resultado)){         
             $datos_archivo = [
                 'id_archivo' => $ver->id_archivo,
                  'folio' => $ver->folio,
                  'nombre' =>  $ver->nombre ];
             }       
        }        
    }

 ?>
<!DOCTYPE html>
 <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Documentos</title>
        <link rel="stylesheet" type="text/css" href="<?php  echo $base_url ?>librerias/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $base_url ?>librerias/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $base_url ?>librerias/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $base_url ?>librerias/datatable/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php  echo $base_url ?>librerias/datatable/dataTables.bootstrap.min.css">
        <style>
            .glyphicon {margin: 2px 15px; }
            .table-responsive {overflow-x: hidden; }
            .table-responsive th {text-align: center; }
            #back{ display: block; position: relative; left: 90%; } 
        </style>        
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
                    <li><a href="../../agente.php">Regresar</a></li>
                    <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>         
        <div class="container">
            <div class="row">
                <div class="panel-body ">
                    <div class="table-responsive" >                            
                        <table class="table table-hover table-condensed table-bordered text-center" id="dataTables-example" >
                            <thead class="bg-dark text-white">
                                <tr>      
                                    <th  align="right" bgcolor="e4e2e2">Archivo</th>
                                    <th align="right" bgcolor="e4e2e2">Ver</th>   
                                    <th align="right" bgcolor="e4e2e2">Descargar</th>
                                    <th align="right" bgcolor="e4e2e2">Eliminar</th>
                                    <th align="right" bgcolor="e4e2e2">Editar</th>
                                    <th align="right" bgcolor="e4e2e2">Visualizado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                
                                    $query ="SELECT  
                                                nombre, fk_folio, id
                                            FROM archivos 
                                            WHERE fk_folio = '$id'";
                                    $resultado = $conexion->query($query); 
                                    while ($row=mysqli_fetch_row($resultado)) 
                                    {
                                ?>
                        <tr>
                        <td  align="center"><?php echo $row[0]; ?></td>
                        <td align="center"> <a href="../sistemas/../archivos/../<?php echo $row[0]; ?>"  target = " _blank">   <span class="btn btn-primary glyphicon glyphicon-file"></span>Ver</a>
                        </td>
                        <td  align="center">
                        <a href="../sistemas/../archivos/../<?php echo $row[0]; ?>" target = " _blank"  download="archivo_descargado.pdf"> 
                            <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>Descargar</a>
                        </td >
                        <td >
                           <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?nombre=<?php echo $row[0]; ?>&id=<?php echo $row[1]; ?>">
                                 <button class="btn btn-danger glyphicon glyphicon-trash" type="submit" name="eliminar"> Eliminar</button>
                           </form>
                        </td>
                        <td>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id_archivo=<?php echo $row[2]; ?>&id=<?php echo $row[1]; ?>">
                            <button type="submit" class="btn   glyphicon glyphicon-list-al" > Editar </button>  
                           </form>                               
                        </td>
                        <td >
                           <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?nombre=<?php echo $row[0]; ?>?id=<?php echo $row[1]; ?>">
                                 <button class="btn btn-info  glyphicon glyphicon-check" type="submit" name="visualizado"> vi</button>
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
    <!--  Actualizar archivos   -->
        <div class="modal" tabindex="-1" role="dialog" id="edit-archivo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../actualizar_archivo.php" id="actualiza-archivo">
                            <input class="form-control" id="folio" type="text" placeholder=" Folio : <?php echo isset($datos_archivo['folio']) ? $datos_archivo['folio'] : '' ?>" readonly>
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" placeholder="" value="<?php echo isset($datos_archivo['nombre']) ? $datos_archivo['nombre'] : '' ?>">
                            </div>
                            <div class="form-group"><span class="glyphicon glyphicon-folder-open"></span>
                                <label>Documentos</label> <span></span>
                                <input type="file" id="file" name="file"  class="form-control"   accept=".pdf">
                                  <span  class="btn-danger"  id ='res_file' ></span>
                            </div>
                            <input id="id_archivo" name="id_archivo" type="hidden" value="<?php echo isset($datos_archivo['id_archivo']) ? $datos_archivo['id_archivo'] : 0 ?>">
                            <input id="id" name="id" type="hidden" value="<?php echo isset($id) ? $id : 0 ?>">
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="enviar" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <script src="<?php  echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
            <script src="<?php  echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php  echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php  echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true,
                        "order": [[ 0, "desc" ]],
                        "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            }
                    });
                    $("#enviar").on('click', function() {
                        $("#actualiza-archivo").submit();
                    });
                });
                window.onload = function() {
                    id_archivo = "<?php echo isset($id_archivo)? $id_archivo : 0; ?>" ;
                    if(id_archivo > 0 ){                     
                        $('#edit-archivo').modal('show');
                    }
                }
            </script>
        </footer>
    </body>
</html>
