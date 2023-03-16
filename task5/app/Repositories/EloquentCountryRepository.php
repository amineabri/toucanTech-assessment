<?php

namespace App\Repositories;

use App\Interfaces\CountryRepository;
use App\Models\Country;
use App\Repositories\Builders\OrderBuilder;
use App\Repositories\Builders\QueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentCountryRepository extends BaseRepository implements CountryRepository
{
    /**
     * EloquentSchoolRepository constructor.
     *
     * @param Country $school
     * @param QueryBuilder $queryBuilder
     * @param OrderBuilder $orderBuilder
     */
    public function __construct(Country $school, QueryBuilder $queryBuilder, OrderBuilder $orderBuilder)
    {
        parent::__construct($school, $queryBuilder, $orderBuilder);
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findBy(array $conditions): ?Country
    {
        $this->validateConditions($conditions);
        $query = $this->queryBuilder->build($this->model, $conditions);
        $newQueryBuilder = $this->orderBuilder->build($query, $conditions);

        return $newQueryBuilder->first();
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function findAll(array $conditions = []): Collection
    {
        $query = $this->queryBuilder->build($this->model, $conditions);
        $newQueryBuilder = $this->orderBuilder->build($query, $conditions);
        return $newQueryBuilder->get();
    }

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Country
    {
        return null;
    }
}
