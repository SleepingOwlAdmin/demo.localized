<?php

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'ru' => [
                'name' => 'Ежемесячная'
            ],
            'en' => [
                'name' => 'Monthly'
            ]
        ]);

        Subscription::create([
            'ru' => [
                'name' => 'Квартальная'
            ],
            'en' => [
                'name' => 'Quarterly'
            ]
        ]);

        Subscription::create([
            'ru' => [
                'name' => 'Ежегодная'
            ],
            'en' => [
                'name' => 'Yearly'
            ]
        ]);
    }
}
