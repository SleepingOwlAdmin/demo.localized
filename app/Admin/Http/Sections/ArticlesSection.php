<?php

namespace App\Admin\Http\Sections;

/**
 * @property \App\Models\Article $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ArticlesSection extends ContentSection
{
    /**
     * @var string
     */
    protected $transPrefix = 'admin.articles';

    /**
     * @var int
     */
    protected $navigationPosition = 300;

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-quote-left';
    }
}