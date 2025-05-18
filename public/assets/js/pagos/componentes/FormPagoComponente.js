const FormPagoComponente = (data) =>{
    return `

    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Seleccione método
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
        <input type="number" step="any" 
        name="abono"
        class="form-control" 
        aria-label="Ingrese monto">
        <button class="btn btn-success" id="agregarAbono">
            <i class="bi bi-plus fs-3"></i>
        </button>
    </div>
    `;
}