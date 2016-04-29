<?php

namespace Artesaos\SEOTools\Tests;

use Mockery as m;

/**
 * Class SEOToolsServiceProviderTest
 */
class SEOToolsServiceProviderTest extends BaseTest
{

    /**
     * Verify if classes are in service container.
     */
    public function test_container_are_provided()
    {
        $this->assertInstanceOf(
            \Artesaos\SEOTools\Contracts\MetaTags::class,
            $this->app[\Artesaos\SEOTools\SEOMeta::class]
        );
    }

}
