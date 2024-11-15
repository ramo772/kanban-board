<?php

namespace App\Repositories;

use App\Models\MemberCard;
use Illuminate\Support\Collection;

class MemberCardRepository extends Repository
{
    public function model(): string
    {
        return MemberCard::class;
    }

    public function getLastOrder()
    {
        return $this->model->max('order');
    }
}
