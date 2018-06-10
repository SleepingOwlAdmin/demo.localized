<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Banner;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use App\Admin\Columns\Langs as LangsColumn;
use SleepingOwl\Admin\Contracts\Form\FormInterface;

/**
 * @property \App\Models\Banner $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class BannersSection extends ContentSection
{
    /**
     * @var string
     */
    protected $transPrefix = 'admin.banners';

    /**
     * @var int
     */
    protected $navigationPosition = 600;

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-image';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                AdminColumn::custom($this->trans('table.column.color'), function ($model) {
                    return sprintf('<div class="label" style="background: %s;">%s</div>', $model->color, $model->color);
                })->setWidth('30px'),
                AdminColumn::image('image_url', $this->trans('table.column.image'))->setWidth('100px'),
                new LangsColumn($this->getAvailableLocales(), $this->trans('table.column.locales')),
                AdminColumn::link('text', $this->trans('table.column.text'))
                    ->append(
                        AdminColumn::custom($this->trans('table.column.alignment'), function ($model) {
                            return sprintf('<div class="label label-primary">%s</div>', $model->alignment);
                        })
                    ),
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
                AdminFormElement::text('link', $this->trans('form.link'))->required()->addValidationRule('url'),
                AdminFormElement::textarea('text', $this->trans('form.text'))->required(),
                AdminFormElement::checkbox('is_draft', $this->trans('form.is_draft')),
            ])
            ->addBody([
                AdminFormElement::text('color', $this->trans('form.color'))
                    ->setHelpText($this->trans('helpers.color_format')),
                AdminFormElement::select('alignment', $this->trans('form.alignment'))
                    ->setEnum((new Banner())->alignments()),
                AdminFormElement::select('icon_id', $this->trans('form.icon'), Banner\Icon::class)
                    ->setDisplay('name'),
            ])
            ->addBody([
                AdminColumn::image('image_url')->setWidth('300px'),
                AdminFormElement::upload('image', $this->trans('form.image'))->addValidationRule('image')
            ]);
    }
}