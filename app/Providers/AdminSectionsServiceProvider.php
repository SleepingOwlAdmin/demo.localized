<?php

namespace App\Providers;

use App\Admin\Http\Sections\ActivitiesSection;
use App\Admin\Http\Sections\ArticlesSection;
use App\Admin\Http\Sections\BannerIconsSection;
use App\Admin\Http\Sections\BannerSidebarSection;
use App\Admin\Http\Sections\BannersSection;
use App\Admin\Http\Sections\CompanyModerationSection;
use App\Admin\Http\Sections\CompanySection;
use App\Admin\Http\Sections\NewsSection;
use App\Admin\Http\Sections\PageSection;
use App\Admin\Http\Sections\SubscriptionsSection;
use App\Models\Banner;
use App\Models\Company;
use App\Models\Event;
use App\Models\News;
use App\Models\Article;
use App\Models\Page;
use App\Models\Subscription;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;

class AdminSectionsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $widgets = [
        \App\Admin\Widgets\NavigationUserBlock::class,
    ];

    /**
     * @var array
     */
    protected $sections = [
        Article::class => ArticlesSection::class,
        News::class => NewsSection::class,
        Event::class => ActivitiesSection::class,
        Banner::class => BannersSection::class,
        Page::class => PageSection::class,
        Banner\Icon::class => BannerIconsSection::class,
        Banner\Sidebar::class => BannerSidebarSection::class,
        Company::class => CompanySection::class,
        Subscription::class => SubscriptionsSection::class,
        //Company\Unverified::class => CompanyModerationSection::class
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(Admin $admin)
    {
        $this->app->call([$this, 'registerViews']);

        parent::boot($admin);
    }

    /**
     * @param WidgetsRegistryInterface $widgetsRegistry
     */
    public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
    {
        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }
    }
}
