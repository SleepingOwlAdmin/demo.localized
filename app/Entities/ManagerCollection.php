<?php

namespace App\Entities;

use App\Contracts\ManagerCollection as ManagerCollectionContract;
use Illuminate\Support\Collection;

class ManagerCollection implements ManagerCollectionContract
{
    /**
     * @var Collection|Manager[]
     */
    protected $managers;

    /**
     * @param array $emails
     */
    public function __construct(array $emails)
    {
        $this->managers = collect($emails)->map(function (string $email) {
            return new Manager($email);
        });
    }

    /**
     * @return Manager[]|Collection
     */
    public function all(): Collection
    {
        return $this->managers;
    }
}