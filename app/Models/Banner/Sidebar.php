<?php

namespace App\Models\Banner;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sidebar extends Model
{
    use SoftDeletes,
        Translatable;

    /**
     * @var string
     */
    protected $table = 'sidebar_banners';

    /**
     * @var array
     */
    public $translatedAttributes = ['link', 'image', 'thumb_url', 'image_url'];

    /**
     * @var array
     */
    protected $fillable = ['is_draft'];

    /**
     * @var array
     */
    protected $casts = [
        'is_draft' => 'bool'
    ];

    /**
     * @var array
     */
    protected $with = ['translations'];

    /**
     * @return string
     */
    public function getTranslationModelName()
    {
        return Sidebar\Translation::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'banner_id';
    }
}
