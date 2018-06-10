<?php

namespace App\Admin\Http\Sections;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Admin\Columns\DisplayPages;
use App\Admin\Form\Elements\Collapsed;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Display\Tree\OrderTreeType;

/**
 * Class Pages
 *
 * @property \App\Models\Page $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class PageSection extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-sitemap';
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function getTitle()
    {
        return trans('admin.pages.title.menu');
    }

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation(150);
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = new DisplayPages(
            OrderTreeType::class
        );

        $display->setNewEntryButtonText(
            trans('admin.pages.table.button.create')
        );

        return $display->setValue('title');
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()
            ->addElement(new Collapsed(trans('admin.pages.title.meta_data'), [
                AdminFormElement::text('meta_title', trans('admin.pages.form.meta_title')),
                AdminFormElement::text('meta_keywords', trans('admin.pages.form.meta_keywords')),
                AdminFormElement::text('meta_description', trans('admin.pages.form.meta_description')),
            ]))
            ->addHeader([
                AdminFormElement::text('title', trans('admin.pages.form.title'))->required()->setHtmlAttribute('class', 'input-lg'),
                AdminFormElement::text('slug', trans('admin.pages.form.slug'))->required()->addValidationRule('alpha_dash'),
                AdminFormElement::number('order', trans('admin.pages.form.order'))->setDefaultValue(1),
                AdminFormElement::checkbox('is_private', trans('admin.pages.form.is_private')),
                AdminFormElement::checkbox('is_draft', trans('admin.pages.form.is_draft')),
                AdminFormElement::checkbox('menu', trans('admin.pages.form.menu')),
            ])->addBody([
                AdminFormElement::ckeditor('html', trans('admin.pages.form.html'))
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

    public function getCreateTitle()
    {
        return sprintf('[Lang: %s] %s', $this->getLocale(), parent::getCreateTitle());
    }
}