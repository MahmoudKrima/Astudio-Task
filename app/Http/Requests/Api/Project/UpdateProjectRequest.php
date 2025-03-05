<?php

namespace App\Http\Requests\Api\Project;

use App\Enum\ProjectStatusEnum;
use App\Models\Attribute;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => [
                'nullable',
                'sometimes',
                'string',
                'max:255',
                Rule::unique('projects', 'name')->ignore($this->project)
            ],

            'attributes' => [
                'nullable',
                'sometimes',
                'array',
                'min:1'
            ],
            'attributes.*' => [
                'required',
                'integer',
                Rule::exists('attributes', 'id')
            ],

            'values' => [
                'nullable',
                'sometimes',
                'array',
                'min:1'
            ],
            'values.*' => [
                'required',
                'string',
                'max:255'
            ],

            'users' => [
                'nullable',
                'sometimes',
                'array',
                'min:1'
            ],
            'users.*' => [
                'integer',
                Rule::exists('users', 'id')
            ],

            'status*' => [
                'nullable',
                'sometimes',
                Rule::in(ProjectStatusEnum::vals())
            ],

        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], __('api.validation_error'), 422);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            $attributes = $data['attributes'] ?? [];
            $values = $data['values'] ?? [];

            if (!empty($attributes) && count($attributes) !== count($values)) {
                $validator->errors()->add('values', __('The number of values must match the number of attributes.'));
                return;
            }

            foreach ($attributes as $index => $attributeId) {
                $attribute = Attribute::find($attributeId);
                if (!$attribute) {
                    continue;
                }

                $value = $values[$index] ?? null;

                switch ($attribute->type->value) {
                    case 'date':
                        if (!strtotime($value)) {
                            $validator->errors()->add("values.$index", __('The value must be a valid date (Y-m-d).'));
                        }
                        break;

                    case 'number':
                        if (!is_numeric($value)) {
                            $validator->errors()->add("values.$index", __('The value must be a number.'));
                        }
                        break;

                    case 'text':
                        if (!is_string($value) || empty(trim($value))) {
                            $validator->errors()->add("values.$index", __('The value must be valid text.'));
                        }
                        break;

                    case 'select':
                        if (!is_string($value) || empty(trim($value))) {
                            $validator->errors()->add("values.$index", __('The value must be valid text.'));
                        } else {
                            $allowedOptions = json_decode($attribute->options, true);
                            if (!in_array($value, $allowedOptions, true)) {
                                $validator->errors()->add("values.$index", __('The value must be one of the allowed options: ' . implode(', ', $allowedOptions)));
                            }
                        }
                        break;
                }
            }
        });
    }
}
