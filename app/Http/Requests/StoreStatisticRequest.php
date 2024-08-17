<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatisticRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'goal' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'image', 'mimes:png,jpg,jpeg,webp'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'goal.required' => 'Goal wajib diisi.',
            'goal.string' => 'Goal harus berupa teks.',
            'goal.max' => 'Goal tidak boleh lebih dari 255 karakter.',

            'icon.required' => 'Icon wajib diunggah.',
            'icon.image' => 'File yang diunggah harus berupa gambar.',
            'icon.mimes' => 'Icon harus berupa file dengan format png, jpg, jpeg, atau webp.',
        ];
    }
}
