<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'occupation' => ['required', 'string', 'max:255'],
            'avatar' => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'logo' => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama klien harus diisi.',
            'name.string' => 'Nama klien harus berupa teks.',
            'name.max' => 'Nama klien tidak boleh lebih dari 255 karakter.',
            'occupation.required' => 'Pekerjaan klien harus diisi.',
            'occupation.string' => 'Pekerjaan klien harus berupa teks.',
            'occupation.max' => 'Pekerjaan klien tidak boleh lebih dari 255 karakter.',
            'avatar.sometimes' => 'Avatar klien harus berupa gambar jika diunggah.',
            'avatar.image' => 'Avatar klien harus berupa gambar.',
            'avatar.mimes' => 'Avatar klien harus memiliki ekstensi png, jpg, atau jpeg.',
            'logo.sometimes' => 'Logo klien harus berupa gambar jika diunggah.',
            'logo.image' => 'Logo klien harus berupa gambar.',
            'logo.mimes' => 'Logo klien harus memiliki ekstensi png, jpg, atau jpeg.',
        ];
    }
}
