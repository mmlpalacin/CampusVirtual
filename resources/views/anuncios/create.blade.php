@extends('layouts.app')
@section('title', 'Anuncios')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Crear Anuncio
    </h1>
@endsection
@section('content')
    @livewire('crear-anuncios', ['anuncio' => $anuncio ?? null])
@endsection
