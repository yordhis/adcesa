let selectPlan = document.querySelector('#planes'),
elementPlan = document.querySelector('#elementPlan'),
dataCreateCuota = {
    plan:null,
    nivel:null
},
inputsCuotas="";

const hanledCambioDeCostoDeCuotas = (e) =>{
 
    let nuevoTotal = [];
    inputsCuotas.forEach(cuota => {
        if(cuota.name.includes('monto')) {
            log(cuota.value)
            log(typeof(cuota.value))
            if(cuota.value == "") nuevoTotal.push(0)
            else nuevoTotal.push(parseFloat(cuota.value))
        };
    });

    inputTotal.value = darFormatoDeNumero(nuevoTotal.reduce((a, b) => a+b));
};

const hanledPlan =  (e) => {
    elementPlan.innerHTML="";
    let codigoPlanE = e.target.value;

    getPlan(codigoPlanE)
    .then(res => {
        log(res)
        let grupo = JSON.parse(localStorage.getItem('grupo'));
        
        if(grupo){
            /** setaer el nivel y plan para generar las cuotas */
            dataCreateCuota.nivel = grupo.nivel,
            dataCreateCuota.plan = res.data,

            /** Crear las cuotas */
            createCuotas(dataCreateCuota)
            .then(res => {

                /** Listar las cuotas */
                res.data.forEach(cuota => {
                    elementPlan.innerHTML += InputCuota(cuota);
                });

                /** Calcular el total a pagar */
                total = res.data.reduce( (a,b) => a + b.monto, 0);
                
                /** Setear el total a pagar */
                inputTotal.value = darFormatoDeNumero(total);

                setTimeout(()=>{
                    inputsCuotas = document.querySelectorAll('.cuotas');
                    inputsCuotas.forEach(element => {
                        log(element)
                        element.addEventListener('keyup', hanledCambioDeCostoDeCuotas)
                        element.addEventListener('change', hanledCambioDeCostoDeCuotas)
                    });
                },1500)
            })
    
        }else{
            $.alert({
                title:"¡Alerta!",
                content:"Debe seleccionar un grupo para poder crear las cuotas.",
                type:"orange"
            })
        }
    })
};



selectPlan.addEventListener('change', hanledPlan);