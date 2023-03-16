<?php

namespace App\Http\Requests;

use App\Services\SchoolService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MemberStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
            'email' => [
                'required',
                'string',
                'min:5',
                'max:60',
                'regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}/'
            ],
            'school' => [
                'required',
                'uuid',
                'exists:schools,uuid',
            ],
        ];

        // Convert the UUID to an ID value
        $schoolId = $schoolService->findByUuid($this->school);

        $this->merge(['school_id' => $schoolId->id]);

        return $arr;
    }
}
