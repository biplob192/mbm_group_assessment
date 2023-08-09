<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivedItemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id'   => 'required|integer',
            'item_id'       => 'required|integer',
            'quantity'      => 'required|integer',
            'unit_price'    => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
