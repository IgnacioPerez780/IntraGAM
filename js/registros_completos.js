// funcion que muestra los input de general e individual//

function showInp() {
    getSelectValue = document.getElementById("seleccion").value;
    if (getSelectValue == "1") {
        document.getElementById("mostrarIndividual").style.display = "none";
        document.getElementById("mostrarGeneral").style.display = "block";
    } else if (getSelectValue == "2") {
        document.getElementById("mostrarIndividual").style.display = "block";
        document.getElementById("mostrarGeneral").style.display = "none";
    }
}
// funcion que envia los datos de las fechas a la hoja resultGeneral//

function enviarTotal() {
    var date1T = document.getElementById('date1T').value;
    var date2T = document.getElementById('date2T').value;

    var dataenT = 'date1T=' + date1T + '&date2T=' + date2T;

    $.ajax({
        type: 'POST',
        url: 'registro_resultGeneral.php',
        data: dataenT,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}

// funcion que envia las fechas seleccionadas a la hoja de consulta individual//

function enviarIndividual() {
    var date1Ind = document.getElementById('date1').value;
    var date2Ind = document.getElementById('date2').value;
    var nombre = document.getElementById('seleccion2').value;

    var dataenInd = '&date1=' + date1Ind + '&date2=' + date2Ind + '&seleccion2=' + nombre;

    $.ajax({
        type: 'POST',
        url: 'registro_resultIndividual.php',
        data: dataenInd,
        success: function (resp) {
            $('#respInd').html(resp);
        }
    });
    return false;
}

