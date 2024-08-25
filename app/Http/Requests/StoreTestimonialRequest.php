<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
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
            'message' => ['required', 'string', 'max:255'],
            'project_client_id' => ['required', 'integer'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Pesan wajib diisi.',
            'message.string' => 'Pesan harus berupa teks.',
            'message.max' => 'Pesan tidak boleh lebih dari 255 karakter.',

            'project_client_id.required' => 'ID Klien Proyek wajib diisi.',
            'project_client_id.integer' => 'ID Klien Proyek harus berupa angka.',

            'thumbnail.required' => 'Thumbnail wajib diunggah.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berupa file dengan format png, jpg, jpeg atau svg.',
        ];
    }
}
