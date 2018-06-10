<?php

namespace App\Models;

use App\Models\Traits\HasAttachments;
use App\Models\Traits\HasDrafts;
use App\Models\Traits\HasImage;
use App\Models\Traits\HasPrivateMaterials;
use App\Models\Traits\SocialTags;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KodiCMS\Assets\Contracts\SocialMediaTagsInterface;
use Spatie\ModelStatus\HasStatuses;

class News extends Model implements SocialMediaTagsInterface
{
    use HasStatuses,
        Translatable,
        HasAttachments,
        HasPrivateMaterials,
        HasImage,
        HasDrafts,
        SocialTags,
        SoftDeletes;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'meta_title', 'meta_keywords', 'meta_description',
        'title', 'description', 'text'
    ];

    /**
     * @var array
     */
    protected $fillable = ['image', 'is_private', 'is_draft'];

    /**
     * @var array
     */
    protected $casts = [
        'is_private' => 'bool',
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
        return News\Translation::class;
    }

    /**
     * @return null|string
     */
    public function getCreatedAtFormattedAttribute(): ?string
    {
        return format_date($this->created_at);
    }

    /**
     * @return string
     */
    public function getDescriptionWithBrakesAttribute(): ?string
    {
        return $this->description ? nl2br($this->description) : null;
    }

    /**
     * @return string
     */
    public function getOgUrl()
    {
        return route('news.show', $this->getKey());
    }
}
