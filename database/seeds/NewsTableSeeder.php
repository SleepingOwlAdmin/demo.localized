<?php

use App\Models\Attachment;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('news');

        factory(News::class, 20)->create()->each(function(News $news) {
            factory(Attachment::class, 2)->make()->each(function(Attachment $attachment) use($news) {
                $attachment->upload(fake_image(), 'news');
                $news->attachments()->save($attachment);
            });
        });
    }
}
