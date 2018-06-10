<?php

namespace App\Http\Controllers;

use App\Models\Page;
use KodiCMS\Assets\Contracts\MetaInterface as Meta;

class PagesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Meta $meta
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta, Page $page)
    {
        abort_if(!$page->isPublished(), 404);

        $meta->setTitle($page->meta_title)
            ->setMetaDescription($page->meta_description)
            ->setMetaKeywords($page->meta_keywords);

        return view('pages.show', compact('page'));
    }
}
