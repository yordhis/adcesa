if (window.location.pathname.includes('insumos')) {
    console.log('connect with insumo.js');
    let inputsStock = document.querySelectorAll('.stock'),
    inputCantidad = document.querySelector('#cantidad'),
    inputUnidad = document.querySelector('#unidad'),
    inputsStockEdit = document.querySelectorAll('.stock-edit'),
    inputCantidadEdit = document.querySelector('#cantidad-edit'),
    inputUnidadEdit = document.querySelector('#unidad-edit'),
    total = 0,
    totalEdit = 0;


    /** Create */
    inputCantidad.addEventListener('change', e => {
        if(inputUnidad.value > 0) total = inputCantidad.value * inputUnidad.value
        inputsStock.forEach(input => input.value = total )
    })
    inputUnidad.addEventListener('change', e => {
        if(inputCantidad.value > 0) total = inputCantidad.value * inputUnidad.value
        inputsStock.forEach(input => input.value = total )
    })

    /** Edit */
    inputCantidadEdit.addEventListener('change', e => {
        if(inputUnidadEdit.value > 0) totalEdit = inputCantidadEdit.value * inputUnidadEdit.value
        inputsStockEdit.forEach(input => input.value = totalEdit )
    })
    inputUnidadEdit.addEventListener('change', e => {
        if(inputCantidadEdit.value > 0) totalEdit = inputCantidadEdit.value * inputUnidadEdit.value
        inputsStockEdit.forEach(input => input.value = totalEdit )
    })
    

    
    
}
