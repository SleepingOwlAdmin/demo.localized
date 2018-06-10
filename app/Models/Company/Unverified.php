<?php

namespace App\Models\Company;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

class Unverified extends Company
{
    /**
     * @var string
     */
    protected $table = 'companies';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::bootTraits();

        static::addGlobalScope('unverified', function (Builder $builder) {
            $builder->where('verified', false);
        });
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'company_id';
    }
}