function guardar4(){

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
    url:"php/agregarcom1_g.php",
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