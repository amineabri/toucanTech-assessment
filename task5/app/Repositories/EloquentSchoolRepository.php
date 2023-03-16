<?php

namespace App\Repositories;

use App\Interfaces\SchoolRepository;
use App\Models\School;
use App\Repositories\Builders\OrderBuilder;
use App\Repositories\Builders\QueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentSchoolRepository extends BaseRepository implements SchoolRepository
{
    /**
     * EloquentSchoolRepository constructor.
     *
     * @param School $school
     * @param QueryBuilder $queryBuilder
     * @param OrderBuilder $orderBuilder
     */
    public function __construct(School $school, QueryBuilder $queryBuilder, OrderBuilder $orderBuilder)
    {
        parent::__construct($school, $queryBuilder, $orderBuilder);
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findBy(array $conditions): ?School
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
    public function create(array $data): ?Model
    {
        return null;
    }
}
