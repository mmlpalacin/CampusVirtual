document.addEventListener('DOMContentLoaded', () => {
    const viveSelects = document.querySelectorAll('select[name$="[vive]"]');
    viveSelects.forEach(select => {
        select.addEventListener('change', function() {
            const viveValue = this.value;
            const tipo = this.dataset.tipo;
            
            const additionalContent = document.querySelector(`.form-content-${tipo}`);

            if (viveValue === '1') {
                additionalContent.style.display = 'block';
            } else {
                additionalContent.style.display = 'none';
            }
        });

        select.dispatchEvent(new Event('change'));
    });

    if (document.getElementById('tutor[vive]')) {
        document.querySelector(`.form-content-tutor`).style.display = 'block';
    }
});


const paisSelects = document.querySelectorAll('select[id^="pais-"]');
paisSelects.forEach(select => {
    select.addEventListener('change', function() {
        const tipo = this.dataset.tipo;
        const paisId = this.value;
        fetch(`/provincias/${paisId}`)
            .then(response => response.json())
            .then(data => {
                const provinciaSelect = document.getElementById(`provincia-${tipo}`);
                provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                data.forEach(provincia => {
                    provinciaSelect.innerHTML += `<option value="${provincia.id}">${provincia.provincia}</option>`;
                });
                provinciaSelect.disabled = false;
            });
    });
});

const provinciaSelects = document.querySelectorAll('select[id^="provincia-"]');
provinciaSelects.forEach(select => {
    select.addEventListener('change', function() {
        const tipo = this.dataset.tipo;
        const provinciaId = this.value;
        fetch(`/partidos/${provinciaId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Datos de partidos recibidos:', data);
                const partidoSelect = document.getElementById(`partido-${tipo}`);
                if (partidoSelect) {
                    partidoSelect.innerHTML = '<option value="">Seleccione un partido</option>';
                    data.forEach(partido => {
                        partidoSelect.innerHTML += `<option value="${partido.id}">${partido.partido}</option>`;
                    });
                    partidoSelect.disabled = false;
                } else {
                    console.error(`Partido select with ID partido-${tipo} not found.`);
                }
            });
    });
});

const selects = document.querySelectorAll('select[id^="partido-"]');
selects.forEach(select => {
    select.addEventListener('change', function() {
        const tipo = this.dataset.tipo;
        const partidoId = this.value;
        fetch(`/ciudades/${partidoId}`)
            .then(response => response.json())
            .then(data => {
                const ciudadSelect = document.getElementById(`ciudad-${tipo}`);
                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                data.forEach(ciudad => {
                    ciudadSelect.innerHTML += `<option value="${ciudad.id}">${ciudad.ciudad}</option>`;
                });
                ciudadSelect.disabled = false;
            });
    });
});
