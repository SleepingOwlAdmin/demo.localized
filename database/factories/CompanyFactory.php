<?php

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company\Type::class, function (Faker $faker) {
    return [
        'ru' => [
            'name' => $faker->word
        ],
        'en' => [
            'name' => $faker->word
        ],
    ];
});

$factory->define(Company::class, function (Faker $faker) {
    $company = $faker->company;
    return [
        'type_id' => function() {
            return factory(Company\Type::class)->create()->id;
        },
        'logo' => fake_image(),
        'email' => $faker->companyEmail,
        'phone' => $faker->phoneNumber,
        'login' => $faker->userName,
        'verified' => $faker->boolean(80),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'ru' => [
            'name' => $company,
            'description' => $faker->paragraph,
            'text' => $faker->paragraph(10),
            'contacts' => $faker->paragraph,
        ],
        'en' => [
            'name' => $company,
            'description' => $faker->paragraph,
            'text' => $faker->paragraph(10),
            'contacts' => $faker->paragraph,
        ],
    ];
});
