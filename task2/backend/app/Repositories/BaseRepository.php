<?php

namespace App\Repositories;

use App\Repositories\Builders\OrderBuilderInterface;
use App\Repositories\Builders\QueryBuilderInterface;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;
    /**
     * @var QueryBuilderInterface
     */
    protected QueryBuilderInterface $queryBuilder;
    /**
     * @var OrderBuilderInterface
     */
    protected OrderBuilderInterface $orderBuilder;

    /**
     * OrganisationRepository constructor.
     *
     * @param Model $model
     * @param QueryBuilderInterface $queryBuilder
     * @param OrderBuilderInterface $orderBuilder
     */
    public function __construct(Model $model, QueryBuilderInterface $queryBuilder, OrderBuilderInterface $orderBuilder)
    {
        $this->model = $model;
        $this->queryBuilder = $queryBuilder;
        $this->orderBuilder = $orderBuilder;
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    abstract function findBy(array $conditions): ?Model;


    /**
     * @param array $conditions
     */
    protected function validateConditions(array $conditions): void
    {
        if (!isset($conditions['where'])) {
            throw new InvalidArgumentException('The where condition is missing.');
        }
    }
}
