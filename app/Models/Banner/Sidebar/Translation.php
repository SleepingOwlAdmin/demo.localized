<?php

namespace App\Models\Banner\Sidebar;

use App\Models\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasImage;

    /**
     * @var string
     */
    protected $table = 'sidebar_banner_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['link', 'image'];
}
