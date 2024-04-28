<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'address' => 'required',
            'number' => 'required',
            'email' => 'required'
        ];
    }
}
