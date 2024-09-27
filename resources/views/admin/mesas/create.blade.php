@extends('layouts.app')
@section('title', 'Mesas De Examen')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Modificando Mesas de Examen
    </h1>
@endsection
@section('content')
<div class="container">
    @livewire('mesa-examen')
</div>
@endsection