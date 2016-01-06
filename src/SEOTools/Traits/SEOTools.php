<?php

namespace Artesaos\SEOTools\Traits;

use Artesaos\SEOTools\Contracts\SEOFriendly;

trait SEOTools
{
    /**
     * @return \Artesaos\SEOTools\Contracts\SEOTools
     */
    protected function seo()
    {
        return app('seotools');
    }

    /**
     * @param SEOFriendly $friendly
     *
     * @return \Artesaos\SEOTools\Contracts\SEOTools
     */
    protected function loadSEO(SEOFriendly $friendly)
    {
        $SEO = $this->seo();

        $friendly->loadSEO($SEO);

        return $SEO;
    }
}
