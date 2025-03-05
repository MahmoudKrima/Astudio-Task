<?php

namespace App\Http\Requests\Api\TimeSheet;

use App\Models\Project;
use App\Models\Timesheet;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTimeSheetRequest extends FormRequest
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
            'task_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:255'
            ],
            'date' => [
                'sometimes',
                'nullable',
                'date',
                'after:today',
                'date_format:Y-m-d',
            ],
            'hours' => [
                'sometimes',
                'nullable',
                'integer',
                'min:1',
            ],
            'project_id' => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists('projects', 'id')
                    ->where('creator_id', Auth::guard('api')->id())
            ],
            'user_id' => [
                'sometimes',
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $authUserId = Auth::guard('api')->id();
                    $timeSheetId = Timesheet::find($this->route('timeSheet')->id);
                    $projectId = request()->input('project_id') ?? $timeSheetId->project_id;
                    $project = Project::find($projectId);
                    if (!$project) {
                        return $fail('The selected project does not exist.');
                    }

                    $isValidUser = $value == $authUserId || $project->users()->where('user_id', $value)->exists();
                    if (!$isValidUser) {
                        return $fail('The selected user is not authorized for this project.');
                    }
                }
            ]
        ];
    }

    /**
     * Handle failed validation.
     */
    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], __('api.validation_error'), 422);
    }
}
