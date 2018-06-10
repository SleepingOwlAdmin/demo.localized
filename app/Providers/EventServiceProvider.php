<?php

namespace App\Providers;

use App\Events\Navigation;
use App\Events\Subscription;
use App\Listeners\Navigation\AddPagesToNavigation;
use App\Listeners\SendCompanySuccessRegistrationNotification;
use App\Listeners\Subscription\SendSubscriberToMailingService;
use Illuminate\Auth\Events\Registered as CompanyRegistered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CompanyRegistered::class => [
            SendCompanySuccessRegistrationNotification::class
        ],
        Navigation\BeforeRender::class => [
            AddPagesToNavigation::class
        ],
        Subscription\Subscribed::class => [
            SendSubscriberToMailingService::class
        ]
    ];

    /**
     * The observers listener mappings for models.
     *
     * @var array
     */
    protected $observers = [
        //'App\Model' => [
        //    'App\Observers\ExampleObserver'
        //]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Register observers
        foreach ($this->observers as $model => $observers) {
            foreach ($observers as $observer) {
                $model::observe($observer);
            }
        }
    }
}
