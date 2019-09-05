<?php

namespace Artesaos\SEOTools\Contracts;

/**
 * JsonLd defines contract for the JSON Linked Data container.
 *
 * Usage example:
 *
 * ```php
 * use Artesaos\SEOTools\JsonLd; // implements `Artesaos\SEOTools\Contracts\JsonLd`
 *
 * $jsonLd = new JsonLd();
 *
 * // specify JSON data
 * $jsonLd->setName('Home');
 * $jsonLd->setDescription('This is my page description');
 * $jsonLd->addValue('author', [
 *     '@type' => 'Organization',
 *     'name' => 'Artesaos',
 * ]));
 *
 * // render HTML, it should be placed within 'head' HTML tag
 * echo $jsonLd->generate();
 * ```
 *
 * Implementation of this contract is available via {@see \Artesaos\SEOTools\Facades\JsonLd} facade.
 * Facade usage example:
 *
 * ```php
 * use Artesaos\SEOTools\Facades\JsonLd;
 *
 * // specify JSON data
 * JsonLd::setName('Homepage');
 * JsonLd::setDescription('This is my page description');
 * JsonLd::addValue('author', [
 *     '@type' => 'Organization',
 *     'name' => 'Artesaos',
 * ]));
 *
 * // render HTML, it should be placed within 'head' HTML tag
 * echo JsonLd::generate();
 * ```
 *
 * @see https://json-ld.org/
 * @see \Artesaos\SEOTools\JsonLd
 * @see \Artesaos\SEOTools\Facades\JsonLd
 */
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
     * @param array $values
     *
     * @return static
     */
    public function addValues(array $values);

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
     * @param string|null|bool $url
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
