<?php

namespace App\Admin\Columns;

use SleepingOwl\Admin\Display\Column\Lists;

class Langs extends Lists
{

    public function getWidth()
    {
        return '100px';
    }

    /**
     * @param array $locales
     * @param string|null $label
     */
    public function __construct(array $locales, $label = null)
    {
        parent::__construct(function ($model) use($locales) {

            $modelConf = $this->getModelConfiguration();
            foreach ($locales as $i => $locale) {
                if($model->hasTranslation($locale)) {
                    $locales[$i] = \Html::link($modelConf->getEditUrl($model, ['lang' => $locale]), $locale, ['class' => 'btn btn-xs btn-success']);
                } else {
                    $locales[$i] = \Html::link($modelConf->getEditUrl($model, ['lang' => $locale]), $locale, ['class' => 'btn btn-xs btn-warning']);
                }
            }

            return $locales;
        }, $label);
    }

    /**
     * @return mixed
     */
    public function getModelValue()
    {
        return $this->getValueFromObject($this->getModel(), $this->getName());
    }

    public function getView()
    {
        return view('admin.display.column.lists');
    }
}