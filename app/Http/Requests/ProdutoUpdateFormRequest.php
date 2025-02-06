<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoUpdateFormRequest extends FormRequest
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
            'codigo' => 'unique:App\models\Produto,codigo|max:255',
            'preco' => 'max:10,2',
            'quantidade_estoque' => 'min:1'
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
            
            'nome.max' => 'o tamanho max é 255',

            
            'codigo.unique' => 'o campo é unico',
            'codigo.max' => 'o tamanho max é 255',
            
            
            'preco.max' => 'o tamanho max é 10,2',
            

           
            'quantidade_estoque.min' => 'o tamanho min é 1'  

        ];
    }
}
