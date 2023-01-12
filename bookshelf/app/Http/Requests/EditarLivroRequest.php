<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarLivroRequest extends FormRequest
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
            "codigo" => ['required'],
            "nome" => ["required"],
            "autor" => ['required'],
            "editora" => ['required'],
            "quantidadePag" => ["required"],
            "avaliacao" => ["required"],
            "categoria_id" => ["required"],
        ];
    }
}
