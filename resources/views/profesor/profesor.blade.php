<div class="flex justify-center">
    <ol class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 inline-block">
        @foreach($cursos as $curso)
            <a href="{{route('admin.cursos.show', $curso)}}"><li class="text-center">{{$curso->name}} ° {{$curso->division->name}}, {{$curso->especialidad->name}}</li></a>
        @endforeach
    </ol>
</div>