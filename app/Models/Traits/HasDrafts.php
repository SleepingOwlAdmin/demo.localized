<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDrafts
{
    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopePublished(Builder $builder)
    {
        return $builder->where('is_draft', false);
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->is_draft === false;
    }
}