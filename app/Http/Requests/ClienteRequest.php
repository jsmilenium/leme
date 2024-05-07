<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'max:255', 'unique:clientes,cpf', 'min:4'],
            'cpf' => 'required',
            'data_nasc' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'Esse campo deve ter no máximo :max caracteres.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'unique' => 'O :attribute já está cadastrado.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.'
        ];
    }
}
