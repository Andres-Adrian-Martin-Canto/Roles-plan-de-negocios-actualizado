// * Variable que contendra los elementos eliminados de la tabla
const arrayEliminados = [];


/**
 *  TODO: Función que agrega un elemento al array de eliminados
 *  @param {Object<ObjectFila>} eliminado
 */
const agregarEliminado = (eliminado) => {
    arrayEliminados.push(eliminado);
};


export default {
    arrayEliminados,
    agregarEliminado,
}
