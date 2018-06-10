<?php

namespace App\Admin\Extensions;

use SleepingOwl\Admin\Contracts\Display\Placable;
use SleepingOwl\Admin\Display\Extension\Extension;

class LocalizedButtons extends Extension implements Placable
{
    /**
     * @var array
     */
    private $locales;

    /**
     * @param array $locales
     */
    public function __construct(array $locales)
    {
        $this->locales = $locales;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $urls = [];

        $modelConfiguration = $this->getDisplay()->getModelConfiguration();

        foreach ($this->locales as $locale) {
            if($locale == 'en') continue;

            $urls[] = [
                'text' => trans('admin.button.create', [
                    'locale' => $locale,
                    'text' => $this->getDisplay()->getNewEntryButtonText()
                ]),
                'url' => $modelConfiguration->getCreateUrl(['locale' => $locale])
            ];
        }

        return [
            'urls' => $urls,
        ];
    }

    /**
     * @return string|\Illuminate\View\View
     */
    public function getView()
    {
        return view('admin.display.buttons');
    }

    /**
     * @return string
     */
    public function getPlacement()
    {
        return 'panel.buttons';
    }
}