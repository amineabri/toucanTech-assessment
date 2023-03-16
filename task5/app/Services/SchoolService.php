<?php

namespace App\Services;

use App\Interfaces\SchoolRepository;
use App\Models\School;
use Illuminate\Support\Collection;

class SchoolService
{
    /** @var SchoolRepository $schoolRepository */
    private SchoolRepository $schoolRepository;

    /**
     * @param SchoolRepository $schoolRepository
     */
    public function __construct(SchoolRepository $schoolRepository) {
        $this->schoolRepository        = $schoolRepository;
    }

    /**
     * @param array $conditions
     * @return Collection|null
     */
    public function findAll(array $conditions = []): ?Collection {
        return $this->schoolRepository->findAll($conditions);
    }

    /**
     * @param string $uuid
     * @return School|null
     */
    public function findByUuid(string $uuid, ): ?School {
        /** @var School $school */
        $school = $this->schoolRepository->findBy([
            'where' => [
                ['uuid', '=', $uuid]
            ],
        ]);
        if (!$school) {
            return null;
        }

        return $school;
    }
}
