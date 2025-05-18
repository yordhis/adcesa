let inputsFormaDePago = document.querySelectorAll('.formas');

log(inputsFormaDePago)

const hanledFormaDePago = (e) => {
    log(e.target.localName)
    if (e.target.localName != "select") {
        let inputMontoForma = e.target.parentElement.parentElement.childNodes[5].childNodes[1],
            inputTasaForma = e.target.parentElement.parentElement.childNodes[7].childNodes[1],
            inputMontoBolivares = e.target.parentElement.parentElement.childNodes[9].childNodes[1],
            inputAbono = e.target.parentElement.parentElement.parentElement.childNodes[17].childNodes[3];

        inputMontoBolivares.value = parseFloat(inputMontoForma.value) * parseFloat(inputTasaForma.value)
    
        let montosAgregados = [];
        inputsFormaDePago.forEach(input => {
            if(input.id.includes('monto')){
                if(!input.id.includes('monto_bolivares')){
                    if(input.value > 0){
                        montosAgregados.push(parseFloat(input.value));
                        inputAbono.value = montosAgregados.reduce((a,b) => a+b);
                    }
                }
            } 
        })


    }
};

inputsFormaDePago.forEach(element => {
    element.addEventListener('change', hanledFormaDePago);
})