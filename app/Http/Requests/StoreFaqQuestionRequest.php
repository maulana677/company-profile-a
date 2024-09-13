<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqQuestionRequest extends FormRequest
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
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => 'Field pertanyaan harus diisi.',
            'question.string' => 'Pertanyaan harus berupa teks.',
            'question.max' => 'Pertanyaan tidak boleh lebih dari 255 karakter.',
            'answer.required' => 'Field jawaban harus diisi.',
            'answer.string' => 'Jawaban harus berupa teks.',
        ];
    }
}
