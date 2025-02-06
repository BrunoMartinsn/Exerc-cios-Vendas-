<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemVendaUpdateFormRequest extends FormRequest
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
            'venda_id' => 'max:255',
            'produto_id' => 'unique:App\models\Cliente,produto_id|produto_id|max:255',
            'quantidade' => 'max:255',
            'preco_unitario' => 'max:255',
            'subtotal_item' => 'max:255'
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
            
            'venda_id.max' => 'o tamanho do campo é 255',

            'quantidade.max' => 'o tamanho do campo é 255',
            'produto_id.unique' => 'o campo é unico',

            'preco_unitario.max' => 'o tamanho do campo é 255',

          
            
            'subtotal_item.max' => 'o tamanho do campo é 255'
           
            

        ];
    }

}
