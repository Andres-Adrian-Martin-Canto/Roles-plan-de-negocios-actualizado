/**
 * TODO: Mensaje que muestra que se almaceno correctamente
 */
// Crear el elemento principal div con sus atributos
export const modalCorrecto = document.createElement('div');
modalCorrecto.classList.add('relative', 'z-10');
modalCorrecto.setAttribute('aria-labelledby', 'modal-title');
modalCorrecto.setAttribute('role', 'dialog');
modalCorrecto.setAttribute('aria-modal', 'true');

modalCorrecto.innerHTML = `
<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Operación exitosa.</h3>
                <p class="text-sm text-gray-500" id="mensaje-correcto">Se ha almacenado correctamente.</p>
            </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" id="toast-correcto" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cerrar</button>
        </div>
        </div>
    </div>
</div>
`;

// Agregar el modalCorrecto al documento
document.body.appendChild(modalCorrecto);

// Ocultar el modalCorrecto inicialmente
modalCorrecto.style.display = 'none';

// * Creacion de inicializacion de la alerta
// const creacion = () => {};
// * Obtengo la etiqueta parrafo donde se mostrara el mensaje de correcto
export const mensajeCorrecto = document.getElementById('mensaje-correcto');

// TODO: Evento para eliminar la alerta de todo correcto
const botonCorrecto = document.getElementById('toast-correcto');
botonCorrecto.addEventListener('click', () => {
    modalCorrecto.style.display = 'none';
    window.location.reload();
});


/**
 * TODO: Mensaje de error no dejar vació o solo se permiten números decimales
 */
// Crear el elemento principal div con sus atributos
export const modalError = document.createElement('div');
modalError.classList.add('relative', 'z-10');
modalError.setAttribute('aria-labelledby', 'modal-title');
modalError.setAttribute('role', 'dialog');
modalError.setAttribute('aria-modal', 'true');

modalError.innerHTML = `

<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-gray-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Advertencia</h3>
                <p class="text-sm text-gray-500" id="mensaje-error"></p> <!-- Mensaje dinámico -->
            </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" id="toast-año"
            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
            Cerrar
            </button>
        </div>
        </div>
    </div>
</div>
`;

// Agregar el nuevo div al documento
document.body.appendChild(modalError);

// Ocultar el nuevo div inicialmente
modalError.style.display = 'none';

// * Obtengo la etiqueta parrafo donde se mostrara el mensaje de error
export const mensajeError = document.getElementById('mensaje-error');

// Evento para cerrar el toast y recargar la página
const newButtonCorrecto = document.getElementById('toast-año');
newButtonCorrecto.addEventListener('click',  () => {
    modalError.style.display = 'none';
});


// TODO: Evento para eliminar la alerta de navegacion con años
    // * Obtengo el boton para cerrar el mensaje.
    const botonCerrar = document.getElementById('cerrarMensaje');
    const divMensaje = document.getElementById('toast-warning');
    if (botonCerrar) {
        botonCerrar.addEventListener('click',  () => {
            divMensaje.style.display = 'none';
        })
    }
