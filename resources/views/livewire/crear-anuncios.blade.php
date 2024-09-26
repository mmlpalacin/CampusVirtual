<div class="container">
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <form wire:submit.prevent="submit">
        @csrf
        <x-validation-errors/>
        <input type="hidden" name="user_id" wire:model.defer="user_id" value="{{ Auth::user()->id }}">

        <input type="text" name="title" id="title" placeholder="Titulo..." wire:model.defer="title">
        <x-section-border />

        <div wire:ignore>
            <textarea x-data x-init="ClassicEditor
            .create(document.querySelector('#body'), {

            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('body', editor.getData());
                })
            })
            .catch(err => {
                console.error(err.stack);
            });" id="body" wire:model.lazy="body" name="body">
            {!! $body !!}
        </textarea>
        </div>
        <x-section-border />

        @can('anuncio.curso')
            @foreach ($cursos as $curso)
                <x-label for="curso">{{ $curso->name }}°{{ $curso->division_id }}
                    <input type="radio" name="curso_id" value="{{ $curso->id }}" wire:model.defer="curso_id" class="rm-1">
                </x-label>
            @endforeach
            <x-section-border />
        @endcan

        <div style="display: flex; gap: 10px;">
            <h3 class="h3 mr-20">Estado:</h3>
            <x-label for="status1">Borrador</x-label>
            <input type="radio" id="status1" name="status" value="1" wire:model.defer="status">
            <x-label class="ml-20" for="status2">Publicar</x-label>
            <input type="radio" id="status2" name="status" value="2" wire:model.defer="status">
            <x-section-border />
        </div>

        <x-button type="submit">Guardar Anuncio</x-button>
    </form>
</div>