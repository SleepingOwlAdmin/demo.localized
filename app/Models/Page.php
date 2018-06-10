<?php

namespace App\Models;

use App\Models\Traits\HasAttachments;
use App\Models\Traits\HasDrafts;
use App\Models\Traits\HasPrivateMaterials;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use Translatable,
        HasAttachments,
        HasDrafts,
        HasPrivateMaterials,
        SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Page $page) {
            $page->slug = (new Slugify)->slugify($page->slug);
        });

        static::addGlobalScope('sortByOrder', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title', 'html', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'slug', 'order', 'menu', 'is_private', 'is_draft'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_private' => 'bool',
        'is_draft' => 'bool',
        'menu' => 'bool',
        'order' => 'int'
    ];

    /**
     * @var array
     */
    protected $with = ['translations'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return string
     */
    public function getTranslationModelName()
    {
        return Page\Translation::class;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeInMenu(Builder $builder)
    {
        return $builder->where('menu', true);
    }
}
