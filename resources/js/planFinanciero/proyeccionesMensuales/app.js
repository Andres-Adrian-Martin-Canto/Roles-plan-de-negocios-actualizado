import { activarBotonGuardar, creacionNuevaFilaYBoton, getPosicionFilaCelda, inicializarStoreVisualizarTotal } from "./utils/util";
import { eventButonEliminar, guardarBD } from "./utils/events";
import { elementTabla, eliminarElemento, filaTotalDeTotales, statusElementoTabla, validarElementoVacioONO } from "./store";

// * Obtener la tabla
const tabla = document.querySelector('table');
// * Iniciar el programa
inicializarStoreVisualizarTotal(tabla);


// * Obtener el boton de guardar
const botonGuardar = document.querySelector("#miBoton");
// * Evento para guardar los datos en la base de datos
botonGuardar.addEventListener('click', () => guardarBD(botonGuardar, elementTabla));

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
        // * Si no cumple con la expresion regular entonces le aviso que no es un numero
        if (!regex.test(valorInput)) {
            alert("El valor ingresado no es un número");
            return;
        }
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
        // * entra si es igual a cero la celda del input o sea la celda de nombre
    } else { // !! LOGICA DEL INPUT PARA NOMBRE
        // * Asignando el valor al input a la celda correspondiente
        elementTabla[posicionFila].name = valorInput;
        // * Cambiar el valor del input del total
        event.target.value = valorInput;
    } // ! FIN DEL IF ELSE
    // * Mando a cambiar el estado si le faltan datos o si hay datos entonces se le asignara el status modificado
    const estaVacio = validarElementoVacioONO(elementTabla[posicionFila]);
    let status = statusElementoTabla.modificado;
    // * SI UN VALOR NO ESTA COMPLETO ENTONCES LE DIRE QUE FALTAN DATOS
    if (estaVacio) {
        status = statusElementoTabla.faltanDatos;
    }
    // * Cambiar el status
    elementTabla[posicionFila].status = status;
    // * Mandar a cambiar el boton de guardar activado
    activarBotonGuardar(botonGuardar);
    // * Cambiar el valor del input del total
    event.target.value = valorInput;
    // * Valida si es el ultimo y si esta completo entonces mandara a crear un nuevo elemento tr
    if (!estaVacio && elementTabla.length - 1 === posicionFila) {
        const elementoTr = event.target.closest('tr');
        const tbody = elementoTr.closest('tbody');
        // * Llamo a la función para crear una nueva fila
        creacionNuevaFilaYBoton(elementoTr, elementTabla, tbody, statusElementoTabla.esNuevo);
    }
});

