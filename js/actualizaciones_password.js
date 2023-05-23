//Indicios password
$(document).ready(function () {
    $("input#password1,#password2").keyup(function () {
        var ucase = new RegExp("[A-Z]+");
        var lcase = new RegExp("[a-z]+");
        var num = new RegExp("[0-9]+");
        var conta = 0;


        //8 CARACTERES
        if ($("#password1").val().length >= 8) {
            $("#8char").removeClass("glyphicon-remove");
            $("#8char").addClass("glyphicon-ok");
            $("#8char").css("color", "#00A41E");
            conta = conta + 1;
        } else {
            $("#8char").removeClass("glyphicon-ok");
            $("#8char").addClass("glyphicon-remove");
            $("#8char").css("color", "#FF0004");
        }

        //MAYUSCULA
        if (ucase.test($("#password1").val())) {
            $("#ucase").removeClass("glyphicon-remove");
            $("#ucase").addClass("glyphicon-ok");
            $("#ucase").css("color", "#00A41E");
            conta = conta + 1;
        } else {
            $("#ucase").removeClass("glyphicon-ok");
            $("#ucase").addClass("glyphicon-remove");
            $("#ucase").css("color", "#FF0004");

        }

        //MINUSCULA
        if (lcase.test($("#password1").val())) {
            $("#lcase").removeClass("glyphicon-remove");
            $("#lcase").addClass("glyphicon-ok");
            $("#lcase").css("color", "#00A41E");
            conta = conta + 1;
        } else {
            $("#lcase").removeClass("glyphicon-ok");
            $("#lcase").addClass("glyphicon-remove");
            $("#lcase").css("color", "#FF0004");
        }

        //NUMERO
        if (num.test($("#password1").val())) {
            $("#num").removeClass("glyphicon-remove");
            $("#num").addClass("glyphicon-ok");
            $("#num").css("color", "#00A41E");
            conta = conta + 1;
        } else {
            $("#num").removeClass("glyphicon-ok");
            $("#num").addClass("glyphicon-remove");
            $("#num").css("color", "#FF0004");
        }

        //COINCIDENCIA ENTRE LA CONTRASEÑA NUEVA/CONFIRMACION DE LA CONTRASEÑA
        if ($("#password1").val() != $("#password2").val()) {
            console.log('ROJO1');
            $("#pwmatch").removeClass("glyphicon-ok");
            $("#pwmatch").addClass("glyphicon-remove");
            $("#pwmatch").css("color", "#FF0004");
        } else if ($("#password2").val() == 0) {
            console.log('ROJO2');
            $("#pwmatch").removeClass("glyphicon-ok");
            $("#pwmatch").addClass("glyphicon-remove");
            $("#pwmatch").css("color", "#FF0004");
        } else {
            console.log('VERDE');
            $("#pwmatch").removeClass("glyphicon-remove");
            $("#pwmatch").addClass("glyphicon-ok");
            $("#pwmatch").css("color", "#00A41E");
            conta = conta + 1;
        }


        //CONTADOR DE VALIDACION CORRECTA
        if (conta == 5) {
            console.log(conta);
            $('#actualizarPass').prop('disabled', false);
        }
    });

});

//VISUALIZAR PASSWORD
function myFunction() {
    var x = document.getElementById("contrasena_actual");
    var y = document.getElementById("password1");
    var z = document.getElementById("password2");
    if (x.type === "password" || y.type === "password" || z.type === "password") {
        x.type = "text";
        y.type = "text";
        z.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
        z.type = "password";
    }
}