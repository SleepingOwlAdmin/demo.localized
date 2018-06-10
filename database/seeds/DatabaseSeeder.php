<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('attachment');

        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);

        $files = File::files(storage_path('framework/tmp'));
        File::delete($files);
    }
}
