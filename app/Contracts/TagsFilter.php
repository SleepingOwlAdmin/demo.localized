<?php

namespace App\Contracts;

interface TagsFilter
{
    /**
     * @param string $html
     * @param string $allowedTags
     * @return string
     */
    public function filter(string $html = null, string $allowedTags = null): string;
}