<?php

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    /**
     * @var string
     */
    protected $table = 'newsletter_templates';

    /**
     * @var array
     */
    protected $fillable = ['email', 'name', 'locale', 'receive_newsletters'];
}
