<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarExemplarRequest extends FormRequest
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
            'estadoConservacao' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            "required" => ['Preencha todos os campos obrigátorios.'],
        ];
    }
}
