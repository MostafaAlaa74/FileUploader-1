<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'file' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
{
    return [
        'file.required' => 'The file field is required.',
        'file.file' => 'The uploaded file must be a valid file.',
        'file.mimes' => 'The file must be a PDF.',
        'file.max' => 'The file size must not exceed 2MB.',
    ];
}
}
