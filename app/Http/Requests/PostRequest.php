<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return true;
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required|min:5'
    ];
    }

    public function messages() 
    {
        return [
            // 'title.required' => 'Include header',
            // 'body.required' => 'Include body',
            // 'body.min' => 'At least five characters'
        ];
    }

    public function attributes()
    {
        return [
            'body' => 'Content'
        ];
    }

}
