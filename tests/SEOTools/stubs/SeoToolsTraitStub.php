<?php

namespace Tsawler\SEOTools\Tests\stubs;
use Tsawler\SEOTools\Traits\SEOTools;

/**
 * Class SeoToolsTraitStub
 */
class SeoToolsTraitStub
{
    use SEOTools;

    public function makeSeoForTests()
    {
        return $this->seo();
    }
}
