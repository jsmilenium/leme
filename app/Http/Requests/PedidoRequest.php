<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'produto' => ['required', 'string', 'max:255', 'min:4'],
            'valor' => 'required',
            'data' => 'required|date',
            'cliente_id' => 'required|int',
            'pedido_status_id' => 'required|int',
            'imagem' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'Esse campo deve ter no máximo :max caracteres.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'int' => 'O campo :attribute deve ser um número inteiro.',
            'mimes' => 'O arquivo deve ser uma imagem válida.',
        ];
    }
}
