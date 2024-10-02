document.getElementById('pais').addEventListener('change', function() {
    const paisId = this.value;
    fetch(`/provincias/${paisId}`)
        .then(response => response.json())
        .then(data => {
            const provinciaSelect = document.getElementById('provincia');
            provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
            data.forEach(provincia => {
                provinciaSelect.innerHTML += `<option value="${provincia.id}">${provincia.provincia}</option>`;
            });
            provinciaSelect.disabled = false;
        });
});

document.getElementById('provincia').addEventListener('change', function() {
    const provinciaId = this.value;
    fetch(`/partidos/${provinciaId}`)
        .then(response => response.json())
        .then(data => {
            const partidoSelect = document.getElementById('partido');
            partidoSelect.innerHTML = '<option value="">Seleccione un partido</option>';
            data.forEach(partido => {
                partidoSelect.innerHTML += `<option value="${partido.id}">${partido.partido}</option>`;
            });
            partidoSelect.disabled = false;
        });
});

document.getElementById('partido').addEventListener('change', function() {
    const partidoId = this.value;
    fetch(`/ciudades/${partidoId}`)
        .then(response => response.json())
        .then(data => {
            const ciudadSelect = document.getElementById('ciudad');
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
            data.forEach(ciudad => {
                ciudadSelect.innerHTML += `<option value="${ciudad.id}">${ciudad.ciudad}</option>`;
            });
            ciudadSelect.disabled = false;
        });
});