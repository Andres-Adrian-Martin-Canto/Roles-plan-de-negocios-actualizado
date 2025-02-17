import { toastDiv, newToastDiv, newMessageP } from './mensajes.js';
// TODO: Se ejecutara después de que cargue el html
document.addEventListener("DOMContentLoaded", function () {
    const botonGuardar = document.getElementById('miBoton');
    // * Creación de diccionarios
    let diccionarioFijo = {};
    let diccionarioVariable = {};
    let diccionarioIngreso = {};

    // * Obtengo los bodys de mi tabla
    let bodys = document.querySelectorAll("#miTabla tbody");

    // TODO: Obtengo los valores de la tabla
    // Obtener los costos Fijos.
    obtenerLosDatos(bodys[0], diccionarioFijo);
    // Obtener los costos Variables
    obtenerLosDatos(bodys[1], diccionarioVariable);
    // Obtengo los Ingresos.
    obtenerLosDatos(bodys[2], diccionarioIngreso);


    // Obtengo la fila de resultados de costos fijos
    let filaResultado = document.getElementById("costosFijos");
    // Obtengo las columnas de la fila de resultados.
    let columnaResultado = filaResultado.children;
    /**
     *  TODO: LLamo a la función que agregara en la columna correspondiente la suma de la fila correspondiente.
     *  * Envió las columnas de la fila " resultado " correspondiente
     */
    asignaciónResultadoFila(columnaResultado, diccionarioFijo);

    // * Obtenemos la fila de resultados de costos variables
    filaResultado = document.getElementById("costosVariable");
    // Obtenemos las columnas de la fila de resultados
    columnaResultado = filaResultado.children;
    // Llamamos la función para que escriba en la columna de resultado correspondiente
    asignaciónResultadoFila(columnaResultado, diccionarioVariable);

    // * Obtengo la fila de resultados de ingresos
    filaResultado = document.getElementById("ingresos");
    columnaResultado = filaResultado.children;
    asignaciónResultadoFila(columnaResultado, diccionarioIngreso);

    // * Llamamos función que calculara las utilidades y asignarlo en la columna correspondiente
    resultadoUtilidades();

    // TODO: Función para calcular el resultado de las utilidades y asignarlo en la columna correspondiente
    function resultadoUtilidades() {
        // Obtenemos la filas de fijos, variables, ingresos y utilidades
        let f_resultado_fijo = document.getElementById("costosFijos");
        let f_resultado_variable = document.getElementById("costosVariable");
        let f_resultado_ingreso = document.getElementById("ingresos");
        let f_utilidades = document.getElementById("utilidades");

        // Obtenemos las columnas de sus filas correspondientes
        let columnasFijo = f_resultado_fijo.children;
        let columnasVariable = f_resultado_variable.children;
        let columnasIngreso = f_resultado_ingreso.children;
        let columnasUtilidades = f_utilidades.children;

        // For que calculara el resultado de utilidades y lo asignara en la columna de utilidades correspondiente.
        for (let index = 1; index < columnasUtilidades.length; index++) {
            // Obtenemos el valor de la columna correspondiente.
            let vFijo = columnasFijo[index].textContent.substring(1);
            let vVariable = columnasVariable[index].textContent.substring(1);
            let vIngreso = columnasIngreso[index].textContent.substring(1);

            // Asignación de la columna correspondiente
            columnasUtilidades[index].innerHTML = "$" + (parseFloat(vIngreso) - (parseFloat(vFijo) + parseFloat(vVariable))).toFixed(2);
        } // FIN DEL FOR
    } // Fin de la función

    /**
     * TODO: Función que obtendrá los valores de cada input, id_actuales y id_pertenece
     * @param {*} tbody
     * @param {*} diccionario
     */
    function obtenerLosDatos(tbody, diccionario) {
        // Obtenemos las filas del body correspondiente
        let filas = tbody.querySelectorAll('tr');
        filas.forEach(function (fila) {
            // Obtiene el id a cual pertenece el dato.
            let id_pertenece = fila.querySelector('td[id_pertenece]').getAttribute('id_pertenece');
            // Obtenemos todas las columnas.
            let columnas = fila.querySelectorAll('td');
            // Creamos
            diccionario[id_pertenece] = [];
            // console.log(JSON.stringify(diccionario));
            for (let index = 1; index < columnas.length; index++) {
                // Obtenemos el input de la columna.
                let input = columnas[index].querySelector('input');
                // Creación de evento para el input
                agregarEventInputs(input);
                // Obtenemos el id al cual pertenece
                let id_actual = columnas[index].getAttribute('id_actual');
                // Se lo asignamos al diccionario
                diccionario[id_pertenece].push([id_actual, parseFloat(input.value)]);
            } // FIN DEL FOR
        });
    } // FIN DE LA FUNCIÓN


    /**
     * TODO: Función que asignara los valores en cada columna de la fila de resultado
     * @param {*} columnasFila
     * @param {*} estructuraBody
     */
    function asignaciónResultadoFila(columnasFila, estructuraBody) {
        // Obtengo las llaves del diccionario
        let claves = Object.keys(estructuraBody);
        // Recorro 5 veces por los cinco años que son.
        for (let indexColumna = 0; indexColumna < columnasFila.length - 1; indexColumna++) {
            // Creo una variable el cual obtendrá la suma total del resultado
            let sumaResultado = 0;
            // For que recorre por filas
            for (let index = 0; index < claves.length; index++) {
                // Hace la sumatoria de la columna correspondiente
                sumaResultado += estructuraBody[claves[index]][indexColumna][1];
            }   // Fin del for filas.
            // Escribe el valor de la columna correspondiente
            columnasFila[indexColumna + 1].innerHTML = '$' + sumaResultado.toFixed(2);
        } // Fin del for de columnas.
    } // Fin de la función asignar valores en la fila resultado

    /**
     * TODO: Función asignación de evento de inputs
     * @param {*} input
     */
    function agregarEventInputs(input) {
        input.addEventListener("blur", function () {
            // Obtenemos el body.
            let parentTbody = input.closest('tbody');
            // Saber cual body es
            let bodyEs = parentTbody.getAttribute('id');
            // Obtener la columna de la tabla
            let columnaTd = input.closest('td');
            // Obtener la fila de la tabla
            let filaTr = columnaTd.closest('tr');
            // Obtener la posición del input que se dejo de escribir.
            let columnaPosición = columnaTd.cellIndex;
            // Obtener a cual pertenece
            let id_pertenece = filaTr.querySelector('td[id_pertenece]').getAttribute('id_pertenece')
            // Variable para saber cual diccionario se va a usar.
            let diccionario;
            // Variable para saber cual fila es.
            let filaResultado;
            // If para saber cual diccionario usaremos.
            if (bodyEs === "fijo") {
                // Si el body es el fijo entonces se usar el diccionario fijo
                diccionario = diccionarioFijo;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("costosFijos");
            } else if (bodyEs === "variable") {
                // Si el body es el fijo entonces se usar el diccionario variable
                diccionario = diccionarioVariable;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("costosVariable");
            } else {
                // Si el body es el fijo entonces se usar el diccionario ingreso
                diccionario = diccionarioIngreso;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("ingresos");
            }
            // Obtengo las columnas de la fila de resultado correspondiente
            columnaResultado = filaResultado.children;
            // Si no esta vació entonces
            if (input.value.trim()) {
                // Creación de expresión regular.
                let regex = /^[-+]?\d*\.?\d+$/;
                // Si cumple con un valor decimal manda hacer lo demás
                if (regex.test(input.value)) {
                    if (input.value != diccionario[id_pertenece][columnaPosición - 1][1]) {
                        activarButton();
                        // Le asignamos el valor del input.
                        diccionario[id_pertenece][columnaPosición - 1][1] = parseFloat(input.value);
                        // Llamamos para que calcule la fila de resultado correspondiente.
                        asignaciónResultadoFila(columnaResultado, diccionario);
                        // Llamamos función para que calcula las utilidades.
                        resultadoUtilidades();
                    }
                    // De lo contrario mandar error.
                } else {
                    activarButton();
                    // Le asignamos el valor 0
                    input.value = 0;
                    // Le asignamos el valor 0
                    diccionario[id_pertenece][columnaPosición - 1][1] = 0;
                    // Llamamos para que calcule la fila de resultado correspondiente.
                    asignaciónResultadoFila(columnaResultado, diccionario);
                    // Llamamos función para que calcula las utilidades.
                    resultadoUtilidades();
                    newMessageP.textContent = "Solo se permiten números enteros o decimales.";
                    newToastDiv.style.display = 'block';
                }
                // De lo contrario pondrá un cero al input
            } else {
                activarButton();
                // Le asignamos el valor 0
                input.value = 0;
                // Le asignamos el valor 0
                diccionario[id_pertenece][columnaPosición - 1][1] = 0;
                // Llamamos para que calcule la fila de resultado correspondiente.
                asignaciónResultadoFila(columnaResultado, diccionario);
                // Llamamos función para que calcula las utilidades.
                resultadoUtilidades();
                newMessageP.textContent = "No se permiten espacios y no dejar celda vacía";
                newToastDiv.style.display = 'block';
            } // Fin de la condiciones
        })
    } //  Fin de la función

    /**
     * TODO: Evento del botón guardar.
     * * Manda la estructura a guardar en la base de datos.
     */
    botonGuardar.addEventListener('click', function () {
        let objeto = [diccionarioFijo, diccionarioVariable, diccionarioIngreso];
        // Obtengo la ruta dinámica
        let ruta = this.getAttribute("urlDinamica");
        fetch(ruta, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify(objeto)
        }).then(response => {
            if (response.ok) {
                toastDiv.style.display = 'block';
            } else {
                throw new Error("Error en la solicitud");
            }
        }).catch(error => {
            console.error("error: ", error);
        })
    });

    /**
     *  TODO: Funcion que activa el botonm de guardar
     */
    function activarButton() {
        if (botonGuardar.disabled) {
            botonGuardar.classList.replace('bg-green-800', 'bg-green-500');
            botonGuardar.classList.toggle
            botonGuardar.classList.replace('text-gray-400', 'text-white');
            botonGuardar.disabled = false;
        }
    }

});
