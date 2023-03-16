<?php

namespace App\Http\Requests;

use App\Services\CountryService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
    public function rules(CountryService $countryService): array
    {
        $arr = [
            'country' => [
                'uuid',
                'exists:countries,uuid',
            ],
        ];
        if (isset($this->school)) {
            // Convert the UUID to an ID value
            $countryId = $countryService->findByUuid($this->country);
            $this->merge(['country_id' => $countryId->id]);
        }

        return $arr;
    }
}
