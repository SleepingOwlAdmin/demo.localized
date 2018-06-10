<?php

use Illuminate\Http\UploadedFile;

/**
 * @param \Carbon\Carbon $date
 * @return string
 */
function format_date(\Carbon\Carbon $date = null): ?string
{
    if (!$date) {
        return null;
    }

    return $date->format('d.m.Y');
}

/**
 * @return UploadedFile
 */
function fake_image(): UploadedFile
{
    $faker = \Faker\Factory::create();

	$image = $faker->file(database_path('seeds/files'), storage_path('framework/tmp'));

    $ext = pathinfo($image, PATHINFO_EXTENSION);

    return new \Illuminate\Http\Testing\File(
        $faker->uuid . '.' . $ext,
        tap(tmpfile(), function ($temp) use($image) {
            fwrite($temp, file_get_contents($image));
        })
    );
}