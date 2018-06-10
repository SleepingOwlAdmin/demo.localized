<?php

use App\Models\Attachment;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('event');

        factory(Event::class, 20)->create()->each(function(Event $event) {
            factory(Attachment::class, 2)->make()->each(function(Attachment $attachment) use($event) {
                $attachment->upload(fake_image(), 'event');
                $event->attachments()->save($attachment);
            });
        });
    }
}
