<?php

namespace App\Admin\Http\Sections;

use AdminDisplay;
use AdminFormElement;
use App\Admin\Columns\Composite;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use App\Admin\Columns\Langs as LangsColumn;
use AdminColumn;
use AdminColumnEditable;

/**
 * @property \App\Models\Event $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ActivitiesSection extends ContentSection
{
    /**
     * @var int
     */
    protected $navigationPosition = 400;

    /**
     * @var string
     */
    protected $transPrefix = 'admin.events';

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-calendar-check-o';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                new LangsColumn($this->getAvailableLocales(), $this->trans('table.column.locales')),
                AdminColumn::link('title', $this->trans('table.column.title'))->setWidth('300px'),

                AdminColumnEditable::datetime('event_at', $this->trans('table.column.event_at'))
                    ->setFormat('d.m.Y'),
                new Composite([
                    AdminColumn::text('address', $this->trans('table.column.address')),
                ]),

                AdminColumnEditable::checkbox('is_private')->setLabel($this->trans('table.column.is_private'))->setWidth('30px'),
                AdminColumnEditable::checkbox('is_draft')->setLabel($this->trans('table.column.is_draft'))->setWidth('30px')
            )
            ->paginate(15);

        return $this->extendDisplay($display, 'event_at');
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return parent::onEdit($id)
            ->addBody([
                AdminFormElement::date('event_at', $this->trans('form.event_at'))->required(),
                AdminFormElement::textarea('address', $this->trans('form.address'))->required()->setRows(2),
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('lat', $this->trans('form.lat'))
                            ->addValidationRule('latitude'),
                    ], 3)->addColumn([
                        AdminFormElement::text('lon', $this->trans('form.lon'))
                            ->addValidationRule('longitude'),
                    ], 3),
            ]);
    }
}