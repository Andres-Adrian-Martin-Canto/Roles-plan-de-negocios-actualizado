import { conversionNumbrerString } from "./utils/conversiones";

// * Obtener la tabla
const tabla = document.querySelector('table');
// * Variable para saber cuanto me dariá el total de la tabla
let totalTabla = 0.00;
// * for para obtenmer el valor de cada fila y sumarlo
for (const element of tabla.tBodies[0].rows) {
    // * Le asigno el valor que tiene el input de la fila
    let valorTotalFila = element.cells[3].querySelector('input').value;
    // * Sumo el valor de la fila al total de la tabla
    totalTabla += (valorTotalFila.trim()) ?  (+valorTotalFila) : 0.00 ;
}
let filaTotalDeTotales = document.getElementById("totaldeTotales");
// Asignarle el resultado al footer de la tabla.
filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + conversionNumbrerString(totalTabla);

let botonesEliminar = tabla.querySelectorAll("tbody tr button");
console.log(botonesEliminar);

const botonGuardar = document.getElementById("miBoton");
botonGuardar.onclick = async function () {
    
};

