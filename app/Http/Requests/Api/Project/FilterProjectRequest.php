<?php

namespace App\Http\Requests\Api\Project;

use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class FilterProjectRequest extends FormRequest
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
            'filters' => [
                'sometimes',
                'nullable',
                'array',
                'min:1',
                'max:5'
            ],
            'filters.*' => [
                'sometimes',
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], __('api.validation_error'), 422);
    }
}
