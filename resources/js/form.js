document.querySelectorAll('[name="pais_id"]').forEach(element => {
    element.addEventListener('change', function() {
        const paisId = this.value;
        const provinciaSelect = this.closest('.form-row') ? 
            this.closest('.form-row').querySelector('[name="provincia_id"]') :
            document.querySelector(`[name="${this.name.replace('pais_id', 'provincia_id')}"]`);

        fetch(`/provincias/${paisId}`)
            .then(response => response.json())
            .then(data => {
                provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
                data.forEach(provincia => {
                    provinciaSelect.innerHTML += `<option value="${provincia.id}">${provincia.provincia}</option>`;
                });
                provinciaSelect.disabled = false;
            });
    });
});

document.querySelectorAll('[name="provincia_id"]').forEach(element => {
    element.addEventListener('change', function() {
        const provinciaId = this.value;
        const partidoSelect = this.closest('.form-row') ? 
            this.closest('.form-row').querySelector('[name="partido_id"]') :
            document.querySelector(`[name="${this.name.replace('provincia_id', 'partido_id')}"]`);

        fetch(`/partidos/${provinciaId}`)
            .then(response => response.json())
            .then(data => {
                partidoSelect.innerHTML = '<option value="">Seleccione un partido</option>';
                data.forEach(partido => {
                    partidoSelect.innerHTML += `<option value="${partido.id}">${partido.partido}</option>`;
                });
                partidoSelect.disabled = false;
            });
    });
});

document.querySelectorAll('[name="partido_id"]').forEach(element => {
    element.addEventListener('change', function() {
        const partidoId = this.value;
        const ciudadSelect = this.closest('.form-row') ? 
            this.closest('.form-row').querySelector('[name="ciudad_id"]') :
            document.querySelector(`[name="${this.name.replace('partido_id', 'ciudad_id')}"]`);

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
