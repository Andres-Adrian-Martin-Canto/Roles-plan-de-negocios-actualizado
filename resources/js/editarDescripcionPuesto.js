var nivelSelect = "";

// TODO: Funcion logica para meter los datos al div correspondiente.
function toggleOption(id, unidadAdministrativa) {
    let etiquetaCheck = document.getElementById('option-' + id);
    // * Si el checkbox esta seleccionado entonces lo deselecciona
    if (etiquetaCheck.checked) {
        etiquetaCheck.checked = !etiquetaCheck.checked
        // Mando a quitarlo de todo.
        removeOption(id, unidadAdministrativa);
        // * Si no esta seleccionado entonces lo selecciona
    } else {
        // TODO: Selecciona el checkbox
        etiquetaCheck.checked = !etiquetaCheck.checked
        // TODO: Crear una fila con las celdas correspondientes
        // Crear una fila tr para la table con el id table
        let tr = document.createElement('tr');
        // Asignarle el css al tr bg-white hover:bg-gray-50
        tr.classList.add('bg-white', 'hover:bg-gray-50');
        // Crear una fila td para la fila tr
        let td = document.createElement('td');
        // Agregar css al td border border-gray-300 px-4 py-2
        td.classList.add('border', 'border-gray-300', 'px-4', 'py-2');
        // Crear un texto con el nombre de la unidad administrativa
        let text = document.createTextNode(unidadAdministrativa);
        // Agregar el texto al td
        td.appendChild(text);
        // Agregar el td a la fila tr
        tr.appendChild(td);
        // Crear una fila td para la fila tr
        let td2 = document.createElement('td');
        td2.classList.add('border', 'border-gray-300', 'px-4', 'py-2');
        // Crear un boton para eliminar la fila
        let button = document.createElement('button');
        //  Agregar css al boton text-red-500 hover:text-red-700
        button.classList.add('text-red-500', 'hover:text-red-700');
        // Agregar un id al boton
        button.id = "button" + id;
        // Agregar un texto al boton
        let textButton = document.createTextNode('Eliminar');
        // Agregar el texto al boton
        button.appendChild(textButton);
        // Agregar un evento al boton
        button.addEventListener('click', () => {
            removeOption(id, unidadAdministrativa);
        });
        // Agregar el boton al td2
        td2.appendChild(button);
        // Agregar el td2 a la fila tr
        tr.appendChild(td2);
        // Switch
        let tablElement = null;
        let tbody = null;
        let nombresSeleccionados = null;
        // TODO: SWITCH PARA HACER LA LOGICA CORRESPONDIENTE.
        switch (nivelSelect.value) {
            case "Estrategico":
                // * Seleccionar la tabla donde se visualizaran los datos.
                tablElement = document.getElementById('tablaEstrategicos');
                // * Seleccionar el tbody de la tabla
                tbody = tablElement.querySelector('tbody');
                // TODO: Agregar el texto al span con el id nombresSeleccionados
                // Obtener el span con el id nombresSeleccionados
                nombresSeleccionados = document.getElementById('nombresSeleccionadosEstrategicos');
                break;
            case "Tactico":
                // * Seleccionar la tabla donde se visualizaran los datos.
                tablElement = document.getElementById('tablaTacticos');
                // * Seleccionar el tbody de la tabla
                tbody = tablElement.querySelector('tbody');
                // TODO: Agregar el texto al span con el id nombresSeleccionados
                // Obtener el span con el id nombresSeleccionados
                nombresSeleccionados = document.getElementById('nombresSeleccionadosTacticos');
                break;
            default:
                // * Seleccionar la tabla donde se visualizaran los datos.
                tablElement = document.getElementById('tablaOperativos');
                // * Seleccionar el tbody de la tabla
                tbody = tablElement.querySelector('table tbody');
                // TODO: Agregar el texto al span con el id nombresSeleccionados
                // Obtener el span con el id nombresSeleccionados
                nombresSeleccionados = document.getElementById('nombreOperativos');
                break;
        }
        // TODO: Eliminar la fila que dice que no hay datos
        // * Si hay una fila que dice que no hay datos entonces la elimina
        if (tbody.rows.length === 1 && tbody.rows[0].children[0].textContent.trim() == "No hay datos") {
            tbody.removeChild(tbody.rows[0]);
        }
        // Agregar la fila tr a la tabla pero al tbody
        tbody.appendChild(tr);
        // Obtener el contenido del span
        let nombres = nombresSeleccionados.textContent;
        // Si esta vacio entonces no deberia ir la coma
        if (nombres.trim() === '') {
            nombresSeleccionados.textContent = unidadAdministrativa;
        } else {
            // Agregar el nombre de la unidad administrativa al contenido del span
            nombresSeleccionados.textContent = nombres + ', ' + unidadAdministrativa;
        }

        // TODO: Aqui agregar los datos del input <input type="hidden" name="supervisa_a[]" value="{{ $operativo1->id }}"> al div oculto
        // * Crear un input oculto con el id del usuario
        let input = document.createElement('input');
        // * Agregar el tipo hidden al input
        input.type = 'hidden';
        // * Agregar el nombre al input
        input.name = 'supervisa_a[]';
        // * Agregar el valor del id al input
        input.value = id;
        // * Agregar el input al div oculto
        let datosEnviados = document.getElementById('datosEnviados');
        datosEnviados.appendChild(input);

    }
}

/**
 *  TODO: Funcion para detener la ejecucion de li cuando presiono el checkbox
 * y llamar de nuevo al toggleOption
 */
function handleCheckboxClick(event, id, unidadAdministrativa, etiquetaCheck) {
    event.stopPropagation(); // Detener la propagación del evento hacia el li
    etiquetaCheck.checked = !etiquetaCheck.checked
    toggleOption(id, unidadAdministrativa);
}


// TODO: Funcion logica para eliminarlo de todo.
function removeOption(id, unidadAdministrativa) {

    // TODO: Deseleccionar el checkbox correspondiente
    document.getElementById('option-' + id).checked = false;

    // * Remueve el elemento del div
    let datosEnviados = document.getElementById('datosEnviados');
    let optionToRemove = datosEnviados.querySelector(`input[value="${id}"]`);
    if (optionToRemove) {
        optionToRemove.remove();
    }
    // borra la fila
    document.getElementById("button" + id).parentElement.parentElement.remove();

    switch (nivelSelect.value) {
        case "Estrategico":
            // Traer la tabla
            // Traer la tabla
            let tablElementEstrategico = document.getElementById('tablaEstrategicos').querySelector('table');
            let tbodyEstrategico = tablElementEstrategico.querySelector('tbody');
            // Esta vacio la tabla
            if (tablElementEstrategico.rows.length === 1) {
                // Crear una fila tr donde se mostrara el mensaje
                let tr = document.createElement('tr');
                // Crear una fila td donde se mostrara el mensaje de que no hay datos
                let td = document.createElement('td');
                // Crear un texto que se mostrara en el td
                let text = document.createTextNode('No hay datos');
                // Agregar el texto al td
                td.appendChild(text);
                // Agregar el td al tr
                tr.appendChild(td);
                // Agregar el tr al body
                tbodyEstrategico.appendChild(tr);
            }
            // Remover el nombre que esta en el span con el id nombresSeleccionados
            let nombresSeleccionadosEstrategicos = document.getElementById('nombresSeleccionadosEstrategicos');
            // Obtener el contenido del span
            let nombresEstrategicos = nombresSeleccionadosEstrategicos.textContent;
            // quitar solo el nombre de ese contenido
            let nombreEstrategico = nombresEstrategicos.split(',').filter((nombre) => {
                return nombre.trim() !== unidadAdministrativa;
            }).join(', ');
            // Actualizar el contenido del span
            nombresSeleccionadosEstrategicos.textContent = nombreEstrategico;
            // TODO: BORRAR LOS OTROS nombresSeleccionados nombresSeleccionadosTacticos
            document.getElementById('nombresSeleccionadosTacticos').textContent = "";
            break;


        // TODO: Entrar a los tacticos
        case "Tactico":
            let tablElementTactico = document.getElementById('tablaTacticos').querySelector('table');
            let tbodyTactico = tablElementTactico.querySelector('tbody');
            // Esta vacio la tabla
            if (tablElementTactico.rows.length === 1) {
                // Crear una fila tr donde se mostrara el mensaje
                let tr = document.createElement('tr');
                // Crear una fila td donde se mostrara el mensaje de que no hay datos
                let td = document.createElement('td');
                // Crear un texto que se mostrara en el td
                let text = document.createTextNode('No hay datos');
                // Agregar el texto al td
                td.appendChild(text);
                // Agregar el td al tr
                tr.appendChild(td);
                // Agregar el tr al body
                tbodyTactico.appendChild(tr);
            }
            // Remover el nombre que esta en el span con el id nombresSeleccionados
            let nombresSeleccionadosTacticos = document.getElementById('nombresSeleccionadosTacticos');
            // Obtener el contenido del span
            let nombresTacticos = nombresSeleccionadosTacticos.textContent;
            // quitar solo el nombre de ese contenido
            let nombreTactico = nombresTacticos.split(',').filter((nombre) => {
                return nombre.trim() !== unidadAdministrativa;
            }).join(', ');
            // Actualizar el contenido del span
            nombresSeleccionadosTacticos.textContent = nombreTactico;
            // TODO: BORRAR LOS OTROS nombresSeleccionados nombresSeleccionadosTacticos
            document.getElementById('nombresSeleccionadosEstrategicos').textContent = "";
            break;

        // !!! CREO QUE NO ES NECESARIO YA QUE NO SE PUEDE SELECCIONAR NADA
        default:
            break;
    }
}

// Asegúrate de exportarlo al ámbito global (si usas un módulo).
window.toggleOption = toggleOption;
// Aseugrate de exportar la función al ámbito global
window.removeOption = removeOption;
// Asegúrate de exportarlo al ámbito global (si usas un módulo).
window.handleCheckboxClick = handleCheckboxClick;

document.addEventListener('DOMContentLoaded', function () {
    // Obtén la referencia al elemento select
    nivelSelect = document.getElementById('nivel');

    // TODO: Obtén la referencia al div que contiene los selectores de reporta
    const divReporta = document.getElementById('reporta');
    var selectores = divReporta.querySelectorAll('select');

    // Obtener los id selectores de supervisa
    var supervisaEstrategico = document.getElementById('supervisaSelectorEstrategico');
    var supervisaTactico = document.getElementById('supervisaSelectorTactico');
    var supervisaOperativo = document.getElementById('supervisaSelectorOperativo');
    // Obtener los id de las tablas de supervisa
    var tablaEstrategico = document.getElementById('tablaEstrategicos');
    var tablaTactico = document.getElementById('tablaTacticos');
    var tablaOperativo = document.getElementById('tablaOperativos');


    // Variable para almacenar el valor seleccionado
    let selectedSelector = '';

    // Establece el valor inicial si existe
    selectedSelector = nivelSelect.value;
    switch (selectedSelector) {
        case "Estrategico":
            // Ocultar los demas selectores
            selectores[1].classList.add('hidden');
            selectores[2].classList.add('hidden');
            supervisaTactico.classList.add('hidden');
            supervisaOperativo.classList.add('hidden');
            tablaTactico.classList.add('hidden');
            tablaOperativo.classList.add('hidden');
            break;
        case "Tactico":
            // Ocultar los demas selectores
            selectores[0].classList.add('hidden');
            selectores[2].classList.add('hidden');
            supervisaEstrategico.classList.add('hidden');
            supervisaOperativo.classList.add('hidden');
            tablaEstrategico.classList.add('hidden');
            tablaOperativo.classList.add('hidden');
            break;

        default:
            selectores[1].classList.add('hidden');
            selectores[0].classList.add('hidden');
            // Selectores de supervisa ocultos
            supervisaEstrategico.classList.add('hidden');
            supervisaTactico.classList.add('hidden');
            // Tablas ocultas
            tablaEstrategico.classList.add('hidden');
            tablaTactico.classList.add('hidden');
            break;
    }



    // * Evento para reporta  Escucha el evento 'change'
    nivelSelect.addEventListener('change', (event) => {
        // Actualiza el valor de la variable con el valor seleccionado
        selectedSelector = event.target.value;

        selectores[0].value = '';
        selectores[1].value = '';
        selectores[2].value = '';
        // Vaciar el value del selector de nivel
        visualizarReporta(selectedSelector, selectores);
    });

    // TODO: Aqui se mostrarian el div correspondiente al nivel seleccionado
    // y se ocultarian los demas
    // Por ejemplo:
    function visualizarReporta(nivel, selectores) {
        // Obtener los selectores del divReporta
        switch (nivel) {
            case "Estrategico":
                // TODO: LLAMAR A LA FUNCION QUE ELIMINA TODO DEL ANTERIOR NIVEL.
                eliminarTodoDelAnteriorNivel(nivel, 'datosEnviados');
                // Ocultar el selector 1
                if (!selectores[1].classList.contains('hidden')) {
                    selectores[1].classList.add('hidden');
                    supervisaTactico.classList.add('hidden');
                    tablaTactico.classList.add('hidden');
                }

                // Mostrar el selector 0
                if (selectores[0].classList.contains('hidden')) {
                    selectores[0].classList.remove('hidden');
                    supervisaEstrategico.classList.remove('hidden');
                    tablaEstrategico.classList.remove('hidden');
                }

                // Ocultar el selector 2
                if (!selectores[2].classList.contains('hidden')) {
                    selectores[2].classList.add('hidden');
                    tablaOperativo.classList.add('hidden');
                    supervisaOperativo.classList.add('hidden');
                }
                break;
            case "Tactico":
                // TODO: LLAMAR A LA FUNCION QUE ELIMINA TODO DEL ANTERIOR NIVEL.
                eliminarTodoDelAnteriorNivel(nivel, 'datosEnviados');
                // Ocultar el selector 0
                if (!selectores[0].classList.contains('hidden')) {
                    selectores[0].classList.add('hidden');
                    supervisaEstrategico.classList.add('hidden');
                    tablaEstrategico.classList.add('hidden');
                }
                // Mostrar el selector 1
                if (selectores[1].classList.contains('hidden')) {
                    selectores[1].classList.remove('hidden');
                    supervisaTactico.classList.remove('hidden');
                    tablaTactico.classList.remove('hidden');
                }
                // Ocultar el selector 2
                if (!selectores[2].classList.contains('hidden')) {
                    selectores[2].classList.add('hidden');
                    tablaOperativo.classList.add('hidden');
                    supervisaOperativo.classList.add('hidden');
                }
                break;

            default:
                // TODO: FALTARIA REMOVER EL HIDDEN de la tabla y selector de operativo
                eliminarTodoDelAnteriorNivel(nivel, 'datosEnviados');
                // Ocultar el selector 0
                if (!selectores[0].classList.contains('hidden')) {
                    selectores[0].classList.add('hidden');
                    supervisaEstrategico.classList.add('hidden');
                    tablaEstrategico.classList.add('hidden');
                }
                // Ocultar el selector 1
                if (!selectores[1].classList.contains('hidden')) {
                    selectores[1].classList.add('hidden');
                    supervisaTactico.classList.add('hidden');
                    tablaTactico.classList.add('hidden');
                }
                // Mostrar el selector 2
                if (selectores[2].classList.contains('hidden')) {
                    selectores[2].classList.remove('hidden');
                    supervisaOperativo.classList.remove('hidden');
                    tablaOperativo.classList.remove('hidden');
                }
                break;
        }
    } // Fin de la funcion visualizarReporta


    function eliminarTodoDelAnteriorNivel(nivel, elementosOcultos) {

        let tbody = null;
        // * Aqui debe llamar al body del nivel que se acaba de seleccionar para que se muestre el mensaje de que no hay datos
        switch (nivel) {
            case "Estrategico":
                accionBorrarLosAnterioresNodos('nombresSeleccionadosTacticos', 'tablaTacticos', 'optionsContainerTacticos');
                accionBorrarLosAnterioresNodos('nombresSeleccionadoOperativos', 'tablaOperativos', 'OptionContainerOperativos');
                tbody = document.getElementById('tablaEstrategicos').querySelector('tbody');
                break;
            case "Tactico":
                accionBorrarLosAnterioresNodos('nombresSeleccionadoOperativos', 'tablaOperativos', 'OptionContainerOperativos');
                accionBorrarLosAnterioresNodos('nombresSeleccionadosEstrategicos', 'tablaEstrategicos', 'optionsContainer');
                tbody = document.getElementById('tablaTacticos').querySelector('tbody');
                break;
            default:
                accionBorrarLosAnterioresNodos('nombresSeleccionadosEstrategicos', 'tablaEstrategicos', 'optionsContainer');
                accionBorrarLosAnterioresNodos('nombresSeleccionadosTacticos', 'tablaTacticos', 'optionsContainerTacticos');
                tbody = document.getElementById('tablaOperativos').querySelector('tbody');
                break;
        }
        // Crear una fila tr donde se mostrara el mensaje
        let tr = document.createElement('tr');
        // Crear una fila td donde se mostrara el mensaje de que no hay datos
        let td = document.createElement('td');
        // Crear un texto que se mostrara en el td
        let text = document.createTextNode('No hay datos');
        // Agregar el texto al td
        td.appendChild(text);
        // Agregar el td al tr
        tr.appendChild(td);
        // Agregar el tr al body
        tbody.appendChild(tr);
        // * Borrar los elementos ocultos que son inputs
        let elementos = document.getElementById(elementosOcultos);
        elementos.querySelectorAll('input').forEach((input) => {
            input.remove();
        });
    }

    /**
     *  TODO: Funcion para borrar todo acerca de los otros niveles.
     * @param {*} nombreseleccionados
     * @param {*} tabla
     * @param {*} listaCheckboxes
     */
    function accionBorrarLosAnterioresNodos(nombreseleccionados, tabla, listaCheckboxes,) {
        // * Poner la logica de borrar el span de nombres
        document.getElementById(nombreseleccionados).textContent = "";
        // * Deseleccionar todos los checkbox
        let checkboxes = document.getElementById(listaCheckboxes).querySelectorAll('input');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        });
        // * Borrar todas las filas de la tabla
        let tablElement = document.getElementById(tabla);
        let tbody = tablElement.querySelector('table tbody');
        // Eliminar todas las filas
        while (tbody.rows.length > 0) {
            tbody.removeChild(tbody.rows[0]);
        }
    }


    // TODO: Abrir el selector de opciones.
    // Seleccionar elementos
    const toggleButton = document.getElementById('toggleButton');
    const optionsContainer = document.getElementById('optionsContainer');

    // Evento para mostrar/ocultar la lista
    toggleButton.addEventListener('click', () => {
        if (optionsContainer.classList.contains('hidden')) {
            optionsContainer.classList.remove('hidden');
        } else {
            optionsContainer.classList.add('hidden');
        }
    });

    // Ocultar la lista al hacer clic fuera de ella
    document.addEventListener('click', (event) => {
        const isClickInside = toggleButton.contains(event.target) || optionsContainer.contains(event.target);
        if (!isClickInside) {
            optionsContainer.classList.add('hidden');
        }
    });

    // TODO: Abrir el selector de opciones para Tactico.
    // Seleccionar elementos
    const toggleButtonTactico = document.getElementById('toggleButtonTacticos');
    const optionsContainerTactico = document.getElementById('optionsContainerTacticos');

    // Evento para mostrar/ocultar la lista
    toggleButtonTactico.addEventListener('click', () => {
        if (optionsContainerTactico.classList.contains('hidden')) {
            optionsContainerTactico.classList.remove('hidden');
        } else {
            optionsContainerTactico.classList.add('hidden');
        }
    });

    // Ocultar la lista al hacer clic fuera de ella
    document.addEventListener('click', (event) => {
        const isClickInsideTactico = toggleButtonTactico.contains(event.target) || optionsContainerTactico.contains(event.target);
        if (!isClickInsideTactico) {
            optionsContainerTactico.classList.add('hidden');
        }
    });

});