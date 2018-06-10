<?php

namespace App\Http\Controllers;

use App\Models\News;
use KodiCMS\Assets\Contracts\MetaInterface as Meta;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     *
     * @param Meta $meta
     * @return \Illuminate\Http\Response
     */
    public function index(Meta $meta)
    {
        $meta->setTitle(trans('portal.news.title.news'));

        $news = News::published()->latest()->paginate(20);

        return view('news.index', compact('news'));
    }

    /**
     * Display the specified news.
     *
     * @param Meta $meta
     * @param  \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta, News $news)
    {
        abort_if(!$news->isPublished(), 404);

        $meta->setTitle($news->meta_title)
            ->setMetaDescription($news->meta_description)
            ->setMetaKeywords($news->meta_keywords);

        $meta->addSocialTags($news);

        return view('news.show', compact('news'));
    }
}
