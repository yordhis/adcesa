/** Componente */
const TarjetaGrupo = (data) => {
    log(data)
    return `
            <div class="card-header rounded-5 shadow bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">                       
                        <h2 class="text-white">Grupo ${data.nombre}</h2>
                        <p class="text-white">
                            <b class="text-warning">Nivel:</b> ${data.nivel.nombre} <br>
                            <b class="text-warning">Libro:</b> ${data.nivel.libro} <br>
                            <b class="text-warning">Inversión:</b> ${data.nivel.precio} $ <br>
                            <b class="text-warning">Matricula:</b> ${data.matricula} estudiantes 
                        </p>
                    
                    </div>

                    <div class="col-sm-6 text-end">                       
                        <h2 class="text-white">Código: <b class="text-warning">${data.codigo}</b></h2>
                        <p class="text-white">
                            <b class="text-warning">Profesor:</b> ${data.profesor.nombre} <br>
                            <b class="text-warning">Fecha de Inicio del curso:</b> ${data.fecha_inicio} <br>
                            <b class="text-warning">Fecha de Finalización del curso:</b> ${data.fecha_fin} <br>
                            <b class="text-warning">Horario:</b> De: ${data.hora_inicio} hasta ${data.hora_fin} <br>
                            <b class="text-warning">Días:</b> ${data.dias} 

                        </p>
                    </div>

                </div>
            </div>
        </div>
    `;
}