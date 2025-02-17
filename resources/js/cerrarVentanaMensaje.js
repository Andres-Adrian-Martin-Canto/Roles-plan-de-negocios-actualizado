document.addEventListener("DOMContentLoaded", function () {
    // TODO: Evento para eliminar la alerta de mensaje de error
    const botonCerrar = document.getElementById('cerrarMensaje');
    const divMensaje = document.getElementById('toast-warning');
    if (botonCerrar) {
        botonCerrar.addEventListener('click', function () {
            divMensaje.style.display = 'none';
        })
    }
});
