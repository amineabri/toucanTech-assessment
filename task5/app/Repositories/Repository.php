<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Mockery\Exception;

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

    /**
     * Find all records by provided conditions.
     *
     * @param array $conditions
     *
     * @return Collection
     */
    public function findAll(array $conditions = []): Collection;

    /**
     * Create a new record.
     *
     * @param array $data
     *
     * @return Model
     *
     * @throws Exception
     */
    public function create(array $data): ?Model;
}
