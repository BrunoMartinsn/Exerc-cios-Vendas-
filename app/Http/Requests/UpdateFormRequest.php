<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFormRequest extends FormRequest
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
            'nome' => 'max:255',
            'email' => 'unique:App\models\Cliente,email|email|max:255',
            'telefone' => 'max:255',
            'endereco' => 'max:255'
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
            'nome.max' => 'o campo naoé obrigatorio',
           
            'email.unique' => 'o campo é unico',
            'email.max' => 'o tamanho max é 255',
            'telefone.max' => 'o tamanho max é 255',
            'endereco.max' => 'o tamanho max é 255 '  

        ];
    }
}
