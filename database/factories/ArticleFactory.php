<?php

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {

    $fakerRu = \Faker\Factory::create('ru_RU');

    return [
        'image' => fake_image(),
        'is_private' => $faker->boolean(20),
        'is_draft' => $faker->boolean(20),
        'created_at' => $faker->dateTime,
        'en' => [
            'meta_title' => $faker->sentence,
            'meta_keywords' => $faker->sentence,
            'meta_description' => $faker->sentence,
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'text' => $faker->paragraph(10)
        ],
        'ru' => [
            'meta_title' => $faker->sentence,
            'meta_keywords' => $faker->sentence,
            'meta_description' => $faker->sentence,
            'title' => $fakerRu->sentence,
            'description' => $fakerRu->paragraph,
            'text' => $fakerRu->paragraph(10)
        ]
    ];
});
