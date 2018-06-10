<?php

namespace App\Events;

use App\Models\Company;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CompanyRegistered
{
    use Dispatchable, SerializesModels;

    /**
     * @var Company
     */
    public $company;

    /**
     * Create a new event instance.
     *
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
}
