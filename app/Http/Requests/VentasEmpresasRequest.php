<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentasEmpresasRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if($this->method()=='PUT') {

            return [
                'empresa_id' => 'numeric',
                'venta' => 'numeric',
                'mes' => 'string'
            ];
        }

        if($this->method()=='POST') {
            return [
                'empresa_id' => 'required|numeric|exists:empresas,id',
                'venta' => 'required|numeric',
                'mes' => 'required|string'
            ];
        }
    }
}
