<?php

use App\Models\Article;
use App\Models\Attachment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('article');

        factory(Article::class, 20)->create()->each(function (Article $article) {
            factory(Attachment::class, 2)->make()->each(function(Attachment $attachment) use($article) {
                $attachment->upload(fake_image(), 'article');
                $article->attachments()->save($attachment);
            });
        });
    }
}
