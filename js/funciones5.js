function guardar5(){

  folio = $('#folio').val();
  observaciones = $('#observaciones').val();
  usuario = $('#usuario').val();
  estadoss = $('#estadoss').val();
  estado = $('#estado').val();
  estado1 = $('#estado1').val();
  fgnp = $('#fgnp').val();
  poliza = $('#poliza').val();  


  cadena="folio=" + folio +
         "&observaciones=" + observaciones +
         "&usuario=" + usuario +
         "&estadoss=" + estadoss +
         "&estado=" + estado +
         "&estado1=" + estado1 +
         "&fgnp=" + fgnp +
         "&poliza=" + poliza;

  $.ajax({
    type:"POST",
    url:"php/agregarcom_a_c.php",
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