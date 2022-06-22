/* Per il login */

function onClick(event) {
    const elem = event.currentTarget;
    elem.value = '';
    elem.removeEventListener('click',onClick);
    elem.classList.add('fullBlack');
}

const input_fields = document.querySelectorAll('.input_field');
for (let el of input_fields) {
    el.addEventListener('click', onClick);
}


/* Per il Sign up */

function checkEmail(email) {
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(email).toLowerCase())) {
        const p = document.querySelector('#center .errore');
        p.textContent = 'Email non valida.';
        return 0;
    } else {
        return 1;
    }
}

function checkUsername(username) {
    if(!/^[a-zA-Z0-9_]{1,15}$/.test(username)) {
        const p = document.querySelector('#center .errore');
        p.textContent = 'Username non valido.';
        return 0;
    } else {
        return 1;
    }    
}

function checkPassword() {
    const p = document.querySelector('#center .errore');
    if(form.password.value.length < 8) {
        p.textContent = 'La password non ha una lunghezza sufficiente (min 8)';
        return 0;
    } 
    if(!/[a-zA-Z]/.test(form.password.value) ||
        !/[0-9]/.test(form.password.value) ||
        !/[^\w]/.test(form.password.value)) {
        p.textContent = 'La password deve contenere almeno un numero, una lettera maiuscola, una lettera minuscola e un carattere speciale';
        return 0;
    }
    return 1;
}


function check(event) {
    if(form.name.value.length > 0 &&
        form.surname.value.length > 0 &&
        checkEmail(form.email.value) &&
        form.email.value.length > 0 &&
        checkUsername(form.username.value) &&
        form.username.value.length > 0 &&
        checkPassword()) {

            const p = document.querySelector('#center .errore');
            p.textContent = 'Stiamo eseguendo altri controlli affinchè tutto vada a buon fine.';
            p.classList.remove('errore');           
    }
    else if(form.name.value.length === 0 ||
        form.surname.value.length === 0 ||
        form.email.value.length === 0 ||
        form.username.value.length === 0 ||
        form.password.value.length === 0){
        const p = document.querySelector('#center .errore');
            p.textContent = 'Completa il form.';

            event.preventDefault();
    }
    else {
        event.preventDefault();
    }
}


const form = document.forms['signup_form'];
form.addEventListener('submit', check);