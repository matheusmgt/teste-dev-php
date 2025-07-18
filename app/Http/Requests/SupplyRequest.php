<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'type'           => 'required|in:PF,PJ',
            'name'           => 'required|string|max:255',
            'social_name'    => 'nullable|string|max:255',
            'cpf'            => 'nullable|string|max:14',
            'cnpj'           => 'nullable|string|max:18',
            'phone'          => 'nullable|string|max:20',
            'cep'            => 'nullable|string|max:9',
            'address'        => 'nullable|string|max:255',
            'address_number' => 'nullable|string|max:20',
            'state'          => 'nullable|string|max:2',
            'city'           => 'nullable|string|max:100',
        ];
    }
}