if(document.getElementById('fecha_nacimiento')){
    let inputFechaNacimiento = document.getElementById('fecha_nacimiento'),
    inputEdadEstudiante = document.getElementById('edad_estudiante')
    
    
    /** Ecuchamos los eventos */
    inputFechaNacimiento.addEventListener("change", (e)=>{    
        let birthDateString = e.target.value;
        return inputEdadEstudiante.value = calculateAge(birthDateString)
    });
    
    /**
     * Calcula la edad a partir de una fecha de nacimiento.
     * @param {string} birthDateString - La fecha de nacimiento en formato 'YYYY-MM-DD'.
     * @returns {number} - La edad calculada.
     */
    function calculateAge(birthDateString) {
        const birthDate = new Date(birthDateString);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDifference = today.getMonth() - birthDate.getMonth();
    
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
    
        return age;
    }
}

