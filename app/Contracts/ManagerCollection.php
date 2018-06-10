<?php

namespace App\Contracts;

use App\Entities\Manager;
use Illuminate\Support\Collection;

interface ManagerCollection
{
    /**
     * @return Manager[]|Collection
     */
    public function all(): Collection;
}