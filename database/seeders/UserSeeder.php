<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use App\Models\Cooperadora;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('configuracion')->insert([
            'name' => 'E.E.S.T.N3',
            'direccion' => '14 de Julio 2550',
            'telefono' => '2234567891',
            'ciclo_lectivo' => now()->year,
            'grados' => json_encode(["1ero", "2do", "3ro", "4to", "5to", "6to"]),
            'cooperadora' => json_encode([
                "ciclo_basico" => [
                    "grados" => ["1ero", "2do", "3ro"],
                    "montos" => [38000]
                ],
                "ciclo_superior" => [
                    "grados" => ["4to", "5to", "6to"],
                    "montos" => [30000]
                ],
                "practicas" => [
                    "grados" => ["7mo"],
                    "montos" => [19000]
                ]
            ]),
            'jornadas' => json_encode(['Simple', 'Completa']),
            'dias' => json_encode(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes']),
            'hora_inicio' => '07:00',
            'hora_fin' => '23:00',
            'tipo_evaluacion' => 'numerica',
        ]);
        
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();

        $user = User::factory()->create([
            'name' => 'Milagros A',
            'lastname' => 'Palacin',
            'email' => 'milagrosp.urena@gmail.com',
            'password' =>bcrypt('12345678')
        ])->assignRole('alumno');

        User::factory()->create([
            'name' => 'Mili D',
            'lastname' => 'Palacin',
            'email' => 'milagrospalacinurena@gmail.com',
            'password' =>bcrypt('12345678')
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Milagros pre',
            'lastname' => 'Ureña',
            'email' => 'mlmstylinson@gmail.com',
            'password' =>bcrypt('12345678')
        ])->assignRole('preceptor');

        User::factory()->create([
            'name' => 'M pro',
            'lastname' => 'Palacin',
            'email' => 'mmlstylinson@gmail.com',
            'password' =>bcrypt('12345678')
        ])->assignRole('profesor');

        Cooperadora::create([
            'user_id' => $user->id,
            'configuracion_id' => $configuracion->id,
        ]);
        Inscripcion::create([
            'user_id' => $user->id,
            'curso_id' => 1,
        ]);

        $users = User::factory(10)->create();
        $roles = Role::all();

        foreach ($users as $user) {
            $randomRole = $roles->random(); 
            $user->assignRole($randomRole);
        }
    }
}
