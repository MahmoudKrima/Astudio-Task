<?php

namespace App\Http\Requests\Api\ProjectAttribute;

use App\Enum\AttributeTypeEnum;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectAttributeRequest extends FormRequest
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
                'required',
                'string',
                'max:255',
                Rule::unique('attributes', 'name')->ignore($this->route('attribute'))
            ],
            'type' => [
                'required',
                'string',
                'max:255',
                Rule::in(AttributeTypeEnum::vals())
            ],
            'options' => [
                'nullable',
                'array',
                'min:1',
                Rule::requiredIf($this->input('type') === 'select')
            ],
            'options.*' => [
                'string',
                'max:255',
                'distinct'
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
            if ($data['type'] === 'select' && empty($data['options'])) {
                $validator->errors()->add('options', __('Options are required when type is select.'));
            }

            if (!empty($data['options']) && is_array($data['options'])) {
                $uniqueOptions = array_unique($data['options']);
                if (count($uniqueOptions) !== count($data['options'])) {
                    $validator->errors()->add('options', __('Options must have unique values.'));
                }
            }
        });
    }
}
