<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'title' => ['string', 'max:100'],
            'description' => ['string'],
            'status' => ['nullable', Rule::in(['pending', 'in_progress', 'done'])],
        ];
    }
    public function messages(): array
    {
        return [
            'status.in' => 'The status field must be one of the following: pending, in_progress, done.',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->input('status', 'pending'), // Значение по умолчанию
        ]);
    }
}
