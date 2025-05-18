let alertaTail = document.getElementById('alertaTail'),
btnClose = document.getElementById('btn__close');

const hanledClose = (e) => {
    alertaTail.innerHTML = "";
};

btnClose.addEventListener('click', hanledClose);