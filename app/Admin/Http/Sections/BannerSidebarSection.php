<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use App\Admin\Columns\Langs as LangsColumn;

/**
 * @property \App\Models\Banner\Sidebar $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class BannerSidebarSection extends ContentSection
{
    /**
     * @var string
     */
    protected $transPrefix = 'admin.banners.sidebar';

    /**
     * @var int
     */
    protected $navigationPosition = 800;

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-image';
    }

    public function getTitle()
    {
        return $this->trans('title.menu');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                AdminColumn::image('image_url', $this->trans('table.column.image'))->setWidth('100px'),
                new LangsColumn($this->getAvailableLocales(), $this->trans('table.column.locales')),
                AdminColumn::link('link', $this->trans('table.column.link')),
                AdminColumnEditable::checkbox('is_draft')->setLabel($this->trans('table.column.is_draft'))->setWidth('30px')
            )
            ->paginate(15);

        return $this->extendDisplay($display);
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
                AdminFormElement::text('link', $this->trans('form.link'))
                    ->required()
                    ->setValidationRules('url')
                    ->setHtmlAttribute('class', 'input-lg'),
                AdminFormElement::checkbox('is_draft', $this->trans('form.is_draft')),
            ])
            ->addBody([
                AdminColumn::image('image_url')->setWidth('300px'),
                AdminFormElement::upload('image', $this->trans('form.image'))
                    ->required()
                    ->addValidationRule('image')
            ]);
    }
}
