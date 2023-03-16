<?php

namespace App\Repositories\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class QueryBuilder implements QueryBuilderInterface
{
    protected Model $model;
    protected Builder $query;

    public function build(Model $model, array $conditions): Builder
    {
        $this->query = $model->newQuery();
        $this->buildWhere($conditions['where'] ?? null);
        $this->buildOrWhere($conditions['orWhere'] ?? null);
        $this->buildWhereHas($conditions['whereHas'] ?? null);
        $this->buildWith($conditions['with'] ?? null);

        return $this->query;
    }
    protected function buildOrWhere(?array $where): void
    {
        if (!$where) {
            return;
        }
        foreach ($where as $condition) {
            $this->query->orWhere($condition[0], $condition[1], $condition[2]);
        }
    }
    protected function buildWhere(?array $where): void
    {
        if (!$where) {
            return;
        }
        foreach ($where as $condition) {
            $this->query->where($condition[0], $condition[1], $condition[2]);
        }
    }
    protected function buildWhereHas(?array $whereHas): void
    {
        if (!$whereHas) {
            return;
        }

        foreach ($whereHas as $condition) {
            $this->query->whereHas(key($condition), function (Builder $query) use ($condition) {
                $query->where($condition[key($condition)][0], $condition[key($condition)][1], $condition[key($condition)][2]);
            });
        }
    }
    protected function buildWith(string|null $with): void
    {
        if (is_null($with)) {
            return;
        }

        $this->query->with($with);
    }
}
