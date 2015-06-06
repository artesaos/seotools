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
     */
    public function setTitle($title);

    /**
     * Setup description for all seo providers
     *
     * @param string $title
     */
    public function setDescription($description);

    /**
     * Generate from all seo providers
     *
     * @return string
     */
    public function generate();
}