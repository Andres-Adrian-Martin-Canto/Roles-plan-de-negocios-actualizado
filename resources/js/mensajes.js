/**
 * TODO: Mensaje que muestra que se almaceno correctamente
 *
 */
// Crear el elemento principal div con sus atributos
export const toastDiv = document.createElement('div');
toastDiv.classList.add('relative', 'z-10');
toastDiv.setAttribute('aria-labelledby', 'modal-title');
toastDiv.setAttribute('role', 'dialog');
toastDiv.setAttribute('aria-modal', 'true');

// Crear y agregar el div con clase bg-gray-500 bg-opacity-75
const bgDiv = document.createElement('div');
bgDiv.classList.add('fixed', 'inset-0', 'bg-gray-500', 'bg-opacity-75', 'transition-opacity');
toastDiv.appendChild(bgDiv);

// Crear y agregar el div con clase fixed inset-0 z-10 w-screen overflow-y-auto
const contentDiv = document.createElement('div');
contentDiv.classList.add('fixed', 'inset-0', 'z-10', 'w-screen', 'overflow-y-auto');
toastDiv.appendChild(contentDiv);

// Crear el div con clase flex y demás clases internas
const flexDiv = document.createElement('div');
flexDiv.classList.add('flex', 'min-h-full', 'items-end', 'justify-center', 'p-4', 'text-center', 'sm:items-center', 'sm:p-0');
contentDiv.appendChild(flexDiv);

// Crear el div con clases internas para el contenido
const relativeDiv = document.createElement('div');
relativeDiv.classList.add('relative', 'transform', 'overflow-hidden', 'rounded-lg', 'bg-white', 'text-left', 'shadow-xl', 'transition-all', 'sm:my-8', 'sm:w-full', 'sm:max-w-lg');
flexDiv.appendChild(relativeDiv);

// Crear el div para el contenido principal
const mainContentDiv = document.createElement('div');
mainContentDiv.classList.add('bg-white', 'px-4', 'pb-4', 'pt-5', 'sm:p-6', 'sm:pb-4');
relativeDiv.appendChild(mainContentDiv);

// Crear el div con clases internas para el contenido del ícono y texto
const iconTextDiv = document.createElement('div');
iconTextDiv.classList.add('sm:flex', 'sm:items-start');
mainContentDiv.appendChild(iconTextDiv);

// Crear el div para el ícono
const iconDiv = document.createElement('div');
iconDiv.classList.add('mx-auto', 'flex', 'h-12', 'w-12', 'flex-shrink-0', 'items-center', 'justify-center', 'rounded-full', 'bg-green-100', 'sm:mx-0', 'sm:h-10', 'sm:w-10');
iconTextDiv.appendChild(iconDiv);

// Crear el SVG para el ícono
const newSVG = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
newSVG.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
newSVG.setAttribute('fill', 'none');
newSVG.setAttribute('viewBox', '0 0 24 24');
newSVG.setAttribute('stroke-width', '1.5');
newSVG.setAttribute('stroke', 'currentColor');
newSVG.classList.add('w-6', 'h-6', 'text-green-600');
iconDiv.appendChild(newSVG);

// Crear el path para el ícono y agregarlo al nuevo SVG
const newPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
newPath.setAttribute('stroke-linecap', 'round');
newPath.setAttribute('stroke-linejoin', 'round');
newPath.setAttribute('d', 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z');
newSVG.appendChild(newPath);


// Crear el div para el contenido de texto
const textContentDiv = document.createElement('div');
textContentDiv.classList.add('mt-3', 'text-center', 'sm:ml-4', 'sm:mt-0', 'sm:text-left');
iconTextDiv.appendChild(textContentDiv);

// Crear el título h3
const titleH3 = document.createElement('h3');
titleH3.classList.add('text-base', 'font-semibold', 'leading-6', 'text-gray-900');
titleH3.id = 'modal-title';
titleH3.textContent = 'Operación exitosa.';
textContentDiv.appendChild(titleH3);

// Crear el párrafo con el mensaje
const messageP = document.createElement('p');
messageP.classList.add('text-sm', 'text-gray-500');
messageP.textContent = 'Se ha almacenado correctamente.'; // Aquí puedes agregar el mensaje dinámico si lo necesitas
textContentDiv.appendChild(messageP);

// Crear el div para el botón de cerrar
const buttonDiv = document.createElement('div');
buttonDiv.classList.add('bg-gray-50', 'px-4', 'py-3', 'sm:flex', 'sm:flex-row-reverse', 'sm:px-6');
relativeDiv.appendChild(buttonDiv);

// Crear el botón
const closeButton = document.createElement('button');
closeButton.type = 'button';
closeButton.id = 'toast-correcto';
closeButton.classList.add('mt-3', 'inline-flex', 'w-full', 'justify-center', 'rounded-md', 'bg-white', 'px-3', 'py-2', 'text-sm', 'font-semibold', 'text-gray-900', 'shadow-sm', 'ring-1', 'ring-inset', 'ring-gray-300', 'hover:bg-gray-50', 'sm:mt-0', 'sm:w-auto');
closeButton.textContent = 'Cerrar';
buttonDiv.appendChild(closeButton);

// Agregar el toastDiv al documento
document.body.appendChild(toastDiv);

// Ocultar el toastDiv inicialmente
toastDiv.style.display = 'none';

// TODO: Evento para eliminar la alerta de todo correcto
const botonCorrecto = document.getElementById('toast-correcto');
botonCorrecto.addEventListener('click', function () {
    toastDiv.style.display = 'none';
    window.location.reload();
});


/**
 * TODO: Mensaje de error no dejar vació o solo se permiten números decimales
 *
 */


// Crear el elemento principal div con sus atributos
export const newToastDiv = document.createElement('div');
newToastDiv.classList.add('relative', 'z-10');
newToastDiv.setAttribute('aria-labelledby', 'modal-title');
newToastDiv.setAttribute('role', 'dialog');
newToastDiv.setAttribute('aria-modal', 'true');

// Crear y agregar el div con clase bg-gray-500 bg-opacity-75
const newBgDiv = document.createElement('div');
newBgDiv.classList.add('fixed', 'inset-0', 'bg-gray-500', 'bg-opacity-75', 'transition-opacity');
newToastDiv.appendChild(newBgDiv);

// Crear y agregar el div con clase fixed inset-0 z-10 w-screen overflow-y-auto
const newContentDiv = document.createElement('div');
newContentDiv.classList.add('fixed', 'inset-0', 'z-10', 'w-screen', 'overflow-y-auto');
newToastDiv.appendChild(newContentDiv);

// Crear el div con clase flex y demás clases internas
const newFlexDiv = document.createElement('div');
newFlexDiv.classList.add('flex', 'min-h-full', 'items-end', 'justify-center', 'p-4', 'text-center', 'sm:items-center', 'sm:p-0');
newContentDiv.appendChild(newFlexDiv);

// Crear el div con clases internas para el contenido
const newRelativeDiv = document.createElement('div');
newRelativeDiv.classList.add('relative', 'transform', 'overflow-hidden', 'rounded-lg', 'bg-white', 'text-left', 'shadow-xl', 'transition-all', 'sm:my-8', 'sm:w-full', 'sm:max-w-lg');
newFlexDiv.appendChild(newRelativeDiv);

// Crear el div para el contenido principal
const newMainContentDiv = document.createElement('div');
newMainContentDiv.classList.add('bg-white', 'px-4', 'pb-4', 'pt-5', 'sm:p-6', 'sm:pb-4');
newRelativeDiv.appendChild(newMainContentDiv);

// Crear el div con clases internas para el contenido del ícono y texto
const newIconTextDiv = document.createElement('div');
newIconTextDiv.classList.add('sm:flex', 'sm:items-start');
newMainContentDiv.appendChild(newIconTextDiv);

// Crear el div para el ícono
const newIconDiv = document.createElement('div');
newIconDiv.classList.add('mx-auto', 'flex', 'h-12', 'w-12', 'flex-shrink-0', 'items-center', 'justify-center', 'rounded-full', 'bg-gray-100', 'sm:mx-0', 'sm:h-10', 'sm:w-10');
newIconTextDiv.appendChild(newIconDiv);

// Crear el SVG para el ícono
const newIconSVG = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
newIconSVG.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
newIconSVG.setAttribute('fill', 'none');
newIconSVG.setAttribute('viewBox', '0 0 24 24');
newIconSVG.setAttribute('stroke-width', '1.5');
newIconSVG.setAttribute('stroke', 'currentColor');
newIconSVG.classList.add('w-6', 'h-6', 'text-red-500'); // Agregar clase de color naranja

// Crear el path para el ícono y agregarlo al nuevo SVG
const newIconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
newIconPath.setAttribute('stroke-linecap', 'round');
newIconPath.setAttribute('stroke-linejoin', 'round');
newIconPath.setAttribute('d', 'M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z');
newIconSVG.appendChild(newIconPath);

// Agregar el nuevo SVG al div del ícono
newIconDiv.appendChild(newIconSVG);

// Crear el div para el contenido de texto
const newTextContentDiv = document.createElement('div');
newTextContentDiv.classList.add('mt-3', 'text-center', 'sm:ml-4', 'sm:mt-0', 'sm:text-left');
newIconTextDiv.appendChild(newTextContentDiv);

// Crear el título h3
const newTitleH3 = document.createElement('h3');
newTitleH3.classList.add('text-base', 'font-semibold', 'leading-6', 'text-gray-900');
newTitleH3.id = 'modal-title';
newTitleH3.textContent = 'Advertencia';
newTextContentDiv.appendChild(newTitleH3);

// Crear el párrafo con el mensaje
export const newMessageP = document.createElement('p');
newMessageP.classList.add('text-sm', 'text-gray-500');
newMessageP.textContent = ''; // Puedes agregar un mensaje dinámico aquí si es necesario
newTextContentDiv.appendChild(newMessageP);

// Crear el div para el botón de cerrar
const newButtonDiv = document.createElement('div');
newButtonDiv.classList.add('bg-gray-50', 'px-4', 'py-3', 'sm:flex', 'sm:flex-row-reverse', 'sm:px-6');
newRelativeDiv.appendChild(newButtonDiv);

// Crear el botón
const newCloseButton = document.createElement('button');
newCloseButton.type = 'button';
newCloseButton.id = 'toast-año';
newCloseButton.classList.add('mt-3', 'inline-flex', 'w-full', 'justify-center', 'rounded-md', 'bg-white', 'px-3', 'py-2', 'text-sm', 'font-semibold', 'text-gray-900', 'shadow-sm', 'ring-1', 'ring-inset', 'ring-gray-300', 'hover:bg-gray-50', 'sm:mt-0', 'sm:w-auto');
newCloseButton.textContent = 'Cerrar';
newButtonDiv.appendChild(newCloseButton);

// Agregar el nuevo div al documento
document.body.appendChild(newToastDiv);

// Ocultar el nuevo div inicialmente
newToastDiv.style.display = 'none';

// Evento para cerrar el toast y recargar la página
const newButtonCorrecto = document.getElementById('toast-año');
newButtonCorrecto.addEventListener('click', function () {
    newToastDiv.style.display = 'none';
});


// TODO: Evento para eliminar la alerta de navegacion con años
    // * Obtengo el boton para cerrar el mensaje.
    export const botonCerrar = document.getElementById('cerrarMensaje');
    export const divMensaje = document.getElementById('toast-warning');
    if (botonCerrar) {
        botonCerrar.addEventListener('click', function () {
            divMensaje.style.display = 'none';
        })
    }
