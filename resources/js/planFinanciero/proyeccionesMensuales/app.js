import {  getPosicionFilaCelda, inicializarStoreVisualizarTotal } from "./utils/util";
import { eventButonEliminar, guardarBD } from "./utils/events";
import { elementTabla, eliminarElemento, filaTotalDeTotales } from "./store";

// * Obtener la tabla
const tabla = document.querySelector('table');
// * Iniciar el programa
inicializarStoreVisualizarTotal(tabla);


// * Obtener el boton de guardar
const botonGuardar = document.querySelector("#miBoton");
// * Evento para guardar los datos en la base de datos
botonGuardar.addEventListener('click', () => guardarBD(botonGuardar));

/**
 *  TODO: Evento para el boton de eliminar
 */
tabla.addEventListener('click', (event) => {
    // * Si no es boton entonces no hago nada
    if (event.target.tagName !== 'BUTTON') return;
    // * Mando a llamar la funcion para eliminar el elemento
    eventButonEliminar(event, eliminarElemento);
});

/**
 *  TODO: Evento para los inputs
 *  @param {Event} event
 */
tabla.addEventListener('change', (event) => {
    const { posicionCelda, posicionFila } = getPosicionFilaCelda(event.target);
    // * Obtengo el valor del input y le quito los espacios
    const valorInput = event.target.value.trim();
    if (posicionCelda !== 0) {
        // const regex = /^[0-9]+(\.[0-9]{1,2})?$/;
        // * Expresion regular
        const regex = /^[-+]?\d*\.?\d+$/;
        if (!regex.test(valorInput)) {
            alert("El valor ingresado no es un número");
            return;
        }

    } else {

    }
    console.log(posicionCelda);
    // * Lo retorno el valor sin espacios
    event.target.value = valorInput;
    // * Primero validar si cumple que es un numero


    // console.log(posicionFila);
});

