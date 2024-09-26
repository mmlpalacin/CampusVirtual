<?php

namespace App\Livewire;

use App\Models\Configuracion as ModelsConfiguracion;
use App\Models\Curso;
use App\Models\Division;
use App\Models\Especialidad;
use App\Models\Turno;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Configuracion extends Component
{
    public $configuracionId;
    public $name, $direccion, $telefono, $ciclo_lectivo, $hora_inicio, $hora_fin, $tipo_evaluacion;
    public $grados = [], $cooperadora = [], $dias = [], $jornadas = [];
    
    public $cursos = [];
    public $nuevoGrado, $nuevaCooperadora, $nuevaEspecialidad, $nuevaDivision;

    public $diasDeLaSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    public $jornadasDisponibles = ['Simple', 'Completa', 'Extendida', 'Doble Escolaridad'];

    public $mostrarCampo = [
        'turno' => false,
        'grado' => false,
	    'cooperadora' =>false,
        'especialidad' => false,
        'division' => false,
    ];

    public function mount($configuracion = null)
    {
        $this->cursos =  Curso::all()->toArray();
        if ($configuracion) {
            $this->configuracionId = $configuracion->id;
            $this->name = $configuracion->name;
            $this->direccion = $configuracion->direccion;
            $this->telefono = $configuracion->telefono;
            $this->ciclo_lectivo = $configuracion->ciclo_lectivo;
            $this->hora_inicio = $configuracion->hora_inicio;
            $this->hora_fin = $configuracion->hora_fin;
            $this->tipo_evaluacion = $configuracion->tipo_evaluacion ?? null;
            $this->grados = $configuracion->grados ?? [];
            $this->cooperadora = $configuracion->cooperadora ?? [];
            $this->jornadas = $configuracion->jornadas ?? [];
            $this->dias = $configuracion->dias ?? [];
        }
    }

    public function mostrarCampoNuevo($campo)
    {
	    $this->mostrarCampo[$campo] = true;
    }

    public function agregarElemento($tipo)
    {
        if (in_array($tipo, ['grado', 'cooperadora'])) {
            $nuevoElemento = ($tipo === 'grado') ? $this->nuevoGrado : $this->nuevaCooperadora;

            if ($nuevoElemento) {
                ($tipo === 'grado') ? $this->grados[] = $nuevoElemento : $this->cooperadora[] = ['montos' => [ $nuevoElemento], 'grados' => []];
                ($tipo === 'grado') ? $this->nuevoGrado = '' : $this->nuevaCooperadora = '';
            }
        }else {
            $model = match ($tipo) {
                'division' => Division::class,
                'turno' => Turno::class,
                'especialidad' => Especialidad::class,
                default => null,
            };
            if ($model) {
                $fieldName = 'nueva' . ucfirst($tipo);
                $this->validate([
                    $fieldName => 'required|string|max:255',
                ]);
            }
            $model::create(['name' => $this->$fieldName]);
            $this->$fieldName = '';
        }
	    $this->mostrarCampo[$tipo] = false;
    }
    
    public function eliminarItem($tipo, $id)
    {
        if (in_array($tipo, ['grado', 'cooperadora'])) {
        $array = $tipo === 'grado' ? 'grados' : 'cooperadora';
        $elemento = $this->$array[$id];
        unset($this->$array[$id]);
        $this->$array = array_values($this->$array);  // Reindexa el array correcto, o sea, elimina espacio en blanco [1, 3, 4] = [1,2,3].
        if ($tipo === 'grado') {
            foreach (['cooperadora', 'cursos'] as $propiedad) {
                $this->$propiedad = array_map(function ($item) use ($elemento) {
                    $item['grados'] = array_values(array_filter($item['grados'], fn($grado) => $grado !== $elemento));
                    return $item;
                }, $this->$propiedad);
            }
        }
        }elseif (in_array($tipo, ['especialidad', 'division'])) {
            $model = $tipo === 'especialidad' ? Especialidad::class : Division::class;
            $column = $tipo === 'especialidad' ? 'especialidad_id' : 'division_id';
            
            Curso::where($column, $id)->update([$column => null]);
            $model::destroy($id);

            $this->{$tipo . 'es'} = $model::all();  // Actualiza 'especialidades' o 'divisiones'
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:45',
            'telefono' => 'nullable|string|max:45',
            'ciclo_lectivo' => 'required|integer|unique:configuracion,ciclo_lectivo,' . $this->configuracionId,
            'grados' => 'required|array',
            'cooperadora' => 'nullable|array',
            'jornadas' => 'nullable|array',
            'dias' => 'required|array',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'tipo_evaluacion' => 'required|in:numerica,letras',
        ];
    }

    public function submit()
    {
        $this->validate();

        if (isset($this->configuracionId)) {
            $configuracion = ModelsConfiguracion::where('id', $this->configuracionId)->first();
            $configuracion->update([
                'name' => $this->name,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'ciclo_lectivo' => $this->ciclo_lectivo,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
                'tipo_evaluacion' => $this->tipo_evaluacion,
                'grados' => $this->grados,
                'cooperadora' => $this->cooperadora,
                'jornadas' => $this->jornadas,
                'dias' => $this->dias,
            ]);
        }else{
            ModelsConfiguracion::create([
                'name' => $this->name,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'ciclo_lectivo' => $this->ciclo_lectivo,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
                'tipo_evaluacion' => $this->tipo_evaluacion,
                'grados' => $this->grados,
                'cooperadora' => $this->cooperadora,
                'jornadas' => $this->jornadas,
                'dias' => $this->dias,
            ]);
        }
        
        return redirect()->route('admin.configuracion.index');
    }

    public function render()
    {
        $turnos = Turno::all();
        $especialidades = Especialidad::all();
        $divisiones = Division::all();
        return view('livewire.configuracion', compact('divisiones', 'especialidades', 'turnos'));
    }
}
