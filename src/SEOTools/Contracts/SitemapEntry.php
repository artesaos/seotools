<?php namespace Artesaos\SEOTools\Contracts;

interface SitemapEntry
{
    /**
     * @return \Sitemap\Sitemap\SitemapEntry
     */
    public function getSitemapEntry();

    /**
     * @return string
     */
    public function getLocation();
}