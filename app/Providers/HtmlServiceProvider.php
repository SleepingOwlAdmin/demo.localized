<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('error', 'form.error', ['field']);
        Form::component('captcha', 'form.recaptcha', []);
        Form::component('bsText', 'form.text', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'form.password', ['name', 'label', 'attributes' => []]);
        Form::component('bsTextarea', 'form.textarea', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('bsEmail', 'form.email', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('bsSelect', 'form.select', ['name', 'label', 'options', 'value' => null, 'attributes' => []]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
