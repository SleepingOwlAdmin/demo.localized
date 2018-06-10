<?php

namespace App\Events\Navigation;

use KodiComponents\Navigation\Contracts\NavigationInterface;

class BeforeRender
{
    /**
     * @var NavigationInterface
     */
    public $navigation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(NavigationInterface $navigation)
    {
        $this->navigation = $navigation;
    }
}
