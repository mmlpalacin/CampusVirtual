@extends('layouts.app')
@section('title', 'Perfil')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Perfil
    </h1>
@endsection
@section('content')
    <div class="flex flex-col items-center">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <img class="h-20 w-20 rounded-full object-cover mb-2 mt-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        @else
            {{ Auth::user()->name }}
            <svg class="h-20 w-20 rounded-full object-cover mb-2 mt-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        @endif
        <h2 class="text-lg font-bold mb-1">{{ Auth::user()->lastname }}, {{ Auth::user()->name }}</h2>
        <h3 class="text-sm text-gray-600">{{ Auth::user()->email }}</h3>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            </div>
        </div>
    </div>
@endsection
