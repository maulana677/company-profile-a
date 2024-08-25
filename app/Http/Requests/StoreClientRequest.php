<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'occupation.required' => 'Pekerjaan wajib diisi.',
            'occupation.string' => 'Pekerjaan harus berupa teks.',
            'occupation.max' => 'Pekerjaan maksimal 255 karakter.',

            'avatar.required' => 'Avatar wajib diunggah.',
            'avatar.image' => 'Avatar harus berupa file gambar.',
            'avatar.mimes' => 'Avatar harus berformat PNG, JPG, JPEG atau SVG.',

            'logo.required' => 'Logo wajib diunggah.',
            'logo.image' => 'Logo harus berupa file gambar.',
            'logo.mimes' => 'Logo harus berformat PNG, JPG, JPEG atau SVG',
        ];
    }
}
