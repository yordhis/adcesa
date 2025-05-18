let btnAddRepre = document.getElementById('addRepre'),
btnAddDifi = document.getElementById('addDifi');
closeRepre = document.getElementById('closeRepre'),
closeDifi = document.getElementById('closeDifi'),
inputEdadEstudiante = document.getElementById('edad_estudiante'),
inputFechaNacimiento = document.getElementById('fecha_nacimiento'),
forms = document.forms,
formCreate = "";

for (const form of forms) {
    if(form.id == "formularioCrearEstudiante") formCreate = form;
}

if(document.getElementById('agregar-representante')){
    representanteElemento = document.getElementById('agregar-representante');
    representanteElemento.hidden = true;
}
if(document.getElementById('agregar-dificultad')){
    dificultadElemento = document.getElementById('agregar-dificultad');
    dificultadElemento.hidden = true;
}

/** Ecuchamos los eventos */
inputFechaNacimiento.addEventListener("change", (e)=>{
    let cumpleanio = e.target.value.split('-');
    let fechaActual = new Date();

    if( fechaActual.getMonth() + 1 >= parseInt(cumpleanio[1]) 
        && fechaActual.getDate() >= parseInt(cumpleanio[2])){
            
        inputEdadEstudiante.value = fechaActual.getFullYear() - parseInt(e.target.value.split('-')[0]);
    }else{
        inputEdadEstudiante.value = fechaActual.getFullYear() - parseInt(e.target.value.split('-')[0]) - 1;
    }
})

btnAddRepre.addEventListener('click', (e) => {
    e.preventDefault(); 
    for (const input of formCreate) {
        if (input.name.includes('rep_')) {
            input.required=true
        }
    }

    btnAddRepre.classList.add('text-warning');
    displayElemento(representanteElemento, false);
});

btnAddDifi.addEventListener('click', (e) => {
    e.preventDefault(); 
    btnAddDifi.classList.add('text-warning');
    displayElemento(dificultadElemento, false);
});

closeRepre.addEventListener('click', (e)=>{
    for (const input of formCreate) {
        if (input.name.includes('rep_')) {
            input.required=false
        }
    }
    displayElemento(representanteElemento, true);
    btnAddRepre.classList.replace('text-warning', 'text-white');
});

closeDifi.addEventListener('click', (e)=>{
    displayElemento(dificultadElemento, true)
    btnAddDifi.classList.replace('text-warning', 'text-white');
});

const displayElemento = (elemento, accion) => elemento.hidden=accion;
