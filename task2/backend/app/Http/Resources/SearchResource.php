<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            "firstname" => $this->Firstname,
            "lastname" => $this->Surname,
            "email" => $this->getDefaultEmail($request),
        ];
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getDefaultEmail(Request $request): string
    {
        $emails = EmailResource::collection($this->whenLoaded("emails"));
        foreach ($emails->toArray($request) as $email) {
            if (isset($email['Default']) && $email['Default']) {
                return $email['email'];
            }
        }
        return "N/A";
    }
}
