<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlunoFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => $this->faker->phoneNumber,
        ];
    }
}