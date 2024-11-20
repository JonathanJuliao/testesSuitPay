<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Aluno;

class DashBoardController extends Controller
{
    
public function index()
{
    $totalCursos = Curso::count();
    $totalAlunos = Aluno::count();
    $vagasAbertas = Curso::withCount('alunos')
        ->get()
        ->sum(function ($curso) {
            return max(0, $curso->quantidade_maxima_alunos - $curso->alunos_count);
        });

        $cursosComVagas = Curso::withCount('alunos')
        ->get()
        ->filter(function ($curso) {
            return $curso->quantidade_maxima_alunos > $curso->alunos_count;
        });
        
    $graficoLabels = Curso::pluck('nome');
    $graficoDados = Curso::withCount('alunos')
        ->orderBy('alunos_count', 'desc')
        ->pluck('alunos_count');

    $percentualVagasDados = Curso::withCount('alunos')->get()
        ->map(fn($curso) => round(($curso->alunos_count / $curso->quantidade_maxima_alunos) * 100, 2));

    return view('dashboard', compact(
        'totalCursos', 
        'totalAlunos', 
        'vagasAbertas', 
        'cursosComVagas', 
        'graficoLabels', 
        'graficoDados', 
        'percentualVagasDados'
    ));
}
}
