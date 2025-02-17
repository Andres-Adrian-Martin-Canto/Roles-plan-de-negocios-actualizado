document.addEventListener("DOMContentLoaded", function () {
    let a = document.querySelectorAll("ol a");
    // Asignarle el evento
    a.forEach((ae) => {
        // Se agregan los eventos.
        ae.onmouseenter = function () {
            ae.querySelector('span').classList.replace('bg-gray-700', 'bg-green-500');
            ae.querySelector('h3').classList.replace('text-gray-400', 'text-white');
            ae.querySelector('svg').classList.replace('dark:text-gray-400', 'dark:text-white');
        };

        ae.onmouseleave = function () {
            ae.querySelector('span').classList.replace('bg-green-500', 'bg-gray-700');
            ae.querySelector('h3').classList.replace('text-white', 'text-gray-400');
            ae.querySelector('svg').classList.replace('dark:text-white', 'dark:text-gray-400');
        };
    });
});
