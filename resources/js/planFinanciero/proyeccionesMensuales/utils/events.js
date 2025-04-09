import { getPosicionFilaCelda } from "./util";
import storeEliminado from "../store/storeEliminados";

/**
 *  TODO: Evento para el boton de eliminar
 * @param {EventTarget} event
 * @param {Function<eliminarElemento>} eliminarElemento
 */
export const eventButonEliminar = (event, eliminarElemento) => {
    // * Obtengo la posicion de la celda y la fila
    const posicionFila = getPosicionFilaCelda(event.target).posicionFila;
    // * Obtengo el tbody
    const cuerpo = event.target.closest('tbody');
    // * Eliminar el elemento de la tabla
    cuerpo.deleteRow(posicionFila);
    // * Eliminar el elemento de la tabla
    eliminarElemento(posicionFila);
};


/**
 *  TODO: Evento para el boton de guardar.
 *  @param {HTMLButtonElement} botonGuardar
 *  @param {Array<Store>} elementTabla
 */
export const guardarBD = async (botonGuardar, elementTabla) => {
    // * Creo una variable para filtrar los elementos que se van a enviar a la base de datos
    const filtreadoElement = [];
    // * Quitar el ultimo elemento de la tabla que no tiene datos
    elementTabla.pop();
    // * Recorro el arreglo de elementos y los guardo en el arreglo para la base de datos.
    for (const element of elementTabla) {
        // * Si el elemento tiene el status de faltanDatos entonces marco un error.
        if (element.status === 'faltanDatos') {
            alert('Faltan datos en la fila');
            return;
        }
        // * Si el elemento tiene diferente a noModificado entonces entra.
        if (element.status !== 'noModificado') {
            // * Mando a guardar el elemento en el arreglo para la base de datos.
            filtreadoElement.push({ ...element });
        }
    }
    // * variable de arreglo para la base de datos
    let arrayDB = undefined;
    // * Si el arreglo de eliminados es mayor a cero entonces entra.
    if (storeEliminado.arrayEliminados.length > 0) {
        // * Le asigno el arreglo de eliminados a la variable arrayDB.
        arrayDB = filtreadoElement.concat(storeEliminado.arrayEliminados);
    } else { // * Si no hay eliminados entonces le asigno el arreglo de elementos filtrados.
        arrayDB = filtreadoElement;
    }
    // * Variable que me va decir si lo guardo a pesar de que si tengo valores en las tablas anuales o cinco anios.
    let respuestaDeGuardar = true;
    // * Si existen otros datos en los anuales o cinco anios entonces entra.
    if (botonGuardar.getAttribute('informacion') !== '0') {
        // * Mando a preguntar si quiere confirmar y se borren los datos anuales o cinco anios.
        // respuestaDeGuardar = await customConfirm('Tienes información en las tablas anuales. Si aceptas, se van a borrar los datos anuales.');
    }

    // * Si la respuesta fue si entonces entrara
    if (respuestaDeGuardar) {
        const ruta = botonGuardar.getAttribute("urlDinamica");
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        fetch(ruta, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(arrayDB),
        })
            .then((response) => {
                // * Si se realizo la peticion entonces entra
                if (response.ok) {
                    // ! ESTO ESTA MAL
                    newMessageP.textContent = "Se guardaron los datos correctamente.";
                    newToastDiv.style.display = 'block';
                    // * De lo contrario marcara un error.
                } else {
                    // ! ESTO ESTA MAL
                    newMessageP.textContent = "Error al guardar los datos.";
                    newToastDiv.style.display = 'block';
                }
            });
    }
};
