import { ObjectFila } from "../Elements/Model/ObjectFila";
import { conversionNumbrerString } from "../utils/util";

export const filaTotalDeTotales = document.querySelector("#totaldeTotales");
// * Arreglo que contendra mis valores de la fila (ObjectFila)
export const elementTabla = [];
export const statusElementoTabla = {
    noModificado: 'noModificado',
    modificado: 'modificado',
    esEliminado: 'eliminado',
    esNuevo: 'nuevo',
};
/**
 *
 *  @param {NodeListOf<HTMLInputElement>} Valores del objeto a agregar ObjetoFila
 */
export const agregarNuevoElemento = ( [ nombreInput, segundoInput, tercerInput, totalInput ] ) => {
    elementTabla.push(new ObjectFila(nombreInput.value, segundoInput.value , tercerInput.value, totalInput.value, statusElementoTabla.noModificado));
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
    // * Asigno el nuevo valor total de la tabla
    filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + conversionNumbrerString(valorTotalTabla - totalElementoFila);
    // * Eliminar el elemento de la tabla
    elementTabla.splice(posicionFila, 1);
};
