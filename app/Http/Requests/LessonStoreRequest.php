<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'order' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul lesson wajib diisi.',
            'title.max' => 'Judul lesson maksimal 255 karakter.',
            'content.required' => 'Konten lesson wajib diisi.',
            'order.required' => 'Urutan lesson wajib diisi.',
            'order.integer' => 'Urutan lesson harus berupa angka.',
            'order.min' => 'Urutan lesson minimal 1.',
        ];
    }
}

