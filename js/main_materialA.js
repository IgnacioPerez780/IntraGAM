// CARGAR MATERIAL DE CAMPANIAS
document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('materialB');

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

    peticion.open('post', 'enviar.php');
    peticion.send(new FormData(form));

    //cancelar

    boton_cancelar.addEventListener("click", () => {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        span.innerHTML = "Proceso Cancelado";
    });
}



// CARGAR MATERIAL DE CIRCULARES GMM
document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('materialGmm');

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        subir_archivosGmm(this);
    })
});

function subir_archivosGmm(form) {
    let barra_estado = document.getElementById('barra_estadoGmm');
    let cancelar = document.getElementById('cancelarGmm');
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

    peticion.open('post', 'enviarGmm.php');
    peticion.send(new FormData(form));

    //cancelar

    boton_cancelar.addEventListener("click", () => {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        span.innerHTML = "Proceso Cancelado";
    });
}


// CARGAR MATERIAL DE CIRCULARES VIDA
document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('materialVida');

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        subir_archivosVida(this);
    })
});

function subir_archivosVida(form) {
    let barra_estado = document.getElementById('barra_estadoVida');
    let cancelar = document.getElementById('cancelarVida');
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

    peticion.open('post', 'enviarVida.php');
    peticion.send(new FormData(form));

    //cancelar

    boton_cancelar.addEventListener("click", () => {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        span.innerHTML = "Proceso Cancelado";
    });
}

// CARGAR MATERIAL DE OTRO TIPO
document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('materialOtros');

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        subir_archivosOtros(this);
    })
});

function subir_archivosOtros(form) {
    let barra_estado = document.getElementById('barra_estadoOtros');
    let cancelar = document.getElementById('cancelarOtros');
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

    peticion.open('post', 'enviarOtros.php');
    peticion.send(new FormData(form));

    //cancelar

    boton_cancelar.addEventListener("click", () => {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        span.innerHTML = "Proceso Cancelado";
    });
}