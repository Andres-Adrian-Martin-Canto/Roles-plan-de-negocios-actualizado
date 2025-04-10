import { agregarNuevoElemento, filaTotalDeTotales, statusElementoTabla } from "../store";

/**
 *  TODO: Función para obtener la posicion de la celda y la fila
 *  @param {HTMLElement} element
 *  @returns {Object} Retorna un objeto con la posicion de la celda y la fila
 */
export const getPosicionFilaCelda = (element) => {
    // * Obtengo la posicion de la celda
    const posicionCelda = element.closest('td').cellIndex;
    // * Obtengo la posicion de la fila
    const posicionFila = element.closest('tr').sectionRowIndex;
    return {
        posicionCelda,
        posicionFila
    };
}

/**
 *  TODO: Función para inicializar el store y visualizar el total
 *  @param {HTMLTableElement} tabla
 */
export const inicializarStoreVisualizarTotal = (tabla) => {
    // * Variable para saber cuanto me dariá el total de la tabla
    let totalTabla = 0.00;
    // * filasDeTabla
    const filasTr = tabla.tBodies[0].rows;
    // * for para obtenmer el valor de cada fila y sumarlo
    for (const element of filasTr) {
        const inputsFila = element.querySelectorAll('input');
        // * Agregar los valores de la fila en mi store
        agregarNuevoElemento(inputsFila[0].value, inputsFila[1].value, inputsFila[2].value, inputsFila[3].value, statusElementoTabla.noModificado);
        const valorInput = inputsFila[3].value;
        totalTabla += (valorInput.trim()) ? (+valorInput) : 0.00;
    }
    // Asignarle el resultado al footer de la tabla.
    filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + conversionNumbrerString(totalTabla);
};


/**
 *  TODO: Función para convertir un número a string con dos decimales
 * @param {Number} numero
 * @returns {String} Retornar el valor convertido a string con dos decimales
 */
export const conversionNumbrerString = (numero) => {
    const posicionPunto = numero.toString().indexOf('.');
    if (posicionPunto === -1) {
        return numero.toFixed(2).toString();
    }
    const numeroDecimales = numero.toString().split('.')[1].length;
    return (numeroDecimales > 1) ? numero.toString().slice(0, posicionPunto + 3) : numero.toFixed(2).toString();
};

/**
 *
 *  TODO: Funcion para crear una nueva fila y un boton para la fila actual.
 *  @param {HTMLTableRowElement} elementoTr
 *  @param {Store<storeElementosTabla>} storeElementosTabla
 *  @param {HTMLTableSectionElement} tbody
 */
export const creacionNuevaFilaYBoton = (elementoTr, storeElementosTabla, tbody, status) => {
    const celdaBoton = elementoTr.insertCell();
    // * Crear el boton
    celdaBoton.innerHTML = `<button class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none"
        >Eliminar
    </button>`;
    // * Crear una nueva fila y insertalar en el tbody
    const nuevaFila = tbody.insertRow();
    // * Insertando los td y input a la nueva fila
    nuevaFila.innerHTML = `
        <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1" type=text></td>
        <td class="border px-4 py-2"><input class="w-full border text-right rounded-sm px-2 py-1"type="text"></td>
        <td class="border px-4 py-2"><input class="w-full border text-right rounded-sm px-2 py-1"type="text"></td>
        <td class="border px-4 py-2"><input class="w-full border text-right rounded-sm px-2 py-1"type="text" disabled></td>
        `;
    // * Agregar nuevo elemento a mi store
    agregarNuevoElemento('', '', '', '', status);
}


/**
 *  TODO: Función para activar el boton de guardar
 * @param {HTMLButtonElement } botonGuardar
 */
export const activarBotonGuardar = (botonGuardar) => {
    // * Cambiar el estado del boton de guardar
    if (botonGuardar.hasAttribute('disabled')) {
        // Replaza el fondo por otro.
        botonGuardar.classList.replace('bg-green-800', 'bg-green-500');
        // Replaza el color del texto.
        botonGuardar.classList.replace('text-gray-400', 'text-white');
        // Activar el boton
        botonGuardar.removeAttribute('disabled');
    }
};

/**
 *  TODO: Funcion para calcular el total de la fila y el total de la tabla
 *  @param {Event} event
 *  @param {Number} posicionCelda
 *  @param {Array<StoreElement>} elementTabla
 *  @param {HTMLTableRowElement} filaTotalDeTotales
 */
export const calculoFilaYTotalTabla = (event, posicionCelda, elementTabla, filaTotalDeTotales, posicionFila, valorInput) => {
    // * cambiar el valor del input
    event.target.value = valorInput;
    // * Asignando el valor al input a la celda correspondiente
    (posicionCelda !== 1) ? elementTabla[posicionFila].valor2 = +valorInput : elementTabla[posicionFila].valor1 = +valorInput;
    // * Valor del total anterior
    const valorTotalAnterior = elementTabla[posicionFila].total;
    // * Calculo el total de la fila
    const calculoTotal = (elementTabla[posicionFila].valor2 * elementTabla[posicionFila].valor1).toFixed(2);
    // * Cambiar el valor del store el total del store
    elementTabla[posicionFila].total = +calculoTotal;
    // * obtener el tr de la fila donde esta el input
    const trElement = event.target.closest('tr');
    // * Cambiar el valor del input del total
    trElement.querySelectorAll('input')[3].value = calculoTotal;
    // * obtener la diferencia entre el total del input actual y el total anterior
    const diferenciaTotal = calculoTotal - valorTotalAnterior;
    // * Cambiar el total de la tabla
    filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + (+filaTotalDeTotales.innerText.split('$')[1] + diferenciaTotal).toFixed(2);
}
