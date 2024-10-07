@extends('layouts.app')
@section('title', 'Lista de Usuarios')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Usuarios Registrados
    </h1>
    <x-a href="{{route('admin.users.create')}}">Nuevo Usuario</x-a>
@endsection
@section('content')
@if (session('info'))
        <div class="alert">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('users-index')
@endsection