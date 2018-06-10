<?php

use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'ru' => [
            'name' => $faker->word,
            'description' => $faker->paragraph()
        ],
        'en' => [
            'name' => $faker->word,
            'description' => $faker->paragraph()
        ]
    ];
});
