// funcion que envia los datos a la hoja registro_fcolab_v//
function enviarVida() {
    //var consulta = document.getElementById('consulta').value;
    //var solicitud = document.getElementById('solicitud').value;
    var poliza = document.getElementById('poliza').value;
    var asegurado = document.getElementById('asegurado').value;
    //var estatus = document.getElementById('estatus').value;

    var datos = 'poliza=' + poliza + '&asegurado=' + asegurado;

    $.ajax({
        type: 'POST',
        url: 'registro_fColab_v.php',
        data: datos,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}

function enviarSiniestros() {
    //var consulta = document.getElementById('consulta').value;
    //var solicitud = document.getElementById('solicitud').value;
    var poliza = document.getElementById('poliza').value;
    var asegurado = document.getElementById('asegurado').value;
    //var estatus = document.getElementById('estatus').value;

    var datos = 'poliza=' + poliza + '&asegurado=' + asegurado;

    $.ajax({
        type: 'POST',
        url: 'registro_fColab_s.php',
        data: datos,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}


function enviarGmm() {
    //var consulta = document.getElementById('consulta').value;
    //var solicitud = document.getElementById('solicitud').value;
    var poliza = document.getElementById('poliza').value;
    var asegurado = document.getElementById('asegurado').value;
    //var estatus = document.getElementById('estatus').value;

    var datos = 'poliza=' + poliza + '&asegurado=' + asegurado;

    $.ajax({
        type: 'POST',
        url: 'registro_fColab_gmm.php',
        data: datos,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}


function enviarAutos() {
    //var consulta = document.getElementById('consulta').value;
    //var solicitud = document.getElementById('solicitud').value;
    var poliza = document.getElementById('poliza').value;
    var asegurado = document.getElementById('asegurado').value;
    //var estatus = document.getElementById('estatus').value;

    var datos = 'poliza=' + poliza + '&asegurado=' + asegurado;

    $.ajax({
        type: 'POST',
        url: 'registro_fColab_a.php',
        data: datos,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}


