const resetFiltro = (e) => {
    document.forms.filtro.reset();
}

addEventListener('load', ()=>{
    if(document.getElementById('reset-filtro')) document.getElementById('reset-filtro').addEventListener('click', resetFiltro);
})



