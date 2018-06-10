<?php

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {

    $fakerRu = \Faker\Factory::create('ru_RU');

    return [
        'image' => fake_image(),
        'is_private' => $faker->boolean(20),
        'is_draft' => $faker->boolean(20),
        'event_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'lat' => $faker->latitude,
        'lon' => $faker->longitude,
        'en' => [
            'meta_title' => $faker->sentence,
            'meta_keywords' => $faker->sentence,
            'meta_description' => $faker->sentence,
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'text' => $faker->paragraph(10),
            'address' => $faker->address
        ],
        'ru' => [
            'meta_title' => $faker->sentence,
            'meta_keywords' => $faker->sentence,
            'meta_description' => $faker->sentence,
            'title' => $fakerRu->sentence,
            'description' => $fakerRu->paragraph,
            'text' => $fakerRu->paragraph(10),
            'address' => $faker->address
        ]
    ];
});
