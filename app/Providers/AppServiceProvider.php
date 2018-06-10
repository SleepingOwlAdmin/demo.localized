<?php

namespace App\Providers;

use App\Contracts\ManagerCollection as ManagerCollectionContract;
use App\Contracts\TagsFilter;
use App\Contracts\Unisender as UnisenderContract;
use App\Entities\ManagerCollection;
use App\Services\Unisender\Unisender;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use KodiCMS\Assets\Contracts\MetaInterface;
use Illuminate\Support\Facades\Validator;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param MetaInterface $meta
     * @return void
     */
    public function boot(MetaInterface $meta)
    {
        Paginator::defaultView('layouts._partials.pagination');
        Schema::defaultStringLength(191);

        $this->makeMetaAttributes($meta);

        Validator::extend('latitude', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,9})?))$/', $value);
        });

        Validator::extend('longitude', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,9})?))$/', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TagsFilter::class, function() {

            $config = \HTMLPurifier_Config::createDefault();

            $config->set(
                'HTML.AllowedElements',
                $this->app['config']->get('portal.content.allowed_elements', '')
            );

            return new \App\Services\Html\TagsFilter(
                new \HTMLPurifier($config)
            );
        });

        $this->app->singleton(ManagerCollectionContract::class, function () {
            return new ManagerCollection(
                config('portal.managers')
            );
        });

        $this->app->singleton(UnisenderContract::class, function () {
            return new Unisender(
                config('services.unisender.key')
            );
        });
    }

    /**
     * @param MetaInterface $meta
     */
    protected function makeMetaAttributes(MetaInterface $meta): void
    {
        View::composer(['layouts.app', 'layouts.inner'], function ($view) use ($meta) {
            $title = strip_tags($meta->getGroup('meta', 'title'));

            if (empty($title)) {
                $title = trans('portal.title');
            } else {
                $title = $title.' - '.trans('portal.title');
            }

            $view->meta = $meta
                ->addMeta([
                    'name' => 'csrf-token',
                    'content' => csrf_token()
                ])
                ->setTitle($title)
                ->setFavicon(asset('favicon.ico'))
                ->render();
        });
    }
}
