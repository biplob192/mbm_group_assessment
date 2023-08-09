<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultipleReceivedItemRequest extends FormRequest
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
            'received_items'                => ['required', 'array'],
            'received_items.*.supplier_id'  => ['required', 'integer'],
            'received_items.*.item_id'      => ['required', 'integer'],
            'received_items.*.quantity'     => ['required', 'integer'],
            'received_items.*.unit_price'   => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }
}
