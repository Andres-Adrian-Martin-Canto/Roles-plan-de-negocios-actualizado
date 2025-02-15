document.addEventListener("DOMContentLoaded", function () {
    let bodys = document.querySelector("table tbody");
    let filas = bodys.querySelectorAll("tr");
    var arraydatos = {};
    filas.forEach(function (fila) {
        // Obtiene el id a cual pertenece el dato.
        let id_pertenece = fila.querySelector('td[id_pertenece]').getAttribute('id_pertenece');
        // Obtenemos todas las columnas.
        let columnas = fila.querySelectorAll('td');
        // Creamos
        arraydatos[id_pertenece] = [];
        // console.log(JSON.stringify(diccionario));
        for (let index = 1; index < columnas.length; index++) {
            // Obtenemos el input de la columna.
            let input = columnas[index].querySelector('input');
            // Creación de evento para el input
            agregarEventInputs(input);
            // Obtenemos el id al cual pertenece
            let id_actual = columnas[index].getAttribute('id_actual');
            // Se lo asignamos al diccionario
            arraydatos[id_pertenece].push([id_actual, parseFloat(input.value)]);
        } // FIN DEL FOR
    });
    var filaResultado = document.getElementById("totales");
    var columnaResultado = filaResultado.children;
    asignaciónResultadoFila(columnaResultado, arraydatos);
   
    function agregarEventInputs(input) {
        input.addEventListener("blur", function () {
            let columnaTd = input.closest('td');
            // Obtener la fila de la tabla
            let filaTr = columnaTd.closest('tr');
            // Obtener la posición del input que se dejo de escribir.
            let columnaPosición = columnaTd.cellIndex;
            // Obtener a cual pertenece
            let id_pertenece = filaTr.querySelector('td[id_pertenece]').getAttribute('id_pertenece');

            if (input.value.trim()) {
                if (input.value != arraydatos[id_pertenece][columnaPosición - 1][1]) {
                    arraydatos[id_pertenece][columnaPosición - 1][1] = parseFloat(input.value);
                    asignaciónResultadoFila(columnaResultado, arraydatos);
                }
                actualizarTotal();
            } else {
                input.value = 0;
                arraydatos[id_pertenece][columnaPosición - 1][1] = 0;
                asignaciónResultadoFila(columnaResultado, arraydatos);
                actualizarTotal();
                alert("No se permite Vacio")
            }
            
        });
    }
    actualizarTotal(); // Llamar a la función para actualizar el total

    function actualizarTotal() {
        // Obtener la fila con los totales
        let filaTotales = document.getElementById("totales");
        // Obtener todas las celdas de la fila
        let celdasTotales = filaTotales.querySelectorAll('th');
        
        // Inicializar una variable para el total
        let totalGeneral = 0;
    
        // Recorrer las celdas (excepto la primera celda que contiene el texto "Total Sueldos")
        for (let i = 1; i < celdasTotales.length; i++) {
            let valor = parseFloat(celdasTotales[i].innerText.replace('$', '').replace(',', ''));
    
            // Asegurarse de que el valor no sea NaN
            if (!isNaN(valor)) {
                totalGeneral += valor;
            }
        }
    
        // Actualizar la celda con el total
        let celdaTotal = document.getElementById("total-general");
        celdaTotal.innerText = `$${totalGeneral.toFixed(2)}`;
    }
    
    function asignaciónResultadoFila(columnasFila, estructuraBody) {
        // Obtengo las llaves del diccionario
        let filaResultado = document.getElementsByTagName("tfoot");
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
    
    let boton = document.getElementById("botonguardar");
    boton.addEventListener("click", function () {
        let ruta = this.getAttribute("ruta");
        fetch(ruta, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify(arraydatos),
        }).then(Response => {
            if (Response.ok) {
                mostrarMensajeExito("Datos guardados exitosamente", true); // Refresca la página después del mensaje
            } else {
                mostrarMensajeError("Hubo un error al guardar los datos.");
            }
        }).catch(error => {
            console.error("Error:", error);
            mostrarMensajeError("Ocurrió un error inesperado.");
        });
    });
    
    // Función para mostrar mensaje de éxito
    function mostrarMensajeExito(message, refresh = false) {
        const messageDialog = document.createElement('div');
        messageDialog.innerHTML = `
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Éxito</h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">${message}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex justify-center sm:flex-row-reverse gap-2">
                            <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                                <button id="closeSuccessBtn" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cerrar
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(messageDialog);

        document.getElementById('closeSuccessBtn').addEventListener('click', () => {
            document.body.removeChild(messageDialog);
            if (refresh) {
                location.reload(); // Refresca la página
            }
        });
        // Refresca automáticamente después de 3 segundos
        if (refresh) {
            setTimeout(() => {
                location.reload();
            }, 3000);
        }
    }
    // Función para mostrar mensaje de error
    function mostrarMensajeError(message) {
        const messageDialog = document.createElement('div');
        messageDialog.innerHTML = `
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Error</h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">${message}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex justify-center sm:flex-row-reverse gap-2">
                            <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                                <button id="closeErrorBtn" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cerrar
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(messageDialog);

        document.getElementById('closeErrorBtn').addEventListener('click', () => {
            document.body.removeChild(messageDialog);
        });
    }
    
});
