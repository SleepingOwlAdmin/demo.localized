<?php

namespace App\Http\Controllers;

use App\Models\Event;
use KodiCMS\Assets\Contracts\MetaInterface as Meta;

class EventsController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @param Meta $meta
     * @return \Illuminate\Http\Response
     */
    public function index(Meta $meta)
    {
        $meta->setTitle(trans('portal.events.title.events'));

        $events = Event::published()->latest('event_at')->paginate(5);

        return view('events.index', compact('events'));
    }

    /**
     * Display the specified event.
     *
     * @param Meta $meta
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta, Event $event)
    {
        abort_if(!$event->isPublished(), 404);

        $meta->setTitle($event->meta_title)
            ->setMetaDescription($event->meta_description)
            ->setMetaKeywords($event->meta_keywords);

        $meta->addSocialTags($event);

        return view('events.show', compact('event'));
    }
}
