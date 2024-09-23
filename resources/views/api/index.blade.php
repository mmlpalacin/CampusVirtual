<x-app-layout>
@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Tokens') }}
        </h2>
@endsection
@section('content')

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('api.api-token-manager')
        </div>
    </div>
@endsection
