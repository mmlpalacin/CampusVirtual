<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label, input, select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
    .form-group {
        margin-bottom: 15px;
        display: flex;
    }
    label {
        margin-right: 5px;
        font-weight: bold;
    }
    input[type="text"], input[type="number"], input[type="email"], input[type="tel"], input[type="date"], select {
        width: 100%;
        padding: 8px;
        margin-top: 2px;
        box-sizing: border-box;
    }
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .form-row .form-group {
        flex: 1;
        margin-right: 10px;
    }
    .form-row .form-group:first-child {
        margin-left: 0;
    }
</style>
</head>
<body>
    @if ($editable && $editable === true)
        @livewire('navigation-menu')
    @endif
    <!-- Page Content -->
    <main class="min-h-screen bg-gray-100">
        <div class="card my-5 mx-5">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </main>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
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
    </script>
</body>
</html>