log('conectado con preincripciones index')

let form = document.forms[0],
select_cursos = document.getElementById('select_cursos');


const hanledSelectCursos = (e) =>{
    if(e.target.id == 'select_cursos'){
        console.log(e.target)
        console.log(e.target.value)
        console.log(form)
        form.submit();
        
    }
};

select_cursos.addEventListener('change', hanledSelectCursos);