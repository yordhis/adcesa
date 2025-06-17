
if (document.getElementById('btn-switch')) {

    let inputLightbulb = document.getElementById('input-lightbulb'),
        btnSwitch = document.getElementById('btn-switch'),
        counter = 1;

    btnSwitch.addEventListener('click', (e) => {
        if (counter % 2) {
            if (e.target.localName == "i") {
                e.target.parentElement.classList.remove('btn', 'btn-warning');
                e.target.parentElement.classList.add('btn', 'btn-primary');
                e.target.classList.remove('bi', 'bi-pencil');
                e.target.classList.add('bi', 'bi-file-lock2');

            }
            if (e.target.localName == "button") {
                e.target.classList.remove('btn', 'btn-warning');
                e.target.classList.add('btn', 'btn-primary');
                e.target.firstElementChild.classList.remove('bi', 'bi-pencil');
                e.target.firstElementChild.classList.add('bi', 'bi-file-lock2');
            }
            inputLightbulb.disabled = false;
            inputLightbulb.readOnly = false;
        } else {
            if (e.target.localName == "i") {
                e.target.parentElement.classList.remove('btn', 'btn-primary');
                e.target.parentElement.classList.add('btn', 'btn-warning');
                e.target.classList.remove('bi', 'bi-file-lock2');
                e.target.classList.add('bi', 'bi-pencil');
            }
            if (e.target.localName == "button") {
                e.target.classList.remove('btn', 'btn-primary');
                e.target.classList.add('btn', 'btn-warning');
                e.target.firstElementChild.classList.remove('bi', 'bi-file-lock2');
                e.target.firstElementChild.classList.add('bi', 'bi-pencil');
            }
            inputLightbulb.disabled = true;
            inputLightbulb.readOnly = true;
        }

        counter++;

    });
}