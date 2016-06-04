<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\Contracts\SEOTools;
use Artesaos\SEOTools\Tests\stubs\SeoToolsTraitStub;

/**
 * Class SeoToolsTraitTest.
 */
class SeoToolsTraitTest extends BaseTest
{
    public function test_seotools_trait()
    {
        $stub = $this->createMock(SeoToolsTraitStub::class);

        $stub->method('makeSeoForTests')
            ->willReturn($this->app['seotools']);

        $this->assertInstanceOf(SEOTools::class, $stub->makeSeoForTests());
    }
}
