<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Admin\Columns\Langs as LangsColumn;
use App\Admin\Extensions\LocalizedButtons;
use App\Admin\Extensions\LocalizeRowsDisplay;
use App\Admin\Form\Elements\Collapsed;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;

abstract class ContentSection extends Section implements Initializable
{
    /**
     * @var int
     */
    protected $navigationPosition = 100;

    /**
     * @var string
     */
    protected $transPrefix = 'admin';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation($this->navigationPosition);

        $this->saving(function ($model) {
            $model->getModel()->setDefaultLocale(
                $this->getLocale()
            );
        });
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return $this->trans('title.menu');
    }

    /**
     * @param string $key
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    protected function trans(string $key)
    {
        return trans($this->transPrefix . '.' . $key, ['locale' => $this->getLocale()]);
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setColumns(
                AdminColumn::image('image_url', $this->trans('table.column.image'))->setWidth('30px'),
                new LangsColumn($this->getAvailableLocales(), $this->trans('table.column.locales')),
                AdminColumn::link('title', $this->trans('table.column.title')),
                AdminColumnEditable::checkbox('is_private')->setLabel($this->trans('table.column.is_private'))->setWidth('30px'),
                AdminColumnEditable::checkbox('is_draft')->setLabel($this->trans('table.column.is_draft'))->setWidth('30px')
            )
            ->paginate(15);

        return $this->extendDisplay($display);
    }

    /**
     * @param DisplayInterface $display
     * @param string $latestColumn
     * @return DisplayInterface
     */
    protected function extendDisplay(DisplayInterface $display, $latestColumn = 'created_at')
    {
        $display->setNewEntryButtonText($this->trans('table.button.create'));

        $display->extend('localize.rows', new LocalizeRowsDisplay());
        $display->extend('localized_buttons', new LocalizedButtons($this->getAvailableLocales()));

        $display->setApply([
            function ($query) use($latestColumn) {
                $query->latest($latestColumn);
            },
        ]);

        return $display;
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
            ->addElement(new Collapsed($this->trans('title.meta_data'), [
                AdminFormElement::text('meta_title', $this->trans('form.meta_title')),
                AdminFormElement::text('meta_keywords', $this->trans('form.meta_keywords')),
                AdminFormElement::text('meta_description', $this->trans('form.meta_description')),
            ]))
            ->addHeader([
                AdminFormElement::text('title', $this->trans('form.title'))->required()->setHtmlAttribute('class', 'input-lg'),
                AdminFormElement::checkbox('is_private', $this->trans('form.is_private')),
                AdminFormElement::checkbox('is_draft', $this->trans('form.is_draft')),
            ])
            ->addBody([
                AdminFormElement::textarea('description', $this->trans('form.description')),
                AdminFormElement::wysiwyg('text', $this->trans('form.text'))->required(),
                AdminFormElement::timestamp('created_at', $this->trans('form.created_at'))->setCurrentDate(),
            ])
            ->addBody([
                AdminColumn::image('image_url')->setWidth('300px'),
                AdminFormElement::upload('image', $this->trans('form.image'))->addValidationRule('image')
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
     * @param int $id
     *
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }

    /**
     * @param string|int $id
     * @param array $parameters
     *
     * @return string
     */
    public function getUpdateUrl($id, array $parameters = [])
    {
        return route('admin.model.update', [
            $this->getAlias(), $id, 'lang' => $this->getLocale()
        ]);
    }

    /**
     * @param Model $model
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getEditTitle(Model $model)
    {
        $locale = $this->getLocale();

        $title = $model->title;
        if ($model->hasTranslation($locale)) {
            $title = $model->getTranslation($this->getLocale())->title;
        }

        return sprintf('[Lang: %s] %s', $this->getLocale(), $title);
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getCreateTitle()
    {
        return sprintf('[Lang: %s] %s', $this->getLocale(), parent::getCreateTitle());
    }
}