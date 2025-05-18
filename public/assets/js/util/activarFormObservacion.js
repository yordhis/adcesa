if (document.querySelectorAll('.btn_edit_observacion')) {
    const botonesEditObservacion = document.querySelectorAll('.btn_edit_observacion')


    botonesEditObservacion.forEach(btn => {
        btn.addEventListener('click', (e)=>{
            const formulario = document.querySelector('#textarea_' + e.target.id)
            formulario.classList.remove('d-none')

            const btnClosedObservacion = document.querySelector('#btn_closed_' + e.target.id)
            
            btnClosedObservacion.addEventListener('click', (e) => {
                formulario.classList.add('d-none')
            })
        })
    });


}