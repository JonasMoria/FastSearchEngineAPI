<?php

namespace App\Http\Requests\Suggestion;

use App\Support\Http\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SuggestionStoreRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'primary_name' => 'required|string|max:255',
            'secondary_name' => 'nullable|string|max:255',
            'image_path' => 'nullable|url|max:255',
            'priority' => 'nullable|integer',
            'type' => 'nullable|string|max:100',
            'metadata' => 'nullable|array',
        ];
    }

    public function messages(): array {
        return [
            'primary_name.required' => 'O nome principal é obrigatório.',
            'primary_name.string' => 'O nome principal deve ser um texto.',
            'primary_name.max' => 'O nome principal pode ter no máximo 255 caracteres.',

            'secondary_name.string' => 'O nome secundário deve ser um texto.',
            'secondary_name.max' => 'O nome secundário pode ter no máximo 255 caracteres.',

            'image_path.string' => 'O caminho da imagem deve ser um texto válido.',
            'image_path.max' => 'O caminho da imagem pode ter no máximo 255 caracteres.',

            'priority.integer' => 'A prioridade deve ser um número inteiro.',

            'type.string' => 'O tipo deve ser um texto.',
            'type.max' => 'O tipo pode ter no máximo 100 caracteres.',

            'metadata.array' => 'Os metadados devem estar no formato JSON válido.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            ApiResponse::validation(
                $validator->errors()->first()
            )
        );
    }
}
