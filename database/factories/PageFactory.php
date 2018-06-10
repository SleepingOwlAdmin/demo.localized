<?php

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'is_private' => $faker->boolean(20),
        'menu' => $faker->boolean,
        'order' => $faker->randomNumber(2),
        'slug' => $faker->sentence,
        'is_draft' => $faker->boolean(20),
        'en' => [
            'meta_title' => $faker->sentence,
            'meta_keywords' => $faker->sentence,
            'meta_description' => $faker->sentence,
            'title' => $faker->sentence,
            'html' => $faker->paragraph(10)
        ],
        'ru' => [
            'meta_title' => $faker->sentence,
            'meta_keywords' => $faker->sentence,
            'meta_description' => $faker->sentence,
            'title' => $faker->sentence,
            'html' => $faker->paragraph(10)
        ]
    ];
});
