<?php

namespace Artesaos\SEOTools\Tests;

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
                'Artesaos\SEOTools\Contracts\MetaTags',
                'Artesaos\SEOTools\SEOMeta',
            ],
            [
                'Artesaos\SEOTools\Contracts\OpenGraph',
                'Artesaos\SEOTools\OpenGraph',
            ],
            [
                'Artesaos\SEOTools\Contracts\SEOTools',
                'Artesaos\SEOTools\SEOTools',
            ],
            [
                'Artesaos\SEOTools\Contracts\TwitterCards',
                'Artesaos\SEOTools\TwitterCards',
            ],
        ];
    }
}
