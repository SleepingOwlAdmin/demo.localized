<?php

namespace App\Models\Company;

use App\Models\Traits\HasFilterHtmlTags;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFilterHtmlTags;

    /**
     * @var string
     */
    protected $table = 'company_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'text', 'contacts'];

    /**
     * @var array
     */
    protected $filterAttributes = [
        'text',
        'contacts'
    ];
}
