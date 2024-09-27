<x-form-section submit="submit">
    <x-slot name="title">
        {{ __('Pagar Cooperadora') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Completa el formulario para pagar la cooperadora.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Monto -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="monto" value="{{ __('Monto') }}" />
            <x-input id="monto" type="number" class="mt-1 block w-full" wire:model.defer="monto" required step="0.01" min="0" />
            @error('monto')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Comprobante -->
        <div class="col-span-6 sm:col-span-4 flex items-center" x-data="{ imagePreview: null }">
            <x-label for="image" value="{{ __('Subir Comprobante') }}" />
            <input type="file" id="image" class="hidden" wire:model="image" x-ref="image"
                x-on:change="
                    const file = $refs.image.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview = null;
                    }
                " 
                accept="image/*,application/pdf" />

            <!-- Select New File Button -->
            <x-button type="button" class="mt-1" x-on:click.prevent="$refs.image.click()">
                {{ __('Seleccionar Archivo') }}
            </x-button>

            <!-- File Preview -->
            <div class="mt-2" x-show="imagePreview">
                <span class="block rounded-lg shadow-sm">
                    <img :src="imagePreview" alt="Preview" class="max-h-48 mx-auto">
                </span>
            </div>

            @error('image')
                <p class="text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Pago registrado correctamente.') }}
        </x-action-message>
        <x-button wire:loading.attr="disabled">
            {{ __('Enviar Comprobante') }}
        </x-button>
    </x-slot>
</x-form-section>