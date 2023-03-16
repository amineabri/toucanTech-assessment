<?php

namespace App\Http\Requests;

use App\Services\SchoolService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MemberListRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(SchoolService $schoolService): array
    {
        $arr = [
            'school' => [
                'uuid',
                'exists:schools,uuid',
            ],
        ];
        if (isset($this->school)) {
            // Convert the UUID to an ID value
            $schoolId = $schoolService->findByUuid($this->school);
            $this->merge(['school_id' => $schoolId->id]);
        }

        return $arr;
    }
}
