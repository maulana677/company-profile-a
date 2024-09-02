<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrincipleRequest extends FormRequest
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
            'subtitle' => ['required', 'string', 'max:255'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg,svg'],
            'icon' => ['required', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string'   => 'Nama harus berupa string.',
            'name.max'      => 'Nama tidak boleh melebihi 255 karakter.',

            'subtitle.required' => 'Subtitle wajib diisi.',
            'subtitle.string'   => 'Subtitle harus berupa string.',
            'subtitle.max'      => 'Subtitle tidak boleh melebihi 255 karakter.',

            'thumbnail.required' => 'Thumbnail wajib diunggah.',
            'thumbnail.image'    => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes'    => 'Thumbnail harus berformat png, jpg, jpeg atau svg.',

            'icon.required' => 'Icon wajib diunggah.',
            'icon.image'    => 'Icon harus berupa gambar.',
            'icon.mimes' => 'Icon harus berformat png, jpg, jpeg atau svg.',
        ];
    }
}
