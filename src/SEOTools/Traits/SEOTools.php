<?php namespace Artesaos\SEOTools\Traits;

trait SEOTools
{
    /**
     * @return \Artesaos\SEOTools\Contracts\SEOTools
     */
    protected function seo()
    {
        return app('seotools');
    }
}