<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        try {
            $alunos = Aluno::all();
            return view('alunos.index', compact('alunos'));
        } catch (\Throwable $th) {
            return redirect()->route('alunos.index')->with('erro', 'Erro ao carregar alunos: ' . $th->getMessage());
        }
    }

    public function create()
    {
        try {
            $aluno = new Aluno();
            return view('alunos.create', compact('aluno'));
        } catch (\Throwable $th) {
            return redirect()->route('alunos.index')->with('erro', 'Erro ao carregar página de criação: ' . $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:alunos,email',
                'telefone' => 'nullable|string|max:20',
            ]);

            Aluno::create($request->all());
            return redirect()->route('alunos.index')->with('status', 'Aluno criado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('alunos.create')->with('erro', 'Erro ao criar o aluno: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            return view('alunos.create', compact('aluno'));
        } catch (\Throwable $th) {
            return redirect()->route('alunos.index')->with('erro', 'Erro ao carregar aluno para edição: ' . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:alunos,email,' . $id,
                'telefone' => 'nullable|string|max:20',
            ]);

            $aluno = Aluno::findOrFail($id);
            $aluno->update($request->all());
            return redirect()->route('alunos.index')->with('status', 'Aluno atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('alunos.edit', $id)->with('erro', 'Erro ao atualizar o aluno: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            $aluno->delete();
            return redirect()->route('alunos.index')->with('status', 'Aluno excluído com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('alunos.index')->with('erro', 'Erro ao excluir o aluno: ' . $th->getMessage());
        }
    }

    public function destroyAll()
    {
        try {
            Aluno::query()->delete();
            return redirect()->route('alunos.index')->with('status', 'Todos os alunos foram excluídos com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('alunos.index')->with('erro', 'Erro ao excluir os alunos: ' . $th->getMessage());
        }
    }
}
