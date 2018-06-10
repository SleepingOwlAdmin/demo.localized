<?php

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('banner');

        factory(Banner::class, 5)->create();
        factory(Banner\Sidebar::class, 3)->create();
    }
}
