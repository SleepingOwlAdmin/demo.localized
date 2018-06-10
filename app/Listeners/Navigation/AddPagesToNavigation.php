<?php

namespace App\Listeners\Navigation;

use App\Events\Navigation\BeforeRender;
use App\Models\Page as PageModel;
use KodiComponents\Navigation\Page;

class AddPagesToNavigation
{
    /**
     * @param BeforeRender $event
     */
    public function handle(BeforeRender $event)
    {
        PageModel::published()->inMenu()->get()->each(function (PageModel $page) use($event) {
            $event->navigation->addPage(new Page(
                $page->title,
                route('page', $page->slug),
                $page->slug,
                1000 * $page->order
            ));
        });
    }
}
