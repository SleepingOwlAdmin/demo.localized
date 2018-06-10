<?php

namespace App\Admin\Http\Sections;

/**
 * @property \App\Models\News $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class NewsSection extends ContentSection
{
    /**
     * @var int
     */
    protected $navigationPosition = 200;

    /**
     * @var string
     */
    protected $transPrefix = 'admin.news';

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-newspaper-o';
    }
}
