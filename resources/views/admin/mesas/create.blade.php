@extends('layouts.app')
@section('title', 'Mesas De Examen')

@section('content')
<div class="container">
    <h1 class="h1">Mesas de Examen</h1>
    <br>
    @livewire('mesa-examen')
</div>
@endsection