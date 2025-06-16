if (window.location.pathname.includes('productos')) {

    let selectTipoProductoEdit = document.querySelectorAll('.tipo_producto_edit'),
        selectTipoProductoCreate = document.getElementById('tipo_producto');

    selectTipoProductoCreate.addEventListener('change', (e) => {
        let tipoProducto = e.target.value;
        let inputCosto = document.getElementById('input-costo-create'),
            inputStock = document.getElementById('input-stock-create');
        if (tipoProducto == 1) { // Producto
            inputCosto.hidden = true;
            inputStock.hidden = true
            inputCosto.parentElement.classList.add('d-none')
            inputStock.parentElement.classList.add('d-none')
        } else if (tipoProducto == 0) { // Servicio
            document.getElementById('input-costo-create').hidden = false;
            document.getElementById('input-stock-create').hidden = false;
            inputCosto.parentElement.classList.remove('d-none')
            inputStock.parentElement.classList.remove('d-none')
        }
    });

    /** Edit */
    selectTipoProductoEdit.forEach(inputCantidad => {
        inputCantidad.addEventListener('change', e => {
            let tipoProducto = e.target.value,
                formulario = e.target.parentElement.parentElement
            if (tipoProducto == 1) { // Producto
                  // input costo
                formulario[6].disabled = true
                formulario[6].parentElement.classList.add('d-none')
                // input stock
                formulario[8].disabled = true
                formulario[8].parentElement.classList.add('d-none')
            } else if (tipoProducto == 0) { // Servicio
                // input costo
                formulario[6].disabled = false
                formulario[6].parentElement.classList.remove('d-none')
                // input stock
                formulario[8].disabled = false
                formulario[8].parentElement.classList.remove('d-none')
            }
        })

    })
}