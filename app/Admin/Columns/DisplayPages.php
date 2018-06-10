<?php

namespace App\Admin\Columns;

use Html;
use SleepingOwl\Admin\Display\DisplayTree;

class DisplayPages extends DisplayTree
{
    public function getView()
    {
        return view('admin.display.pages');
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function toArray()
    {
        $urls = [];
        $locales = \LaravelLocalization::getSupportedLanguagesKeys();

        $modelConfiguration = $this->getModelConfiguration();

        foreach ($locales as $locale) {
            $urls[] = [
                'text' => trans('admin.button.create', [
                    'locale' => $locale,
                    'text' => $this->getNewEntryButtonText()
                ]),
                'url' => $modelConfiguration->getCreateUrl(['locale' => $locale])
            ];
        }

         $data = parent::toArray() + [
            'buttons' => $urls
        ];

        $data['items']->each(function($model) use($modelConfiguration, $locales) {

            foreach ($locales as $i => $locale) {
                if ($model->hasTranslation($locale)) {
                    $locales[$i] = Html::link($modelConfiguration->getEditUrl($model->getKey(), ['lang' => $locale]), $locale, ['class' => 'btn btn-xs btn-success']);
                } else {
                    $locales[$i] = Html::link($modelConfiguration->getEditUrl($model->getKey(), ['lang' => $locale]), $locale, ['class' => 'btn btn-xs btn-warning']);
                }
            }

            $model->locale_buttons = $locales;

        });


        return $data;
    }
}