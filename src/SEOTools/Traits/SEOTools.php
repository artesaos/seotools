<?php

namespace Tsawler\SEOTools\Traits;

use Tsawler\SEOTools\Contracts\SEOFriendly;

trait SEOTools
{
    /**
     * @return \Tsawler\SEOTools\Contracts\SEOTools
     */
    protected function seo()
    {
        return app('seotools');
    }

    /**
     * @param SEOFriendly $friendly
     *
     * @return \Tsawler\SEOTools\Contracts\SEOTools
     */
    protected function loadSEO(SEOFriendly $friendly)
    {
        $SEO = $this->seo();

        $friendly->loadSEO($SEO);

        return $SEO;
    }
}
