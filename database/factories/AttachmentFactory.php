<?php

use App\Models\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker) {
    return [
        'title'=> $faker->sentence,
        'description' => $faker->paragraph(2),
        'is_private' => $faker->boolean(20),
    ];
});
