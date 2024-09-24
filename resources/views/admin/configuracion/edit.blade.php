@extends('layouts.app')
@section('title', 'Configuracion')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Configuracion
    </h1>
@endsection
@section('content')
    <livewire:configuracion :configuracion="$configuracion ?? null" />
@endsection