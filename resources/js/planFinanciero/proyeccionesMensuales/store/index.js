import { ObjectFila } from "../Elements/Model/ObjectFila";
import { conversionNumbrerString } from "../utils/util";
import storeEliminados from './storeEliminados';

export const filaTotalDeTotales = document.querySelector("#totaldeTotales");
// * Arreglo que contendra mis valores de la fila (ObjectFila)
export const elementTabla = [];
export const statusElementoTabla = {
    noModificado: 'noModificado',
    modificado: 'modificado',
    esEliminado: 'eliminado',
    esNuevo: 'nuevo',
    faltanDatos: 'faltanDatos',
};
/**
 *
 *  @param {NodeListOf<HTMLInputElement>} Valores del objeto a agregar ObjetoFila
 */
export const agregarNuevoElemento = ([nombreInput, segundoInput, tercerInput, totalInput]) => {
    elementTabla.push(new ObjectFila(nombreInput.value, segundoInput.value, tercerInput.value, totalInput.value, statusElementoTabla.noModificado));
};


/**
 *  TODO: Funcion para eliminar el elemento de la tabla
 * @param {Number} posicionFila
 */
export const eliminarElemento = (posicionFila) => {
    // Obtengo el elemento de la fila y el total de la fila
    const totalElementoFila = elementTabla[posicionFila].total;
    // * Obtener el valor total de la tabla y lo convierto a numero
    const valorTotalTabla = +filaTotalDeTotales.innerText.split('$')[1];
    // Si la resta de la tabla y el total de la fila es menor a 0 entonces le asigno 0
    const resultadoResta = (valorTotalTabla - totalElementoFila < 0) ? 0 : (valorTotalTabla - totalElementoFila).toFixed(2);
    // * Asigno el nuevo valor total de la tabla
    filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + resultadoResta;
    // * Eliminar el elemento de la tabla
    const elementoEliminado = elementTabla.splice(posicionFila, 1);
    // * Cambiar el estado del elemento a eliminado
    elementoEliminado[0].status = statusElementoTabla.esEliminado;
    // * Llamar a funcion para guardar los eliminados en un array
    storeEliminados.agregarEliminado(elementoEliminado[0]);
};

/**
 *
 * @param {Array<ElementStore>} elemento
 */
export const validarElementoVacioONO = (elemento) => {
    return Object.values(elemento).some((valor) => valor === "");
}
