<?php
    error_reporting(0);
    include 'app/conexion.php';
    $conexion = conexion();
    include('plantillas/cabecera.php');
    
    if(isset($_SESSION['logged_in'])){
        
        $inactive = 600;
        
        if (isset($_SESSION["timeout"])) {
            // calculate the session's "time to live"
                $sessionTTL = time() - $_SESSION["timeout"];
            if ($sessionTTL > $inactive) {
                session_destroy();
                    
                ?>
                    // Page redirection
                    <script>window.location = 'index.php';</script>
                <?php
                  
            }
        }
        $_SESSION["timeout"] = time();
    }
    
    //if ( $_SESSION['logged_in'] == 1  ){} else header('location: index.php');
    
    date_default_timezone_set("America/Mexico_City");
      $time = time();
      $fechaactual = date("Y-m-d H:i:s",$time);
      
      $sql="select * from linea_negocio where nombre='VIDA'";
      $result = $conexion->query($sql);
      if($result->num_rows > 0){
         $combobit="";
         while ($row= $result->fetch_array(MYSQLI_ASSOC)) {
         $combobit.=" <option value='".$row['nombre']."'>".$row['nombre']."</option>";
         }
      }

      $sql1="select * from tipo_solicitud";
      $result1 = $conexion->query($sql1);
      if($result1->num_rows > 0){
         $combobit1="";
         while ($row= $result1->fetch_array(MYSQLI_ASSOC)) {
         $combobit1.=" <option value='".$row['tipo']."'>".$row['tipo']."</option>";
         }
      }

      $sql2="select * from moneda";
      $result2 = $conexion->query($sql2);
      if($result2->num_rows > 0){
         $combobit2="";
         while ($row= $result2->fetch_array(MYSQLI_ASSOC)) {
         $combobit2.=" <option value='".$row['tipo']."'>".$row['tipo']."</option>";
         }
      }

      $sql3="select * from rango";
      $result3 = $conexion->query($sql3);
      if($result3->num_rows > 0){
         $combobit3="";
         while ($row= $result3->fetch_array(MYSQLI_ASSOC)) {
         $combobit3.=" <option value='".$row['tiporan']."'>".$row['tiporan']."</option>";
         }
      }

      $sql4="select * from producto where id_tipo_solicitud='1' order by producto asc";
      $result4 = $conexion->query($sql4);
      if($result4->num_rows > 0){
         $combobit4="";
         while ($row= $result4->fetch_array(MYSQLI_ASSOC)) {
         $combobit4.=" <option value='".$row['producto']."'>".$row['producto']."</option>";
         }
      }
      
      $sql5="select * from producto where id_tipo_solicitud='2' order by producto asc";
      $result5 = $conexion->query($sql5);
      if($result5->num_rows > 0){
         $combobit5="";
         while ($row= $result5->fetch_array(MYSQLI_ASSOC)) {
         $combobit5.=" <option value='".$row['producto']."'>".$row['producto']."</option>";
         }
      }

      $sql6="select * from datos_agente order by nombre";
      $result6 = $conexion->query($sql6);
      if($result6->num_rows > 0){
         $combobit6="";
         while ($row= $result6->fetch_array(MYSQLI_ASSOC)) {
         $combobit6.=" <option value='".$row['nombre']."'>".$row['nombre']."</option>";
         }
      }
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/alertify.min.js"></script>
        
        <meta http-equiv = "refresh" content = "600" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>ADP</title>
        <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">

        <!--librerias de bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!--hojas de estilo-->
        <link rel="stylesheet" href="css/alertify.core.css">
        <link rel="stylesheet" href="css/alertify.default.css">
    </head>
    <body>
        
        <!--CARGAR TABLA CONSULTOR-->
        <div class="container">
          <?php include('componentes/tablaconsultor.php'); ?>
          <div id="tabla"></div>
        </div>
        
        
        <!--anexe para el refresh-->
<form method="post" action="consultor1.php">
<input type="hidden" onclick="window.opener.location.reload(); window.close();">
</form>    

        
        
        <!--MODAL PARA REGISTROS NUEVOS-->
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Alta Folio GAM</h4>    
                    </div>
                    <div class="modal-body">
                        <label>Fecha</label>
                        <input type="text" name="" value="<?php echo $fechaactual = date("Y-m-d",$time); ?>" id="fecha" class="form-control input-sm" disabled>
                     
                        <label>Línea de negocio:</label>
                        <select type="text" name="negocio" value="" id="negocio" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit; ?>
                        </select>
                        <label>Tipo de Solicitud:</label>
                        <select type="text" name="t_solicitud" value="" id="t_solicitud" onChange="mostrar()" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit1; ?>
                        </select>
        
        
                        <label>Agente:</label>
                        <select type="text" name="agente" value="" id="agente" onChange="mostrar()" class="form-control input-sm">
                            <option  value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit6; ?>
                        </select>
                        
                        <!--FUNCION PARA QUE EL MODAL SEA DINAMICO DEPENDIENDO EL TIPO DE TRAMITE-->
                        <script>
                            function mostrar(){
                                var opcion = document.getElementById("t_solicitud").value;
                                if(opcion=="ALTA DE POLIZA"){
                                    document.getElementById('t_nuevo').style.display = 'block';
                                    document.getElementById('t_movimiento').style.display = 'none';
                                    document.getElementById('t_pago').style.display = 'none';        
                                }else if(opcion=="MOVIMIENTOS"){
                                    document.getElementById('t_movimiento').style.display = 'block';
                                    document.getElementById('t_nuevo').style.display = 'none';
                                    document.getElementById('t_pago').style.display = 'none';
                                }else if(opcion="PAGOS"){
                                    document.getElementById('t_pago').style.display = 'block';
                                    document.getElementById('t_nuevo').style.display = 'none';
                                    document.getElementById('t_movimiento').style.display = 'none';
                                }else{
                                    document.getElementById('t_nuevo').style.display = 'none';
                                    document.getElementById('t_movimiento').style.display = 'none';
                                    document.getElementById('t_pago').style.display = 'none';
                                }
                            }
                        </script>
                        
                        <!--ALTA DE POLIZA-->
                        <div id="t_nuevo" name="t_nuevo" style="display:none;">
                            <label>Producto:</label>
                            <select type="text" name="producto" value="" id="producto" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit4; ?>
                            </select>
                          
                            <label>Rango:</label>
                            <select type="text" name="rango" value="" id="rango" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit3; ?>
                            </select>
                            
                            <!--moneda 1 PARA ALT POLIZA-->
                            <label>Moneda:</label>
                            <select type="text" name="monedap" value="" id="monedap" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit2; ?>
                            </select>
                  

                            <label>Prima:</label>
                            <input type="text" name="prima1" value="" id="prima1" class="number form-control input-sm"  id="prima1" placeholder="Escribe la prima correspondiente" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 30 digitos)</i>
                        </div>
                        
                        <!--MOVIMIENTOS-->
                        <div id="t_movimiento" name="t_movimiento" style="display:none;">
                            <label>Póliza:</label>
                            <input type="text" name="poliza" value="" id="poliza" class="form-control input-sm"  placeholder="Escribe Poliza Correspondiente" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /> <i>(Máximo 40 caracteres)</i>
                         
                            <label>Tipo de movimiento:</label>
                            <select type="text" name="movimiento" value="" id="movimiento" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit5; ?>
                            </select>
                        </div>
                        
                        <!--PAGOS-->
                        <div id="t_pago" name="t_pago" style="display:none;">
                            <label>Póliza:</label>
                            <input type="text" name="polizap" value="" id="polizap" class="form-control input-sm"  placeholder="Escribe Poliza Correspondiente" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 40 caracteres)</i></br>

                            <label>Monto:</label>
                            <input type="text" name="monto1" value="" id="monto1" class=" number form-control input-sm"  id="monto1" placeholder="Escribe el monto correspondiente" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 30 caracteres)</i></br>           

                            <!--moneda 2 para PAGOS-->
                            <label>Moneda:</label>
                            <select type="text" name="moneda_pagos" value="" id="moneda_pagos" class="form-control input-sm">
                            <option value="" selected disabled hidden>Seleccione:</option>
                            <?php echo $combobit2; ?>
                            </select>
                        </div>
                        <!--TERMINA LA FUNCION PARA QUE EL MODAL SEA DINAMICO DEPENDIENDO EL TIPO DE TRAMITE-->
                        
                        <!--CONTINUA EL MODAL CON LOS DATOS FALTANTES-->
                        
                        <label>Contratante:</label>
                        <input type="text" name="contratante" value="" id="contratante" class="form-control input-sm" placeholder="Nombre APaterno AMaterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();" required>
              
                        <label>Prioridad:</label>
                        <select class="form-control" name="prioridad" id="prioridad">
                        <option value="Alta"> Alta </option>
                        <option value="Normal"> Normal </option>
                        </select>

                        <label>Comentarios:</label>
                        <input type="text" name="comentarios" value="" id="comentarios" class="form-control input-sm" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
                        <label>Estado:</label>
                        <input type="text" name="" value="ENVIADO" id="estado" class="form-control input-sm" disabled>
                        
                    </div>
                    <!--BOTON PARA CREAR FOLIOS Y GUARDAR ARCHIVOS-->
                    <div class="modal-footer">
                        <button href="#" class="btn btn-primary" type="button" id="guardar-form" onclick="return validar()">Crear</button>
                    </div><!--TERMINA EL DIV DEL BOTON PARA CREAR FOLIOS Y GUARDAR ARCHIVOS-->
                    <script type="text/javascript">
                        //FUNCION PARA VALIDAR LOS CAMPOS PARA EL REGISTRO DEL FOLIO
                        function validar(){
                            //PRIMEROS CAMPOS A VALIDAR
                            var linea_de_negocio = document.getElementById("negocio").value;
                            if(linea_de_negocio == null || linea_de_negocio == 0){
                              alertify.alert('ERROR: Seleccione alguna opción del combo Línea de negocio.');
                              return false;
                            }
            
                            var t_solicitud = document.getElementById("t_solicitud").value;
                            if(t_solicitud == null || t_solicitud == 0){
                              alertify.alert('ERROR: Seleccione alguna opción del combo Tipo de Solicitud.');
                              return false;          
                            }
            
                            var agente = document.getElementById("agente").value;
                            if(agente == null || agente == 0){
                              alertify.alert('ERROR: Seleccione alguna opción del combo Agente.');
                              return false;          
                            }
                            
                            //ALTA POLIZA
                            if(t_solicitud == 'ALTA DE POLIZA'){
                                var linea_de_negocio = document.getElementById("negocio").value;
                                if(linea_de_negocio == null || linea_de_negocio == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Línea de negocio.');
                                  return false;
                                }
                                            
                                var producto = document.getElementById("producto").value;  
                                if (producto == null || producto == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Producto.');
                                  return false;
                                } 
                
                                var rango = document.getElementById("rango").value;  
                                if (rango == null || rango == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Rango.');
                                  return false;
                                }
                
                                var monedap = document.getElementById("monedap").value;  
                                if (monedap == null || monedap == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Moneda.');
                                  return false;
                                }
                
                                var prima1 = document.getElementById("prima1").value;  
                                if (prima1 == null || prima1 == 0){
                                  alertify.alert('ERROR: Ingrese la Prima correspondiente.');
                                  return false;
                                }
                
                                var contratante = document.getElementById("contratante").value; 
                                if (contratante == ""){
                                  alertify.alert('ERROR: Ingrese el nombre del Contratante.');
                                  return false;
                                }
                                
                                //PRIORIDAD Y COMENTARIOS  
                                var prioridad = document.getElementById("prioridad").value;
                                var comentarios = document.getElementById("comentarios").value;
                
                                if (prioridad == 'Alta'){
                                  
                                    if(comentarios.length >=1 || /^\s+$/.test(comentarios)){
                                        $guarda = (guardarfolio()+actualizar()+actualizar1());
                                    }else{
                                        alertify.alert('ERROR: Ingrese un Comentario justificando la Prioridad Alta.');
                                    }
                                }else{
                                  $guardar_alta=(guardarfolio()+actualizar()+actualizar1());
                                }
                            }//CIERRE DE VALIDACION ALTA POLIZA
                            
                            //MOVIMIENTO
                            if(t_solicitud == 'MOVIMIENTOS'){
                                var linea_de_negocio = document.getElementById("negocio").value;
                                if(linea_de_negocio == null || linea_de_negocio == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Línea de negocio.');
                                  return false;
                                }
                
                                var poliza = document.getElementById("poliza").value;  
                                if (poliza == ""){
                                  alertify.alert('ERROR: Ingrese la Poliza correspondiente.');
                                  return false;
                                }
                
                                var movimiento = document.getElementById("movimiento").value;  
                                if (movimiento == null || movimiento == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Tipo de movimiento.');
                                  return false;
                                }
                
                                var contratante = document.getElementById("contratante").value; 
                                if (contratante == ""){
                                  alertify.alert('ERROR: Ingrese el nombre del Contratante.');
                                  return false;
                
                                }
                
                                //PRIORIDAD Y COMENTARIOS  
                                var prioridad = document.getElementById("prioridad").value;
                                var comentarios = document.getElementById("comentarios").value;
                
                                    if (prioridad == 'Alta'){
                                  
                                      if(comentarios.length >=1 || /^\s+$/.test(comentarios)){
                                        $guarda = (guardarfolio()+actualizar()+actualizar1());
                                      }
                                      else{
                                        alertify.alert('ERROR: Ingrese un Comentario justificando la Prioridad Alta.');
                                      }
                                    }else{
                                        $guardar_alta=(guardarfolio()+actualizar()+actualizar1());
                                    }
                            }//CIERRE DE VALIDACION MOVIMIENTO
                            
                            //PAGOS
                            if(t_solicitud == 'PAGOS'){
                                var linea_de_negocio = document.getElementById("negocio").value;
                                if(linea_de_negocio == null || linea_de_negocio == 0){
                                  alert('ERROR: Seleccione alguna opción en el combo Línea de negocio.');
                                  return false;
                                }
                
                                var polizap = document.getElementById("polizap").value;  
                                if (polizap == ""){
                                  alertify.alert('ERROR: Ingrese la Poliza correspondiente.');
                                  return false;
                                }
                
                                var monto1 = document.getElementById("monto1").value;
                                if (monto1 == ""){
                                  alertify.alert('ERROR: Ingrese el Monto correspondiente.');
                                  return false;
                                }
                
                                //hay cambios aqui
                
                                var moneda_pagos = document.getElementById("moneda_pagos").value;  
                                if (moneda_pagos == null || moneda_pagos == 0){
                                  alertify.alert('ERROR: Seleccione alguna opción del combo Moneda.');
                                  return false;
                                }
                
                                var contratante = document.getElementById("contratante").value; 
                                if (contratante == ""){
                                  alertify.alert('ERROR: Ingrese el nombre del Contratante.');
                                  return false;
                
                                }
                
                                //PRIORIDAD Y COMENTARIOS  
                                var prioridad = document.getElementById("prioridad").value;
                                var comentarios = document.getElementById("comentarios").value;
                
                                  if (prioridad == 'Alta'){
                                  
                                      if(comentarios.length >=1 || /^\s+$/.test(comentarios)){
                                        $guarda = (guardarfolio()+actualizar()+actualizar1());
                
                                      }else{
                                        alertify.alert('ERROR: Ingrese un Comentario justificando la Prioridad Alta.');
                                      }
                                  }else{
                                    $guardar_alta=(guardarfolio()+actualizar()+actualizar1());
                                  }
                            }//CIERRE DE CALIDACION PAGOS
                        }
                    </script>
                </div>
            </div>
        </div><!--TERMINA MODAL PARA REGISTRO DE FOLIOS-->
    </body>
</html>

<script>
    function guardarfolio(){
        
        fecha = $('#fecha').val();
        negocio = $('#negocio').val();
        t_solicitud = $('#t_solicitud').val();
        producto = $('#producto').val();
        rango = $('#rango').val();
        moneda = $('#moneda').val();
        prima1 = $('#prima1').val();
        poliza = $('#poliza').val();
        movimiento = $('#movimiento').val();
        monto1 = $('#monto1').val();
        contratante = $('#contratante').val();
        prioridad = $('#prioridad').val();
        comentarios = $('#comentarios').val();
        estado = $('#estado').val();
        polizap = $('#polizap').val();
        monedap = $('#monedap').val();
        agente = $('#agente').val();
        
        //hay cambios aqui
        moneda_pagos = $('#moneda_pagos').val();

        //se incerto otro cambio aqui moneda_pagos

        guardarfolio = "true";
        var cadena="fecha=" + fecha + "&negocio=" + negocio + "&t_solicitud=" + t_solicitud + "&producto=" + producto + "&rango=" + rango + "&moneda=" + moneda + "&prima1=" + prima1 + "&poliza=" + poliza + "&movimiento=" + movimiento + "&monto1=" + monto1 + "&contratante=" + contratante + "&prioridad=" + prioridad + "&comentarios=" + comentarios  + "&estado=" + estado +"&polizap=" + polizap + "&monedap=" + monedap + "&moneda_pagos=" +  moneda_pagos + '&guardar='+'v' + "&agente=" + agente;
        
        
        if (window.FormData) {
            formdata = new FormData();
        }
        
        formdata.append("datos", cadena);
        $.ajax({
            url: 'php/agregarfolio_consultor1.php',
            type: 'POST',
            contentType: false,
            data: formdata,
            processData: false,
            cache: false,
            success: function(resultado){
                $('#guardar-form').removeAttr("disabled");
            },
            error: function (){
                alert("Algo ha fallado.");
            }
        });
        
    }
</script>

<script>
    function actualizar(segs){
        setTimeout(function() {
            location.reload();
            location.reload();
        }, 
        parseInt(segs) * 1000);
    }
</script>

<script>
    function actualizar1(segs){
        setTimeout(function() {
            location.reload();
            location.reload();
        }, 
        parseInt(segs) * 1000);
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabla_agentes').DataTable({});
          $('#tabla_agentes').on( 'click', 'tbody tr', function (e) {
                console.log(this);
            });
            
        
        $('input.number').keyup(function(event) {
    
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }
                
            $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/([0-9])([0-9]{2})$/, '$1.$2')  
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
                ;
            });
        });
        
    });
</script>

<!--codigo anexado para bloquear teclas y mouse-->
<script>
window.oncontextmenu = function() {
return false;
} </script>

     <script language="JavaScript">

       window.onload = function () {
           document.addEventListener("contextmenu", function (e) {
               e.preventDefault();
           }, false);
           document.addEventListener("keydown", function (e) {
               //document.onkeydown = function(e) {
               // "I" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                   disabledEvent(e);
               }
               // "J" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                   disabledEvent(e);
               }
               // "S" key + macOS
               if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                   disabledEvent(e);
               }
               // "U" key
               if (e.ctrlKey && e.keyCode == 85) {
                   disabledEvent(e);
               }
               // "F12" key
               if (event.keyCode == 123) {
                   disabledEvent(e);
               }
           }, false);
           function disabledEvent(e) {
               if (e.stopPropagation) {
                   e.stopPropagation();
               } else if (window.event) {
                   window.event.cancelBubble = true;
               }
               e.preventDefault();
               return false;
           }
       }
      </script>


<!--anexe para el refresh-->
          <script type="text/javascript">
          function cargar(){
              opener.location.reload();
              window.close();
          }
