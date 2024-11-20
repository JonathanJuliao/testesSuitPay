<?php

namespace App\Models;

use CursoAluno;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo', 'quantidade_maxima_alunos', 'data_limite_matricula'];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'curso_aluno');
    }

    public function estudantes()
    {
        return $this->hasManyThrough(Aluno::class, CursoAluno::class, 'curso_id', 'id', 'id', 'aluno_id');
    }
}
