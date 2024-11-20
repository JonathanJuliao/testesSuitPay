<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;
use App\Models\Aluno;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $cursos = Curso::factory(10)->create();
        $alunos = Aluno::factory(50)->create();

        foreach ($cursos as $curso) {
            $curso->alunos()->attach($alunos->random(rand(5, 20))->pluck('id'));
        }
    }
}
