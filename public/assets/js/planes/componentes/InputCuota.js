const InputCuota = (data) =>{
    return `
    <div class="input-group">
        <span class="input-group-text bg-primary text-white"> Cuota ${data.id} </span>

        <input  type="date" 
                aria-label="Fecha"
                placeholder="Fecha"
                id="${data.id}"
                name="fecha_${data.id}"
                value="${data.fecha.split('T')[0]}" 
                class="form-control cuotas">

        <input  type="number" 
                min="0" 
                max="1000000" 
                step="0.01"
                placeholder="Ingrese monto a cobrar"
                id="${data.id}"
                name="monto_${data.id}"
                value="${darFormatoDeNumero(data.monto)}" 
                class="form-control cuotas">
    </div>
    `;
}