<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaUpateFormRequest extends FormRequest
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
            'cliente_id' => 'max:255',
            'data_venda' => 'unique:App\models\Cliente,email|email|max:255',
            'subtotal' => 'max:255',
            'desconto' => 'max:255',
            'total' => 'max:255'
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
            
            'cliente_id.max' => 'o tamanho do campo é 255',

            'data_venda.max' => 'o tamanho do campo é 255',
            'data_venda.unique' => 'o campo é unico',

            'subtotal.max' => 'o tamanho do campo é 255',

            'desconto.max' => 'o tamanho do campo é 255',
            
            'total.max' => 'o tamanho do campo é 255',
           
            

        ];
    }

}
