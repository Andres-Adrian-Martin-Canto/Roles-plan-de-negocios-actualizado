/**
 *  TODO: Función para convertir un número a string con dos decimales
 * @param {Number} numero
 * @returns {String} Retornar el valor convertido a string con dos decimales
 */
export const conversionNumbrerString = (numero) => {
    const posicionPunto = numero.toString().indexOf('.');
    if (posicionPunto === -1) {
        return numero.toFixed(2).toString();
    }
    const numeroDecimales = numero.toString().split( '.' )[1].length;
    return (numeroDecimales > 1) ? numero.toString().slice( 0 , posicionPunto + 3) : numero.toFixed(2).toString();
};
