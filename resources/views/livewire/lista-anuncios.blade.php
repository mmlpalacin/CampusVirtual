<div class="mx-2 my-2">
    <div class="card-header">
        <br>
        <input type="text" wire:model.live="search" class="form-control" placeholder="Ingrese titulo del anuncio...">
        <br>
    </div>
    @if ($anuncios->count())
        <div class="card-body mx-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anuncios as $anuncio)
                        <tr>
                            <td>{{$anuncio->title}}</td>
                            <td>{!!$anuncio->body ?? ''!!}</td>
                            <td width="10px"><a href="{{route('admin.anuncio.create', ['id' => $anuncio->id])}}"><button class="btn btn-primary">editar</button></a></td>
                            <td width="10px">
                                <form action="{{route('admin.anuncio.destroy', $anuncio)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="card-footer">
            {{$anuncios->links()}}
        </div>    
    @else
        <strong class="mx-2 mt-4 bg-gray">No hay anuncios</strong>
    @endif
</div>