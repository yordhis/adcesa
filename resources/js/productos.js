if (window.location.pathname.includes('productos')) {
    console.log('connected to script product');

    let selectTipoProductoCreate = document.getElementById('tipo_producto'),
        inputAncho = document.querySelectorAll('.input-ancho'),
        selectMedida = document.querySelectorAll('.select-medida'),
        inputAlto = document.querySelectorAll('.input-alto');

    /** renderiza el formulario segun el tipo de producto */
    window.addEventListener('load', (e) => {
        const formularioCreate = selectTipoProductoCreate.parentElement.parentElement
        const tipoProductoCreate = selectTipoProductoCreate.value


        if (tipoProductoCreate == 1) {
            // input codigo barra
            formularioCreate[3].disabled = true
            formularioCreate[3].parentElement.parentElement.classList.add('d-none')
            // input costo
            formularioCreate[6].disabled = true
            formularioCreate[6].parentElement.classList.add('d-none')
            // input precio
            formularioCreate[7].disabled = true
            formularioCreate[7].parentElement.classList.add('d-none')
            // input stock
            formularioCreate[8].disabled = true
            formularioCreate[8].parentElement.classList.add('d-none')
            // input almacen
            formularioCreate[9].disabled = true
            formularioCreate[9].parentElement.classList.add('d-none')
            // input marca
            formularioCreate[10].disabled = true
            formularioCreate[10].parentElement.classList.add('d-none')
        }
    });

    /** Create */
    selectTipoProductoCreate.addEventListener('change', (e) => {
        let tipoProductoCreate = e.target.value,
            formularioCreate = e.target.parentElement.parentElement

        if (tipoProductoCreate == 1) { // Producto
            // input codigo barra
            formularioCreate[3].disabled = true
            formularioCreate[3].parentElement.parentElement.classList.add('d-none')
            // input costo
            formularioCreate[6].disabled = true
            formularioCreate[6].parentElement.classList.add('d-none')
            // input precio
            formularioCreate[7].disabled = true
            formularioCreate[7].parentElement.classList.add('d-none')
            // input stock
            formularioCreate[8].disabled = true
            formularioCreate[8].parentElement.classList.add('d-none')
            // input almacen
            formularioCreate[9].disabled = true
            formularioCreate[9].parentElement.classList.add('d-none')
            // input marca
            formularioCreate[10].disabled = true
            formularioCreate[10].parentElement.classList.add('d-none')
        } else if (tipoProductoCreate == 0) { // Servicio
            // input codigo barra
            formularioCreate[3].disabled = false
            formularioCreate[3].parentElement.parentElement.classList.remove('d-none')
            // input costo
            formularioCreate[6].disabled = false
            formularioCreate[6].parentElement.classList.remove('d-none')
            // input precio
            formularioCreate[7].disabled = false
            formularioCreate[7].parentElement.classList.remove('d-none')
            // input stock
            formularioCreate[8].disabled = false
            formularioCreate[8].parentElement.classList.remove('d-none')
            // input almacen
            formularioCreate[9].disabled = false
            formularioCreate[9].parentElement.classList.remove('d-none')
            // input marca
            formularioCreate[10].disabled = false
            formularioCreate[10].parentElement.classList.remove('d-none')
        }
    });

    const calcularArea = (e) => {
        
        const formularioVariante = e.target.parentElement.parentElement.parentElement.parentElement;
        const medidas = formularioVariante[6].children
        let medida;

        for (const key in medidas) {
            if (Object.prototype.hasOwnProperty.call(medidas, key)) {
                const element = medidas[key];
                console.log(element.value);
                if(element.value == formularioVariante[6].value) medida = element
            }
        }
        
        formularioVariante[7].value =  (formularioVariante[3].value *  formularioVariante[4].value) + ' ' 
        + medida.innerText;
    }
    /** Calcular área */
    inputAncho.forEach(input => {
        input.addEventListener('input', calcularArea);
    });
    inputAlto.forEach(input => {
        input.addEventListener('input', calcularArea);
    });

    selectMedida.forEach(input => {
        input.addEventListener('input', calcularArea);
    });



}