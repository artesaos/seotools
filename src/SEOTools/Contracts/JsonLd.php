<?php

namespace Artesaos\SEOTools\Contracts;

interface JsonLd
{
    /**
     * @param array $defaults
     */
    public function __construct(array $defaults = []);

    /**
     * @param bool $minify
     * 
     * @return string
     */
    public function generate($minify = false);

    /**
     * @param string       $key
     * @param string|array $value
     *
     * @return JsonLd
     */
    public function addValue($key, $value);

    /**
     * @param string $type
     *
     * @return JsonLd
     */
    public function setType($type);

    /**
     * @param string $title
     *
     * @return JsonLd
     */
    public function setTitle($title);

    /**
     * @param string $site
     *
     * @return JsonLd
     */
    public function setSite($site);

    /**
     * @param string $description
     *
     * @return JsonLd
     */
    public function setDescription($description);

    /**
     * @param string $url
     *
     * @return JsonLd
     */
    public function setUrl($url);

    /**
     * @param string|array $image
     *
     * @return JsonLd
     */
    public function addImage($image);

    /**
     * @param string|array $images
     *
     * @return JsonLd
     */
    public function setImages($images);
}
