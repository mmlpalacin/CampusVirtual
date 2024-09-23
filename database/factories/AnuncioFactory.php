<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anuncio>
 */
class AnuncioFactory extends Factory
{
    public function definition(): array
    {
        $title=$this->faker->unique()->words(3, true);
        $status = $this->faker->randomElement([1, 2]);

        return [
            'title' => $title,
            'body' => $this->faker->text(250),
            'status' => $status,
            'user_id' => User::role(['admin', 'profesor', 'preceptor'])->get()->random()->id,
            'curso_id' => function() {
                if ($this->faker->boolean(50)) {
                    $user = User::role(['profesor', 'preceptor'])->get()->random();
                    return $user ? Curso::all()->random()->id : null;
                }
            },
            'published' => $status === 2 ? $this->faker->dateTimeBetween('-1 week', 'now') : null, // Asignar una fecha de publicación si status es 2
        ];
    }
}
