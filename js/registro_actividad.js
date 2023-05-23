//RESULTADOS EN FECHAS DESDE HASTA Y LA TABLA 

function resultCarolina() {
    var x = document.getElementById("resultC");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

function resultDante() {
    var x = document.getElementById("resultDa");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

function resultDiana() {
    var x = document.getElementById("resultDi");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

function resultGiovanni() {
    var x = document.getElementById("resultGi");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

function resultKarla() {
    var x = document.getElementById("resultK");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

function resultVeronica() {
    var x = document.getElementById("resultV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

function resultTodos() {
    var x = document.getElementById("resultT");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

//MUESTRA LOS RESULTADOS DE CADA SELECCIONE ELEGIDA
function mostrarSeleccion() {
    var opcion = document.getElementById("select").value;
    if (opcion == "Carolina") {
        document.getElementById('Carolina').style.display = 'block';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'none';
    } else if (opcion == "Dante") {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'block';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'none';
    } else if (opcion == "Diana") {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'block';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'none';
    } else if (opcion == "Giovanni") {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'block';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'none';
    } else if (opcion == "Karla") {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'block';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'none';
    } else if (opcion == "Veronica") {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'block';
        document.getElementById('Todos').style.display = 'none';
    } else if (opcion == "Todos") {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'block';
    } else {
        document.getElementById('Carolina').style.display = 'none';
        document.getElementById('Dante').style.display = 'none';
        document.getElementById('Diana').style.display = 'none';
        document.getElementById('Giovanni').style.display = 'none';
        document.getElementById('Karla').style.display = 'none';
        document.getElementById('Veronica').style.display = 'none';
        document.getElementById('Todos').style.display = 'none';
    }
}

// funcion para enviar las fechas por post usando ajax  // 

function enviar() {
    var date1 = document.getElementById('date1').value;
    var date2 = document.getElementById('date2').value;

    var dataen = 'date1=' + date1 + '&date2=' + date2;

    $.ajax({
        type: 'POST',
        url: 'registro_c.php',
        data: dataen,
        success: function (resp) {
            $('#respC').html(resp);
        }
    });
    return false;
}


function enviarDa() {
    var date1Da = document.getElementById('date1Da').value;
    var date2Da = document.getElementById('date2Da').value;

    var dataenDa = 'date1Da=' + date1Da + '&date2Da=' + date2Da;

    $.ajax({
        type: 'POST',
        url: 'registro_da.php',
        data: dataenDa,
        success: function (resp) {
            $('#respDa').html(resp);
        }
    });
    return false;
}

function enviarDi() {
    var date1Di = document.getElementById('date1Di').value;
    var date2Di = document.getElementById('date2Di').value;

    var dataenDi = 'date1Di=' + date1Di + '&date2Di=' + date2Di;

    $.ajax({
        type: 'POST',
        url: 'registro_di.php',
        data: dataenDi,
        success: function (resp) {
            $('#respDi').html(resp);
        }
    });
    return false;
}


function enviarGi() {
    var date1Gi = document.getElementById('date1Gi').value;
    var date2Gi = document.getElementById('date2Gi').value;

    var dataenGi = 'date1Gi=' + date1Gi + '&date2Gi=' + date2Gi;

    $.ajax({
        type: 'POST',
        url: 'registro_gi.php',
        data: dataenGi,
        success: function (resp) {
            $('#respGi').html(resp);
        }
    });
    return false;
}


function enviarK() {
    var date1K = document.getElementById('date1K').value;
    var date2K = document.getElementById('date2K').value;

    var dataenK = 'date1K=' + date1K + '&date2K=' + date2K;

    $.ajax({
        type: 'POST',
        url: 'registro_k.php',
        data: dataenK,
        success: function (resp) {
            $('#respK').html(resp);
        }
    });
    return false;
}

function enviarV() {
    var date1V = document.getElementById('date1V').value;
    var date2V = document.getElementById('date2V').value;

    var dataenV = 'date1V=' + date1V + '&date2V=' + date2V;

    $.ajax({
        type: 'POST',
        url: 'registro_v.php',
        data: dataenV,
        success: function (resp) {
            $('#respV').html(resp);
        }
    });
    return false;
}

function enviarTotal() {
    var date1T = document.getElementById('date1T').value;
    var date2T = document.getElementById('date2T').value;

    var dataenT = 'date1T=' + date1T + '&date2T=' + date2T;

    $.ajax({
        type: 'POST',
        url: 'registro_t.php',
        data: dataenT,
        success: function (resp) {
            $('#respT').html(resp);
        }
    });
    return false;
}

