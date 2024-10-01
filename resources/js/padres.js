document.addEventListener('DOMContentLoaded', function() {
    const paisSelects = document.querySelectorAll('.pais-select');

    paisSelects.forEach(paisSelect => {
        paisSelect.addEventListener('change', function() {
            const tipo = this.dataset.tipo;
            const paisId = this.value;

            const provinciaSelect = document.getElementById(`provincia-${tipo}`);
            const partidoSelect = document.getElementById(`partido-${tipo}`);
            const ciudadSelect = document.getElementById(`ciudad-${tipo}`);

            fetch(`/provincias/${paisId}`)
                .then(response => response.json())
                .then(data => {
                    provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                    partidoSelect.innerHTML = '<option value="">Seleccione un partido</option>';
                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

                    data.forEach(provincia => {
                        provinciaSelect.innerHTML += `<option value="${provincia.id}">${provincia.provincia}</option>`;
                    });
                    provinciaSelect.disabled = false;
                });
        });
    });

    const provinciaSelects = document.querySelectorAll('.provincia-select');
    
    provinciaSelects.forEach(provinciaSelect => {
        provinciaSelect.addEventListener('change', function() {
            const tipo = this.dataset.tipo;
            const provinciaId = this.value;

            const partidoSelect = document.getElementById(`partido-${tipo}`);
            const ciudadSelect = document.getElementById(`ciudad-${tipo}`);

            fetch(`/partidos/${provinciaId}`)
                .then(response => response.json())
                .then(data => {
                    partidoSelect.innerHTML = '<option value="">Seleccione un partido</option>';
                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

                    data.forEach(partido => {
                        partidoSelect.innerHTML += `<option value="${partido.id}">${partido.partido}</option>`;
                    });
                    partidoSelect.disabled = false;
                });
        });
    });

    const partidoSelects = document.querySelectorAll('.partido-select');
    
    partidoSelects.forEach(partidoSelect => {
        partidoSelect.addEventListener('change', function() {
            const tipo = this.dataset.tipo;
            const partidoId = this.value;

            const ciudadSelect = document.getElementById(`ciudad-${tipo}`);

            fetch(`/ciudades/${partidoId}`)
                .then(response => response.json())
                .then(data => {
                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                    data.forEach(ciudad => {
                        ciudadSelect.innerHTML += `<option value="${ciudad.id}">${ciudad.ciudad}</option>`;
                    });
                    ciudadSelect.disabled = false;
                });
        });
    });
});