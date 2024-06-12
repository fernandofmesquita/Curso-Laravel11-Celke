<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
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
            'course_id' => 'required_if:course_id,!=,null',
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Campo ID da Aula é obrigatório',
            'name.required' => 'Campo Nome da Aula é obrigatório',
            'description.required' => 'Campo Descrição da Aula é obrigatório',

        ];
    }
}
