<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'အမည်ထည့်ပါ',
            'price.required' => 'ဖုန်းနံပါတ်ထည့်ပါ',
        ];
    }
}
