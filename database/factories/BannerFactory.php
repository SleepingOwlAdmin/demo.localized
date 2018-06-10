<?php

use App\Models\Banner;
use Faker\Generator as Faker;

$factory->define(Banner::class, function (Faker $faker) {
    return [
        'link' => $faker->url,
        'image' => fake_image(),
        'icon_id' => function () {
            return factory(Banner\Icon::class)->create()->id;
        },
        'alignment' => $faker->randomElement((new Banner)->alignments()),
        'color' => $faker->hexColor,
        'is_draft' => $faker->boolean(20),
        'en' => [
            'text' => $faker->paragraph(2)
        ],
        'ru' => [
            'text' => $faker->paragraph(2)
        ]
    ];
});

$factory->define(Banner\Icon::class, function (Faker $faker) {
    return [
        'image' => fake_image(),
        'name' => $faker->word
    ];
});

$factory->define(Banner\Sidebar::class, function (Faker $faker) {
    return [
        'en' => [
            'image' => fake_image(),
            'link' => $faker->url
        ],
        'ru' => [
            'image' => fake_image(),
            'link' => $faker->url
        ]
    ];
});