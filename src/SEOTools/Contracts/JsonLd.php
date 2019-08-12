<?php

namespace Artesaos\SEOTools\Contracts;

interface JsonLd
{
    /**
     * @param array $defaults
     */
    public function __construct(array $defaults = []);

    /**
     * Generates linked data script tag.
     *
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false);

    /**
     * @param string       $key
     * @param string|array $value
     *
     * @return static
     */
    public function addValue($key, $value);

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type);

    /**
     * @param string $title
     *
     * @return static
     */
    public function setTitle($title);

    /**
     * @param string $site
     *
     * @return static
     */
    public function setSite($site);

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description);

    /**
     * @param string $url
     *
     * @return static
     */
    public function setUrl($url);

    /**
     * @param string|array $image
     *
     * @return static
     */
    public function addImage($image);

    /**
     * @param string|array $images
     *
     * @return static
     */
    public function setImages($images);
}
