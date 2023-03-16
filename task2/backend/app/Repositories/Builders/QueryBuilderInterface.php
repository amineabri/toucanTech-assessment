<?php

namespace App\Repositories\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface QueryBuilderInterface
{
    public function build(Model $model, array $conditions): Builder;
}
