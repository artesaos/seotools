<?php

namespace Artesaos\SEOTools\Contracts;

/**
 * TwitterCards defines contract for the "TwitterCard" meta tags container.
 *
 * "TwitterCard" meta tags are used by Twitter during the "sharing" process.
 *
 * Usage example:
 *
 * ```php
 * use Artesaos\SEOTools\TwitterCards; // implements `Artesaos\SEOTools\Contracts\TwitterCards`
 *
 * $twitterCards = new TwitterCards();
 *
 * // specify meta info
 * $twitterCards->setTitle('Home');
 * $twitterCards->setUrl('http://current.url.com');
 * $twitterCards->addValue('app:country', 'US');
 *
 * // render HTML, it should be placed within 'head' HTML tag
 * echo $twitterCards->generate();
 * ```
 *
 * Implementation of this contract is available via {@see \Artesaos\SEOTools\Facades\TwitterCard} facade.
 * Facade usage example:
 *
 * ```php
 * use Artesaos\SEOTools\Facades\TwitterCard;
 *
 * // specify meta info
 * TwitterCard::setTitle('Home');
 * TwitterCard::setUrl('http://current.url.com');
 * TwitterCard::addValue('app:country', 'US');
 *
 * // render HTML, it should be placed within 'head' HTML tag
 * echo TwitterCard::generate();
 * ```
 *
 * @see https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/abouts-cards
 * @see \Artesaos\SEOTools\TwitterCards
 * @see \Artesaos\SEOTools\Facades\TwitterCard
 */
interface TwitterCards
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
