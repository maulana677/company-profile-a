<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeroSectionRequest extends FormRequest
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
            'heading' => ['required', 'string', 'max:255'],
            'achievement' => ['required', 'string', 'max:255'],
            'subheading' => ['required', 'string', 'max:255'],
            'path_video' => ['required', 'string', 'max:255'],
            'banner' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
            'heading.required' => 'Heading wajib diisi.',
            'heading.string' => 'Heading harus berupa teks.',
            'heading.max' => 'Heading tidak boleh melebihi 255 karakter.',

            'achievement.required' => 'Achievement wajib diisi.',
            'achievement.string' => 'Achievement harus berupa teks.',
            'achievement.max' => 'Achievement tidak boleh melebihi 255 karakter.',

            'subheading.required' => 'Subheading wajib diisi.',
            'subheading.string' => 'Subheading harus berupa teks.',
            'subheading.max' => 'Subheading tidak boleh melebihi 255 karakter.',

            'path_video.required' => 'Path Video wajib diisi.',
            'path_video.string' => 'Path Video harus berupa teks.',
            'path_video.max' => 'Path Video tidak boleh melebihi 255 karakter.',

            'banner.required' => 'Banner wajib diisi.',
            'banner.image' => 'Banner harus berupa gambar.',
            'banner.mimes' => 'Banner harus memiliki format: png, jpg, jpeg.',
        ];
    }
}
