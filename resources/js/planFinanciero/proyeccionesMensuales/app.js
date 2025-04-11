import { activarBotonGuardar, calculoFilaYTotalTabla, creacionNuevaFilaYBoton, getPosicionFilaCelda, inicializarStoreVisualizarTotal } from "./utils/util";
import { eventButonEliminar, guardarBD } from "./utils/events";
import { elementTabla, eliminarElemento, filaTotalDeTotales, statusElementoTabla, validarElementoVacioONO } from "./store";
import { mensajeError, modalError} from "../util/mensaje";

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
    eventButonEliminar(event, eliminarElemento, () => activarBotonGuardar(botonGuardar));
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
            modalError.style.display = 'block';
            mensajeError.innerText = "El valor ingresado no es un número";
            // * Llamar a la funcion para calcular el total fila y de la tabla
            calculoFilaYTotalTabla(event,posicionCelda,elementTabla,filaTotalDeTotales, posicionFila, '0');
            return;
        }
        // * Llamar a la funcion para calcular el total fila y de la tabla
        calculoFilaYTotalTabla(event,posicionCelda,elementTabla,filaTotalDeTotales, posicionFila, valorInput);
        // * entra si es igual a cero la celda del input o sea la celda de nombre
    } else { // !! LOGICA DEL INPUT PARA NOMBRE
        // * Asignando el valor al input a la celda correspondiente
        elementTabla[posicionFila].name = valorInput;
    } // ! FIN DEL IF ELSE
    // * Mando a cambiar el estado si le faltan datos o si hay datos entonces se le asignara el status modificado
    const estaVacio = validarElementoVacioONO(elementTabla[posicionFila]);
    // * Mandar a cambiar el boton de guardar activado
    activarBotonGuardar(botonGuardar);
    // * Si el elemento es diferente su status a nuevo entonces lo pone como modificado
    if (elementTabla[posicionFila].status !== statusElementoTabla.esNuevo) {
        elementTabla[posicionFila].status = statusElementoTabla.modificado;
    }
    // * Valida si es el ultimo y si esta completo entonces mandara a crear un nuevo elemento tr
    if (!estaVacio && elementTabla.length - 1 === posicionFila) {
        const elementoTr = event.target.closest('tr');
        const tbody = elementoTr.closest('tbody');
        // * Llamo a la función para crear una nueva fila
        creacionNuevaFilaYBoton(elementoTr, elementTabla, tbody, statusElementoTabla.esNuevo);
    }
});

