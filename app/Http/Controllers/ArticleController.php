<?php

namespace App\Http\Controllers;

use App\Models\Article;
use KodiCMS\Assets\Contracts\MetaInterface as Meta;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     *
     * @param Meta $meta
     * @return \Illuminate\Http\Response
     */
    public function index(Meta $meta)
    {
        $meta->setTitle(trans('portal.articles.title.articles'));

        $articles = Article::published()->latest()->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     *
     * @param Meta $meta
     * @param  \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta, Article $article)
    {
        abort_if(!$article->isPublished(), 404);

        $meta->setTitle($article->meta_title)
            ->setMetaDescription($article->meta_description)
            ->setMetaKeywords($article->meta_keywords);

        $meta->addSocialTags($article);

        return view('articles.show', compact('article'));
    }
}
