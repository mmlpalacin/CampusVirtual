<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Inscripción Formación Profesional</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

.container {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    max-width: 800px;
    margin: auto;
}

h1 {
    text-align: center;
    color: #333;
}

h2 {
    color: #444;
    margin-top: 20px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 5px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
input[type="date"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Inscripción Formación Profesional</h1>
            <section>
                @include('alumno.inscripcion.form')
            </section>

            <section>
                @include('alumno.inscripcion.form2')
            </section>

            <section>
                @include('alumno.inscripcion.form3')
            </section>
            <section>
                @include('alumno.inscripcion.form4')
            </section>

            <section>
                @include('alumno.inscripcion.form5')
            </section>
            
            <section>
                @include('alumno.inscripcion.padres')
            </section>
    </div>
</body>
</html>
