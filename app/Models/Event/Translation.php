<?php

namespace App\Models\Event;

use App\Models\Traits\HasFilterHtmlTags;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFilterHtmlTags;

    /**
     * @var string
     */
    protected $table = 'event_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'meta_title', 'meta_keywords', 'meta_description',
        'title', 'description', 'text', 'address'
    ];

    /**
     * @var array
     */
    protected $filterAttributes = [
        'text',
    ];
}
