// Evento para mandar el formulario  // 
document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('filesformga');

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        subir_archivos(this);
    })
});


// funcion para subir los archivos  // 
function subir_archivos(form) {
    let barra_estado = document.getElementById('barra_estado');
    let cancelar = document.getElementById('cancelar');
        span = barra_estado.children[0],
        boton_cancelar = cancelar;


    barra_estado.classList.remove('barra_verde', 'barra_roja');

    //peticion 

    let peticion = new XMLHttpRequest();


    //progreso

    peticion.upload.addEventListener("progress", (event) => {
        let porcentaje = Math.round((event.loaded / event.total) * 100);

        console.log(porcentaje);

        barra_estado.style.width = porcentaje + '%';
        span.innerHTML = porcentaje + '%';
    });

    //finalizado

    peticion.addEventListener("load", () => {
        barra_estado.classList.add('barra_verde');
        span.innerHTML = "Proceso Completado";
        // alert('Archivo Cargado Correctamente');
        document.location.reload();
    });

    //enviar datos 

    peticion.open('post', 'anexarg_a.php');
    peticion.send(new FormData(form));

    //cancelar

    boton_cancelar.addEventListener("click", () => {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        span.innerHTML = "Proceso Cancelado";
    });
}