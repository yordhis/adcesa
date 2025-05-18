let input_edad_representante = document.getElementById('rep_edad'),
input_fecha_nacimiento_representante = document.getElementById('rep_nacimiento'),
input_edad_estudiante = document.getElementById('edad_estudiante'),
input_fecha_nacimiento_estudiante = document.getElementById('fecha_nacimiento_estudiante');
fecha_cumpleanio = document.getElementById('fecha_cumpleanio'),
forms = document.forms,
formRepresentante = null;

for (const form of forms) {
    if(form.id = 'formulario_add_representante') formRepresentante = form;
}


input_fecha_nacimiento_representante.addEventListener("change", (e)=>{
    calcularEdad(e.target, input_edad_representante)
})

input_fecha_nacimiento_estudiante.addEventListener("change", (e)=>{
    calcularEdad(e.target, input_edad_estudiante);
})

formatearFecha(fecha_cumpleanio);
/** funciones extras */
/**
 * Esta funcion calcula la edad apartir de la fecha de nacimiento agregada detectando el cambio 
 * del año, dia y mes.
 * @param {fecha} input_fecha 
 * @param {edad} input_edad 
 */
function calcularEdad(input_fecha, input_edad){
   
        let cumpleanio = input_fecha.value.split('-');
        let fechaActual = new Date();
    
        if( fechaActual.getMonth() + 1 >= parseInt(cumpleanio[1]) 
            && fechaActual.getDate() >= parseInt(cumpleanio[2])){
                
            input_edad.value = fechaActual.getFullYear() - parseInt(cumpleanio[0]);
        }else{
            input_edad.value = fechaActual.getFullYear() - parseInt(cumpleanio[0]) - 1;
        }
};

/** */
function formatearFecha(elemento_fecha){
    elemento_fecha.textContent = elemento_fecha.textContent.split('-').reverse().join('/');
}

