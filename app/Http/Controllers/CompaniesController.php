<?php

namespace App\Http\Controllers;

use App\Models\Company;
use KodiCMS\Assets\Contracts\MetaInterface as Meta;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Meta $meta
     * @return void
     */
    public function index(Meta $meta)
    {
        $meta->setTitle(trans('portal.companies.title.companies'));

        $companies = Company::verified()->get();

        return view('companies.index', compact('companies'));
    }

    /**
     * Display the specified resource.
     *
     * @param Meta $meta
     * @param  \App\Models\Company $company
     * @return void
     */
    public function show(Meta $meta, Company $company)
    {
        abort_if(!$company->isVerified(), 404);

        $meta->setTitle($company->name);

        $meta->addSocialTags($company);

        return view('companies.show', compact('company'));
    }
}
