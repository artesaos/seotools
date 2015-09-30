<?php

namespace Artesaos\SEOTools;

use Sitemap\Collection as SitemapCollection;
use Sitemap\Formatter;
use Sitemap\Sitemap\SitemapEntry;
use Sitemap\Formatter\XML\SitemapIndex as SitemapIndexFormatter;
use Artesaos\SEOTools\Contracts\SitemapEntry as SitemapEntryContract;

class Sitemap {

    /**
     * @var SitemapCollection
     */
    protected $collection;

    /**
     * @var Formatter
     */
    protected $formatter;

    public function __construct()
    {
        $this->collection = new SitemapCollection();
    }

    /**
     * @param SitemapEntry $entry
     *
     * @return Sitemap
     */
    public function addEntry(SitemapEntry $entry)
    {
        $this->collection->addSitemap($entry);

        return $this;
    }

    /**
     * @param SitemapEntryContract $entry
     *
     * @return Sitemap
     */
    public function add(SitemapEntryContract $entry)
    {
        return $this->addEntry($entry->getSitemapEntry());
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $this->collection->setFormatter($this->formatter);

        return $this->collection->output();
    }

    /**
     * @param Formatter $formatter
     *
     * @return Sitemap
     */
    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * If formatter is not defined, define formatter
     */
    protected function loadFormatter()
    {
        if(is_null($this->formatter))
        {
            $this->setFormatter(new SitemapIndexFormatter());
        }
    }
}