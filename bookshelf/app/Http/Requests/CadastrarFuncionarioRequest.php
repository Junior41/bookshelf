<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastrarFuncionarioRequest extends FormRequest
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
            "name" => ['required'],
            "CPF" => ['required'],
            "email" => ['required'],
            "status" => ['required'],
            "password" => ['required'],
            "confirmarSenha" => ['required', 'same:password'],
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
