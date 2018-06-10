<?php

namespace App\Services\Html;

use App\Contracts\TagsFilter as TagsFilterContract;
use HTMLPurifier;

class TagsFilter implements TagsFilterContract
{
    /**
     * @var HTMLPurifier
     */
    private $purifier;

    /**
     * TagsFilter constructor.
     * @param HTMLPurifier $purifier
     */
    public function __construct(HTMLPurifier $purifier)
    {
        $this->purifier = $purifier;
    }

    /**
     * @param string $html
     * @param string $allowedTags
     * @return string
     */
    public function filter(string $html = null, string $allowedTags = null): string
    {
        if (!empty($allowedTags)) {
            $config = \HTMLPurifier_Config::createDefault();

            $config->set(
                'HTML.AllowedElements',
                $allowedTags
            );

            $this->purifier->config = $config;
        }

        return $this->purifier->purify($html);
    }
}