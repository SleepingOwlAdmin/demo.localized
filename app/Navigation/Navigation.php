<?php

namespace App\Navigation;

use App\Events\Navigation\BeforeRender;

class Navigation extends \KodiComponents\Navigation\Navigation
{
    /**
     * @param string|null $view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = null)
    {
        event(new BeforeRender($this));

        return parent::render($view);
    }
}