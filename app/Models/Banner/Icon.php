<?php

namespace App\Models\Banner;

use App\Models\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasImage;

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Icon $icon) {
            if ($icon->default) {
                Icon::where('default', true)->where('id', '!=', $icon->id)->update([
                    'default' => false
                ]);
            } else if(Icon::where('default', true)->count() === 0) {
                $icon->default = true;
                $icon->save();
            }
        });
    }

    /**
     * @var string
     */
    protected $table = 'banner_icons';

    protected $casts = [
        'default' => 'bool'
    ];
}
