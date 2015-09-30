<?php namespace Artesaos\SEOTools\Contracts;

interface SitemapEntry
{
    /**
     * @return \Sitemap\Sitemap\SitemapEntry
     */
    public function getSitemapEntry();

    /**
     * Get URL
     *
     * @return string
     */
    public function getLocation();
}