<?php
    error_reporting(0);
    include 'app/conexion.php';
    $conexion = conexion();
    include('plantillas/cabecera_agente.php');
    
    if( $_SESSION['logged_in']<>TRUE){
        header('location: index.php');
        exit;
    }
    
    
    //INACTIVIDAD DE SESION
    if(isset($_SESSION['logged_in']))
    {
        // set time-out period (in seconds)
        $inactive = 1500;
         
        // check to see if $_SESSION["timeout"] is set
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
    

    if ( $_SESSION['logged_in'] == 1  ){} else header('location: index.php');
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
 ?>
 <!DOCTYPE html>
 <html>
    <head>

<!--ALERTAS PARA MENSAJES DE VALIDACION-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/alertify.min.js"></script>

    <meta http-equiv = "refresh" content = "1500" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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

    <div class="container">
      <?php include('componentes/tabla.php'); ?>
      <div id="tabla"></div>
    </div>
    
    <!-- Modal para registros nuevos -->
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
              <select type="text" name="t_solicitud" value="" id="t_solicitud" onChange="mostrar();"class="form-control input-sm">
                <option value="" selected disabled hidden>Seleccione:</option>
                <?php echo $combobit1; ?>
              </select>
              

              <script>
                function mostrar(){
              var opcion = document.getElementById("t_solicitud").value;
              // alert(opcion);

              if(opcion=="ALTA DE POLIZA"){
                document.getElementById('t_nuevo').style.display = 'block';
                document.getElementById('t_movimiento').style.display = 'none';
                document.getElementById('t_pago').style.display = 'none';
              }else if (opcion=="MOVIMIENTOS") {
                document.getElementById('t_movimiento').style.display = 'block';
                document.getElementById('t_nuevo').style.display = 'none';
                document.getElementById('t_pago').style.display = 'none';
              }else if (opcion=="PAGOS") {
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


              <div id="t_movimiento" name="t_movimiento" style="display:none;">
                  <label>Póliza:</label>
                  <input type="text" name="poliza" value="" id="poliza" class="form-control input-sm"  placeholder="Escribe Poliza Correspondiente" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /> <i>(Máximo 40 caracteres)</i>
                 
                  <label>Tipo de movimiento:</label>
                  <select type="text" name="movimiento" value="" id="movimiento" class="form-control input-sm">
                    <option value="" selected disabled hidden>Seleccione:</option>
                    <?php echo $combobit5; ?>
                  </select>
              </div>


              <div id="t_pago" name="t_pago" style="display:none;">


                  <label>Póliza:</label>
                  <input type="text" name="polizap" value="" id="polizap" class="form-control input-sm"  placeholder="Escribe Poliza Correspondiente" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 40 caracteres)</i></br>
                  

                  <label>Monto:</label>
                  <input type="text" name="monto1" value="" id="monto1" class="number form-control input-sm"  id="monto1" placeholder="Escribe el monto correspondiente" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 30 caracteres)</i></br>

                 
                  <!--moneda 2 para PAGOS-->

                  <label>Moneda:</label>
                  <select type="text" name="moneda_pagos" value="" id="moneda_pagos" class="form-control input-sm">
                  <option value="" selected disabled hidden>Seleccione:</option>
                    <?php echo $combobit2; ?>
                  </select>

              </div>
              
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

              <div class="col-md-14">
                  <div class="form-group"><span class="glyphicon glyphicon-folder-open"></span>
                      <label>Solicitud</label>
                      <input type="file" id="solicitud" name="solicitud"  class="form-control"   accept=".pdf">
                      <span class="btn-danger" id ='res_solicitud' ></span>
                  </div>
                  <div class="form-group"><span class="glyphicon glyphicon-folder-open"></span>
                      <label>Identificación</label>
                      <input type="file" id="identificacion" name="fidentificacion"  class="form-control"   accept=".pdf">
                      <span  class="btn-danger"  id ='res_identificacion' ></span>
                  </div>
                  <div class="form-group"><span class="glyphicon glyphicon-folder-open"></span>
                      <label>Comprobante Domicilio</label>
                      <input type="file" id="comprobante" name="comprobante"  class="form-control"   accept=".pdf">
                      <span  class="btn-danger"  id ='res_comprobante' ></span>
                  </div>
                  <div class="form-group"><span class="glyphicon glyphicon-folder-open"></span>
                    <label>Otros Documentos</label> <span></span>
                    <input type="file" id="file" name="file[]"  multiple="15" class="form-control"   accept=".pdf">
                      <span  class="btn-danger"  id ='res_file' ></span>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button href="#" class="btn btn-primary" type="button" id="guardar-form" onclick="return validar()" id="btnreload"> Crear</button>
          </div>

          <script type="text/javascript">

              //VALIDACION DE CAMPOS PARA EL MODAL
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
                        $guarda = (guardarfolio()+actualizar());
                      }
                      else{
                        alertify.alert('ERROR: Ingrese un Comentario justificando la Prioridad Alta.');
                      }
                  }else{
                  $guardar_alta=(guardarfolio()+actualizar());
              }

              }//CIERRE ALTA POLIZA

                //MOVIMIENTO 
                if(t_solicitud == 'MOVIMIENTOS'){

                var linea_de_negocio = document.getElementById("negocio").value;
                if(linea_de_negocio == null || linea_de_negocio == 0){
                  alertify.alert('ERROR: Seleccione alguna opción del combo Línea de negocio.');
                  return false;
                }

                var poliza = document.getElementById("poliza").value;  
                if (poliza == ""){
                  alertify.alert('ERROR: Ingrese la Póliza correspondiente.');
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
                        $guarda = (guardarfolio()+actualizar());
                      }
                      else{
                        alertify.alert('ERROR: Ingrese un Comentario justificando la Prioridad Alta.');
                      }
                  }else{
                  $guardar_alta=(guardarfolio()+actualizar());
              }

              }//CIERRE MOVIMIENTO


              //PAGOS
                if(t_solicitud == 'PAGOS'){
                var linea_de_negocio = document.getElementById("negocio").value;
                if(linea_de_negocio == null || linea_de_negocio == 0){
                  alert('ERROR: Seleccione alguna opción en el combo Línea de negocio.');
                  return false;
                }

                var polizap = document.getElementById("polizap").value;  
                if (polizap == ""){
                  alertify.alert('ERROR: Ingrese la Póliza correspondiente.');
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
                        $guarda = (guardarfolio()+actualizar());

                      }else{
                        alertify.alert('ERROR: Ingrese un Comentario justificando la Prioridad Alta.');
                      }
                  }else{
                    $guardar_alta=(guardarfolio()+actualizar());
                  }

              }//CIERRE PAGO
              
}//CIERRE FUNCION VALIDAR

          </script>



  <script>
              function guardarfolio() {
                var archivos_pdf = [];
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

                 //hay cambios aqui
                 moneda_pagos = $('#moneda_pagos').val();

                 //se incerto otro cambio aqui moneda_pagos

                 guardarfolio = "true";
                 var cadena="fecha=" + fecha + "&negocio=" + negocio + "&t_solicitud=" + t_solicitud + "&producto=" + producto + "&rango=" + rango + "&moneda=" + moneda + "&prima1=" + prima1 + "&poliza=" + poliza + "&movimiento=" + movimiento + "&monto1=" + monto1 + "&contratante=" + contratante + "&prioridad=" + prioridad + "&comentarios=" + comentarios  + "&estado=" + estado +"&polizap=" + polizap + "&monedap=" + monedap + "&moneda_pagos=" +  moneda_pagos + '&guardar='+'v' ;


                var filedata = $('#file')[0],
                    formdata = false;


                var i = 0, len =  filedata.files.length, file;
                if (window.FormData) {
                    formdata = new FormData();
                }



                /*for (; i < len; i++) {
                   console.log( filedata.files[0]);
                   console.log( filedata.files[1]);
                   file = filedata.files[i];
                    formdata.append("file"+i, file);
                }*/


                formdata.append("datos", cadena);
                $.ajax({
                  url: 'php/agregarfolio_agente.php',
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
              }, parseInt(segs) * 1000);
            }
          </script>
        </div>
      </div>
    </div>
    <footer>
      <script src="js/index.js"></script>
      <script src="<?php  echo $base_url ?>librerias/jquery-3.2.1.min.js"></script>
      <script src="js/funciones.js"></script>
      <script src="<?php  echo $base_url ?>librerias/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?php  echo $base_url ?>librerias/datatables/jquery.dataTables.min.js"></script>
      <script src="<?php  echo $base_url ?>librerias/datatables/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){


          $('#tabla_agentes').DataTable({});
          $('#tabla_agentes').on( 'click', 'tbody tr', function (e) {
                console.log(this);
          } );





          /*$('#file').change(function() {
            $('#guardar-form').removeAttr("disabled");
          });*/

//ANEXE
          $('#file').change(function() { 
              var file_data = $('#file').prop('files')[0]; 
              status = send_file(file_data , 'file');
              if(status)
                $('#res_file').html("");
              else
                $('#res_file').html("Tú archivo es demasido grande, el límite es de 10 megas."); 
          }); 

          $('#solicitud').change(function() {
              var file_data = $('#solicitud').prop('files')[0];
              status = send_file(file_data , 'solicitud');
              if(status)
                $('#res_solicitud').html("");
              else
                $('#res_solicitud').html(" tu archivo es demasido grande el limite es de 2 megas");
          });
          $('#identificacion').change(function() {
              var file_data = $('#identificacion').prop('files')[0];
               status = send_file(file_data ,'identificacion');
              if(status)
                $('#res_identificacion').html("");
              else
                $('#res_identificacion').html(" tu archivo es demasido grande el limite es de 2 megas");
          });
          $('#comprobante').change(function() {
              var file_data = $('#comprobante').prop('files')[0];
               status = send_file(file_data, 'comprobante');
              if(status)
                $('#res_comprobante').html("" );
              else
                $('#res_comprobante').html(" tu archivo es demasido grande el limite es de 2 megas");
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

          function send_file(file_data , id_archivo){
            var form_data = new FormData();
            form_data.append(id_archivo, file_data);
            $.ajax({
                url: 'php/agregarfolio_agente.php',
                type: 'POST',
                contentType: false,
                data: form_data,
                processData: false,
                cache: false,
                success:function(data) {
                    if(data){
                      datos = JSON.parse(data);
                      alert(datos.mensaje);
                      return datos.mensaje;
                    }
                    else {
                      return datos.mensaje;
                    }
                  },
                  error: function (){
                    alert("Algo ha fallado.");
                  }
              });
            }
        });
      </script>
    </footer>
  </body>
</html>