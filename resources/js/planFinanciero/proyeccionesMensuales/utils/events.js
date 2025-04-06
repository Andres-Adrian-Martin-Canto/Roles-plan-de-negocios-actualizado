import { getPosicionFilaCelda } from "./util";

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


// TODO: Evento para el boton de guardar.
export const guardarBD = async (botonGuardar) => {
    // Copio la matriz
    console.log(botonGuardar);
    // let copiaMatriz = matrizMultidimensional.slice();
    // // Creo una variable para obtener la respuesta de si desea confirmar.
    // let result = true;
    // // Pregunto si existen otros datos en los anuales.
    // if (botonGuardar.getAttribute('informacion') !== '0') {
    //     // Mando a preguntar si quiere confirmar y se borren los datos de la tabla para los anuales o cinco anios.
    //     result = await customConfirm('Tienes información en las tablas anuales. Si aceptas, se van a borrar los datos anuales.');
    // }
    // // * Si la respuesta fue si entonces entra
    // if (result) {
    //     // Si la matriz no tiene una celda vacia entonces entra hacer la peticion.
    //     if (validarMatriz(copiaMatriz)) {
    //         // Obtengo la ruta.
    //         let ruta = botonGuardar.getAttribute("urlDinamica");
    //         fetch(ruta, {
    //             method: "POST",
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    //             },
    //             body: JSON.stringify(copiaMatriz),
    //         }).then(Response => {
    //             if (Response.ok) {
    //                 toastDiv.style.display = 'block';
    //             } else {
    //                 throw new Error("Error en la solicitud");
    //             }
    //         });
    //     } else {
    //         // Agregar el texto de la moda.
    //         newMessageP.textContent = "Tienes datos vacíos en una fila.";
    //         // Mostrar el moda.
    //         newToastDiv.style.display = 'block';
    //     }
    // }
};
