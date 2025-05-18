if (document.getElementById('rep_cedula')) {

    let inputCedulaRepresentante = document.getElementById('rep_cedula'),
        componenteRepresentante = document.getElementById('componenteRepresentante'),
        componenteCardRepresentante = document.getElementById('componenteCardRepresentante'),
        preloadSpan = document.getElementById('preload'),
        mensajeRepresentante = document.getElementById('mensajeRepresentante'),
        formRepresentante = document.querySelector('#formRepresentante'),
        URLpatname = window.location.pathname,
        URLhref = window.location.href;

    const log = console.log,
        URL_BASE_API = URLhref.split(URLpatname)[0] + "/api",
        URL_BASE_HOST = URLhref.split(URLpatname)[0],
        preload = `
        <!-- Growing Color spinnersr -->
        <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
    `;


    const getCardRepresentante = (data) => {
        let newAction = formRepresentante.action.replace('registrar', 'asignar')
        
        return `
            <div class="accordion accordion-flush " id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed bg-primary text-white p-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <b>Representante: </b> ${data.nombre.toUpperCase()} - C.i: ${data.cedula} | Haga click para ver más datos.
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <h5 class="card-text text-dark">Datos</h5>
                            
                            <small class=" fs-5">
                                <b>Nombre:</b>
                                ${data.nombre.toUpperCase()}
                            </small> <br>
                            <small class=" fs-5">
                                <b>C.I:</b>
                                ${data.cedula}
                            </small> <br>
                            <small class=" fs-5">
                                <b>Correo:</b>
                                ${data.correo}
                            </small> <br>

                            <small class=" fs-5">
                                <b>Dirección:</b> 
                                ${data.direccion}
                            </small> <br>

                            <small class=" fs-5">
                                <b>Telefono:</b> 
                                ${data.telefono}
                            </small> <br>
                           
                            <small class=" fs-5">
                                <b>Cumpleaños:</b>
                                ${data.nacimiento ? data.nacimiento : 'Sin asignar'} 
                            </small> <br>
                            <small class=" fs-5">
                                <b>Edad:</b>
                                ${data.edad} años
                            </small> 
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="${newAction}?rep_cedula=${formRepresentante[2].value}" class="btn btn-success">Asignar representante</a>

        `;
    };

    /** Funcion que Obtiene datos del representante */
    function getRepresentante(cedula) {
        if (cedula.value.length > 6) {
            preloadSpan.innerHTML = preload;
            componenteRepresentante.classList.remove('visible');
            componenteRepresentante.classList.add('invisible');
            setTimeout(() => {

                fetch(URL_BASE_API + "/getRepresentante/" + cedula.value)
                    .then((response) => response.json())
                    .then((result) => {

                        if (result.estatus == 200) {
                            mensajeRepresentante.textContent = result.mensaje;
                            mensajeRepresentante.classList.remove('bg-danger');
                            mensajeRepresentante.classList.add('bg-success');
                            componenteRepresentante.classList.remove('visible');
                            componenteRepresentante.classList.add('d-none');
                            formRepresentante[10].classList.add('d-none')
                            componenteCardRepresentante.innerHTML = getCardRepresentante(result.data);
                            preloadSpan.innerHTML = "";
                        } else {
                            mensajeRepresentante.textContent = result.mensaje;
                            mensajeRepresentante.classList.remove('bg-success');
                            mensajeRepresentante.classList.add('bg-danger');
                            componenteRepresentante.classList.remove('invisible');
                            componenteRepresentante.classList.add('visible');
                            formRepresentante[10].classList.remove('d-none')
                            componenteCardRepresentante.innerHTML = "";
                            preloadSpan.innerHTML = "";

                            for (const input of formCreate) {
                                if (input.name.includes('rep_')) {
                                    if (!input.name.includes('rep_cedula')) {
                                        input.value = null;
                                    }
                                } 
                            }
                        }
                    })
                    .catch((err) => {
                        $.alert({
                            title: "Alerta",
                            type: "red",
                            content: 'No hay resultados'
                        })
                    });
            }, 3000)

        }
    }

    inputCedulaRepresentante.addEventListener('keyup', (e) => {
        getRepresentante(e.target)
    })
}