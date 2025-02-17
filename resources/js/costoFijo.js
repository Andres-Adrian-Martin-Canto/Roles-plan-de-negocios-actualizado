/**
 * Autor: Andres Adrian Martin Canto
 * Version: 1.0
 * description:
 */
// * Importamos los botones asi como los divs de los mensajes de error y que se guardo correctamente.
import { toastDiv, newToastDiv, newMessageP, botonCerrar, divMensaje } from './mensajes.js';
// Creo la matrizMultidimensional.
var matrizMultidimensional = [];
document.addEventListener("DOMContentLoaded", function () {
    // * Crea un evento onclick para un boton.
    const miBoton = document.getElementById("miBoton");
    // Agrega elementos por si vienen de la base de datos
    let filas = document.querySelectorAll("#miTabla tbody tr");
    // ForEach para obtener cada dato que traiga la base de datos.
    filas.forEach(function (fila) {
        // Obtiene los inputs.
        let inputs = fila.querySelectorAll('input[type="text"]');
        // Crea un arreglo el cual obtendra los valores de cada input y agregarlo a la matriz.
        let filaValores = [];
        // Foreach para sacar los valor de cada input
        inputs.forEach(function (input) {
            // Se los asigno a la matriz cada valor
            filaValores.push(input.value);
        });
        // Agrego la fila en la mtriz.
        matrizMultidimensional.push(filaValores);
    });
    // Obtento todos los inputs para asignarle los eventos.
    const inputs = document.querySelectorAll("tbody input");
    // Agrega el evento blur a cada input
    inputs.forEach((input) => {
        // Se agregan los eventos.
        eventoInputs(input);
    });
    // Recalcula el total de costos fijos por si tiene datos la base de datos.
    calcularTotalFijos();
    // TODO: Crear los eventos para los botones de los datos de la base de datos
    let botones = document.querySelectorAll("#miTabla tbody tr button");
    // Recorro los botones para asignarle el evento.
    botones.forEach((boton) => {
        // Se agregan los eventos.
        eventoButton(boton);
    });


    /**
     *  TODO: Evento que envia guardar los valores a la base de datos.
     */
    // * Agregar el evento onclick al botón
    miBoton.onclick = async function () {
        // * Quitar la ultima fila.
        let elemnt = document.getElementById('miBoton');
        let hayDatosAnuales = elemnt.getAttribute('informacion');
        let copiaMatriz = matrizMultidimensional.slice();
        if (hayDatosAnuales !== '') {
            const result = await customConfirm('Tienes información en las tablas anuales. Si aceptas, se van a borrar los datos anuales.');
            if (result) {
                if (validarMatriz(copiaMatriz)) {
                    fetch(
                        "/plan_de_negocio/" +
                        document.getElementById("miTabla").getAttribute("dato") +
                        "/costo_fijo",
                        {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"), // Incluye el token CSRF en el encabezado
                            },
                            body: JSON.stringify(copiaMatriz),
                        }
                    ).then(response => {
                        if (response.ok) {
                            toastDiv.style.display = 'block';
                        } else {
                            throw new Error("Error en la solicitud");
                        }
                    }).catch(error => {
                        // Manejar errores
                        console.error("Error:", error);
                    });
                } else {
                    newMessageP.textContent = "Tienes datos vacíos en una fila.";
                    newToastDiv.style.display = 'block';
                }
            }
        } else {
            if (validarMatriz(copiaMatriz)) {
                fetch(
                    "/plan_de_negocio/" +
                    document.getElementById("miTabla").getAttribute("dato") +
                    "/costo_fijo",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"), // Incluye el token CSRF en el encabezado
                        },
                        body: JSON.stringify(copiaMatriz),
                    }
                ).then(response => {
                    if (response.ok) {
                        // load
                        toastDiv.style.display = 'block';
                    } else {
                        throw new Error("Error en la solicitud");
                    }
                }).catch(error => {
                    // Manejar errores
                    console.error("Error:", error);
                });
            } else {
                newMessageP.textContent = "Tienes datos vacíos en una fila.";
                newToastDiv.style.display = 'block';
            }
        }
    };


    async function customConfirm(message) {
        return new Promise(resolve => {
            const confirmDialog = document.createElement('div');
            confirmDialog.innerHTML = `
            <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Datos anuales
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">
                                    ${message}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex justify-center sm:flex-row-reverse gap-2">
                        <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                            <button id="confirmBtn" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Aceptar
                            </button>
                        </span>
                        <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                            <button id="cancelBtn" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancelar
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    `;
            document.body.appendChild(confirmDialog);

            document.getElementById('confirmBtn').addEventListener('click', () => {
                document.body.removeChild(confirmDialog);
                resolve(true);
            });

            document.getElementById('cancelBtn').addEventListener('click', () => {
                document.body.removeChild(confirmDialog);
                resolve(false);
            });
        });
    }
    // ##########################################################################################33
    function validarMatriz(copiaMatriz) {
        if (copiaMatriz.length > 1) {
            copiaMatriz.pop();
            for (let fila = copiaMatriz.length - 1; fila >= 0; fila--) {
                if (copiaMatriz[fila].every(elemento => elemento === "")) {
                    copiaMatriz.splice(fila, 1); // Elimina la fila vacía
                }
            }

            // Recorremos cada fila de la matriz
            for (let fila of copiaMatriz) {
                let contadorDatos = 0;
                // Contamos cuántas celdas tienen datos en cada fila
                for (let celda of fila) {
                    if (celda !== '') {
                        contadorDatos++;
                    }
                }
                // Valida que la fila tenga todos los valores.
                if (contadorDatos < copiaMatriz[0].length) {
                    return false;
                }
            }
            // Si llegamos aquí, significa que todas las filas pasaron la validación
            return true;
        } else {
            // Recorremos cada fila de la matriz
            for (let fila of copiaMatriz) {
                let contadorDatos = 0;
                // Contamos cuántas celdas tienen datos en cada fila
                for (let celda of fila) {
                    if (celda !== '') {
                        contadorDatos++;
                    }
                }
                // Valida que la fila tenga todos los valores.
                if (contadorDatos > 0) {
                    return false;
                }
            }
            return true;
        }

    }
    /**
 *  @description Evento que crea los eventos para los inputs.
 *  @param {*} input
 */
    function eventoInputs(input) {
        input.addEventListener("blur", function () {
            // Obtener el padre
            const tdPadre = input.parentElement;
            // Saber la posicion de la fila del input actual
            let fila = tdPadre.parentNode.rowIndex;
            // Saber la posicion de la columna del input actual
            let columna = tdPadre.cellIndex;
            // Expresion regular la cual valida que sea un numero entero o decimal.
            let regex = /^[-+]?\d*\.?\d+$/;
            // * Verifica cual columna fue seleccionada
            switch (tdPadre.cellIndex) {
                // Si es la columna uno entonces hara lo siguiente
                case 1:
                    // Validar que no este vacia y elimina los espacios
                    if (input.value.trim()) {
                        // Valida con la expresion regular que solo se permitan numeros enteros y decimales.
                        if (regex.test(input.value)) {
                            if (input.value != matrizMultidimensional[fila - 1][columna]) {
                                // Despues el mismo valor lo agrega al input
                                input.value = input.value.trim();
                                // * Evento para activar el boton de guardar
                                activarButton();
                                // Despues lo agrego a la matriz.
                                matrizMultidimensional[fila - 1][columna] = input.value;
                                // Comprueba si el nodo siguiente tiene un valor entonces calcular el total de costo fijo
                                // y revisara que si toda la fila esta completa para crear una nueva fila.
                                columnaSiguiente(tdPadre, fila, columna, input)
                                // En caso de que no sea un numero o un dato valido entonces se hara lo siguiente
                            }
                        } else {
                            // Se cambiara el valor en el input actual.
                            input.value = "0";
                            // Se le asignara en la matriz el dato correspondiente
                            matrizMultidimensional[fila - 1][columna] = "0";
                            // Comprueba si el nodo siguiente tiene un valor entonces calcular el total de costo fijo
                            // y revisara que si toda la fila esta completa para crear una nueva fila.
                            columnaSiguiente(tdPadre, fila, columna, input);
                            activarButton();
                            // Se mostrar en pantalla que solo se permiten numeros
                            // alert("Solo se permiten números en este campo.");
                            newMessageP.textContent = "Solo se permiten números en este campo.";
                            newToastDiv.style.display = 'block';
                        }
                        // * Si esta vacio el valor hara lo siguiente
                    } else {
                        input.value = "0";
                        // Asigno el vacio a la matriz en la posicion correspondiente.
                        matrizMultidimensional[fila - 1][columna + 2] = "";
                        // Cambio el valor en la matriz.
                        matrizMultidimensional[fila - 1][columna] = "";
                        // Obtengo el nodo padre que es el td
                        const tdSiguiente = tdPadre.nextElementSibling;
                        // Obtengo el nodo siguiente o sea otro td
                        const totalNodo = tdSiguiente.nextElementSibling;
                        activarButton();
                        // Le asigno el valor 0
                        totalNodo.querySelector("input").value = "0";
                        // Calculo de nuevo el total costo fijo.
                        calcularTotalFijos();
                    }
                    // Se sale del switch.
                    break;
                // En caso de que sea la columna 2 entonces hara lo siguiente.
                case 2:
                    // Validar que no este vacia y elimina los espacios
                    if (input.value.trim()) {
                        // Valida con la expresion regular que solo se permitan numeros enteros y decimales.
                        if (regex.test(input.value)) {
                            if (input.value != matrizMultidimensional[fila - 1][columna]) {
                                // Despues el mismo valor lo agrega al input
                                input.value = input.value.trim();
                                activarButton();
                                // Despues lo agrego a la matriz.
                                matrizMultidimensional[fila - 1][columna] = input.value;
                                // Valida el nodo anterior
                                columnaAnterior(tdPadre, input, columna, fila);
                            }
                        } else {
                            // Le asigna el valor de cero al input actual
                            input.value = "0";
                            matrizMultidimensional[fila - 1][columna] = "0";
                            activarButton();
                            // Valido el nodo anterior si tiene un valor.
                            columnaAnterior(tdPadre, input, columna, fila);
                            // Muestra un alert de que esta mal ingresar otra cosa que no sean numeros.
                            newMessageP.textContent = "Solo se permiten números en este campo.";
                            newToastDiv.style.display = 'block';
                        }
                        // * Si esta vacio entonces hara lo siguiente
                    } else {
                        // Le asigno vacio al input actual.
                        input.value = "0";
                        // Asigno el vacio a la matriz en la posicion correspondiente.
                        matrizMultidimensional[fila - 1][columna + 1] = "";
                        activarButton();
                        // cambiO el valor en la matriz.
                        matrizMultidimensional[fila - 1][columna] = "";
                        // Obtengo el nodo padre que es el td
                        const tdSiguiente = tdPadre.nextElementSibling;
                        // Le asigno el valor 0
                        tdSiguiente.querySelector("input").value = "0";
                        // Calculo de nuevo el total costo fijo.
                        calcularTotalFijos();
                    }
                    break;
                default:
                    if (input.value != matrizMultidimensional[fila - 1][columna]) {
                        // Le quito todos los espacios.
                        input.value = input.value.trim();
                        activarButton();
                        // Le asigno los valor a la posicion correspondiente en la matriz.
                        matrizMultidimensional[fila - 1][columna] = input.value;
                        // Valida para crear una fila.
                        crearFila(fila, tdPadre);
                    }
                    // Sale del switch.
                    break;
            }
            // * Si es de la posicion 0 entonces el siguiente
        });
    }


    /**
     * @description Metodo que valida cuando crear una fila.
     * @param {*} row
     * @param {*} tdPadre
     */
    function crearFila(row, tdPadre) {
        //---------ESTRUCTURA QUE VALIDA QUE HACER---------
        // Valida que todas las filas no sean cadenas vacias.
        // Si no son vacias entonces agrega una fila.
        if (
            matrizMultidimensional[row - 1][0].trim() &&
            matrizMultidimensional[row - 1][1].trim() &&
            matrizMultidimensional[row - 1][2].trim()
        ) {

            // If para solo validar si es el ultima fila
            if (row === matrizMultidimensional.length) {
                // TODO: Calcular total costo fijo
                let nuevaFila = new Array(4).fill("");
                // La agrego la nueva fila a la matriz.
                matrizMultidimensional.push(nuevaFila);
                // Creo un boton el cual es para eliminar
                const botonEliminar = document.createElement("button");
                // Le agrego el texto correspondiente
                botonEliminar.textContent = "Eliminar";
                // Agrego las clases las cuales se le van asignar.
                botonEliminar.classList.add(
                    "bg-red-500",
                    "hover:bg-red-700",
                    "text-white",
                    "font-bold",
                    "py-2",
                    "px-4",
                    "rounded",
                );
                // * CREAR EL EVENTO PARA EL BOTON.
                eventoButton(botonEliminar);
                // Se agregará al final de la fila
                const ultimaCelda = tdPadre.parentElement.insertCell(-1);
                // Se agrega en esa misma fila el boton.
                ultimaCelda.appendChild(botonEliminar);
                // Obtengo la etiqueta tbody la cual me va a servir para luego insertarlo a lo ultimo
                let tbody = tdPadre.parentElement.parentElement;
                // Creo la una fila la cual me va a servir para luego ingresarle
                // los inputs correspondientes
                let fila = tbody.insertRow();
                // Recorro 5 veces porque son las columnas totales.
                for (let i = 0; i < 4; i++) {
                    // Creo la columna la cual va a ir lo que corresponda.
                    let celda = fila.insertCell();
                    // Agrego la clase a la celda
                    celda.classList.add(
                        "border",
                        "px-4",
                        "py-2",

                    );
                    // Cuando se la columna 3 entonces agregara lo siguiente.
                    if (i === 3) {
                        // Se crea un input.
                        let input = document.createElement("input");
                        // El cual se le asigna el evento.
                        eventoInputs(input);
                        // Se le dice que sera tipo texto

                        input.setAttribute("type", "text");
                        // Se le asigna que no se podra escribir en el
                        input.setAttribute("disabled", "true");
                        input.classList.add(
                            "w-full",
                            "border",
                            "rounded-sm",
                            "px-2",
                            "py-1",
                            "text-right"
                        );
                        // Y se agrega en la columna.
                        celda.appendChild(input);
                        // De lo contrario se va a crear un input con las expecificaciones correspondientes
                    } else {
                        // Se crea un input
                        let input = document.createElement("input");
                        // Se le asigna un evento.
                        eventoInputs(input);
                        // Se le dice que sera tipo texto
                        input.setAttribute("type", "text");
                        if (i > 0) {
                            input.classList.add(
                                "w-full",
                                "border",
                                "rounded-sm",
                                "px-2",
                                "py-1",
                                "text-right"
                            );
                        }
                        input.classList.add(
                            "w-full",
                            "border",
                            "rounded-sm",
                            "px-2",
                            "py-1",
                        );
                        // Y se agrega en la columna.
                        celda.appendChild(input);
                    }
                }
            }
        }
    }

    /**
     * @description Metodo que calcula el total de los costos fijos.
     */
    function calcularTotalFijos() {
        let totalCostoFijo = 0;
        // Recorro la matriz pero solo la ultima posicion ya que es la que tiene el total de cada fila.
        for (let i = 0; i < matrizMultidimensional.length; i++) {
            // Solo sumara las filas las cuales tengan un valor
            if (matrizMultidimensional[i][matrizMultidimensional[i].length - 1] !== "") {
                // Aqui sumara el valor y lo asignara en el apartado correspondiente donde dice total costo fijo.
                totalCostoFijo += parseFloat(matrizMultidimensional[i][matrizMultidimensional[i].length - 1]);
            }
        }
        // Le asigno el total de todas las fila.
        document.getElementById("costosFijos").textContent = "Total costos fijos: $" + totalCostoFijo.toFixed(2).toString();
        // document.getElementById("costosFijos").textContent = "Total costos fijos: $" + totalCostoFijo.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    /**
     * @description Metodo que verifica que el nodo siguiente tenga un dato para calcular el costo fijo de la fila.
     * @param {*} tdPadre
     * @param {*} fila
     * @param {*} columna
     * @param {*} input
     */
    function columnaSiguiente(tdPadre, fila, columna, input) {
        const tdSiguiente = tdPadre.nextElementSibling;
        // Obtengo la columna total la cual almacena el total de esa fila.
        const totalNodo = tdSiguiente.nextElementSibling;
        // En caso de que tenga un valor hara lo siguiente
        if (tdSiguiente.querySelector("input").value) {
            // Calculo el input actual es la posicion 1 con el nodo siguiente para sacar el total de esa fila.
            let calcularTotal = parseFloat(input.value) * parseFloat(tdSiguiente.querySelector("input").value);
            // Se lo asigno a la posicon de la matriz correspondiente.
            matrizMultidimensional[fila - 1][columna + 2] = calcularTotal.toString();
            // Le asigno el valor a la columna total.
            totalNodo.querySelector("input").value = calcularTotal.toString();
            // Creo una variable la cual me hara sacar el total de todo el costo fijo.
            // * SE MANDA A CALCULAR EL TOTAL DE COSTO FIJO
            calcularTotalFijos();
            // Envio a comprobar si es la ultima fila para crear un nueva fila.
            crearFila(fila, tdPadre);
        } else {
            // Agarro el nodo columna Total y lo pongo en cero y luego hago sacar el total de costo fijo otra vez.
            // Le asigno 0 al total de la fila
            totalNodo.querySelector("input").value = "0";
            // Le asigno cero a la matriz en la posicion correspondiente.
            matrizMultidimensional[fila - 1][columna + 2] = 0;
            // Calcula el total costo fijo.
            calcularTotalFijos();
        }
    }
    /**
     * @description Metodo que valida que la columna anterior tenga dato para calcular
     * @param {*} tdPadre
     * @param {*} input
     */
    function columnaAnterior(tdPadre, input, columna, fila) {
        // Obtengo el nodo anterior.
        const tdAnterior = tdPadre.previousElementSibling;
        // Obtengo el nodo del total de la fila.
        const totalNodo = tdPadre.nextElementSibling;
        // Compruebo que el nodo anterios tenga un valor.
        if (tdAnterior.querySelector("input").value) {
            // Calculo el total de la fila.
            let calcularTotal = parseFloat(input.value) * parseFloat(tdAnterior.querySelector("input").value);
            // Asigno el resultado en el nodo Total de la fila.
            totalNodo.querySelector("input").value = calcularTotal.toString();
            // Se le asigno el resultado a la matriz en la posicion correspondiente.
            matrizMultidimensional[fila - 1][columna + 1] = calcularTotal.toString();
            // El metodo para calcular el total de costo fijo.
            calcularTotalFijos();
            // Valida si es necesario crear una nueva fila.
            crearFila(fila, tdPadre);
        } else {
            // Agarro el nodo columna Total y lo pongo en cero y luego hago sacar el total de costo fijo otra vez.
            // Le asigno 0 al total de la fila
            totalNodo.querySelector("input").value = "0";
            // Le asigno cero a la matriz en la posicion correspondiente.
            matrizMultidimensional[fila - 1][columna + 1] = 0;
            // Calcula el total costo fijo.
            calcularTotalFijos();
        }
    }

    /**
     *  Metodo para crearle a los botones.
     * @param {*} button
     */
    function eventoButton(button) {
        // * Se crea el evento para eliminar
        button.addEventListener('click', function () {
            // Obtengo la posicion de la fila.
            const row = button.parentNode.parentNode.rowIndex;
            activarButton();
            // Obtengo la tabla
            const tabla = document.getElementById("miTabla");
            // Lo elimina en la matriz.
            matrizMultidimensional.splice(row - 1, 1);
            // Eliminar en el HTML
            tabla.deleteRow(row);
            // Recalcula el total de costo Fijo.
            calcularTotalFijos();
        });
    }


    /**
     *  TODO: Funcion que activa el botonm de guardar
     */
    function activarButton() {
        if (miBoton.disabled) {
            miBoton.classList.replace('bg-green-800', 'bg-green-500');
            miBoton.classList.toggle
            miBoton.classList.replace('text-gray-400', 'text-white');
            miBoton.disabled = false;
        }
    }
});


