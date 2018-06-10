<?php

namespace App\Models;

use App\Models\Banner\Icon;
use App\Models\Traits\HasDrafts;
use App\Models\Traits\HasImage;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use Translatable,
        HasImage,
        HasDrafts,
        SoftDeletes;

    const ALIGN_LEFT = 'left';
    const ALIGN_RIGHT = 'right';

    /**
     * @var array
     */
    public $translatedAttributes = ['text'];

    /**
     * @var array
     */
    protected $fillable = ['link', 'image', 'color', 'alignment', 'icon_id', 'is_draft'];

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
     * @return array
     */
    public function alignments(): array
    {
        return [self::ALIGN_LEFT, self::ALIGN_RIGHT];
    }

    /**
     * @return string
     */
    public function getTranslationModelName()
    {
        return Banner\Translation::class;
    }

    /**
     * @return string
     */
    public function defaultColor(): string
    {
        return '#000000';
    }

    /**
     * @param string|null $color
     * @return string
     */
    public function getColorAttribute($color): string
    {
        if (empty($color)) {
            return $this->defaultColor();
        }

        return $color;
    }

    /**
     * @return BelongsTo
     */
    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    /**
     * @return string
     */
    public function getTextWithBrakesAttribute(): ?string
    {
        return $this->text ? nl2br($this->text) : null;
    }
}
