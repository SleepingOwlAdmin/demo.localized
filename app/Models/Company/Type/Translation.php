<?php

namespace App\Models\Company\Type;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     * @var string
     */
    protected $table = 'company_type_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];
}
