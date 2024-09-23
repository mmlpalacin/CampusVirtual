@extends('layouts.app')
@section('title', 'Anuncios')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Anuncios
    </h1>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($anuncios as $anuncio)
                <div class="bg-white overflow-hidden shadow-xl mt-4 sm:rounded-lg">

                    <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->published}}</p>
                    @if ($anuncio->curso)
                        <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->curso->name}} ° {{$anuncio->curso->division->name}}</p>
                    @endif
                    <div class=" flex flex-col items-center"> 
                        <h3 class="h4 font-weight-bold">{{$anuncio->title}}</h3>
                        <p class="card-text ml-4">{!!$anuncio->body!!}</p>  
                        @if($anuncio->image->count())
                            <div class="swiper-container swiper-container-{{$anuncio->id}} mb-2 mt-2">
                                <div class="swiper-wrapper">
                                    @foreach($anuncio->image->shuffle() as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::url($image->url) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection