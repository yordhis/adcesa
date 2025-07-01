if (window.location.pathname.includes('tienda/finalizar/pedido')) {
    console.log('connected to end request 🛍️');
    let inputCuentaBancaria = document.querySelector('#id_cuenta'),
    cuentasInfo = document.querySelectorAll('.cuentas-info');

    inputCuentaBancaria.addEventListener('input', (e)=>{

        for (const key in cuentasInfo) {
            if (Object.prototype.hasOwnProperty.call(cuentasInfo, key)) {
                const info = cuentasInfo[key];
                if(info.id == e.target.value){
                    info.classList.remove('d-none')
                }else{                    
                    if(!info.classList.value.includes('d-none')){
                        info.classList.add('d-none')
                    }
                }
            }
        }
    })  
}