// funcion que manda alerta si no se ha cargado el archivo //
function alerta() {
    var archivo = document.getElementById("archivo").value;
    if (archivo == null || archivo == 0) {
        swal({
            title: "¡Error!",
            text: "Seleccione algun Archivo para continuar",
            type: "error",
            customClass: 'swal-wide',
            allowOutsideClick: false
        });
        hasError = true;
        return false;
    } else {
        $("#cancelar").prop("disabled", false);
        $(".barraProgresoT").removeClass("barraProgresoT");
    }
}

// alerta para archivo de GMM // 
function alertaGmm() {
    var archivoGmm = document.getElementById("archivoGmm").value;
    if (archivoGmm == null || archivoGmm == 0) {
        swal({
            title: "¡Error!",
            text: "Seleccione algun Archivo para continuar",
            type: "error",
            customClass: 'swal-wide',
            allowOutsideClick: false
        });
        hasError = true;
        return false;
    } else {
        $("#cancelarGmm").prop("disabled", false);
        $(".barraProgresoTGmm").removeClass("barraProgresoTGmm");
    }
}
// alerta para archivo de vida // 
function alertaVida() {
    var archivoVida = document.getElementById("archivoVida").value;
    if (archivoVida == null || archivoVida == 0) {
        swal({
            title: "¡Error!",
            text: "Seleccione algun Archivo para continuar",
            type: "error",
            customClass: 'swal-wide',
            allowOutsideClick: false
        });
        hasError = true;
        return false;
    } else {
        $("#cancelarVida").prop("disabled", false);
        $(".barraProgresoTVida").removeClass("barraProgresoTVida");
    }
}

// alerta para archivo de otros // 
function alertaOtros() {
    var archivoOtros = document.getElementById("archivoOtros").value;
    if (archivoOtros == null || archivoOtros == 0) {
        swal({
            title: "¡Error!",
            text: "Seleccione algun Archivo para continuar",
            type: "error",
            customClass: 'swal-wide',
            allowOutsideClick: false
        });
        hasError = true;
        return false;
    } else {
        $("#cancelarOtros").prop("disabled", false);
        $(".barraProgresoTOtros").removeClass("barraProgresoTOtros");
    }
}

// alerta para validar  que se ingrese un comentario  // 
function validar() {
    var comentario = document.getElementById("comentario").value;
    if (comentario.length == 0) {
        swal({
            title: "¡Error!",
            text: "Ingrese un Comentario para continuar",
            type: "error",
            customClass: 'swal-wide',
            allowOutsideClick: false
        });
        hasError = true;
        return false;
    }

}