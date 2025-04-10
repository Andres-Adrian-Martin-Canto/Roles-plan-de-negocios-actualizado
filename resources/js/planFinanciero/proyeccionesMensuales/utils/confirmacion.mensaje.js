/**
 *  TODO: Modal para confirmar si quiere borrar los valores anuales y cinco anios
 *  @param {String} message
 *  @returns {Promise<Boolean>}
 */
export const confirmacionEliminarLosAnuales = async(message) => {
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
        },{ once: true });

        document.getElementById('cancelBtn').addEventListener('click', () => {
            document.body.removeChild(confirmDialog);
            resolve(false);
        },{ once: true });
    });
}
