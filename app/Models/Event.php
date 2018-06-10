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

class Event extends Model implements SocialMediaTagsInterface
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
        'title', 'description', 'text', 'address'
    ];

    /**
     * @var array
     */
    protected $dates = ['event_at'];

    /**
     * @var array
     */
    protected $fillable = ['image', 'is_private', 'event_at', 'lat', 'lon', 'is_draft'];

    /**
     * @var array
     */
    protected $casts = [
        'is_private' => 'bool',
        'is_draft' => 'bool',
        'lat' => 'float',
        'lon' => 'float'
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
        return Event\Translation::class;
    }

    /**
     * @return null|string
     */
    public function getEventAtFormattedAttribute(): ?string
    {
        return format_date($this->event_at);
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
        return route('event.show', $this->getKey());
    }

    /**
     * @return bool
     */
    public function hasCoordinates(): bool
    {
        return !empty($this->lat) && !empty($this->lon);
    }
}
