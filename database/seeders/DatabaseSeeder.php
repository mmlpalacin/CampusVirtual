<?php

namespace Database\Seeders;

use App\Models\Anuncio;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('anuncio');
        Storage::disk('public')->makeDirectory('anuncio');

        $this->call([
            RolesSeeder::class,
            CursosSeeder::class,
            UserSeeder::class,
            LocalidadSeeder::class,
        ]);
        
        $generos = [
            ['genero' => 'masculino'],
            ['genero' => 'femenino'],
        ];

        DB::table('generos')->insert($generos);

        $anuncios = Anuncio::factory(10)->create();

        foreach ($anuncios as $anuncio){
            $numImages = rand(1, 5);
            Imagen::factory($numImages)->create([
                'imageable_id' => $anuncio ->id,
                'imageable_type' => Anuncio::class
            ]);
        }
    }
}
