@extends('layouts.app')
@section('title', 'Anuncios')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Lista de Anuncios
    </h1>
    <x-a href="{{route('admin.anuncio.create')}}">Nuevo Anuncio</x-a>
@endsection
@section('content')
    @livewire('lista-anuncios')
@endsection