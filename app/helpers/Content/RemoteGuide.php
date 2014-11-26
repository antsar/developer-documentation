<?php

namespace helpers\Content;

/**
 * Guide on an external URL (e.g. the blog).
 */
class RemoteGuide implements MenuItem
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getMenuTitle()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMenuUrl()
    {
        return $this->url;
    }

    /**
     * @return MenuItem[]
     */
    public function getSubItems()
    {
        return [];
    }
}