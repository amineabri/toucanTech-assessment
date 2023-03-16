<?php

namespace App\Repositories;

use App\Interfaces\MemberRepository;
use App\Models\Member;
use App\Repositories\Builders\OrderBuilder;
use App\Repositories\Builders\QueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class EloquentMemberRepository extends BaseRepository implements MemberRepository
{
    /**
     * EloquentMemberRepository constructor.
     *
     * @param Member $school
     * @param QueryBuilder $queryBuilder
     * @param OrderBuilder $orderBuilder
     */
    public function __construct(Member $school, QueryBuilder $queryBuilder, OrderBuilder $orderBuilder)
    {
        parent::__construct($school, $queryBuilder, $orderBuilder);
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findBy(array $conditions): ?Member
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
     * @return Member|null
     */
    public function create(array $data): ?Member
    {
        /** @var Member $member */
        $member = $this->model->newInstance();
        $member->name = $data['name'] ?? null;
        $member->email = $data['email'] ?? null;
        $member->school_id = $data['school_id'] ?? null;

        if (!$member->save()) {
            throw new Exception();
        }

        return $member;
    }
}
