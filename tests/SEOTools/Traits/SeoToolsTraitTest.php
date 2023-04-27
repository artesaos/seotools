<?php

namespace Artesaos\SEOTools\Tests\Traits;

use Artesaos\SEOTools\Contracts\SEOTools;
use Artesaos\SEOTools\Tests\stubs\SeoToolsTraitStub;
use Artesaos\SEOTools\Tests\BaseTest;
use Mockery as m;

/**
 * Class SeoToolsTraitTest.
 */
class SeoToolsTraitTest extends BaseTest
{
    public function test_seotools_trait()
    {
        $stub = m::mock(SeoToolsTraitStub::class);

        $stub->shouldReceive('makeSeoForTests')
            ->andReturn($this->app['seotools']);

        $this->assertInstanceOf(SEOTools::class, $stub->makeSeoForTests());
    }
}
