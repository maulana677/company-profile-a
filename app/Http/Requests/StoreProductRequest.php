<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'tagline' => ['required', 'string', 'max:255'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'about' => ['required', 'string', 'max:65535'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk harus diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk maksimal 255 karakter.',

            'tagline.required' => 'Tagline produk harus diisi.',
            'tagline.string' => 'Tagline produk harus berupa teks.',
            'tagline.max' => 'Tagline produk maksimal 255 karakter.',

            'thumbnail.required' => 'Thumbnail produk harus diunggah.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus bertipe png, jpg, atau jpeg.',

            'about.required' => 'Deskripsi produk harus diisi.',
            'about.string' => 'Deskripsi produk harus berupa teks.',
            'about.max' => 'Deskripsi produk maksimal 65535 karakter.',
        ];
    }
}
