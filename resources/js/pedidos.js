if (document.querySelector('#formularioPedido')) {
    let variantes = document.querySelectorAll('.variantes'),
        inputCantidad = document.querySelector('#cantidad'),
        inputPrecioUnitario = document.querySelector('#precioUnitario'),
        inputImagenRadio = document.querySelectorAll('.imagen_radio'),
        inputdetLetraAcrilica = document.querySelectorAll('.det_letra_acrilica'),
        inputImgAdicionales = document.querySelector('#img_adicionales'),
        inputFraseAcrilica = document.querySelector('#frase_acrilica'),
        formularioDePedido = document.querySelector('#formularioPedido'),
        btnVistaPago = document.querySelector('#vista_pago'),
        inputVista = document.querySelector('#vista'),
        inputPrecio = document.querySelector('#precio');


    variantes.forEach((variante) => {
        variante.addEventListener('input', (e) => {
            const precio = e.target.previousElementSibling.value;
            inputPrecio.value = parseFloat(precio) * parseFloat(inputCantidad.value);
            inputPrecioUnitario.value = parseFloat(precio);
        })
    });

    inputCantidad.addEventListener('input', (e) => {
        inputPrecio.value = parseFloat(e.target.previousElementSibling.value) * parseFloat(e.target.value)
    });

    inputImagenRadio.forEach((checkInput) => {
        checkInput.addEventListener('input', (e) => {
            if (e.target.value == 'si') inputImgAdicionales.classList.remove('d-none')
            else inputImgAdicionales.classList.add('d-none')
        });
    });

    inputdetLetraAcrilica.forEach((checkInput) => {
        checkInput.addEventListener('input', (e) => {
            if (e.target.value.includes('si')) inputFraseAcrilica.classList.remove('d-none')
            else inputFraseAcrilica.classList.add('d-none')
        });
    });

    btnVistaPago.addEventListener('click', (e) => {
        e.preventDefault();
        inputVista.value = e.target.id;
        formularioDePedido.submit();
    });

    window.addEventListener('load', () => {
        inputImagenRadio.forEach((checkInput) => {
            if (checkInput.value.includes('si') && checkInput.checked) inputImgAdicionales.classList.remove('d-none')
            else if (checkInput.value.includes('no') && checkInput.checked) inputImgAdicionales.classList.add('d-none')
        });

        inputdetLetraAcrilica.forEach((checkInput) => {
            if (checkInput.value.includes('si') && checkInput.checked) inputFraseAcrilica.classList.remove('d-none')
            else if (checkInput.value.includes('no') && checkInput.checked) inputFraseAcrilica.classList.add('d-none')
        });
    });

}   