<?php

namespace App\Listeners\Subscription;

use App\Contracts\Unisender;
use App\Events\Subscription\Subscribed;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSubscriberToMailingService implements ShouldQueue
{
    /**
     * @var Unisender
     */
    public $unisender;

    /**
     * @param Unisender $unisender
     */
    public function __construct(Unisender $unisender)
    {
        $this->unisender = $unisender;
    }

    /**
     * @param Subscribed $event
     */
    public function handle(Subscribed $event)
    {
        $subscriptions = $event->subscriber->subscriptions->pluck('name');

        $subscriptionsLists = collect($this->unisender->getLists());
        $ids = [];

        foreach ($subscriptionsLists as $subscription) {
            if($subscriptions->contains($subscription['title'])) {
                $ids[] = $subscription['id'];
                $subscriptions = $subscriptions->reject(function($name) use($subscription) {
                    return $subscription['title'] == $name;
                });
            }
        }

        foreach ($subscriptions as $subscription) {
            $list = $this->unisender->createList([
                'title' => $subscription
            ]);

            if (isset($list['id'])) {
                $ids[] = $list['id'];
            }
        }

        $this->unisender->importContacts([
            'field_names' => [
                'Name', 'locale', 'email', 'email_status', 'email_list_ids'
            ],
            'data' => [
                [
                    $event->subscriber->name,
                    $event->subscriber->locale,
                    $event->subscriber->email,
                    $event->subscriber->receive_newsletters ? 'active' : 'unsubscribed',
                    implode(',', $ids)
                ]
            ]
        ]);
    }
}
