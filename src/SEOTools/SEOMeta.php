<?php namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\MetaTagsContracts;

class SEOMeta implements MetaTagsContracts
{

    public function __construct(array $defaults = array(), array $webmaster = array())
    {
        // TODO: Implement __construct() method.
    }

    /**
     * Generates meta tags
     *
     * @return string
     */
    public function generate()
    {
        // TODO: Implement generate() method.
    }

    /**
     * Sets the title
     *
     * @param string $title
     *
     * @return MetaTagsContracts
     */
    public function setTitle($title)
    {
        // TODO: Implement setTitle() method.
    }

    /**
     * @param string $description
     *
     * @return MetaTagsContracts
     */
    public function setDescription($description)
    {
        // TODO: Implement setDescription() method.
    }

    /**
     * Sets the list of keywords, you can send an array or string separated with commas
     * also clears the previously set keywords
     *
     * @param string|array $keywords
     *
     * @return MetaTagsContracts
     */
    public function setKeywords($keywords)
    {
        // TODO: Implement setKeywords() method.
    }

    /**
     * Add a keyword
     *
     * @param string|array $keyword
     *
     * @return MetaTagsContracts
     */
    public function addKeyword($keyword)
    {
        // TODO: Implement addKeyword() method.
    }

    /**
     * Add a custom meta tag.
     *
     * @param string $meta
     * @param string $value
     * @param string $name
     *
     * @return MetaTagsContracts
     */
    public function addMeta($meta, $value = null, $name = 'name')
    {
        // TODO: Implement addMeta() method.
    }

    /**
     * Takes the title formatted for display
     *
     * @return string
     */
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    /**
     * takes the title that was set
     *
     * @return string
     */
    public function getTitleSession()
    {
        // TODO: Implement getTitleSession() method.
    }

    /**
     * Get the Meta keywords.
     *
     * @return string
     */
    public function getKeywords()
    {
        // TODO: Implement getKeywords() method.
    }

    /**
     * Get the Meta description.
     *
     * @return string
     */
    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

    /**
     * Reset all data.
     *
     * @return void
     */
    public function reset()
    {
        // TODO: Implement reset() method.
    }

    /**
     * Get a default value of configuration.
     *
     * @param string $default
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getDefault($default)
    {
        // TODO: Implement getDefault() method.
    }
}