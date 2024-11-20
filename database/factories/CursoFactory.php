<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'tipo' => $this->faker->randomElement(['online', 'presencial']),
            'quantidade_maxima_alunos' => $this->faker->numberBetween(10, 100),
            'data_limite_matricula' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
