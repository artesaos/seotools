<?php namespace Artesaos\SEOTools\Contracts;

/**
 * SEOTools
 *
 * @package SEOTools
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
      * Setup title for all seo providers
      * 
      * @param string $title
      *
      * @return  \Artesaos\SEOTools\Contracts\SEOTools
     */
    public function setTitle($title);

    /**
     * Setup description for all seo providers
     *
     * @param string $title
     *
     * @return \Artesaos\SEOTools\Contracts\SEOTools
     */
    public function setDescription($description);

    /**
     * Add one or more images urls
     *
     * @param array|string $urls
     *
     * @return \Artesaos\SEOTools\Contracts\SEOTools
     */
    public function addImages($urls);

    /**
     * Generate from all seo providers
     *
     * @return string
     */
    public function generate();
}