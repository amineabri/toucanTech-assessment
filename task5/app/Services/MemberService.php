<?php

namespace App\Services;

use App\Interfaces\MemberRepository;
use App\Models\Member;
use Illuminate\Support\Collection;

class MemberService
{
    /** @var MemberRepository $memberRepository */
    private MemberRepository $memberRepository;

    /**
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository) {
        $this->memberRepository        = $memberRepository;
    }

    /**
     * @param array $conditions
     * @return Collection|null
     */
    public function findAll(array $conditions = []): ?Collection {
        return $this->memberRepository->findAll($conditions);
    }

    public function create(array $data): ?Member {
        /* @var Member $member*/
        $member = $this->memberRepository->create($data);
        return $member;
    }
}
