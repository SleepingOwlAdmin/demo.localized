<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{

    /**
     * @var string
     */
    protected $table = 'page_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'meta_title', 'meta_keywords', 'meta_description',
        'title', 'html'
    ];
}
