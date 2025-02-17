document.addEventListener("DOMContentLoaded", function () {
    let bodys = document.querySelector("table tbody");
    let filas = bodys.querySelectorAll("tr");
    var arraydatos = [];
    filas.forEach(function (fila) {
        let valueid = fila.querySelector('td[valorid]').getAttribute('valorid');
        let columnas = fila.querySelectorAll('td');

        let array = [];
        array.push(valueid);
        columnas.forEach(element => {
            let input = element.querySelector('input');
            if (input) {
                array.push(parseFloat(input.value).toFixed(2))
                agregareventoinput(input);
            } else {
                array.push(parseFloat(element.innerText))
            }

        });
        array.push(fila.getAttribute('idactual'));
        arraydatos.push(array);

    });
    function agregareventoinput(input) {
        input.addEventListener("blur", function () {
            // * Obtener el padre
            const tdPadre = input.parentElement;
            // * Obtengo la posicion de la fila
            let posicionFila = tdPadre.parentNode.rowIndex;
            // * Obtengo la posicion de la columna.
            let posicionColumna = tdPadre.cellIndex;
            const tdSiguiente = tdPadre.nextElementSibling;


            if (input.value.trim()) {
                if (input.value != arraydatos[posicionFila - 1][posicionColumna + 1]) {
                    arraydatos[posicionFila - 1][posicionColumna + 1] = parseFloat(input.value).toFixed(2);
                    tdSiguiente.innerHTML = parseFloat(arraydatos[posicionFila - 1][posicionColumna] * arraydatos[posicionFila - 1][posicionColumna + 1]).toFixed(2);
                    arraydatos[posicionFila - 1][posicionColumna + 2] = tdSiguiente.innerHTML;
                    caculartotaldesueldo();
                }
            } else {
                input.value = "0";
                arraydatos[posicionFila - 1][posicionColumna + 1] = input.value;
                tdSiguiente.innerHTML = parseFloat(arraydatos[posicionFila - 1][posicionColumna] * arraydatos[posicionFila - 1][posicionColumna + 1]).toFixed(2);
                arraydatos[posicionFila - 1][posicionColumna + 2] = tdSiguiente.innerHTML;
                caculartotaldesueldo();
                alert("No se permite Vacio")
            }
        });

    }
    function caculartotaldesueldo() {
        let totaldesueldos = document.getElementById("totaldesueldos");
        let total = 0;
        for (let index = 0; index < arraydatos.length; index++) {
            // Accede al índice correcto de cada elemento
            total += parseFloat(arraydatos[index][4]); // Suma el valor numérico del sueldo
        }
        // Muestra el total formateado con 2 decimales
        totaldesueldos.innerText = "Total de Sueldos: " + total.toFixed(2);
    }

    // let boton = document.getElementById("botonguardar");
    // boton.addEventListener("click", function () {
    //     let ruta = this.getAttribute("ruta");
    //     fetch(ruta, {
    //         method: "POST",
    //         headers: {
    //             "Content-Type": "application/json",
    //             "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    //         },
    //         body: JSON.stringify(arraydatos),
    //     }).then(Response => {
    //         if (Response.ok) {
    //             alert("Datos guardados exitosamente");
    //             location.reload(); // Refresca la página después de guardar
    //         } else {
    //             alert("Hubo un error al guardar los datos.");
    //         }
    //         console.log("Hubo error");
    //     });
    // });
    const toastDiv = document.createElement('div');
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

    let boton = document.getElementById("botonguardar");
    boton.onclick = async function () {
        // Creo una variable para obtener la respuesta de si desea confirmar.
        let result = true;
        // Pregunto si existen otros datos en los anuales.
        if (boton.getAttribute('informacion') !== '0') {
            // Mando a preguntar si quiere confirmar y se borren los datos de la tabla para los anuales o cinco anios.
            result = await customConfirm('Tienes datos en las tablas anuales. Si aceptas, se van a borrar los datos anuales.');
        }
        // * Si la respuesta fue si entonces entra
        if (result) {
            // Si la matriz no tiene una celda vacia entonces entra hacer la peticion.
            // if (validarMatriz(copiaMatriz)) {
            // Obtengo la ruta.
            let ruta = this.getAttribute("ruta");
            fetch(ruta, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify(arraydatos),
            }).then(Response => {
                if (Response.ok) {
                    toastDiv.style.display = 'block';
                } else {
                    throw new Error("Error en la solicitud");
                }
            });
            // } else {
            //     // Agregar el texto de la moda.
            //     newMessageP.textContent = "Tienes datos vacíos en una fila.";
            //     // Mostrar el moda.
            //     newToastDiv.style.display = 'block';
            // }
        }
    }
    /**
     *  TODO: Funcion para crear el moda.
     */
    async function customConfirm(message) {
        return new Promise(resolve => {
            const confirmDialog = document.createElement('div');
            confirmDialog.innerHTML = `
            <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Datos anuales
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">
                                    ${message}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex justify-center sm:flex-row-reverse gap-2">
                        <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                            <button id="confirmBtn" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Aceptar
                            </button>
                        </span>
                        <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                            <button id="cancelBtn" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancelar
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    `;
            document.body.appendChild(confirmDialog);

            document.getElementById('confirmBtn').addEventListener('click', () => {
                document.body.removeChild(confirmDialog);
                resolve(true);
            });

            document.getElementById('cancelBtn').addEventListener('click', () => {
                document.body.removeChild(confirmDialog);
                resolve(false);
            });
        });
    }

});