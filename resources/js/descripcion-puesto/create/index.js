const selectorJornada = document.querySelector('#jornada_laboral');

selectorJornada.addEventListener('change', () => {
    let otrosJornada = document.querySelector('#otros_jornada_laboral');
    selectorJornada.value === 'otros' ? otrosJornada.disabled = false : otrosJornada.disabled = true;
    selectorJornada.value === 'otros' ? (() => {
        otrosJornada.classList?.remove('bg-[#B8BABE]');
        otrosJornada.classList?.add('bg-white');
    })() : (() => {
        otrosJornada.value = '';
        otrosJornada.classList?.remove('bg-white');
        otrosJornada.classList?.add('bg-[#B8BABE]');
    })();
});

