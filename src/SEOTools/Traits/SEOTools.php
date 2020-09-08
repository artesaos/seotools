<?php

namespace Apility\SEOTools\Traits;

use Apility\SEOTools\Contracts\SEOFriendly;

trait SEOTools
{
    /**
     * @return \Apility\SEOTools\Contracts\SEOTools
     */
    protected function seo()
    {
        return app('seotools');
    }

    /**
     * @param SEOFriendly $friendly
     *
     * @return \Apility\SEOTools\Contracts\SEOTools
     */
    protected function loadSEO(SEOFriendly $friendly)
    {
        $SEO = $this->seo();

        $friendly->loadSEO($SEO);

        return $SEO;
    }
}
