<?php

namespace App\Services;

use App\Interfaces\CountryRepository;
use App\Models\School;
use Illuminate\Support\Collection;

class CountryService
{
    /** @var CountryRepository $countryRepository */
    private CountryRepository $countryRepository;

    /**
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository) {
        $this->countryRepository        = $countryRepository;
    }

    /**
     * @param array $conditions
     * @return Collection|null
     */
    public function findAll(array $conditions = []): ?Collection {
        return $this->countryRepository->findAll($conditions);
    }

    /**
     * @param string $uuid
     * @return School|null
     */
    public function findByUuid(string $uuid, ): ?School {
        /** @var School $school */
        $school = $this->countryRepository->findBy([
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
