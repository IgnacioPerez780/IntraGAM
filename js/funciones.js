function agregarfolio(fecha,negocio,t_solicitud,producto,rango,moneda,prima,poliza,movimiento,monto,contratante,prioridad,comentarios,estado,archivo){

  cadena="fecha=" + fecha +
         "&negocio=" + negocio +
         "&t_solicitud=" + t_solicitud +
         "&producto=" + producto +
         "&rango=" + rango +
         "&moneda=" + moneda +
         "&prima=" + prima +
         "&poliza=" + poliza +
         "&movimiento=" + movimiento +
         "&monto=" + monto +
         "&contratante=" + contratante +
         "&prioridad=" + prioridad +
         "&comentarios=" + comentarios +
         "&estado=" + estado +
         "&archivo=" + archivo;

         $.ajax({
             type:"POST",
             url:"php/agregarfolio.php",
             data:cadena,
             success:function(r){
               if(r==1){
                 $('#tabla').load('componentes/tabla.php');
                 alertify.success("Agregado correctamente :)");

               }else{
                 //alertify.error("Fallo en el servidor :´(");
               }
             }
           })
}

function agregaform(datos){

  d = datos.split('||');

  $('#idpersona').val(d[0]);
  $('#fechau').val(d[1]);
  $('#negociou').val(d[2]);
  $('#t_solicitudu').val(d[3]);
  $('#productou').val(d[4]);
  $('#rangou').val(d[5]);
  $('#monedau').val(d[6]);
  $('#primau').val(d[7]);
  $('#polizau').val(d[8]);
  $('#movimientou').val(d[9]);
  $('#montou').val(d[10]);
  $('#contratanteu').val(d[11]);
  $('#prioridadu').val(d[12]);
  $('#comentariosu').val(d[13]);
  $('#monedap').val(d[14]);
  $('#moneda_pagos').val(d[15]);
  $('#estadou').val(d[16]);
}

function actualizadatos(){

  id = $('#idpersona').val();
  fecha = $('#fechau').val();
  negocio = $('#negociou').val();
  t_solicitud = $('#t_solicitudu').val();
  producto = $('#productou').val();
  rango = $('#rangou').val();
  moneda = $('#monedau').val();
  prima = $('#primau').val();
  poliza = $('#polizau').val();
  movimiento = $('#movimientou').val();
  monto = $('#montou').val();
  contratante = $('#contratanteu').val();
  prioridad = $('#prioridadu').val();
  comentarios = $('#comentariosu').val();
  estado = $('#estadou').val();

  cadena="id=" + id +
         "&fecha=" + fecha +
         "&negocio=" + negocio +
         "&t_solicitud=" + t_solicitud +
         "&producto=" + producto +
         "&rango=" + rango +
         "&moneda=" + moneda +
         "&prima=" + prima +
         "&poliza=" + poliza +
         "&movimiento=" + movimiento +
         "&monto=" + monto +
         "&contratante=" + contratante +
         "&prioridad=" + prioridad +
         "&comentarios=" + comentarios +
         "&estado=" + estado;

  $.ajax({
    type:"POST",
    url:"php/actualizadatos.php",
    data:cadena,
    success:function(r){

      if(r==1){
        $('#tabla').load('componentes/tabla.php');
          alertify.success("Actualizado con Exito :)");
      }else{
          //alertify.error("Fallo el servidor :(");
        }
    }
  })
}

function actualizadatosconsultor(){

  id = $('#idpersona').val();
  fecha = $('#fechau').val();
  negocio = $('#negociou').val();
  t_solicitud = $('#t_solicitudu').val();
  producto = $('#productou').val();
  rango = $('#rangou').val();
  moneda = $('#monedau').val();
  prima = $('#primau').val();
  poliza = $('#polizau').val();
  movimiento = $('#movimientou').val();
  monto = $('#montou').val();
  contratante = $('#contratanteu').val();
  prioridad = $('#prioridadu').val();
  comentarios = $('#comentariosu').val();
  estado = $('#estadou').val();

  cadena="id=" + id +
         "&fecha=" + fecha +
         "&negocio=" + negocio +
         "&t_solicitud=" + t_solicitud +
         "&producto=" + producto +
         "&rango=" + rango +
         "&moneda=" + moneda +
         "&prima=" + prima +
         "&poliza=" + poliza +
         "&movimiento=" + movimiento +
         "&monto=" + monto +
         "&contratante=" + contratante +
         "&prioridad=" + prioridad +
         "&comentarios=" + comentarios +
         "&estado=" + estado;

  $.ajax({
    type:"POST",
    url:"php/actualizadatosconsultor.php",
    data:cadena,
    success:function(r){

      if(r==1){
        $('#tabla').load('componentes/tablaconsultor.php');
          alertify.success("Actualizado con Exito :)");
      }else{
          //alertify.error("Fallo el servidor :(");
        }
    }
  })
}

function guardar(){

  folio = $('#folio').val();
  observaciones = $('#observaciones').val();
  usuario = $('#usuario').val();
  estadoss = $('#estadoss').val();
  estado = $('#estado').val();
  estado1 = $('#estado1').val();
  fgnp = $('#fgnp').val();
  polizap = $('#polizap').val();  
  
  prima2 = $('#prima2').val();
  moneda2 = $('#moneda2').val();
  periodo = $('#periodo').val();
  primaAnual = $('#primaAnual').val();


  cadena="folio=" + folio +
         "&observaciones=" + observaciones +
         "&usuario=" + usuario +
         "&estadoss=" + estadoss +
         "&estado=" + estado +
         "&estado1=" + estado1 +
         "&fgnp=" + fgnp +
         "&polizap=" + polizap +
        "&prima2=" + prima2 +
         "&moneda2=" + moneda2 +
         "&periodo=" + periodo +
         "&primaAnual=" + primaAnual;

  $.ajax({
    type:"POST",
    url:"php/agregarcom.php",
    data:cadena,
    success:function(r){

      if(r==1){
        //$('#tabla').load('../seguimiento.php');
          alertify.success("Actualizado con Exito :)");
      }else{
          //alertify.error("Fallo el servidor :(");
        }
    }
  })
}

function guardar1(){

  folio = $('#folio').val();
  observaciones = $('#observaciones').val();
  usuario = $('#usuario').val();
  estadoss = $('#estadoss').val();


  cadena="folio=" + folio +
         "&observaciones=" + observaciones +
         "&usuario=" + usuario +
         "&estadoss=" + estadoss;

  $.ajax({
    type:"POST",
    url:"php/agregarcom1.php",
    data:cadena,
    success:function(r){

      if(r==1){
        //$('#tabla').load('../seguimiento.php');
          alertify.success("Actualizado con Exito :)");
      }else{
          //alertify.error("Fallo el servidor :(");
        }
    }
  })
}

function reload(segs) {
    setTimeout(function() {
        location.reload();
    }, parseInt(segs) * 1000);
}
