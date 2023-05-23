// funcion que envia los datos a la hoja registro_f_s por ajax //
function enviar() {
    //var consulta = document.getElementById('consulta').value;
    //var solicitud = document.getElementById('solicitud').value;
    var poliza = document.getElementById('poliza').value;
    var asegurado = document.getElementById('asegurado').value;
    //var estatus = document.getElementById('estatus').value;

    var datos = 'poliza=' + poliza + '&asegurado=' + asegurado;

    $.ajax({
        type: 'POST',
        url: 'registro_f_s.php',
        data: datos,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}