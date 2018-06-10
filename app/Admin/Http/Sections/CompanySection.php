<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminFormElement;
use App\Admin\Columns\Langs as LangsColumn;
use App\Rules\PhoneNumber;

class CompanySection extends ContentSection
{
    /**
     * @var string
     */
    protected $transPrefix = 'admin.companies';

    /**
     * @var int
     */
    protected $navigationPosition = 180;

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-university';
    }

    /**
     * @return \SleepingOwl\Admin\Contracts\Display\DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setApply(function($query) {
                $query->withoutGlobalScopes(['verified']);
                $query->orderBy('verified');
                $query->latest();
            })
            ->setColumns(
                AdminColumn::image('logo_url', $this->trans('table.column.logo'))->setWidth('30px'),
                new LangsColumn($this->getAvailableLocales(), $this->trans('table.column.locales')),
                AdminColumn::link('name', $this->trans('table.column.name')),
                AdminColumnEditable::checkbox('verified')->setLabel($this->trans('table.column.verified'))->setWidth('30px')
            )
            ->paginate(20);

        return $this->extendDisplay($display);
    }

    /**
     * @param int $id
     * @return \SleepingOwl\Admin\Contracts\Form\FormInterface
     */
    public function onEdit($id)
    {
        return \AdminForm::panel()
            ->withFiles()
            ->addHeader([
                AdminFormElement::text('name', $this->trans('form.name'))->required()->setHtmlAttribute('class', 'input-lg'),
                AdminFormElement::checkbox('verified', $this->trans('form.verified')),
                AdminFormElement::checkbox('receive_newsletters', $this->trans('form.receive_newsletters')),
            ])
            ->addBody([
                AdminFormElement::text('login', $this->trans('form.login'))->required()->unique(),
                AdminFormElement::text('email', $this->trans('form.email'))->required()->unique()->addValidationRule('email'),
                AdminFormElement::text('phone', $this->trans('form.phone'))->required()->addValidationRule(new PhoneNumber()),
            ])
            ->addBody([
                AdminFormElement::textarea('description', $this->trans('form.description')),
                AdminFormElement::wysiwyg('text', $this->trans('form.text'))->required(),
                AdminFormElement::wysiwyg('contacts', $this->trans('form.contacts'))->required(),
                AdminFormElement::timestamp('created_at', $this->trans('form.created_at'))->setCurrentDate(),
            ])
            ->addBody([
                AdminColumn::image('logo_url')->setWidth('300px'),
                AdminFormElement::upload('logo', $this->trans('form.logo'))->addValidationRule('logo')
            ]);
    }
}