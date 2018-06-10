<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param string $name
     * @return string
     */
    protected function route(string $name): string
    {
        return \LaravelLocalization::getLocalizedURL('en', route($name));
    }
}
