if (window.location.pathname.includes('insumos')) {
    console.log('connect with insumo.js');
    let inputsStock = document.querySelectorAll('.stock'),
    inputCantidad = document.querySelector('#cantidad'),
    inputUnidad = document.querySelector('#unidad'),
    inputCantidadEdit = document.querySelectorAll('.cantidad-edit'),
    inputUnidadEdit = document.querySelectorAll('.unidad-edit'),
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
    inputCantidadEdit.forEach(inputCantidad => {
        const eventos = ['keyup', 'change']
        eventos.forEach(event => {
            inputCantidad.addEventListener(event, e => {
                let targetValue = e.target.value,
                unidadValue = e.target.parentElement.parentElement[8].value
                e.target.parentElement.parentElement[9].value = (targetValue * unidadValue)
                e.target.parentElement.parentElement[10].value = (targetValue * unidadValue)
            })
        });
    })
    
    inputUnidadEdit.forEach(inputUnidad => {
        const eventos = ['keyup', 'change']
        eventos.forEach(event => {
            inputUnidad.addEventListener(event, e => {
                let targetValue = e.target.value,
                cantidadValue = e.target.parentElement.parentElement[6].value
                e.target.parentElement.parentElement[9].value = (targetValue * cantidadValue)
                e.target.parentElement.parentElement[10].value = (targetValue * cantidadValue)
            })
        });
    })


    
    
}
