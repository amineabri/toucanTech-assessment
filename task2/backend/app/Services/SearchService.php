<?php

namespace App\Services;

use App\Models\Profile;
use App\Repositories\Repository;

class SearchService
{
    /** @var Repository $profileRepository */
    private Repository $profileRepository;
    public function __construct(Repository $profileRepository) {
        $this->profileRepository        = $profileRepository;
    }

    public function findByName(string $name): ?Profile {
        $conditions = [
            'where' => [
                ['Firstname', 'LIKE', "%$name%"],
            ],
            'orWhere' => [
                ['Surname', 'LIKE', "%$name%"],
            ],
            'with' => 'emails'
        ];

        /** @var Profile $profile */
        $profile = $this->profileRepository->findBy($conditions);

        return $profile;
    }
}
