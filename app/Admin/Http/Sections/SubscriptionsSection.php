<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Admin\Columns\Langs as LangsColumn;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;

class SubscriptionsSection extends ContentSection
{
    /**
     * @var string
     */
    protected $transPrefix = 'admin.subscriptions';

    /**
     * @var int
     */
    protected $navigationPosition = 1000;

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-envelope-open-o';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                new LangsColumn($this->getAvailableLocales(), $this->trans('table.column.locales')),
                AdminColumn::link('name', $this->trans('table.column.name'))
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
            ->addHeader([
                AdminFormElement::text('name', $this->trans('form.name'))->required()->setHtmlAttribute('class', 'input-lg'),
            ])
            ->addBody([
                AdminFormElement::wysiwyg('description', $this->trans('form.description'))
            ]);
    }
}