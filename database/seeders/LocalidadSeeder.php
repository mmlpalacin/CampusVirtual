<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadSeeder extends Seeder
{
    public function run(): void
    {
        $paisId = DB::table('pais')->insertGetId(['pais' => 'Argentina']);
        $provinciaId = DB::table('provincias')->insertGetId([
            'pais_id' => $paisId,
            'provincia' => 'Buenos Aires',
        ]);
        $partidoId = DB::table('partidos')->insertGetId([
            'provincia_id' => $provinciaId,
            'partido' => 'General Pueyrredon',
        ]);
        DB::table('ciudads')->insert([
            ['partido_id' => $partidoId, 'ciudad' => 'Mar del Plata'],
            ['partido_id' => $partidoId, 'ciudad' => 'Batan'],
        ]);
    }
}
