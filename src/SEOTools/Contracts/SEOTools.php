<?php

namespace Artesaos\SEOTools\Contracts;

/**
 * SEOTools.
 *
 * @author `Vinicius Reis`
 */
interface SEOTools
{
    /**
     * @return \Artesaos\SEOTools\Contracts\MetaTags
     */
    public function metatags();

    /**
     * @return \Artesaos\SEOTools\Contracts\OpenGraph
     */
    public function opengraph();

    /**
     * @return \Artesaos\SEOTools\Contracts\TwitterCards
     */
    public function twitter();

    /**
     * @return \Artesaos\SEOTools\Contracts\JsonLd
     */
    public function jsonLd();

    /**
     * Setup title for all seo providers.
     *
     * @param string $title
     * @param bool   $appendDefault
     *
     * @return static
     */
    public function setTitle($title, $appendDefault = true);

    /**
     * Setup description for all seo providers.
     *
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description);

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     *
     * @return static
     */
    public function setCanonical($url);

    /**
     * Add one or more images urls.
     *
     * @param array|string $urls
     *
     * @return static
     */
    public function addImages($urls);

    /**
     * Get current title from metatags.
     *
     * @param bool $session
     *
     * @return string
     */
    public function getTitle($session = false);

    /**
     * Generate from all seo providers.
     *
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false);
}
