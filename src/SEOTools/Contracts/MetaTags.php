<?php

namespace Artesaos\SEOTools\Contracts;

interface MetaTags
{
    /**
     * Configuration.
     *
     * @param array
     */
    public function __construct(array $config = []);

    /**
     * Generates meta tags.
     * 
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false);

    /**
     * Set the title.
     *
     * @param string $title
     * @param bool   $appendDefault
     *
     * @return MetaTags
     */
    public function setTitle($title, $appendDefault = true);

    /**
     * Sets the default title tag.
     *
     * @param string $default
     *
     * @return MetaTags
     */
    public function setTitleDefault($default);

    /**
     * Set the title separator.
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
     * @param string       $value
     * @param string       $name
     *
     * @return MetaTags
     */
    public function addMeta($meta, $value = null, $name = 'name');

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     *
     * @return MetaTags
     */
    public function setCanonical($url);

    /**
     * Sets the prev URL.
     *
     * @param string $url
     *
     * @return MetaTags
     */
    public function setPrev($url);

    /**
     * Sets the next URL.
     *
     * @param string $url
     *
     * @return MetaTags
     */
    public function setNext($url);

    /**
     * Add an alternate language.
     *
     * @param string $lang language code in format ISO 639-1
     * @param string $url
     */
    public function addAlternateLanguage($lang, $url);

    /**
     * Add alternate languages.
     *
     * @param array $languages
     *
     * @return MetaTags
     */
    public function addAlternateLanguages(array $languages);

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
     * Get the title separator that was set.
     *
     * @return string
     */
    public function getTitleSeparator();

    /**
     * Get all metatags.
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
     * Get the canonical URL.
     *
     * @return string
     */
    public function getCanonical();

    /**
     * Get the prev URL.
     *
     * @return string
     */
    public function getPrev();

    /**
     * Get the next URL.
     *
     * @return string
     */
    public function getNext();

    /**
     * Get alternate languages.
     *
     * @return array
     */
    public function getAlternateLanguages();

    /**
     * Takes the default title.
     *
     * @return string
     */
    public function getDefaultTitle();

    /**
     * Reset all data.
     *
     * @return void
     */
    public function reset();
}
