<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\Builders\OrderBuilder;
use App\Repositories\Builders\QueryBuilder;
use Illuminate\Database\Eloquent\Model;

class EloquentProfileRepository extends BaseRepository implements Repository
{
    /**
     * ProfileRepository constructor.
     *
     * @param Profile $profile
     * @param QueryBuilder $queryBuilder
     * @param OrderBuilder $orderBuilder
     */
    public function __construct(Profile $profile, QueryBuilder $queryBuilder, OrderBuilder $orderBuilder)
    {
        parent::__construct($profile, $queryBuilder, $orderBuilder);
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findBy(array $conditions): ?Profile
    {
        $this->validateConditions($conditions);
        $query = $this->queryBuilder->build($this->model, $conditions);
        $newQueryBuilder = $this->orderBuilder->build($query, $conditions);

        return $newQueryBuilder->first();
    }
}
