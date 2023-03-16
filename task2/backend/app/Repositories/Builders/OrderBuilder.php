<?php

namespace App\Repositories\Builders;

use Illuminate\Database\Eloquent\Builder;

class OrderBuilder implements OrderBuilderInterface
{
    protected Builder $query;

    public function build(Builder $query, array $conditions): Builder
    {
        $sortBy = $conditions['sortBy'] ?? 'id';
        $orderBy = $conditions['orderBy'] ?? 'asc';

        $query->orderBy($sortBy, $orderBy);
        return $query;
    }
}
