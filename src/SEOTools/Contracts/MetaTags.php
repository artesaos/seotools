<?php namespace Artesaos\SEOTools\Contracts;

interface MetaTags
{

    /**
     * Configuration.
     *
     * @param array
     */
    public function __construct(array $config = array());

    /**
     * Generates meta tags.
     *
     * @return string
     */
    public function generate();

    /**
     * Set the title.
     *
     * @param string $title
     *
     * @return MetaTags
     */
    public function setTitle($title);

    /**
     * Set the title seperator.
     *
     * @param string $separator
     *
     * @return MetaTags
     */
    public function setTitleSeparator($separator);

    /**
     * Set the description.
     *
     * @param string $description
     *
     * @return MetaTags
     */
    public function setDescription($description);

    /**
     * Sets the list of keywords, you can send an array or string separated with commas
     * also clears the previously set keywords.
     *
     * @param array $keywords
     *
     * @return MetaTags
     */
    public function setKeywords($keywords);

    /**
     * Add a keyword.
     *
     * @param string|array $keyword
     *
     * @return MetaTags
     */
    public function addKeyword($keyword);

    /**
     * Remove a metatag.
     *
     * @param string $key
     *
     * @return MetaTags
     */
    public function removeMeta($key);

    /**
     * Add a custom meta tag.
     *
     * @param string|array $meta
     * @param string $value
     * @param string $name
     *
     * @return MetaTags
     */
    public function addMeta($meta, $value = null, $name = 'name');

    /**
     * Get the title formatted for display.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the title that was set.
     *
     * @return string
     */
    public function getTitleSession();

    /**
     * Get the title seperator that was set.
     *
     * @return string
     */
    public function getTitleSeperator();

    /**
     * Get all metatags
     *
     * @return array
     */
    public function getMetatags();

    /**
     * Get the Meta keywords.
     *
     * @return array
     */
    public function getKeywords();

    /**
     * Get the Meta description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Reset all data.
     *
     * @return void
     */
    public function reset();
}
