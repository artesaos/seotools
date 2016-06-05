<?php

namespace Artesaos\SEOTools\Tests\stubs;
use Artesaos\SEOTools\Traits\SEOTools;

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
