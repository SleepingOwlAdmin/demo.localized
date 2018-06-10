<?php

// Admin login
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::localizedGroup(function () {

    // News
    Route::get('news/{news}', 'NewsController@show')->name('news.show');
    Route::get('news', 'NewsController@index')->name('news.index');

    // Articles
    Route::get('learntea/{article}', 'ArticleController@show')->name('article.show');
    Route::get('learntea', 'ArticleController@index')->name('article.index');

    // Activities
    Route::get('activities/{event}', 'EventsController@show')->name('event.show');
    Route::get('activities', 'EventsController@index')->name('event.index');

    // Home
    Route::get('/', 'HomeController@index')->name('home');
});