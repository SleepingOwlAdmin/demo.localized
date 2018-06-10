<?php

namespace App\Models\Traits;

trait SocialTags
{
    /**
     * @return string
     */
    public function getOgTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getOgDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getOgImage()
    {
        return $this->image_url;
    }

    /**
     * @return string
     */
    public function getOgType()
    {
        return 'article';
    }

    /**
     * @return string
     */
    public function getOgPublishedTime()
    {
        return $this->created_at->toIso8601String();
    }

    /**
     * @return string
     */
    public function getOgModifiedTime()
    {
        return $this->updated_at->toIso8601String();
    }

    /**
     * @return string
     */
    public function getOgTags()
    {
        return null;
    }
}