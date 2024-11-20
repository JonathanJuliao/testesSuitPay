<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoAluno extends Model
{
    use HasFactory;

    protected $table = 'curso_aluno';

    protected $fillable = ['curso_id', 'aluno_id'];
}