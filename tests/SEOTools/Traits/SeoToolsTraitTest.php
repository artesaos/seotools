<?php

namespace Tsawler\SEOTools\Tests;

use Tsawler\SEOTools\Contracts\SEOTools;
use Tsawler\SEOTools\Tests\stubs\SeoToolsTraitStub;
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
