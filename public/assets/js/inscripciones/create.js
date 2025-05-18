let cardDataEstudiante = document.getElementById("dataEstudiante"),
    elementoPreload = document.getElementById("preload_inscriciones"),
    elementoFormasDePagos = document.getElementById("formasDePagos"),
    inputCodigo = document.querySelector("#codigo"),
    inputEstudiantes = document.querySelector("#estudiantes"),
    inputTotal = document.querySelector("#total"),
    botonAgruparCodigos = document.querySelector("#botonAgruparCodigos"),
    estudiantes = [];


/** Cargar tarjetas añadidas de estudiantes */
const hanledLoad = async () => {
    
    elementoPreload.innerHTML = preload;
    localStorage.removeItem('grupo');
    estudiantes = JSON.parse(localStorage.getItem('estudiantes'));
    log(estudiantes)
    /** Si en local storage no hay nada redirecciona a la sección de agregar estudiante a planilla de inscripción */
    if(estudiantes == null) $.confirm({
        title: "¡Alerta!",
        type: 'red',
        content: "No hay estudiantes para procesar una inscripción, le redireccionaremos a la seccion de agregar estudiante",
        buttons:{
            confirm:{
                text: "Ok",
                action: function() {
                    elementoPreload.innerHTML = "";
                    window.location.href = URL_BASE_HOST + "/inscripciones/estudiante";
                }
            }
        }
    })

    /** 
     * Se valida si el array de estudiante poseé mas de un elemento 
     * @sino Redireccionamos a la sección de agregar estudiante a planilla de inscripción
     */
    if (estudiantes.length) {
        cardDataEstudiante.innerHTML = "";
        inputCodigo.value = ""
        inputEstudiantes.value = ""

       await listarEstudiantes(getCodigoInscripcion, estudiantes, inputCodigo, inputEstudiantes)
        .then(async res =>{
           
            if(res.estatus){

                /** Agregar los acordiones de los estudiantes */
                estudiantes.forEach(estudiante => {
                    cardDataEstudiante.innerHTML += AccordionComponente(estudiante);
                });
              
                
                elementoPreload.innerHTML=""
                await cargerEventosDeBotonEliminar();
            }
        });
       
    }else{
        $.confirm({
            title: "¡Alerta!",
            type: 'red',
            content: "No hay estudiantes para procesar una inscripción, le redireccionaremos a la seccion de agregar estudiante",
            buttons:{
                confirm:{
                    text: "Ok",
                    action: function() {
                        elementoPreload.innerHTML = "";
                        window.location.href = URL_BASE_HOST + "/inscripciones/estudiante";
                    }
                }
            }
        })
    }
    
  
};

const hanledBotonAgrupar = (e) => {
    if(e.target.textContent.toUpperCase() == "AGRUPAR"){
        log(e.target.textContent.toUpperCase())
        e.target.textContent= "Desagrupar"

        getCodigoInscripcion("00")
        .then(res =>{
            log(res)
            if(res.estatus == HTTP_OK) {
                inputCodigo.value="";
                inputEstudiantes.value="";
                inputCodigo.value += res.data + ',';

                estudiantes.forEach( async (estudiante, index) => {
                    estudiantes[index].codigoInscripcion = null;
                    inputEstudiantes.value += estudiante.cedula + ',';
                    localStorage.setItem('estudiantes', JSON.stringify( estudiantes ))
                })
        
            } else $.alert({
                title: "¡Alerta!",
                type: 'red',
                content: res.mensaje + " (Recomendamos que recargue la página con F5)",
            })

        });

    }else{
        e.target.textContent= "Agrupar";
        hanledLoad();
    }
};

addEventListener('load', hanledLoad);

botonAgruparCodigos.addEventListener('click', hanledBotonAgrupar)

/** cargar eventos de boton eliminar */
function cargerEventosDeBotonEliminar() {
    let botones = document.querySelectorAll('.btn-eliminar'),
        nuevaListaDeEstudiantes = [];
    
    botones.forEach(boton => {
        boton.addEventListener('click', (e) => {
            nuevaListaDeEstudiantes = estudiantes.filter(estudiante => estudiante.cedula != e.target.id);
            setTimeout(() => {
                localStorage.setItem('estudiantes', JSON.stringify(nuevaListaDeEstudiantes));
                hanledLoad();
            }, 1000);
        });
    });
}

const listarEstudiantes = (getCodigo, datos, inputCodigo, inputEstudiantes) => {
    return new Promise( (resolve, reject) => {
       
        setTimeout(() => {
            let capturarEstudianteSinCodigo = datos.filter(estudiante => estudiante.codigoInscripcion == undefined);
            log(capturarEstudianteSinCodigo)
            if(capturarEstudianteSinCodigo.length){
                console.log('entro aqui en undefined');
                inputEstudiantes.value = "";
                inputCodigo.value = "";
                
                datos.forEach( async (estudiante, index) => {
                    
                        await getCodigo("0"+index)
                        .then(res => {
                            if(res.estatus == HTTP_OK) {
                                datos[index].codigoInscripcion = res.data;
                                inputEstudiantes.value += estudiante.cedula + ',';
                                inputCodigo.value += estudiante.codigoInscripcion + ',';
            
                            } else $.alert({
                                title: "¡Alerta!",
                                type: 'red',
                                content: res.mensaje + " (Recomendamos que recargue la página con F5)",
                            })
                        });
                        localStorage.setItem('estudiantes', JSON.stringify( datos ))
                    
                });

                // setTimeout(()=>{
                //     quitarComaAlFinal( inputCodigo )
                //     quitarComaAlFinal( inputEstudiantes )
                // },3000)

            }else{
                console.log('entro aqui');
                inputEstudiantes.value = "";
                inputCodigo.value = "";
                
                datos.forEach((estudiante, index) => {
                    inputEstudiantes.value += estudiante.cedula + ',';
                    inputCodigo.value += estudiante.codigoInscripcion + ',';
                });

                // quitarComaAlFinal( inputCodigo )
                // quitarComaAlFinal( inputEstudiantes )
              
            }
       
            resolve({
                data: datos,
                estatus: true
            })
        },1000);
    })
}