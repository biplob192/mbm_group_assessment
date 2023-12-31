<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        return ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
        return [
            'name'      => 'required',
            'email'     => 'required|email|unique:suppliers',
            'phone'     => 'required|unique:suppliers',
        ];
    }

    protected function update()
    {
        return [
            'email'     => [Rule::unique('suppliers')->ignore($this->route('supplier'))],
            'phone'     => [Rule::unique('suppliers')->ignore($this->route('supplier'))],
        ];
    }
}
