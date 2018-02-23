<?php

namespace Tsawler\SEOTools\Tests;

/**
 * Class SEOToolsServiceProviderTest.
 */
class SEOToolsServiceProviderTest extends BaseTest
{
    /**
     * Verify if classes are in service container.
     *
     * @dataProvider bindsListProvider
     *
     * @param string $contract
     * @param string $concreteClass
     */
    public function test_container_are_provided($contract, $concreteClass)
    {
        $this->assertInstanceOf(
            $contract,
            $this->app[$concreteClass]
        );
    }

    /**
     * @return array
     */
    public function bindsListProvider()
    {
        return [
            [
                'Tsawler\SEOTools\Contracts\MetaTags',
                'Tsawler\SEOTools\SEOMeta',
            ],
            [
                'Tsawler\SEOTools\Contracts\OpenGraph',
                'Tsawler\SEOTools\OpenGraph',
            ],
            [
                'Tsawler\SEOTools\Contracts\SEOTools',
                'Tsawler\SEOTools\SEOTools',
            ],
            [
                'Tsawler\SEOTools\Contracts\TwitterCards',
                'Tsawler\SEOTools\TwitterCards',
            ],
        ];
    }
}
