document.addEventListener('DOMContentLoaded', () => {
    let contadores = [];

    iniciar();

    function iniciar() {
        document.querySelectorAll('[id^="slider-"]').forEach((slider, index) => {
            contadores[index] = 0;
            setInterval(() => {
                cambiarImg(index);
            }, 5000);
        });
    }

    window.cambiarManual = function(sentido, index) {
        const obj = document.getElementById('slider-' + index);
        const obj2 = obj.getElementsByTagName('img');
        obj2[contadores[index]].style.opacity = 0;
        if (sentido === "DER") {
            contadores[index] = contadores[index] < obj2.length - 1 ? contadores[index] + 1 : 0;
        } else if (sentido === "IZQ") {
            contadores[index] = contadores[index] !== 0 ? contadores[index] - 1 : obj2.length - 1;
        }
        obj2[contadores[index]].style.opacity = 1;
    };

    function cambiarImg(index) {
        const obj = document.getElementById('slider-' + index);
        const obj2 = obj.getElementsByTagName('img');
        obj2[contadores[index]].style.opacity = 0;
        contadores[index] = (contadores[index] + 1) % obj2.length;
        obj2[contadores[index]].style.opacity = 1;
    }
});
