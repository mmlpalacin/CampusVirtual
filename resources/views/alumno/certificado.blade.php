<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Asistencia</title>
    <style>
        .certificado { border: 2px solid #000; padding: 20px; margin: 50px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }

        h1 { font-size: 24px; color: #333; text-align: center }

        h2 { font-size: 20px; color: #666; text-align: center }

    </style>
</head>
<body>
    <div class="certificado">
        <h1>Constancia de Alumno Regular</h1>
        <h2>Escuela "E.E.S.T.N°3. Domingo Faustino Sarmiento"</h2>
        <p>Se hace constar que <strong>{{$user['name']}}</strong> es alumno/a regular del establecimiento y esta matriculado en el presente curso escolar en {{$user['curso']}} y concurre a clase en el turno {{$user['turno']}}.</p>
        <p>A pedido del interesado y a solo efecto de ser presentado ante las autoridades de {{$user['autoridad']}} se le extiende la constancia en Mar del Plata a los {{$user['dia']}} dias del mes de {{$user['mes']}} de {{$user['year']}}.</p>
        <p>__________________________</p>
        <p>Firma y Sello de la Escuela</p>
    </div>
</body>