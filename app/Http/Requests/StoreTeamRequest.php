<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'location' => ['required', 'string', 'max:255'],
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'occupation.required' => 'Pekerjaan wajib diisi.',
            'occupation.string' => 'Pekerjaan harus berupa teks.',
            'occupation.max' => 'Pekerjaan tidak boleh lebih dari 255 karakter.',

            'location.required' => 'Lokasi wajib diisi.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',

            'avatar.required' => 'Avatar wajib diupload.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa file dengan format: png, jpg, atau jpeg.',
        ];
    }
}
