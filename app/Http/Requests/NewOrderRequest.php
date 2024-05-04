<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'string', 'max:255'],
            'product_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric'],
            'ppl' => ['required', 'numeric'],
            'nett_cost' => ['required', 'numeric'],
            'vat' => ['required', 'numeric'],
            'total_cost' => ['required', 'numeric']
        ];
    }
}
