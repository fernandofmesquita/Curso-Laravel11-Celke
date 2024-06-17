<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome do curso é obrigatório',
            'price.required' => 'Campo preço do curso é obrigatório',
            'price.max' => 'O preço só pode ter no maximo 8 números',
        ];
    }
}
