<?php

namespace Artesaos\SEOTools\Tests;

use Artesaos\SEOTools\Contracts\MetaTags;
use Artesaos\SEOTools\SEOMeta;

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
            MetaTags::class,
            $this->app[SEOMeta::class]
        );
    }

}
