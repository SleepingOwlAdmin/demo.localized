<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * @property \App\Models\Banner\Icon $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class BannerIconsSection extends Section implements Initializable
{
    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation(700);
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-address-card-o';
    }

    public function getTitle()
    {
        return trans('admin.banners.icons.title.menu');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return $display = AdminDisplay::table()
            ->setColumns(
                AdminColumn::image('image_url', trans('admin.banners.icons.column.image'))->setWidth('100px'),
                AdminColumn::link('name', trans('admin.banners.icons.column.name')),
                AdminColumnEditable::checkbox('default')->setLabel(trans('admin.banners.icons.column.default'))->setWidth('30px')
            );
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()
            ->withFiles()
            ->addHeader([
                AdminFormElement::text('name', trans('admin.banners.icons.form.name'))
                    ->required()
                    ->setHtmlAttribute('class', 'input-lg'),
                AdminFormElement::checkbox('default', trans('admin.banners.icons.form.default')),
            ])
            ->addBody([
                AdminColumn::image('image_url')->setWidth('300px'),
                AdminFormElement::upload('image', trans('admin.banners.icons.form.image'))
                    ->required()
                    ->addValidationRule('image')
            ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
