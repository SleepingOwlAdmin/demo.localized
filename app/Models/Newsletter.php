<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'subject', 'locale',
    ];
}
