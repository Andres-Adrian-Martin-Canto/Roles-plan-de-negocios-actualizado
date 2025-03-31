import { conversionNumbrerString, getPosicionFilaCelda } from "./utils/util";
import { eventButonEliminar, guardarBD } from "./utils/events";
import { agregarNuevoElemento, eliminarElemento } from "./store";

// * Obtener la tabla
const tabla = document.querySelector('table');
// * Variable para saber cuanto me dariá el total de la tabla
let totalTabla = 0.00;
// * filasDeTabla
const filasTr = tabla.tBodies[0].rows;
if (filasTr.length > 1) {
    // * for para obtenmer el valor de cada fila y sumarlo
    for (const element of filasTr) {
        const inputsFila = element.querySelectorAll('input');
        // * Agregar los valores de la fila en mi store
        agregarNuevoElemento( inputsFila );
        for (let i = 0; i < inputsFila.length; i++) {
            // * Obtener el valor del input
            const valorInput = inputsFila[i].value;
            if (i === 3) {
                // * Sumo el valor de la fila al total de la tabla
                totalTabla += (valorInput.trim()) ? (+valorInput) : 0.00;
            }
        }
    }
    // console.log(totalTabla);
    const filaTotalDeTotales = document.querySelector("#totaldeTotales");
    // Asignarle el resultado al footer de la tabla.
    filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + conversionNumbrerString(totalTabla);
}


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

