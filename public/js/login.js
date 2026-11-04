// La validación real la hace LoginController; aquí solo se mejora el uso del formulario.
const formulario = document.getElementById('form-login');
const correo = document.getElementById('correo');
const contrasena = document.getElementById('contrasena');
const btnMostrar = document.getElementById('btn-mostrar');
const btnIngresar = document.getElementById('btn-ingresar');
const alertaCliente = document.getElementById('alerta-cliente');
const alertaServidor = document.getElementById('alerta-servidor');

btnMostrar.addEventListener('click', function () {
    const visible = contrasena.type === 'text';
    contrasena.type = visible ? 'password' : 'text';
    btnMostrar.textContent = visible ? 'Mostrar' : 'Ocultar';
    btnMostrar.setAttribute('aria-pressed', String(!visible));
    contrasena.focus();
});

function mostrarError(texto, campo) {
    if (alertaServidor) alertaServidor.hidden = true;
    alertaCliente.textContent = texto;
    alertaCliente.hidden = false;
    campo.closest('.entrada').classList.add('invalida');
    campo.focus();
}

[correo, contrasena].forEach(function (campo) {
    campo.addEventListener('input', function () {
        campo.closest('.entrada').classList.remove('invalida');
        alertaCliente.hidden = true;
    });
});

formulario.addEventListener('submit', function (evento) {
    if (correo.value.trim() === '') {
        evento.preventDefault();
        return mostrarError('Escribe tu correo.', correo);
    }
    if (!correo.checkValidity()) {
        evento.preventDefault();
        return mostrarError('El correo no es válido.', correo);
    }
    if (contrasena.value === '') {
        evento.preventDefault();
        return mostrarError('Escribe tu contraseña.', contrasena);
    }

    btnIngresar.disabled = true;
    btnIngresar.textContent = 'Ingresando…';
});

// Al volver con el botón Atrás, el botón debe quedar activo otra vez
window.addEventListener('pageshow', function () {
    btnIngresar.disabled = false;
    btnIngresar.textContent = 'Ingresar';
});
