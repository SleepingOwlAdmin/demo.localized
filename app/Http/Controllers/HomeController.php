<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Event;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::published()->with('icon')->get();

        $latestNews = News::published()->latest()->take(3)->get();
        $latestArticles = Article::published()->latest()->take(3)->get();
        $latestEvents = Event::published()->latest('event_at')->take(3)->get();

        return view('home.index', compact('banners', 'latestNews', 'latestArticles', 'latestEvents'));
    }
}
