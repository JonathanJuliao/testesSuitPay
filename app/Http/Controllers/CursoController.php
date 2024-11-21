<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        try {
            $cursos = Curso::withCount('alunos')->get();
            return view('cursos.index', compact('cursos'));
        } catch (\Throwable $th) {
            return redirect()->route('cursos.index')->with('erro', 'Erro ao carregar cursos: ' . $th->getMessage());
        }
    }
    

    public function create()
    {
        try {
            $curso = new Curso(); 
            return view('cursos.create', compact('curso'));
        } catch (\Throwable $th) {
            return redirect()->route('cursos.index')->with('erro', 'Erro ao carregar página de criação: ' . $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'tipo' => 'required|in:online,presencial',
                'quantidade_maxima_alunos' => 'required|integer|min:1',
                'data_limite_matricula' => 'required|date|after:today',
            ]);
    
            Curso::create($request->all());
            return redirect()->route('cursos.index')->with('status', 'Curso criado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('cursos.create')->with('erro', 'Erro ao criar o curso: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $curso = Curso::findOrFail($id);
            return view('cursos.create', compact('curso'));
        } catch (\Throwable $th) {
            return redirect()->route('cursos.index')->with('erro', 'Erro ao carregar curso para edição: ' . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'tipo' => 'required|in:online,presencial',
                'quantidade_maxima_alunos' => 'required|integer|min:1',
                'data_limite_matricula' => 'required|date|after:today',
            ]);

            $curso = Curso::findOrFail($id);
            $curso->update($request->all());
            return redirect()->route('cursos.index')->with('status', 'Curso atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('cursos.edit', $id)->with('erro', 'Erro ao atualizar o curso: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $curso = Curso::findOrFail($id);
            $curso->delete();
            return redirect()->route('cursos.index')->with('status', 'Curso excluído com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('cursos.index')->with('erro', 'Erro ao excluir o curso: ' . $th->getMessage());
        }
    }
    public function destroyAll()
    {
        try {
            Curso::query()->delete();  
            return redirect()->route('cursos.index')->with('status', 'Todos os cursos foram excluídos com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('cursos.index')->with('erro', 'Erro ao excluir os cursos: ' . $th->getMessage());
        }
    }

    public function alunos($cursoId)
    {
        $curso = Curso::with('alunos')->findOrFail($cursoId);
        $alunosDisponiveis = Aluno::whereDoesntHave('cursos', function ($query) use ($cursoId) {
            $query->where('cursos.id', $cursoId);
        })->get();
        return view('cursos.alunos', compact('curso', 'alunosDisponiveis'));
    }
    
 public function matricular(Request $request, $cursoId, $alunoId)
    {
        try {
            $curso = Curso::withCount('alunos')->findOrFail($cursoId);
            $aluno = Aluno::findOrFail($alunoId);
    
            if ($curso->alunos_count >= $curso->quantidade_maxima_alunos) {
                 return response()->json(['error' => 'O curso atingiu a quantidade maxima de alunos.'], 500);
            }
    
            if ($curso->alunos()->where('alunos.id', $alunoId)->exists()) {
              return response()->json(['error' => 'O aluno já está matriculado no curso.'], 500);
            }
    
            $curso->alunos()->attach($aluno);
            return redirect()->back()->with('success', 'Aluno matriculado com sucesso!');
        } catch (\Throwable $th) {
             return response()->json(['error' => 'Erro ao cadastrar '], 500);
        }
    }
    public function desmatricular(Request $request, $cursoId, $alunoId)
    {
        $curso = Curso::findOrFail($cursoId);
        $aluno = Aluno::findOrFail($alunoId);
        $curso->alunos()->detach($alunoId);
        return response()->json(['message' => 'Aluno desmatriculado com sucesso!']);
    }

}
