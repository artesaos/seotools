<?php namespace Artesaos\SEOTools\Contracts;

interface OpenGraph
{
    /**
     * @param array $config
     */
    public function __construct(array $config = array());

    /**
     * Generates open graph tags.
     *
     * @return string
     */
    public function generate();

    /**
     * Add or update property.
     *
     * @param string $key
     * @param string|array $value
     *
     * @return OpenGraph
     */
    public function addProperty($key, $value);

    /**
     * Remove property.
     *
     * @param string $key
     *
     * @return OpenGraph
     */
    public function removeProperty($key);

    /**
     * Add image to properties.
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function addImage($url);

    /**
     * Add images to properties.
     *
     * @param array $urls
     *
     * @return OpenGraph
     */
    public function addImages(array $urls);

    /**
     * Define title property.
     *
     * @param $title
     *
     * @return OpenGraph
     */
    public function setTitle($title);

    /**
     * Define description property.
     *
     * @param string $description
     *
     * @return OpenGraph
     */
    public function setDescription($description);

    /**
     * Define url property.
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function setUrl($url);

    /**
     * Define site_name property
     *
     * @param string $name
     *
     * @return OpenGraph
     */
    public function setSiteName($name);
}
