<?php

namespace Database\Seeders;

use App\Models\Materia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    public function run(): void
    {
        $divisiones = [
            ['name' => '1'],
            ['name' => '2'],
            ['name' => '3'],
            ['name' => '4'],
            ['name' => '5'],
            ['name' => '6'],
            ['name' => '7'],
            ['name' => '8'],
            ['name' => '9'],
            ['name' => '10'],
            ['name' => '11'],
            ['name' => '12'],
        ];
        
        DB::table('division')->insert($divisiones);

        $especialidades = [
            ['name' => 'Ciclo Básico'],
            ['name' => 'Informatica'],
            ['name' => 'Automotores'],
            ['name' => 'Electronica'],
            ['name' => 'Electromecanica'],
            ['name' => 'Quimica'],
            ['name' => 'Construcciones'],
        ];

        DB::table('especialidad')->insert($especialidades);

        $turnos = [
            ['name' => 'mañana'],
            ['name' => 'tarde'],
            ['name' => 'noche'],
        ];
        
        DB::table('turnos')->insert($turnos);

        $cursos = [
            ['name' => '7mo', 'turno_id' => 3, 'especialidad_id' => 2, 'division_id' => 11],
            ['name' => '1ro', 'turno_id' => 1, 'especialidad_id' => 1, 'division_id' => 2],
        ];
        
        DB::table('cursos')->insert($cursos);

        $materias = [
            [['name' => 'Matemáticas'], ['tipo' => 'aula']],    
            [['name' => 'Lengua'], ['tipo' => 'aula']],
            [['name' => 'Educación Artística'], ['tipo' => 'aula']],
        ];

        foreach ($materias as $materia) {
            Materia::create($materia);
        }
    }
}
