<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:255',
            'email' => 'required|unique:App\models\Cliente,email|email|max:255',
            'telefone' => 'required|max:255',
            'endereco' => 'required|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'menssagem' => 'Erro de Validação',
                'errors' => $validator->errors()
            ], 422)
        );

        
    }

    public function messages()
    {
        return [
            'nome.required' => 'o campo é obrigatorio',
            'email.required' => 'o campo é obrigatorio',
            'email.unique' => 'o campo é unico',
            'telefone.required' => 'o campo é obrigatorio',
            'endereco.required' => 'o campo é obrigatorio'  

        ];
    }
}
