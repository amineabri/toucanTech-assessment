<?php

namespace App\Repositories;

use app\Repositories\Builders\OrderBuilder;
use app\Repositories\Builders\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

interface Repository
{
    /**
     * Find a record by $conditions.
     *
     * @param array $conditions
     * @return Model|null
     *
     * @throws InvalidArgumentException
     */
    public function findBy(array $conditions): ?Model;
}
