const ListaAbonoComponente = (data) =>{

    let listaDePagos = `
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Método</li>
            <li class="list-group-item">Monto</li>
            <li class="list-group-item">Pendiente</li>
        </ul>
    `;
    data.abonos.forEach(abono => {
        listaDePagos += `
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">${abono.metodo}</li>
                <li class="list-group-item">${abono.monto}</li>
                <li class="list-group-item">${darFormatoDeNumero(nivel.precio - abono.monto)}</li>
            </ul>
        `
    });

    return `
    <div class="list-group">
        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
            Lista de métodos de pago agregados:
        </button>

 
    </div>
    `;
};