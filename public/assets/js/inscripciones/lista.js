
const hanledLoad = () => {
    localStorage.removeItem('estudiantes');
    localStorage.removeItem('grupo');
};

addEventListener('load', hanledLoad);