<?php

namespace App\Services\Unisender;

use Unisender\ApiWrapper\UnisenderApi;

class Unisender extends UnisenderApi implements \App\Contracts\Unisender
{
    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return string
     */
    public function __call($name, $arguments)
    {
        $result = parent::__call($name, $arguments);

        return array_get(json_decode($result, true), 'result');
    }
}