import { agregarNuevoElemento, filaTotalDeTotales } from "../store";

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
        agregarNuevoElemento(inputsFila);
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
    const numeroDecimales = numero.toString().split( '.' )[1].length;
    return (numeroDecimales > 1) ? numero.toString().slice( 0 , posicionPunto + 3) : numero.toFixed(2).toString();
};
