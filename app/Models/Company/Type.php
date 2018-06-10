<?php

namespace App\Models\Company;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Translatable;

    /**
     * @var string
     */
    protected $table = 'company_types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * @var array
     */
    protected $with = ['translations'];

    /**
     * @return string
     */
    public function getTranslationModelName()
    {
        return Type\Translation::class;
    }
}
