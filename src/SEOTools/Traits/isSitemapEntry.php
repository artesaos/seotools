<?php namespace Artesaos\SEOTools\Traits;

use Sitemap\Sitemap\SitemapEntry;

trait isSitemapEntry
{
    /**
     * @return SitemapEntry
     */
    public function getSitemapEntry()
    {
        $url = $this->getLocation();

        return new SitemapEntry($url, $this->update_at, $this->changeFreq, $this->priority);
    }
}