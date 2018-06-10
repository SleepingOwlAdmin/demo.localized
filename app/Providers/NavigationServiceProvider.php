<?php

namespace App\Providers;

use App\Navigation\Navigation;
use FrontNavigation;
use Illuminate\Support\ServiceProvider;
use KodiComponents\Navigation\Page;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function() {
            $this->initNavigation();
        });
    }

    protected function initNavigation()
    {
        FrontNavigation::setFromArray([
            new Page(
                trans('portal.home.menu'), route('home'), 'home', 100
            ),
            new Page(
                trans('portal.news.menu'), route('news.index'), 'news', 200
            ),
            new Page(
                trans('portal.events.menu'), route('event.index'), 'events', 300
            ),
            new Page(
                trans('portal.companies.menu'), route('company.index'), 'companies', 400
            ),
            new Page(
                trans('portal.articles.menu'), route('article.index'), 'articles', 500
            )
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('front.navigation', function () {
            return new Navigation();
        });
    }
}
