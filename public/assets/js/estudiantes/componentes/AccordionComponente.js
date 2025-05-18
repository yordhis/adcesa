const AccordionComponente = (data) => {
    return `
        <div class="d-flex d-inline">
            <div class="accordion accordion-flush mb-2" id="accordionFlushExample${data.cedula}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne${data.cedula}">
                        <button class="accordion-button collapsed bg-primary text-white p-2" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#flush-collapseOne${data.cedula}" 
                        aria-expanded="false" 
                        aria-controls="flush-collapseOne${data.cedula}">
                            
                            ${data.nombre.toUpperCase()} - C.i: ${data.cedula} | Haga click para ver más datos. 
                            
                        </button>
                    </h2>
                    <div id="flush-collapseOne${data.cedula}" 
                    class="accordion-collapse collapse" 
                    aria-labelledby="flush-headingOne${data.cedula}" 
                    data-bs-parent="#accordionFlushExample${data.cedula}">
                        <div class="accordion-body p-2">
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
                                <b>Edad:</b>
                                ${data.edad} años
                            </small> 
                        </div>
                    </div>
                </div>
            </div>   

            <a href="#" class="fs-3 text-danger btn-eliminar" id="${data.cedula}">
                <i class="bi bi-trash" id="${data.cedula}"></i>
            </a>   
        </div>  
    `;
}