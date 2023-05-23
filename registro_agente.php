<?php
    error_reporting(E_ALL);
    session_start();
    include_once "app/conexion.php";
    $conexion=conexion();

    if( $_SESSION['logged_in']<>TRUE){
      header('location: index.php');
      exit;
    }  
    
    $nomusuario = $_SESSION['nomusuario'];

     if ( $_SESSION['logged_in'] == 1 && '2' == $_SESSION['rol'] || $_SESSION['logged_in'] == 1 && '3' == $_SESSION['rol']|| $_SESSION['logged_in'] == 1 && '4' == $_SESSION['rol']){} else header('location: consultor.php');
?>

<?php
    if(isset($_POST['enviar']))
    {

        $nombre = $_POST['nombre'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $direccion = $_POST['direccion'];
        $celular = $_POST['celular'];
        $cua = $_POST['cua'];
        $correo = $_POST['correo'];
        $correov = $_POST['correov'];
        $correog = $_POST['correog'];
        $correoa = $_POST['correoa'];
        $tipo_agente = $_POST['tipo_agente'];
        $contrasena_encryptada = htmlentities( $_POST['contrasena']);
        $contrasena_encryptada = hash("sha512", $contrasena_encryptada);
        $nomusuario = $_POST['nomusuario'];
        $insertar = "INSERT INTO datos_agente(nombre, direccion, celular,cua,correoa,correov,correog, correo, password, nomusuario,  id_tipo_usuario, id_tipo_agente) VALUES ('$nombre','$direccion','$celular','$cua','$correov','$correoa','$correog','$correo','$contrasena_encryptada', '$nomusuario','$tipo_usuario', '$tipo_agente')";
        $verificar = mysqli_query($conexion, "SELECT nomusuario FROM datos_agente WHERE nomusuario = '$nomusuario'");
        if (mysqli_num_rows($verificar) > 0)
        {
            echo '<script> alert("El Usuario ya esta registrado."); window.history.go(-1); </script> ';
            exit;
        }
        $resultado = mysqli_query($conexion, $insertar);
        if(!$resultado){
            echo '<script> alert("Problemas con el servidor intente mas tarde"); window.history.go(-1); </script>';
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
                <li><a href="registro.php">Agregar Usuario</a></li>
                <li><a href="consultor.php">Regresar</a></li>
                <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registro de Agente</h3>
                        </div>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                       <label>Nombre Completo</label>
                                       <input type="text" class="form-control" name="nombre"  id="nombre" placeholder="Nombre APaterno AMaterno" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tipo de usuario</label>
                                        <select class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                                            <?php
                                                $query ="SELECT id, descripcion FROM tipo_usuario WHERE id= '1'";
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
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Celular</label>
                                        <input type="celular" class="form-control" name="celular" id="celular" placeholder="Numero celular" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 10 caracteres)</i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de agente</label>
                                    <select class="form-control" name="tipo_agente" id="tipo_agente">
                                        <?php
                                            $query ="SELECT id, tipo FROM tipo_agente";
                                            $resultado = $conexion->query($query);
                                            while ($row=$resultado->fetch_assoc())
                                            {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['tipo']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>CUA</label>
                                    <input type="text" class="form-control" name="cua" id="cua"  placeholder="Escribe la CUA correspondiente" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 10 caracteres)</i>
                                </div>
                                <div class="form-group">
                                      <label>Correo electronico General</label>
                                      <input  class="form-control" name="correo" id="correo" placeholder="correo@dominio.com.mx" >
                                </div>
                                <div class="form-group">
                                      <label>Correo electronico Linea Vida</label>
                                      <input type="email" class="form-control" name="correov" id="correov" placeholder="correo1@dominio.com.mx" >
                                </div>
                                <div class="form-group">
                                      <label>Correo electronico Linea GMM</label>
                                      <input type="email" class="form-control" name="correog" id="correog" placeholder="correo2@dominio.com.mx" >
                                </div>
                                <div class="form-group">
                                    <label>Correo electronico Linea Autos</label>
                                    <input type="email" class="form-control" name="correoa" id="correoa" placeholder="coreo3@dominio.com.mx" >
                                </div>
                                    <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Escribe la contraseña" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 12 caracteres)</i>
                                </div>
                                <div  class="form-group">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control" name="nomusuario" id="nomusuario" placeholder="Escribe tu usuario" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 12 caracteres)</i>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="name " class="btn btn-primary btn-block btn-flat" name="enviar">Guardar</button>
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
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    },
    4000);
</script>
</body>
</html>
