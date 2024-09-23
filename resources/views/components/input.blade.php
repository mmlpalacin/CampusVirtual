@props(['disabled' => false, 'for' => null])

<div class="relative">
    <input
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
    >

    @if ($for)
        @error($for)
            <p class="text-sm text-red-600 mt-3">{{ $message }}</p>
        @enderror
    @endif
</div>