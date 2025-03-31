import { ObjectFila } from "../Elements/Model/ObjectFila";
import { getPosicionFilaCelda } from "../utils/util";

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
 * @param {Array} Valores del objeto a agregar ObjetoFila
 */
export const agregarNuevoElemento = ([valor1,valor2,valor3,valor4,status]) => {
    elementTabla.push(new ObjectFila([valor1,valor2,valor3,valor4,status]));
    console.log(elementTabla);
};




export const eliminarElemento = (event, actualizarTabla) => {
    // * Obtengo la posicion de la celda y la fila
    const { posicionCelda, posicionFila } = getPosicionFilaCelda(event.target);
    // * Obtengo el tbody
    const cuerpo = event.target.closest('tbody');
    // * Eliminar el elemento de la tabla
    cuerpo.deleteRow(posicionFila);
    // * Eliminar el elemento de la tabla
    elementTabla.splice(posicionFila, 1);
    // ! Llamar a funcion para actualizar el total de la tabla
}
