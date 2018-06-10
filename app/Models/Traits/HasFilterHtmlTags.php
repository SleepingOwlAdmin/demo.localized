<?php

namespace App\Models\Traits;

use App\Contracts\TagsFilter;
use Illuminate\Database\Eloquent\Model;

trait HasFilterHtmlTags
{
    protected static function bootHasFilterHtmlTags()
    {
        static::saving(function (Model $model) {
            $filter = app(TagsFilter::class);

            if (!isset($model->filterAttributes)) {
                return;
            }

            foreach ($model->filterAttributes as $attribute => $tags) {
                if (is_int($attribute)) {
                    $attribute = $tags;
                    $tags = null;
                }

                $model->setAttribute(
                    $attribute,
                    $filter->filter($model->{$attribute}, $tags)
                );
            }
        });
    }
}