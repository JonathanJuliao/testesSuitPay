<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:online,presencial',
            'quantidade_maxima_alunos' => 'required|integer|min:1',
            'data_limite_matricula' => 'required|date|after_or_equal:today',
        ];
    }
}
