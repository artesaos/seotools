<?php

namespace Artesaos\SEOTools\Contracts;

/**
 * JsonLdMulti defines contract for the JSON Linked Data container.
 * Usage example:
 * ```php
 * use Artesaos\SEOTools\JsonLdMulti; // implements `Artesaos\SEOTools\Contracts\JsonLdMulti`
 * $jsonLdMulti = new JsonLdMulti();
 * // specify JSON data
 * $jsonLdMulti->setTitle('Home');
 * $jsonLdMulti->setDescription('This is my page description');
 * $jsonLdMulti->addValue('author', [
 *     '@type' => 'Organization',
 *     'name' => 'Artesaos',
 * ]));
 * $jsonLdMulti->newJsonLd();
 * $jsonLdMulti->setTitle('Homepage');
 * $jsonLdMulti->setType('Product');
 * // render HTML, it should be placed within 'head' HTML tag
 * echo $jsonLd->generate();
 * ```
 * Implementation of this contract is available via {@see \Artesaos\SEOTools\Facades\JsonLdMulti} facade.
 * Facade usage example:
 * ```php
 * use Artesaos\SEOTools\Facades\JsonLdMulti;
 * // specify JSON data
 * JsonLdMulti::setTitle('Home');
 * JsonLdMulti::setDescription('This is my page description');
 * JsonLdMulti::addValue('author', [
 *     '@type' => 'Organization',
 *     'name' => 'Artesaos',
 * ]));
 * JsonLdMulti::newJsonLd();
 * JsonLdMulti::setTitle('Homepage');
 * JsonLdMulti::setType('Product');
 * // render HTML, it should be placed within 'head' HTML tag
 * echo JsonLdMulti::generate();
 * ```
 *
 * @see https://json-ld.org/
 * @see \Artesaos\SEOTools\JsonLdMulti
 * @see \Artesaos\SEOTools\Facades\JsonLdMulti
 */
interface JsonLdMulti
{
    /**
     * JsonLdMulti constructor.
     *
     * @param array $defaultJsonLdData
     */
    public function __construct(array $defaultJsonLdData = []);

    /**
     * Generates linked data script tag.
     *
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false);

    /**
     * Create a new JsonLd group and increment the selector to target it
     *
     * @return static
     */
    public function newJsonLd();

    /**
     *  Check if the current JsonLd group is empty
     *
     * @return static
     */
    public function isEmpty();

    /**
     * Target a JsonLd group that will be edited in the next methods
     *
     * @param int $index
     *
     * @return static
     */
    public function select($index);

    /**
     * @param string $key
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
