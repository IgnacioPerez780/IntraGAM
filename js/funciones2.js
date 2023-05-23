function guardar3(){

  folio = $('#folio').val();
  observaciones = $('#observaciones').val();
  usuario = $('#usuario').val();
  estadoss = $('#estadoss').val();
  estado = $('#estado').val();
  //estado1 = $('#estado1').val();
  //fgnp = $('#fgnp').val();
  //polizap = $('#polizap').val();  


  cadena="folio=" + folio +
         "&observaciones=" + observaciones +
         "&usuario=" + usuario +
         "&estadoss=" + estadoss +
         "&estado=" + estado;

  $.ajax({
    type:"POST",
    url:"php/agregarcom_s_c.php",
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
