<?php

namespace App\Admin\Http\Sections;

use SleepingOwl\Admin\Model\SectionModelConfiguration;

class Section extends SectionModelConfiguration
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @param $id
     *
     * @return mixed|void
     */
    public function fireEdit($id)
    {
        $form = parent::fireEdit($id);

        $form->getModel()->setDefaultLocale(
            $this->getLocale()
        );

        return $form;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return request('lang', $this->app->getLocale());
    }

    /**
     * @return array
     */
    public function getAvailableLocales(): array
    {
        return \LaravelLocalization::getSupportedLanguagesKeys();
    }
}