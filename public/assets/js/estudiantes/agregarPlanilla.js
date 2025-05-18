
    let inputCedula = document.getElementById("cedula"),
        cardDataEstudiante = document.getElementById("dataEstudiante"),
        elementoPreload = document.getElementById("preload_inscriciones"),
        botonProcesarInscripcion = document.getElementById("botonProcesarInscripcion"),
        // inputMontoBs = document.getElementById("monto_bs"),
        // inputMontoUsd = document.getElementById("monto_usd"),
        // cardCuotaEstudiante = document.getElementById("cuotasEstudiante"),
        // divMetodos = document.getElementById("divMetodos"),
        // metodos = document.querySelectorAll(".metodo"),
        btnBuscarEstudiante = document.getElementById("buscarEstudiante"),
        botonSubmit = document.querySelector(".boton"),
        // inputReferencia = document.getElementById("referencia"),
        // URLpatname = window.location.pathname,
        // URLhref = window.location.href,
        estudiantes = [];



    /** Cargar tarjetas añadidas de estudiantes */
    const hanledLoad = async () => {
        log(botonProcesarInscripcion)
        estudiantes = JSON.parse(localStorage.getItem('estudiantes'));

        if(estudiantes == null) estudiantes = [];

        if (estudiantes.length) {
            
            botonProcesarInscripcion.classList.remove('invisible');
            botonProcesarInscripcion.classList.add('visible');
            cardDataEstudiante.innerHTML="";

            log(estudiantes)
            await estudiantes.forEach(estudiante => {
                cardDataEstudiante.innerHTML += AccordionComponente(estudiante);
            });
            
            await cargerEventosDeBotonEliminar();

            botonProcesarInscripcion.disabled = false;
            elementoPreload.innerHTML = "";
        }else{
            elementoPreload.innerHTML = "";
            cardDataEstudiante.innerHTML = "";
            botonProcesarInscripcion.classList.add('invisible');
        }
    };

    addEventListener('load', hanledLoad);

    function getDataEstudiante(cedula) {
        if (cedula.value.length > 6) {
            elementoPreload.innerHTML = preload;

            setTimeout(() => {
                fetch(URL_BASE_API + "/getEstudiante/" + cedula.value)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.estatus == HTTP_OK) {
                            log(data)
                            log(estudiantes)
                            let capturado = estudiantes.filter(estudiante => estudiante.cedula == data.data.cedula);
                            
                            if (capturado.length) {
                                return $.alert({
                                    title: "¡Alerta!",
                                    content: "Ya esta agregado",
                                    type:"orange",
                                    action: elementoPreload.innerHTML = ""
                                })
                            } else {
                                return $.alert({
                                    title: "Procesado",
                                    content: "El estudiante se agregó correctamente a la planilla de inscripción.",
                                    type:"green",
                                    action: function(){
                                        estudiantes.push(data.data);
                                        localStorage.setItem('estudiantes', JSON.stringify(estudiantes));
                                        inputCedula.value="";
                                        inputCedula.focus();
                                        hanledLoad();
                                    }()

                                })
                              
                            }
                        } else {

                            return $.alert({
                                title: "¡Alerta!",
                                type:"orange",
                                content: data.mensaje,
                                action: elementoPreload.innerHTML = ""
                            })
                        }


                    })
                    .catch((err) => {
                        log(err);
                        cardDataEstudiante.innerHTML = err;

                    });
            }, 1500);
        }
    }

    btnBuscarEstudiante.addEventListener("click", (e) => {
        e.preventDefault();
        getDataEstudiante(inputCedula);
    });

    inputCedula.addEventListener("submit", (e) => {
        e.preventDefault();
        getDataEstudiante(e.target);
    });


    /** cargar eventos de boton eliminar */
    async function cargerEventosDeBotonEliminar() {
        let botones = document.querySelectorAll('.btn-eliminar'),
            nuevaListaDeEstudiantes = [];
            

        botones.forEach(boton => {
            boton.addEventListener('click', (e) => {
                elementoPreload.innerHTML = preload;
                nuevaListaDeEstudiantes = estudiantes.filter(estudiante => estudiante.cedula != e.target.id);
                setTimeout(() => {
                    localStorage.setItem('estudiantes', JSON.stringify(nuevaListaDeEstudiantes));
                    hanledLoad();
                }, 1500);
            });
        });
    }


