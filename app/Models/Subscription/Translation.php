<?php

namespace App\Models\Subscription;

use App\Models\Traits\HasFilterHtmlTags;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFilterHtmlTags;

    /**
     * @var string
     */
    protected $table = 'subscription_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @var array
     */
    protected $filterAttributes = [
        'description'
    ];
}
