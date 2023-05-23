<?php
error_reporting(E_ALL);

    session_start();
    include_once "app/conexion.php";
    $conexion=conexion();
    $nomusuario = $_SESSION['nomusuario'];

    if( $_SESSION['logged_in']<>TRUE){
      header('location: index.php');
      exit;
    }  
    
    if ( $_SESSION['logged_in'] == 1 && '3' == $_SESSION['rol'] ){} else header('location: consultor.php');
?>


<?php
    if(isset($_POST['enviar']))
    {

        $nombre = $_POST['nombre'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $telefono = $_POST['telefono'];
        $extencion = $_POST['extencion'];
        $nomusuario = $_POST['nomusuario'];
        $tipo_linea_negocio = $_POST['tipo_linea_negocio'];
        $correo = $_POST['correo'];
        $contrasena_encryptada = htmlentities( $_POST['contrasena']);
        $contrasena_encryptada = hash("sha512", $contrasena_encryptada);
        $insertar = "INSERT INTO datos_operativos(nombre, correo, password, telefono, extension,nomusuario,  id_tipo_usuario, id_linea_negocio) VALUES ('$nombre','$correo','$contrasena_encryptada','$telefono', '$extencion','$nomusuario','$tipo_usuario', '$tipo_linea_negocio')" ;echo "query: <br>".$insert . "<br>";
        $verificar = mysqli_query($conexion, "SELECT nomusuario FROM datos_operativos WHERE nomusuario = '$nomusuario'");
        if (mysqli_num_rows($verificar) > 0)
        {
            echo '<script> alert("El Usuario ya esta registrado."); window.history.go(-1); </script> ';
            exit;
        }
        $resultado = mysqli_query($conexion, $insertar);
        if(!$resultado){
            echo '<script> alert("Problemas con el servidor intente mas tarde"); window.history.go(-1); </script> ';
        }
        else{
            echo '<script> alert("Usuario registrado con exito."); location.href ="consultor.php"; </script> ';
        }
        mysqli_close($conexion);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="libreri/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="img/gam.ico">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="consultor.php">GAM</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenido <?php echo $nomusuario ?></a></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="registro.php">Agregar Consultor</a></li>
                <li><a href="consultor.php">Regresar</a></li>
                <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registra usuario</h3>
                        </div>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre APaterno AMaterno" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                <div class="col-md-6">
                                        <label>Tipo de usuario</label>
                                        <select class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                                            <?php

                                                $query ="SELECT id, descripcion FROM tipo_usuario WHERE id NOT LIKE '%1'";
                                                $resultado = $conexion->query($query);
                                                while ($row=$resultado->fetch_assoc())
                                                {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['descripcion']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Escribe  telefono" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 20 digitos)</i>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Extensión</label>
                                        <input type="text" class="form-control" name="extencion" id="extencion" placeholder="Escribe la extencion" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de linea de negocio</label>
                                    <select class="form-control" name="tipo_linea_negocio" id="tipo_linea_negocio">
                                        <?php
                                            $query ="SELECT id, nombre FROM linea_negocio";
                                            $resultado = $conexion->query($query);
                                            while ($row=$resultado->fetch_assoc())
                                            {
                                        ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                        <?php
                                            }
                                            mysqli_close($conexion);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="correo@dominio.com.mx" required>
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Escribe la contraseña" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 12 caracteres)</i>
                                </div>
                                <div class="form-group">
                                    <label>Usuario</label>
                                    <input type="nomusuario" class="form-control" name="nomusuario" id="nomusuario" placeholder="Escribe nombre usuario" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 12 caracteres)</i>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-block btn-flat" name="enviar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="libreri/jquery/dist/jquery.min.js"></script>
<script src="libreri/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
