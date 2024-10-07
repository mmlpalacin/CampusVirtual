@extends('layouts.app')
@section('title', 'Anuncios')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Anuncios
    </h1>
@endsection
@section('content')
<style>
.slider {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 800px;
    height: 500px;
    margin: 0 auto;
    overflow: hidden;
    background-color: black;
}

.slider img {
    position: absolute;
    top: 0;
    left: 0;
    width: 800px;
    height: 500px;
    opacity: 0;
    transition: opacity 2s;
}

.slider img:nth-child(2) { /* Selecciona la primera imagen para que sea visible */
    opacity: 1;
}

/* Estilos para los botones de flecha */
.slider .prev,
.slider .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(255, 255, 255, 0.5);
    color: black;
    font-size: 24px;
    border: none;
    cursor: pointer;
    padding: 8px 16px;
    z-index: 2;
}

.slider .prev {
    left: 10px;
}

.slider .next {
    right: 10px;
}

.slider .prev:hover,
.slider .next:hover {
    background-color: rgba(255, 255, 255, 0.8);
}

</style>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($anuncios as $index => $anuncio) 
            <div class="bg-white overflow-hidden pb-3 shadow-xl mt-4 sm:rounded-lg">
                <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->published}}</p>
                @if ($anuncio->curso)
                    <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->curso->name}} ° {{$anuncio->curso->division->name}}</p>
                @endif
                <div class="flex flex-col items-center"> 
                    <h3 class="h4 font-weight-bold">{{$anuncio->title}}</h3>
                    <p class="card-text ml-4">{!! $anuncio->body !!}</p>  
                    @if($anuncio->image->count())
                        <div class="slider" id="slider-{{$index}}">
                            <input type="button" class="prev" value="←" onclick="cambiarManual('IZQ', {{$index}})">
                            @foreach($anuncio->image->shuffle() as $image)
                                <img class="slider-item" src="{{ Storage::url($image->url) }}">
                            @endforeach
                            <input type="button" class="next" value="→" onclick="cambiarManual('DER', {{$index}})">
                        </div>                    
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    window.addEventListener('load', iniciar, false);

    function iniciar(){
        setInterval(function(){
            document.querySelectorAll('[id^="slider-"]').forEach((slider, index) => {
                cambiarImg(index);
            });
        }, 5000);
    }

    function cambiarManual(sentido, index) {
        var obj = document.getElementById('slider-' + index);
        var obj2 = obj.getElementsByTagName('img');
        if (sentido == "DER") {
            obj2[contador].style.opacity = 0;
            if (contador < obj2.length - 1) {
                contador++;
            } else {
                contador = 0;
            }
            obj2[contador].style.opacity = 1;
        } else if (sentido == "IZQ") {
            obj2[contador].style.opacity = 0;
            if (contador != 0) {
                contador--;
            } else {
                contador = obj2.length - 1;
            }
            obj2[contador].style.opacity = 1;
        }
    }

    var contador = 0;
    function cambiarImg(index) {
        var obj = document.getElementById('slider-' + index);
        var obj2 = obj.getElementsByTagName('img');
        obj2[contador].style.opacity = 0;
        contador = (contador + 1) % obj2.length;
        obj2[contador].style.opacity = 1;
    }
</script>

@endsection