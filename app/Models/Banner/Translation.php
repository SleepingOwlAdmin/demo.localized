<?php

namespace App\Models\Banner;

use App\Models\Traits\HasFilterHtmlTags;
use App\Models\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasImage,
        HasFilterHtmlTags;

    /**
     * @var string
     */
    protected $table = 'banner_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * @return string
     */
    protected function getImageFolderName(): string
    {
        return 'banner';
    }

    /**
     * @var array
     */
    protected $filterAttributes = ['text'];
}
