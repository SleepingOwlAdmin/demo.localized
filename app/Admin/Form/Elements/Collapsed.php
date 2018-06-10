<?php

namespace App\Admin\Form\Elements;

use SleepingOwl\Admin\Form\Panel\Body;

class Collapsed extends Body
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $class = '';

    /**
     * @var bool
     */
    protected $expanded;

    /**
     * @param string $title
     * @param array $elements
     * @param bool $expanded
     */
    public function __construct(string $title, array $elements = [], bool $expanded = false)
    {
        parent::__construct();

        $this->title = $title;
        $this->expanded = $expanded;

        $this->setElements($elements);

        $this->setHtmlAttribute('style', 'background: whitesmoke;');
    }

    /**
     * @return View|string
     */
    public function getView()
    {
        return view('admin.form.element.collapsed');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return parent::toArray() + [
            'title' => $this->title,
            'id' => str_random(5),
            'expanded' => $this->expanded ? 'in' : ''
        ];
    }
}