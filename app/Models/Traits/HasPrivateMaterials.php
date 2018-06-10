<?php

namespace App\Models\Traits;

use App\Models\Scopes\OnlyPublicMaterials;

trait HasPrivateMaterials
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootHasPrivateMaterials()
    {
        static::addGlobalScope(new OnlyPublicMaterials);
    }
}