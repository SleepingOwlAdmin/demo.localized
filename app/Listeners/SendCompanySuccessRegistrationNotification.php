<?php

namespace App\Listeners;

use App\Contracts\ManagerCollection;
use App\Entities\Manager;
use App\Notifications\CompanyRegistered;
use App\Notifications\CompanyWaitingVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCompanySuccessRegistrationNotification
{
    /**
     * @var ManagerCollection
     */
    private $managers;

    /**
     * @param ManagerCollection $managers
     */
    public function __construct(ManagerCollection $managers)
    {
        $this->managers = $managers;
    }

    /**
     * @param Registered $event
     */
    public function handle(Registered $event)
    {
        $event->user->notify(
            new CompanyWaitingVerification
        );

        $this->managers->all()->each(function(Manager $manager) use($event) {
            $manager->notify(
                new CompanyRegistered($event->user)
            );
        });
    }
}
