<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterInfoRequest extends FormRequest
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
            'logo' => ['nullable', 'image', 'max:3000'],
            'description' => ['required', 'max:300'],
            'copyright' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'logo.image' => 'Logo harus berupa file gambar.',
            'logo.max' => 'Ukuran logo tidak boleh lebih dari 3MB.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 300 karakter.',
            'copyright.required' => 'Copyright wajib diisi.',
            'copyright.max' => 'Copyright tidak boleh lebih dari 255 karakter.',
        ];
    }
}
