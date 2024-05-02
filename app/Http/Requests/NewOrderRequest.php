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
            'product_name' => ['required'],
            'quantity' => ['required'],
            'ppl' => ['required'],
            'nett_cost' => ['required'],
            'vat' => ['required'],
            'total_cost' => ['required']
        ];
    }
}
