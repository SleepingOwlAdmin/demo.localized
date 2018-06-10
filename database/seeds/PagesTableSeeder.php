<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page::class)->create([
            'is_private' => false,
            'is_draft' => false,
            'slug' => 'about',
            'menu' => true,
            'order' => 2,
            'ru' => [
                'title' => 'О нас'
            ],
            'en' => [
                'title' => 'About'
            ]
        ]);

        factory(Page::class)->create([
            'is_private' => false,
            'is_draft' => false,
            'slug' => 'contacts',
            'menu' => true,
            'order' => 1,
            'ru' => [
                'title' => 'Контакты'
            ],
            'en' => [
                'title' => 'Contacts'
            ]
        ]);
    }
}
