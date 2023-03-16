<?php

namespace App\Repositories\Builders;

use Illuminate\Database\Eloquent\Builder;

interface OrderBuilderInterface
{
    /**
     * @param Builder $query
     * @param array $conditions
     * @return Builder
     */
    public function build(Builder $query, array $conditions): Builder;
}
