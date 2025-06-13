if(document.getElementById('tipo_producto')) {
    document.getElementById('tipo_producto').addEventListener('change', (e) => {
        let tipoProducto = e.target.value;
        let inputCosto = document.getElementById('input-costo-create'),
            inputStock = document.getElementById('input-stock-create');
        console.log(tipoProducto);
        console.log(inputCosto);
        if(tipoProducto == 1) { // Producto
            inputCosto.hidden=true;
            inputStock.hidden=true
            inputCosto.parentElement.classList.add('d-none')
            inputStock.parentElement.classList.add('d-none')
        } else if(tipoProducto == 0) { // Servicio
            document.getElementById('input-costo-create').hidden=false;
            document.getElementById('input-stock-create').hidden=false;
            inputCosto.parentElement.classList.remove('d-none')
            inputStock.parentElement.classList.remove('d-none')
        }
    });
}