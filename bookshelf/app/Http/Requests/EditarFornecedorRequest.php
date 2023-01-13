<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarFornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "endereco" => ['required'],
            "nome" => ['required'],
            "status" => ['required'],
            "confirmarSenha" => ['same:password'],
        ];
    }

    public function messages()
    {
        return [
            "same" => ['O campo senha e confirmação de senha devem ser iguais.'],
            "required" => ['Preencha todos os campos obrigátorios.'],
        ];
    }
}
